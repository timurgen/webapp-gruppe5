<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'config.php';

$button = $_GET ['submit'];
$search = $_GET ['search']; 

        if(!$button)
            echo "you didn't submit a keyword";
        else
        {
        if(strlen($search)<=1)
           echo "Search term too short";
        else{
        echo "You searched for <b>$search</b> <hr size='1'></br>";
        
        
        mysql_connect("$DB_SERVER","$DB_USER","$DB_PASS");

        mysql_select_db("$DB_NAME");

        $search_exploded = explode (" ", $search);

foreach($search_exploded as $search_each)
{
$x++;
if($x==1)
$construct .="keywords LIKE '%$search_each%'";
else
$construct .="AND keywords LIKE '%$search_each%'";

}

$construct ="SELECT * FROM bloge_entity WHERE $construct";
$run = mysql_query($construct);

$foundnum = mysql_num_rows($run);

if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
 try agin";
else
{
echo "$foundnum results found !<p>";

while($runrows = mysql_fetch_assoc($run))
{
$title = $runrows ['title'];
$desc = $runrows ['description'];
$url = $runrows ['url'];

echo "
<a href='$url'><b>$title</b></a><br>
$desc<br>
<a href='$url'>$url</a><p>
";

}
}

}
}


?>

  <form action='search.php' method='GET'>
         
     <center>
    <h2> Search </h2>
    <input type='text' size='10' name='search'></br></br>
    <input type='submit' name='submit' value='Search source code' ></br></br></br>
    </center>
    </form>

	
