<?php
    
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
                
                if($blogpost[vedlegg]!=NULL)
                {
                    $fp = fopen('vedlegg.jpg', 'w');
                    fwrite($fp, $blogpost[vedlegg]);
                    fclose($fp);
                    
                    list($width) = getimagesize("vedlegg.jpg");
                    
                    //echo $width;
                    
                    echo "<div id=picture>";

                        if($width > 835)
                        {
                            echo "<img src=vedlegg.jpg width=835>";
                        }
                        else
                        {
                            echo "<img src=vedlegg.jpg align=center>";
                        }
                        
                    echo "</div>";
                    echo "</br>";
                }

        }
        catch(Exception $e){
            return $e;
        }
	?>
                
                
        <?php
        if(isset($_SESSION['userid'])) {
        ?>
                
        <h3>Your comment</h3>
            <form action="blogpost_new_comment.php" method="post">
                <table border="0">
                    <tr>
                        <td width="150">
                            Name : 
                        </td>
                        <td>
                            <h2>
                                <?php
                                    echo "<b>".$showpost->getName($_SESSION['userid'])."</b>";
                                ?>
                            </h2>
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
                            <input type="hidden" name="id" value=<?php echo $_GET['id'] ;?>>
                            </input>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="submit" name="ny" value="Legg Inn" class="key blue"/>
                        </td>
                        <td>
                            <input type="reset" value="Blank ut" class="key blue"/>
                        </td>     
                    </tr>
            </table>
        </form>
        
        <?php
        }
        ?>
        
        <?php
                
                
            try
                {
               
                    $showcomment = new BlogEntityHandler();
                    
                    $commentId = $_GET['id'];
                    $commentpost = $showcomment->getComments($commentId);
                    
                    //echo $postername = $showcomment->getName($commentpost[1][user_id]);
                    
                    for ($i = 1; $i < sizeof($commentpost) + 1; $i++)
                    {
                        //$commentpost[$i]['user_id'];
                        $postername = $showcomment->getName($commentpost[$i]['user_id']);
                        //echo $postername;
                        
                        echo "<br />";
                        echo "<div id=comment>";
                        echo "<table width=100%>";
                            echo "<tr height=30>";
                                echo "<td>"; 
                                    echo $postername;
                                    //echo $commentpost[$i][user_id];
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
                         echo "</div>";
                         echo "<br />";
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
  