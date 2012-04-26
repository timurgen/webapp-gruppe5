<?php 
    //Må sjekkes på andre gang før innlevering
    session_start() 
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Gruppe 5" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
	<title>Ompa Lompa MegaBlog</title>
</head>
<body id="home">
<?php include_once 'menu.php'; ?>
	<div class="wrap">
		<div id="left">
		<h2></h2><br/>
			<?php
			include('blogpost_show.php');
                        
			if(isset($_SESSION['basic_is_logged_in'])){
				include('blogpost.php'); 
			}
			?>
		</div>
		<div id="right">
			<h2>Latest Entries</h2>
			<ul>
				<li><a href="index.php">Lates post</a></li>			       
			</ul>
                        
                        <h2>Tags Cloud</h2>
                        <div id="tagcloud">
					<?php
                                        include("tagcloud.php"); 
                                        ?>
                        </div>
                        
                        <h2>Archive</h2>
                            <ul>
                               <li>
                                  <?php
                                  include 'date.php';                                 
                                  ?>
                               </li>            
                           </ul>
                                       
                         <?php
                              include 'search.php';                                 
                         ?>
			</div>

        </div>         
              
		<div id="footer">
			<p><strong>Blog:</strong> <a href=".">Home</a> &middot; <a href="about.htm">About</a> &middot; <a href="links.htm">Links</a> &middot; <a href="#">Login</a> &middot; <a href="contact.htm">Contact</a></p>
			<p><strong>Network:</strong> <a href="http://www.hin.no"HIN</a> &middot;  <a href="http://www.facebook.com">Facebook</a> &middot;  <a href="http://www.funn.no">Funn-IT</a> &middot;  <a href="http://www.Itslearning.com">Itslearning</a></p>
			<p>Design: Martin Bang Tollefsen(w3chool for CSS info, <a title="www.w3schools.com" href="http://www.w3schools.com">w3s</a></p>
		</div>
</body>
</html>
