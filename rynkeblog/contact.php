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
