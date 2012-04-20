<?PHP
class UserHandler{
    /**
     * @author Timur Samkharadze 
     * @version 1.0.0
     * @param username - brukerens navn
     * @param dbconnection - forbindelse mot database
     * @param query - forespørsel
     * @param result - resultat av forespørsel
     * class håndterer alle operasjoner knyttet til brukere
     */
    private $username;
    private $dbconnection;
    private $query;
    private $result;
    private $email;
    private $old_password;
    private $new_password;
    /**
     *
     * @param type $_username navn av bruker
     * her opprettes forbindelse mot database
     */
    function __construct($_username) {
        include('config.php');
        $this->username = $_username;
        //$this->email = $_email;
        $this->dbconnection = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS) or die('Connection error'.PHP_EOL.mysql_error().PHP_EOL);
        //print 'Connection to server OK'.PHP_EOL;
        mysql_select_db($DB_NAME) or die('Databasen er ikke funnet på tjeneren '.$DB_SERVER);
        //print 'Connection to database '.$DB_NAME.' OK'.PHP_EOL;
    }
    /**
     *funksjpn genererer nytt midlertidig passord, legger til database og sender til brukerens epost
     * vi kjenner brukerens navn fra konstruktør og i tilleg bruker må vise epost adresse selv om vi har den
     */
    public function sendPassword($_email) {
        include('config.php');
        $this->email = $_email;
        //sjekker om bruker eksisterer i databasen
        $this->query = 'SELECT * FROM `user` WHERE username ="'.$this->username.'"';
        $this->result = mysql_query($this->query) or die('Opps something går weird: ' . mysql_error());
        if(($this->result = mysql_fetch_array($this->result, MYSQLI_NUM)) != FALSE & $this->result[0] == $this->username & $this->result[1] == $this->email) {
            //navn og epost stemmer, user found
            //skaper nytt passord
            $newPass = $this->passCreater();
            //beregner md5 hash fra nyskapt passord, bruker salting fra config.php
            $hash = md5($newPass.$SALT);
            //lagrer hash i database og sender passord til bruker
            $this->query = 'UPDATE `user` SET password_temporary="'.$hash.'" WHERE username ="'.$this->username.'"';
            mysql_query($this->query) or die(mysql_error());
            //sender nytt midlertidig passord til brukeren
            //trenger bare epost tjener for å sende epost og teste den
            mail($this->email, 'Password recovery mail from MegaBlog', 
                    'Noen har bestylt nytt passord til deres MegaBlog account, 
                        dersom det var ikke du bare bruk din gammelt passord, 
                        ellers nytt engangs passord er: '.$newPass, "From: timur.samkharadze@gmail.com");   
        }
        else {
            mysql_close($this->dbconnection);
            throw new Exception('User not found in database or email is invalid');
        } 
    }
    
    /**
     * funksjoner setter inn nytt passord til en bestemt bruker
     * @param $_old_password eksisterende passord
     * @param $_new_password nytt passord
     */
    public function changePassword($_old_password, $_new_password) {
        include('config.php');
        $this->old_password = $_old_password;
        $this->new_password = $_new_password;
        //først sjekker at passord lang nok
        if (strlen($this->new_password) < $PASS_MIN_LENGTH) {
            throw new Exception('minimum length of password is '.$PASS_MIN_LENGTH);
        }
        //sjekker om gammelt og nytt passord er like 
        if($this->old_password == $this->new_password){
            throw new Exception('old and new passwords have the same value');
        }
        //beregner hashverdi av nytt og gammelt passord
        $this->old_password = md5($this->old_password.$SALT);
        $this->new_password = md5($this->new_password.$SALT);
        //lager forespørsel
        $this->query = "SELECT * FROM `user` WHERE `username`='".$this->username."'";
        $this->result = mysql_query($this->query) or die('Opps something går weird: ' . mysql_error());
        //ser etter brukeren i resultsvar
        if(($this->result = mysql_fetch_array($this->result, MYSQLI_NUM)) != FALSE & $this->result[0] == $this->username & $this->result[2] == $this->old_password) {
            //user found, setter inn nytt passord
            $this->query = 'UPDATE `user` SET password="'.$this->new_password.'" WHERE username ="'.$this->username.'"';
            mysql_query($this->query) or die(mysql_error());
            //eventuelt sender brev til bruker med melding om nytt passord
            return true;
        }
        else {
            //user not fount kaster exception
            mysql_close($this->dbconnection);
            throw new Exception('User not found in database or password is invalid');
        }
    }
    
    /**
     *
     * @param type $_isblocked true to block or false to unblock
     */
    public function blockUnblockUser($_isblocked) {
        include('config.php');
        $this->query = "SELECT * FROM `user` WHERE `username`='".$this->username."'";
        $this->result = mysql_query($this->query) or die('Opps something går weird i blockUnblockUser(): ' . mysql_error());
        //sjekker om bruker har det samme verdi (som skal settes) i tabell
        if(($this->result = mysql_fetch_array($this->result)) != FALSE & $this->result[0] == $this->username) {
            if(($_isblocked == 1 and $this->result['isBlocked'] == 1) or ($_isblocked == 0 and $this->result['isBlocked'] == 0)) {
                throw new Exception('isBlocked has the same value');
            }
            else {
                $this->query = 'UPDATE `user` SET isBlocked='.$_isblocked.' WHERE username ="'.$this->username.'"';
                mysql_query($this->query) or die(mysql_error());
            }

        }
        else {
            //user not found eller passord stemmer ikke kaster exception
            mysql_close($this->dbconnection);
            throw new Exception('User not found in database invalid');
        }
        
    }
    /**
     *Skaper ny bruker 
     */
    public function createUser($name, $email, $pass) {
        include('config.php');
        //solim passord
        $pass= md5($pass.$SALT);
        //sql injection prevention
        $name = mysql_real_escape_string($name);
        $email = mysql_real_escape_string($email);
        $aktivationCode = $this->passCreater().$this->passCreater();
        //Her bruker vi engangspassordfelt i database for å lagre aktivasjonskode
        $this->query = 'INSERT INTO `user` (username, email, password, password_temporary, isBlocked) VALUES ("'.$name.'", "'.$email.'", "'.$pass.'", "'.$aktivationCode
                .'", 1)';
        //print $this->query;
        mysql_query($this->query) or die($this->queryError(mysql_error()));
        //sende bekreftelse til email
        //trenger bare epost tjener for å sende epost og teste den
        mail($email, 'Registrasjonsbekrefting', 
            'Du ble registrert som bruker på MegaBlog, 
             for å aktivere brukerakkount tast inn aktivasjonskode (kode her), her '.$_SERVER['SERVER_ADDR'].'activate.php, 
                 eller trykk her'.$_SERVER['SERVER_ADDR'].'activate.php?activation='.$aktivationCode); 
    }
    
    /**
     * Genererer nytt passord her også  brukes til å lage activation code ved registrering
    *@param $newPass er nytt passord som genereres avtomatisk og har lengde 8 by default
    *@param $base symboler som brukes til å generere passorrd
    *@param $hash md5 hash som beregnes av passord  
    */
    public function passCreater(){

        $base = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", 1);
        shuffle($base);
        $newPass = "";
        $length = count($base);
        for ($i = 0; $i < 8; $i++) {
            $rand = rand(0, $length-1);
            $newPass = $newPass.$base[$rand];
        }
        //print $newPass;
        return $newPass;
        
    }

     /**
     *Sjekker brukernavn og passord og returnerer bruker id om det finnes i databasen
     * 
     */
    public function autentificate($_password) {
        include('config.php');
        //beregner hashverdi
        $password = md5($_password.$SALT);
        //ser etter bruker i database og sjekker at hash verdi til passord stemmer
        $this->query = "SELECT * FROM `user` WHERE `username`='".$this->username."' AND `password`='".$password."'";
        $this->result = mysql_query($this->query) or die('Opps something går weird in autentificate function: ' . mysql_error());
        if(($this->result = mysql_fetch_array($this->result)) != FALSE & $this->result[0] == $this->username & $this->result[2] == $password) {
            //user found, returnerer id
            return $this->result['userid'];
        }
        else {
            $this->trying += 1;
            //user not found eller passord stemmer ikke kaster exception
            mysql_close($this->dbconnection);
            throw new Exception('User not found in database or password is invalid');
        }
    }
    
    /**
     *funksjon returnerer multidemensjonal array som inneholder alle kommentarer bruker har gjørt 
     */
    public function getAllComments() {
        $this->query = "SELECT * FROM `user` WHERE `username`='".$this->username."'";
        //print $this->query.PHP_EOL;
        $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
        if(($this->result = mysql_fetch_array($this->result)) != FALSE & $this->result[0] == $this->username) {
            $this->query = "SELECT * FROM `comments` WHERE `user_id`='".$this->result['userid']."'";
            $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
            $final_result;
            $index = 0;
            while($resultrow = mysql_fetch_array($this->result)) {
                $index++;
                $final_result[$index] = $resultrow;
            }
        }
        else {
            throw new Exception('ser ikke noen kommentarer i database');
        }
        return $final_result;
    }
    
    /**
     *returnerer alle innlegg bruker har gjørt
     */
    public function getAllBlogEntities() {
        //TODO skal returnere alle innlegg fra database
        //get user id
        //get alle innlegg merket med dette id
    }

    /**
     * returnerer login hostory for bruker
     */
    public function getlogHistory() {
        //TODO skal returnere info fra log tabell
    }
    /**
     * throw exception dersom bruker exists, som skal håndteres av php side og exception message skal vises til bruker
     * @param type $_username 
     */
    public function checkIfUsernameExists($_username) {
        $this->query = "SELECT * FROM `user` WHERE `username`='".mysql_real_escape_string($_username)."'";
        $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
        if($this->result = mysql_fetch_array($this->result)) {
            //print 'user exists';
            throw new Exception("User exists");
        }
        else {
            //print 'user not exists';
            return;
        }
    }
    /**
     *
     * @param type $_email
     * @return ingenting om alt er ok
     * @throws Exception dersom epost adresse var tidligere registrert i databasen
     */
    public function checkIfEmailExists($_email) {
        $this->query = "SELECT * FROM `user` WHERE `email`='".$_email."'";
        $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
        if($this->result = mysql_fetch_array($this->result)) {
            //print 'email exists';
            throw new Exception("Email exists");
        }
        else {
            //print 'email not exists';
            return;
        }
    }
    /**
     * Brukes ved sql forespørssler i konstruksjon "or die"
     * @param type $error
     * @throws Exception 
     */
    public function queryError($error) {
        throw new Exception($error);
    }

    /**
     * destruktør
     */
    function __destruct() {
        //mysql_free_result($this->$result);
        mysql_close($this->dbconnection);
        //print PHP_EOL."DB Connection closed OK";
    }
}
/////////////////////TEST
$test = new UserHandler('test');
//$test->sendPassword('timkinmail@gmail.com');
//$test->changePassword("test222", "test222");
$test->autentificate('test222');
//$test->blockUnblockUser(1);
//$test->getAllComments();
//$test->checkIfUsernameExists('test2');
//$test->checkIfEmailExists('timkinmail@gmail.com');
?>