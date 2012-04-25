<?PHP
class BlogEntityHandler{
     /**
     * @author Timur Samkharadze 
     * @version 1.0.0
     * @param 
     * @param 
     * @param 
     * @param 
      * class håndterer alle operasjoner knyttet til blog innlegg
     */
    private $id;
    private $username;
    private $dbconnection;
    private $query;
    private $result;
    /**
     *konstruktør 
     */
    function __construct() {
        include('config.php');
        $this->dbconnection = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS) or die('Connection error'.PHP_EOL.mysql_error().PHP_EOL);
        //print 'Connection to server OK'.PHP_EOL;
        mysql_select_db($DB_NAME) or die('Databasen er ikke funnet på tjeneren '.$DB_SERVER);
        //print 'Connection to database '.$DB_NAME.' OK'.PHP_EOL;
    }
    /**
     *
     * @param type $_username - hvem som skrev innlegg
     * @param type $_titel - titel ti innlegg
     * @param type $_text - text til innlegg
     * @param type $_category - kategory av innlegg
     * @param type $_tags - nøkkeløord
     * @param type $_payload - bilde for eksempel
     */
    public function addNewEntity($_username, $_titel, $_text, $_category, $_tags, $_payload) {//funker men ikke testet skikkelig godt
        //håndterer begrensinger
        if(strlen($_titel) > 100){//titel max length = 100
            throw new Exception('title max length is 100');
        }
        if(strlen($_text) > 5000) {//text max length = 5000
            throw new Exception('text max length is 5000');
        }
        if(strlen($_tags) >100) {//tags max length = 100
            throw new Exception('tags max length is 100');
        }
        $this->query = 'INSERT INTO `blog_entity` (author, title, kategory, text, tags, vedlegg) VALUES ("'.$_username.'", "'.$_titel.'", "'.$_category.'", "'.$_text.'", "'.$_tags.'", "'.$_payload.'")';
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
         
    }

    /**
     *
     * @param type $_id id til bloginnleg
     * @return type bloginnlegg med gitt id
     */
    public function getEntity($_id) {//funker godt Timur
        $this->query = 'SELECT * FROM `blog_entity` WHERE `id`='.$_id;
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        if(($this->result = mysql_fetch_array($this->result)) != FALSE) {
            return $this->result;
        } 
    }
    
    /**
     *
     * @param type $_tag String med nøkkelord
     * @return type array av id'er til innlegg markerte med nøkkelord
     */
    public function getEntitiesByTag($_tag) {//funker godt men må sjekke når vi vil ha mange innlegg med mange nøkkelord Timur
        $this->query = 'SELECT * FROM `blog_entity` WHERE `tags` LIKE "%'.$_tag.'%"';
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        $array;
        $result_array;
        $index = 0;
        while($array = mysql_fetch_array($this->result)) {
            $index++;
            $result_array[$index] = $array;
        }
        mysql_free_result($this->result);
        return $result_array;
    }
    
    public function getPostByM($_year){
        
        $this->query = 'SELECT * FROM `blog_entity` WHERE `creation_date` LIKE "%'.$_year.'%"';
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        
        /*$array;
        $result_array;
        $index = 0;
        while($array =  mysql_fetch_array($this->result)){
            
            $index++;
            $result_array[$index] = $array;
            
        }*/
        mysql_free_result($this->result);
        return $result_array;
    }
    
    /**
     *
     * @param type $_id - innlegg id
     * @param type $_user_id - kommentator id
     * @param type $_comment - String, comment
     */
    public function addComment($_id, $_user_id, $_comment) {//funker godt Timur
        //max length of comment is 250 bokstaver
        if(strlen($_comment) > 250) {
            throw new Exception('max length 250!');
        }
        if(strlen($_comment) == 0) {
            throw new Exception('comment kan ikke ha 0 lengde');
        }
        $this->query = 'INSERT INTO comments (blog_id, user_id, text) VALUES ('.$_id.','.$_user_id.',"'.$_comment.'")';
        //print $this->query;
        mysql_query($this->query) or die($this->queryError(mysql_error()));
    }
    
    /**
     *funksjon returnerer array med id'er som tilhører alle innlegg markerte me gitt kategory
     * @param type $_category
     * @return type 
     */
    public function getEntitiesByCategori($_category) {
        //TODO metode skal returnere alle innleg som tilhører gitt kategory
        return $entities;
    }
    
    /**
     *Oppdatterer text av innleg
     * @param type $_id til innlegg
     * @param type $new_text ny tekst som skal lagres
     */
    public function updateEntity($_id, $new_text) {
        //TODO oppdatterer innlegg ved gitt id med gitt text
    }
    
    
    /**
     *Funksjon brukes i "or die construction" for å sende error text til exception handler
     * @param type $error
     * @throws Exception 
     */
    public function queryError($error) {
        throw new Exception($error);
    }
    /**
     *destruktør 
     */
    function __destruct() {
        mysql_close($this->dbconnection);
        //print PHP_EOL."DB Connection closed OK";  
    }
    
    public function maxID()
    {
        $this->query = 'SELECT MAX(id) as id FROM `blog_entity`';
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        $max = mysql_fetch_array($this->result, MYSQL_BOTH);
        $max = $max[0];
        return $max;
    }
    
    public function getName($_id) 
    {
        $this->query = 'SELECT username FROM `user` WHERE `userid`='.$_id;
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        $name = mysql_fetch_array($this->result, MYSQL_BOTH);
        $name = $name[0];
        return $name;
    }
    
    public function getComments($_id) {
        
            $this->query = "SELECT * FROM `comments` WHERE `blog_id`=".$_id." ORDER BY date_time";
            $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
            $final_result;
            $index = 0;
            while($resultrow = mysql_fetch_array($this->result)) {
                $index++;
                $final_result[$index] = $resultrow;
            }
        return $final_result;
    }
    
    public function getNumberComments($_id) {
        
            $this->query = "SELECT * FROM `comments` WHERE `blog_id`=".$_id;
            $this->result = mysql_query($this->query) or die('Opps something går weird ' . mysql_error());
            $final_result;
            $index = 0;
            while($resultrow = mysql_fetch_array($this->result)) {
                $index++;
            }
        return $index;
    }
    
   public function getAllTag() {//funker godt men må sjekke når vi vil ha mange innlegg med mange nøkkelord Timur
        $this->query = 'SELECT tags FROM `blog_entity`';        
        $this->result = mysql_query($this->query) or die($this->queryError(mysql_error()));
        $array;
        $result_array;
        $index = 0;
        while($array = mysql_fetch_array($this->result)) {
            $index++;
            $result_array[$index] = $array;
        }
        mysql_free_result($this->result);
        return $result_array;
    } 
    
    
    
}

 

    
/////////////////TEST
//$test = new BlogEntityHandler();
//$test->addComment(1, 1, '23123123123123123123123123123123123123123123123123123123123');
//$test->getEntity(1);
//$test->getEntitiesByTag('test');
//$test->addNewEntity(1, 'Test 3', 'Arcenal Chelsea', 'test', 'tag1, tag 2', null);

?>
