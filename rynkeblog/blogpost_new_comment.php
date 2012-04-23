<?php
  session_start();
  echo "<?xml version=\"1.0\"?>";
  if(isset($_SESSION['userid'])) {
      //dersom session startet viser new blog form
?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <title>
            Blogpost_new
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      </head>
  <body>
      
 <?php 
    include ('blogentityhandler.class.php');
            try
            {
                $object = new BlogEntityHandler();
                $object->addComment($_POST['id'], $_SESSION['userid'], $_POST['tekst']);

            }
            catch(Exception $e)
            {
                echo $e;
                return $e;
            }     
  }
  header("Location: blogpost.php")
?>
      
  </body>
</html>