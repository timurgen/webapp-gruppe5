<?php

/*
 * @author 490501
 * @date 20.04.2012
 * @version 1.0.0 
 */
session_start();
if(isset($_GET['activation'])){
    //sjekker activation code
    $code = $_GET['activation'];
    require_once 'userhandler.class.php';
    $handler = new UserHandler("");
    try {
        $handler->activate($code); ?>
        <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta name="author" content="Martin Bang Tollefsen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
        <script type="text/javascript" src="main.js"></script>
	<title>Ompa Lompa MegaBlog</title>
</head>
<body id="home">
<?php include_once 'menu.php'; ?>
    <div class="loginform">
        <p align="center"><strong><font color="#990000" id="errorMessage">Profile activated!</font></strong></p>
        <a href="login.php"> go to login form</a>
    </div>
</body>
</html>
   <?php }
    catch(Exception $e) {
        $errorMessage = $e->getMessage();
        ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta name="author" content="Martin Bang Tollefsen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
        <script type="text/javascript" src="main.js"></script>
	<title>Ompa Lompa MegaBlog</title>
</head>
<body id="home">
<?php include_once 'menu.php'; ?>
    <div class="loginform">
        <p align="center"><strong><font color="#990000"><?php print $errorMessage?></font></strong></p>
        <input type="submit" onclick="history.back()" value="Back"/>
    </div>
</body>
</html>
    <?php }   
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta name="author" content="Martin Bang Tollefsen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
        <script type="text/javascript" src="main.js"></script>
	<title>Ompa Lompa MegaBlog</title>
</head>
<body id="home">
<?php include_once 'menu.php'; ?>
    <div class="loginform">
        <p align="center"><strong><font color="#990000" id="errorMessage"></font></strong></p>
        <form actiom="activate.php" method="get" name="FrmActvt">
            <label>Tast inn activation code here:</label><br/>
            <input type="text" name="activation" required="true" />
            <input type="submit" value="send" />
        </form>
    </div>
</body>
</html>
<?php } ?>