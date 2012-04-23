<?php
include_once 'userhandler.class.php';
if(isset($_POST['txtPassOne']) & isset($_POST['txtPassword']) & isset($_POST['txtPassword2']) & isset($_POST['txtUserName'])) {
    $name = $_POST['txtUserName'];
    try {
        $handler = new UserHandler($name);
        $handler->changePasswordIfLost($_POST['txtPassOne'], $_POST['txtPassword'], $_POST['txtPassword2']);
        header('Location: login.php');
    }
    catch(Exception $e) {
        
        print $e->getMessage();
    }
}

else {
?>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
                <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
                <script type="text/javascript" src="main.js"></script>
    </head>
    <body id="home">
        <?php include_once 'menu.php'; ?>
        
        <div class="loginform">
            <H1>You need to change your password</H1>
        <p align="center"><strong><font color="#990000" id="errorMessage"></font></strong></p>
        <form action="changepass.php" method="post" name="frmChangePass" id="frmLogin" onsubmit="return checkPass()">
                   Brukernavn:<input name="txtUserName" type="text" id="txtUsername"><br/>   
                   Engangspassord:<input name="txtPassOne" type="text" id="txtPassOneTime"><br/>                                  
                   New password: <input name="txtPassword" type="password" id="txtPassword"><br/>
                   New password: <input name="txtPassword2" type="password" id="txtPassword2"><br/>
                   <input name="btnLogin" type="submit" id="btnChngPs" value="Change password"> <br />
        </form>
        </div>
    </body>
</html>
<?php } ?>


