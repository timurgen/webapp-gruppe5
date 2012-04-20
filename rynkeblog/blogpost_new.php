<?php
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
<?php //
    require ('blogpost.class.php');
    require ('hilsen.class.php');
    //$gjestebok->printFile();
    if((isset($_POST['tittel']) ? $_POST['tittel'] : '') && (isset($_POST['tekst']) ? $_POST['tekst'] : '')) {
    //var_dump($_POST);
    $hilsen = new hilsen($_POST['tittel'], $_POST['tekst'], $_POST['web']);
    $blogpost = new blogpost('gjestebok.xml');
    $blogpost->readFile();
    $blogpost->addToFile($hilsen);
    echo "Takk for din hilsen";
}
else {
    echo "B&aring;de feltene navn og hilsen m&aring; v&aelig;re utfylte";
}
?>
<a href="index.php">Tilbake til forsiden</a> 
</body>
</html>
<?PHP } else { ?>
      
  
      
<?PHP } ?>
