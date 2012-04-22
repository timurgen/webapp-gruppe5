<?php
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

                $blogpost = $showpost->getEntity($_GET['id']);
                $postername = $showpost->getName($blogpost[author]);
                echo "<div id=onepost>";
                echo "<table border=0 width=100%>";
                    echo "<tr height=30>";
                        echo "<td>"; 
                            echo $blogpost[title];
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
                echo "</br>";         

        }
        catch(Exception $e){
            return $e;
        }
	?>
                
        <h3>Your comment</h3>
            <form action="blogpost_new_comment.php" method="post">
                <table border="0">
                    <tr>
                        <td width="150">
                            Name
                        </td>
                        <td>
                        <input type="text" name="name" />
                        </td>
                    </tr>
                    <tr>
                        <td width="150">
                            Comment text
                        </td>
                        <td>
                            <textarea name="tekst" cols="50" rows="5">
                            </textarea>
                        </td>
                    </tr>    
                    <tr>
                        <td>
                            <input type="submit" name="ny" value="Legg Inn" />
                        </td>
                        <td>
                            <input type="reset" value="Blank ut" />
                        </td>     
                    </tr>
            </table>
        </form>
        
        <?php
                
                
            try
                {
               
                    $showcomment = new BlogEntityHandler();
                    
                    
                    //$maxCommentId = $showcomment->maxComment();
                    
                     
                    //echo $commentpost[blog_id] . PHP_EOL;
                    //echo $commentId . PHP_EOL;
                    //echo $commentpost[user_id] . PHP_EOL;
                    //echo $commentpost[date_time] . PHP_EOL;
                    //echo $commentpost[text] . PHP_EOL;
                    
                    $commentId = $_GET['id'];
                    $commentpost = $showcomment->getComments($commentId);
                    
                   
                    
                    for ($i = 0; $i < sizeof($commentpost) + 1; $i++)
                    {
                        if($commentpost[$i][blog_id] == $commentId)
                        {  
                        echo "<table border=3 width=100%>";
                            echo "<tr height=30>";
                                echo "<td>"; 
                                    echo $commentpost[$i][user_id];
                                echo "</td>";
                                echo "<td align=right>"; 
                                    echo $commentpost[$i][date_time];
                                echo "</td>";
                            echo "</tr>";
                    
                            echo "<tr >";
                                echo "<td colspan=2 align=justify>";
                                    echo $commentpost[$i][text];
                                echo "</td>";
                            echo "</tr>";
                         echo "</table>";
                        }
                    }
                    
                }
                catch(Exception $e)
                {
                    return $e;
                }
        ?>
        
                
	</div>	
        
     
  </body>
</html>
  