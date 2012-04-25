<html> 
    
    <head>
        <title>Search blog entity</title>
        <meta name="OmpaLompa Crew" content="Ompalomåa megaBLOG">
    </head>
   
    <body>

        <form name="form" action="search.php" method="get">
            <input type="text"  name="q" />
            <input type="submit" name="Submit" value="Search" />
        </form>

        <?php
        include 'config.php';
        include 'blgpost_show.php';
            
        // Tutorial hentet fra designpalace.com PHP.
        
        // Get the search variable from URL
        $var = @$_GET['q'];
        
        $search = trim($var); 
        
        // rows to return
        $limit = 50;

        // check for an empty string and display a message.
        if ($search == "") {
            echo "<p>Please enter a search...</p>";
            exit;
        }

       // check for a search parameter
        if (!isset($var)) {
            echo "<p>We dont seem to have a search parameter!</p>";
            exit;
        }

        //connect to your database ** EDIT REQUIRED HERE **
        mysql_connect("$DB_SERVER", "$DB_USER", "$DB_PASS"); //(host, username, password)
        //specify database ** EDIT REQUIRED HERE **
        mysql_select_db("$DB_NAME") or die("$DB_NAME"); //select which database we're using
        // Build SQL Query  
        $query = "select * from blog_entity where text like \"%$search%\" order by text";

        $numresults = mysql_query($query);
        $numrows = mysql_num_rows($numresults);

        // if no result , Google IT!

        if ($numrows == 0) {
            echo "<h4>Results</h4>";
            echo "<p>Sorry, your search: &quot;" . $search . "&quot; returned 0 results</p>";

// google
            echo "<p><a href=\"http://www.google.com/search?q=". $search. "\" target=\"_blank\" title=\"Look up 
                 " . $search . " on Google\">Click here</a> Google IT!</p>";
        }

        // next determine if s has been passed to script, if not use 0
        if (empty($s)) {
            $s = 0;
        }

        // get results
        $query .= " limit $s,$limit";
        $result = mysql_query($query) or die("Couldn't execute query");

        // display what the person searched for
        echo "<p>You searched for: &quot;" . $var . "&quot;</p>";

        // begin to show results set
        echo "Results ";
        
        
        $count =  $s;

        // now you can display the results returned
        while ($row = mysql_fetch_array($result)) {
            $text = $row["text"];
            
            
            //echo $text;
            //"$count.)&nbsp;$title";
            //$count++;
             echo "<div id=search>";
                  echo "<table border=0 width=100%>";
                  echo "<tr height=30>";              
                  echo "<td>";
                  echo $text;              
                  echo "</td>";
                   echo "<td align=right>"; 
                            echo $blogpost;
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
                  
                  //MÅ GJØRES FERDIG
                  
            
            echo "</div>";
                    
        }

        $currPage = (($s / $limit) + 1);

        //break before paging
        echo "<br />";

        // next we need to do the links to other results
        if ($s >= 1) { // bypass PREV link if s is 0
            $prevs = ($s - $limit);
            print "&nbsp;<a href=\"$PHP_SELF?s=$prevs&q=$var\">&lt;&lt; 
  Prev 10</a>&nbsp&nbsp;";
        }

         // calculate number of pages needing links
        $pages = intval($numrows / $limit);

        // $pages now contains int of pages needed unless there is a remainder from division

        if ($numrows % $limit) {
            // has remainder so add one page
            $pages++;
        }

         // check to see if last page
        if (!((($s + $limit) / $limit) == $pages) && $pages != 1) {

            // not last page so give NEXT link
            $news = $s + $limit;

            echo "&nbsp;<a href=\"$PHP_SELF?s=$news&q=$var\">Next 10 &gt;&gt;</a>";
        }

        $a = $s + ($limit);
        if ($a > $numrows) {
            $a = $numrows;
        }
        $b = $s + 1;
        echo "<p>Showing results $b to $a of $numrows</p>";
        ?>



    </body>
</html>