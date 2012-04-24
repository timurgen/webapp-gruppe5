<?php
    session_start();  
    echo "<?xml version=\"1.0\"?>";  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      Tagcloud PHP
    </title>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php
    
    //http://www.youtube.com/watch?v=p-2SiTsABxY

    //include ('blogentityhandler.class.php');//jeg vet ikke hvorfor tags virker utten det men det virker
    //require ('blogentityhandler.class.php');
    //echo "from body";
    try
    {
        
        //Poluchaem dvumerniy massiv i perevodim ego v odnomerniy rabotaet
        $object = new BlogEntityHandler();
        $tagArrays = array();
        
        $tagArrays = $object->getAllTag();
        $tagArraysOnes = array();
        
        for ($i=1; $i < sizeof($tagArrays); $i++)
        {
            $tagArraysOnes[$i] = $tagArrays[$i][0];
        }
        
        //print_r($tagArraysOnes);
        
        foreach ($tagArraysOnes as $tagArraysOne)
        {
            //echo "TEST <br/>";
            $words = explode(" ", $tagArraysOne);
            //print_r($words);
            
            foreach($words as $word)
            {
                $word = strtolower($word);
                if(isset($tags[$word]))
                {
                    $tags[$word] += 1;
                }
                else
                {
                    $tags[$word] = 1;
                }
            }
        }
        
        foreach ($tags as $tag => $size) 
        {
            $size += 10;
            
            if($size > 30)
                {$size = 30;}
            
            //echo "<h3 style=\"font-size: {$size}px\">$tag</h3> ";
            echo "<a href=blogpost_tags.php?tagtext=$tag style=\"font-size: {$size}px\">".$tag."</a>";
            echo "<br \>";
             /*echo "<table border=2 width=200>";
                 echo "<tr>";
                        echo "<td>";  
                            echo "<h3 style=\"font-size: {$size}px\">$tag</h3> ";
                        echo "</td>";
                echo "</tr>";
             echo "</table>";*/
            
        }
       //print_r($tags);
        
    }
    catch(Exception $e)
    {
        echo $e;
        return $e;
    }   
?>

  </body>
</html>    
