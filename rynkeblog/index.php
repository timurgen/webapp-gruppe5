<?php session_start() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta name="author" content="Martin Bang Tollefsen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
	<title>Marin Bang Tollefsen &middot; BLOG</title>
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
				<li><a href="blogpost_show.php">Lates post</a></li>
				
			</ul>
			<div id="tagcloud">
				<p>
					<span style="font-size: 1.3em"><a href="www.google.no">google</a></span>
					<span style="font-size: 1.1em"><a href="http://www.hin.no">HIN</a></span>
					<span style="font-size: 1.6em"><a href="http://www.Fremover.no">Fremover</a></span>
					<span style="font-size: 1.5em"><a href="www.facebook.com">facebook</a></span>
				
				</p>
			</div>
			<p id="info">If you like my blog, Like it on facebook <a href="www.facebook.com" title="Information Architecture and Web Design">Facebook</a>!</p>
		</div>
		<div id="footer">
			<p><strong>Blog:</strong> <a href=".">Home</a> &middot; <a href="about.htm">About</a> &middot; <a href="links.htm">Links</a> &middot; <a href="task.htm">Task</a> &middot; <a href="#">Login</a> &middot; <a href="contact.htm">Contact</a></p>
			<p><strong>Network:</strong> <a href="www.hin.no"HIN</a> &middot;  <a href="www.facebook.com">Facebook</a> &middot;  <a href="www.funn.no">Funn-IT</a> &middot;  <a href="www.Itslearning.com">Itslearning</a></p>
			<p>Design: Martin Bang Tollefsen(w3chool for CSS info, <a title="www.w3schools.com" href="www.w3schools.com">w3s</a></p>
		</div>		
	</div>
</body>
</html>