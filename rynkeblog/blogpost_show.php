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
    <
    <?php
        require ('blogpost.class.php');
		
        $blogpost = new blogpost('gjestebok.xml');
        $blogpost->readFile();
        $blogpost->printFile();
    ?>
     
  </body>
</html>
  