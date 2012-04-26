<!DOCTYPE HTML>
<?php session_start() ?>
<html>
<head>
<title>Contact</title>
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
</head>
<body id="home">
    <?php 
        include_once 'menu.php'; 
        require ('blogentityhandler.class.php');
    ?>
    
    <div class="wrap">
        <div id="left">
            <br />
            <div id="about">        

                <table>
                    <tr>
                        <td>
                            <h3>Martin:</h3>                         
                                <p>
                                <a href="http://www.facebook.com/profile.php?id=717942393">Facebook</a> Link to Martins Facebook site
                                </p>
                            
                            <h3>Vitaly</h3>
                                <p>
                                <a href="http://www.facebook.com/vitalys">Facebook</a> Link to Vitaly Facebook site
                                </p>
                            <h3>Timur</h3>
                                <p>
                                <a href="http://www.facebook.com/timur.samkharadze">Facebook</a> Link to Timur Facebook site
                                </p>
                        </td>
                    </tr>
                </table>
                    
            </div>
            <br />
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
                                include('datetime.php');
			     ?>
                        </li>            
                    </ul>
                                       
                    <?php
                        include 'search.php';                                 
                    ?>
	</div>

        </div>  
    
  
</body>
</html>
