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
            for ($i = 0; $i < $maxium; $i++)
            {
                $kukk = $showpost->getEntity($i);
                echo $kukk[title];
                echo $kukk[text];
            
            }
        }
        catch(Exception $e){
            return $e;
        }
       
    ?>
     
  </body>
</html>
  