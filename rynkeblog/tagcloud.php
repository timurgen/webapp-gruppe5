<?php

    //http://www.youtube.com/watch?v=p-2SiTsABxY

    include ('blogentityhandler.class.php');
    
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
            $size += 5;
            echo "<li><span style=\"font-size: {$size}px\">$tag</span></li> ";
        }
       //print_r($tags);
        
    }
    catch(Exception $e)
    {
        echo $e;
        return $e;
    }   
?>
