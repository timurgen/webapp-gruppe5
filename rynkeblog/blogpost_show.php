<?php
  echo "<?xml version=\"1.0\"?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      Blog
    </title>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php
        require ('blogentityhandler.class.php');     
        try
        {    
            $showpost = new BlogEntityHandler();
            
            
            $maxium = $showpost->maxID();
            for ($i = $maxium; $i > -1; $i--)
            {
                $blogpost = $showpost->getEntity($i);
                $postername = $showpost->getName($blogpost[author]);
                $numComments = $showpost->getNumberComments($i);
                echo "<div id=onepost>";
                echo "<table border=0 width=100%>";
                    echo "<tr height=30>";
                        echo "<td>"; 
                            echo "<a href=blogpost_comments.php?id=$blogpost[id]>" . $blogpost[title] . "</a>";
                        echo "</td>";
                        echo "<td align=right>"; 
                            echo $blogpost[creation_date];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr >";
                        echo "<td colspan=2 align=justify>";
                            echo $blogpost[text];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr height=30>";
                         echo "<td align=left>";
                            echo $blogpost[kategory];
                         echo "</td>";
                         echo "<td align=right>";
                            echo "Author - " . $postername;
                         echo "</td>";
                    echo "</tr>";
                    
                    
                    echo "<tr height=30>";
                        echo "<td colspan=2 align=left>";
                            echo "<hr />";
                            echo $blogpost[tags];
                        echo "</td>";
                    echo "</tr>";
                    
                echo "</table>";
                echo "</div>";
                echo "<a href=blogpost_comments.php?id=$blogpost[id]>" . "<h3>$numComments Comments</h3>" . "</a>";
                echo "</br>";         
            }
        }
        catch(Exception $e){
            return $e;
        }
       
    ?>
     
  </body>
</html>
  