<?php session_start() ?>
<?php if(isset($_POST['username']) & isset($_POST['email'])) {
    require_once('userhandler.class.php');
    $handler = new UserHandler($_POST['username']);
    try {
        $handler->sendPassword($_POST['email']);
        $errorMessage = "new Password was sent to your email";
}
    catch(Exception $e) {
        $errorMessage = $e->getMessage();
    }

    
    
    
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta name="author" content="Timur Samkharadze" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="css/loginstyle.css" type="text/css" />
	<title>Ompa Lompa MegaBlog</title>
</head>
<body id="home">
<?php include_once 'menu.php'; ?>
    <div class="loginform">
        <?php if ($errorMessage != null) { ?>
            <p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
        <?php } ?>
        <form method="post" action="lost_pass.php" name="lost">
            <label>Tast inn brukernavn</label><br />
            <input type="text" name="username" /><br />
            <label>Tast inn email</label><br />
            <input type="text" name="email" /><br /><br />
            <input type="submit" name="submitbtn"  value="Send new password to email"/>

        </form>
    </div>
</body>
</html>