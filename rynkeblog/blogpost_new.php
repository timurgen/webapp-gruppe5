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
    //require ('blogentityhandler.class.php');
    include ('blogentityhandler.class.php');
            try
            {
                $object = new BlogEntityHandler();
                //$object->addNewEntity($_username, $_titel, $_text, $_category, $_tags, $_payload);
                //$object->addNewEntity(1, 'HardCodedTittel', 'TextForDummies', 'BlogTestingSystem', 'TestTag1, TestTag2', null);
                
                //$vedlegg = file_get_contents($_POST['uploadedfile']);
                //echo $vedlegg;
                //echo $_POST['uploadedfile'];
                
                //$fileName = $_FILES['uploadedfile']['name'];
                $tmpName = $_FILES['uploadedfile']['tmp_name']; //filnavnet på tjenester
                //$fileSize = $_FILES['uploadedfile']['size'];
                
                
                $fp = fopen($tmpName, 'r');
                $vedlegg = fread($fp, filesize($tmpName));
                $vedlegg = addslashes($vedlegg);
                fclose($fp);
                
                //echo $content;
                //echo $fileName;
                //echo $fileSize;
                //echo $tmpName;
                
                $object->addNewEntity($_SESSION['userid'], $_POST['tittel'], $_POST['tekst'], $_POST['kategory'], $_POST['tags'], $vedlegg);

            }
            catch(Exception $e)
            {
                echo $e;
                return $e;
            }     
  }
  header("Location: index.php")
?>
      
  </body>
</html>
      