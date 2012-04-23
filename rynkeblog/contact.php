<!DOCTYPE HTML>
<?php session_start() ?>
<html>
<head>
<title>Contact</title>
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
</head>
<body id="home">
    <?php include_once 'menu.php'; ?>
    
    <form action='search.php' method='GET'>
         
    <center>
    <h1>My Search Engine</h1>
    <input type='text' size='90' name='search'></br></br>
    <input type='submit' name='submit' value='Search source code' ></br></br></br>
    </center>
    </form>

	
</body>
</html>
