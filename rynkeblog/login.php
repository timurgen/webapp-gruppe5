<?php
include_once 'userhandler.class.php';
// start the session
error_reporting(E_ALL);
session_start();
$errorMessage;
if(isset($_SESSION['userid'])) {
    if($_GET['logoff'] = true) {
        session_unset();
        header('Location: login.php');
    }
}
else {
    if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
    $name = $_POST['txtUserId'];
    $pass = $_POST['txtPassword'];
    // check if the username and password combination is correct
    $userhandler = new UserHandler($name);
    try {
        $userid = $userhandler->autentificate($pass);
        $_SESSION['userid'] = $userid;
        header('Location: index.php');
    }
    catch(Exception $e) {
        //print "<font color=red><em>".$e->getMessage()."</em></font>";
        $errorMessage = $e->getMessage();
    }   
}
?>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
                <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
    </head>
    <body id="home">
        <?php include_once 'menu.php'; ?>

        <div class="loginform">
        <?php if ($errorMessage != null) { ?>
        <p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
        <?php } ?>
        <form action="login.php" method="post" name="frmLogin" id="frmLogin">                  
                   Username:<input name="txtUserId" type="text" id="txtUserId"><br/><br />                                   
                   Password: <input name="txtPassword" type="password" id="txtPassword"><br/>
                   <input name="btnLogin" type="submit" id="btnLogin" value="Login"> <br />
                   <a href="register.php">Jeg er Umpa Lompa og vil bli registrert</a><br />
                   <a href="lost_pass.php">Jeg er Umpa Lompa og glemte passord</a>
        </form>
        </div>
    </body>
</html>
<?php } ?>
