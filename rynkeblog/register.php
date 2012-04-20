<?php
include_once 'userhandler.class.php';
session_start();
error_reporting(E_ALL); //for debugging
if(isset($_SESSION['userid'])) { header('Location: index.php'); } //bruker logged in og har ingenting å gjøre her, sender tilbake til main side
elseif(isset($_POST['txtUserId']) & isset($_POST['txtEmail']) & isset($_POST['txtPass'])) {//ny bruker registrerer seg
    $name = $_POST['txtUserId'];
    $mail = $_POST['txtEmail'];
    $pass = $_POST['txtPass'];
    $userhandler = new UserHandler($_username);
    try {
        $userhandler->createUser($name, $mail, $pass);
    ?> 
<!--Html side med melding om at registrasjon ble utført-->
<html>
    <head>
        <title>Register</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
                <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
                <script type="text/javascript" src="main.js"></script>
    </head>
    <body id="home">
        <?php include_once 'menu.php'; ?>
        <!--melding her-->
        
        
    </body>
</html>
    
    <?PHP
    }
    catch(Exception $e) {//viser exception
        print "Exception ".$e->getMessage();
    }
    
}
else {
//
?>
<html>
    <head>
        <title>Register</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
                <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
                <script type="text/javascript" src="main.js"></script>
    </head>
    <body id="home">
        <?php include_once 'menu.php'; ?>
        
        <div class="loginform">
        <p align="center"><strong><font color="#990000" id="errorMessage"></font></strong></p>
        <form action="register.php" method="post" name="frmRegister" id="frmRegister" onsubmit="return check()">
            <table>
                <tr>
                    <td>Username:</td> <td><input name="txtUserId" type="text" id="txtUserId" required="true"><br/></td>
                </tr>
                <tr>
                   <td>Email:</td><td><input name="txtEmail" type="text" id="txtEmail" required="true"></td>
                </tr>
                <tr>
                   <td>Password:</td> <td><input name="txtPass" type="password" id="txtPassword" required="true"></td>
                </tr>
                <tr>
                   <td>Reenter password:</td> <td><input name="txtPass2" type="password" id="txtPassword2" required="true"></td>
                </tr>
                <tr>
                   <td><input name="btnRegister" type="submit" id="btnLogin" value="Register"></td>
                   <td><input name="btnBack" type="submit" id="btnBack" value="Back" onsubmit="history.back()"></td>
                </tr>
            </table>
                   
        </form>
        </div>
    </body>
</html>
<?php } ?>