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

        // Get the search variable from URL
        $var = @$_GET['q'];
        $trimmed = trim($var); //trim whitespace from the stored variable
// rows to return
        $limit = 50;

// check for an empty string and display a message.
        if ($trimmed == "") {
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
        $query = "select * from blog_entity where text like \"%$trimmed%\" or title like \"%$trimmed%\"  
  order by text";

        $numresults = mysql_query($query);
        $numrows = mysql_num_rows($numresults);

// if no result , try search on google.

        if ($numrows == 0) {
            echo "<h4>Results</h4>";
            echo "<p>Sorry, your search: &quot;" . $trimmed . "&quot; returned 0 results</p>";

// google
            echo "<p><a href=\"http://www.google.com/search?q="
            . $trimmed . "\" target=\"_blank\" title=\"Look up 
  " . $trimmed . " on Google\">Click here</a> to try the 
  search on google</p>";
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
            $title = $row["text"];
            
            echo $title;
            //"$count.)&nbsp;$title";
            //$count++;
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