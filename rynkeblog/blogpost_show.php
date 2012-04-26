<html>
<head>
	<meta name="author" content="Gruppe 5" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
	<title>Ompa Lompa MegaBlog</title>
</head>
    <?php
        //Funker godt Vitaly
        require ('blogentityhandler.class.php');
        if(isset($_POST['search'])) {
        try
            {    
                $showpost = new BlogEntityHandler();
                $result = $showpost->getEntitiesBySearchWord($_POST['search']);
                for ($i = count($result); $i > -1; $i--)
                {
                    $blogpost = $result[$i];
                    $postername = $showpost->getName($blogpost['author' ]);
                    $numComments = $showpost->getNumberComments($i);
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
            catch(Exception $e)
            {
            return $e;
            }
        }//end of isset
        
        else {
        try
            {    
                $showpost = new BlogEntityHandler();
                $maxium = $showpost->maxID();
                for ($i = $maxium; $i > -1; $i--)
                {
                    $blogpost = $showpost->getEntity($i);
                    $postername = $showpost->getName($blogpost[author]);
                    $numComments = $showpost->getNumberComments($i);
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
                    catch(Exception $e){
                return $e;
            }
        }

    ?>
