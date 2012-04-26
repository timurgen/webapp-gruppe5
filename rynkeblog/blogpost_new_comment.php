<?php
    //Funker godt Vitaly
    session_start();
    echo "<?xml version=\"1.0\"?>";
    if(isset($_SESSION['userid'])) {
      //dersom session startet viser new blog form
?>
      
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
  header("Location: index.php")
?>
