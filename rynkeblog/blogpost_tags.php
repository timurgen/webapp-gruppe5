<?php
//Alt i orden Vitaly    
session_start();
    echo "<?xml version=\"1.0\"?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      Comments
    </title>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
    
  </head>
    
    <body>
    <?php   
        include_once 'menu.php';
        ?>
        
        <div class="wrap">
		<div id="leftComments">
		<h2></h2><br/>
		<?php
                require ('blogentityhandler.class.php');     
                
                try
                {     
                $showpost = new BlogEntityHandler();
                $blogpost = $showpost->getEntitiesByTag($_GET['tagtext']);
                $size = count($blogpost);
                //print_r($size);
                
                
                //print_r($blogpost);
                
                for ($i=1; $i<$size+1;$i++)
                {
                 
                $postername = $showpost->getName($blogpost[$i][author]);    
                
                echo "<div id=onepost>";
                echo "<table border=0 width=100%>";
                    echo "<tr height=30>";
                        echo "<td>";
                            echo "<a href=blogpost_comments.php?id=".$blogpost[$i][id].">" . $blogpost[$i][title] . "</a>";
                            //echo $blogpost[$i][title];
                        echo "</td>";
                        echo "<td align=right>"; 
                            echo $blogpost[$i][creation_date];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr >";
                        echo "<td colspan=2 align=justify>";
                            echo $blogpost[$i][text];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr height=30>";
                         echo "<td align=left>";
                            echo $blogpost[$i][kategory];
                         echo "</td>";
                         echo "<td align=right>";
                            echo "Author - " . $postername;
                         echo "</td>";
                    echo "</tr>";
                    
                    
                    echo "<tr height=30>";
                        echo "<td colspan=2 align=left>";
                            echo "<hr />";
                            echo $blogpost[$i][tags];
                        echo "</td>";
                    echo "</tr>";
                    
                echo "</table>";
                echo "</div>";
                echo "</br>";
                }
        }
        catch(Exception $e){
            return $e;
        }
	?>
                        
	</div>	
        </div>
        
     
  </body>
</html>
  