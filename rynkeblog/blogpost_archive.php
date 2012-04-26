<?php
    //Funker godt Vitaly 
    //Kan utvikles til år søk
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
                //$result = $showpost->getEntitiesBySearchWord($_POST['search']);
                $maxium = $showpost->maxID();
                for ($i = $maxium; $i > -1; $i--)
                {
                    $blogpost = $showpost->getEntity($i);
                    $postername = $showpost->getName($blogpost['author' ]);
                    $numComments = $showpost->getNumberComments($i);
                    $monthOfPost = $showpost->monthCheck($blogpost[id]);
                    //echo "Testing ";
                    //echo $t = $_POST['month'];
                    //
                    //echo " From DB- ";
                    //print_r($monthOfPost);
                    //echo " From datetime: ";
                    //print_r($_POST['month'][0]);
                    
                    if($monthOfPost == $_POST['month'][0])
                    {
                    echo "<div id=\"onepost\">";
                    echo "<table border=\"0\" width=\"100%\">";
                        echo "<tr height=\"30\">";
                            echo "<td>"; 
                                echo "<a href=\"blogpost_comments.php?id=$blogpost[id]\">" . $blogpost[title] . "</a>";
                            echo "</td>";
                            echo "<td align=\"right\">"; 
                                echo $blogpost[creation_date];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr >";
                            echo "<td colspan=\"2\" align=\"justify\">";
                                echo $blogpost[text];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr height=\"30\">";
                            echo "<td align=\"left\">";
                                echo $blogpost[kategory];
                            echo "</td>";
                            echo "<td align=\"right\">";
                                echo "Author - " . $postername;
                            echo "</td>";
                        echo "</tr>";


                        echo "<tr height=\"30\">";
                            echo "<td colspan=\"2\" align=\"left\">";
                                echo "<hr />";
                                echo $blogpost[tags];
                            echo "</td>";
                        echo "</tr>";

                    echo "</table>";
                    echo "</div>";
                    echo "<a href=\"blogpost_comments.php?id=$blogpost[id]\">" . "<h3>$numComments Comments</h3>" . "</a>";
                    echo "</br>";  
                    }
                    
                }   
                }
                catch(Exception $e)
                {
                    return $e;
                }
                ?>
                
                </div>
      </div>
      
  </body>
</html>