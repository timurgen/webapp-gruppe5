<?php
    session_start();
    echo "<?xml version=\"1.0\"?>";
    if(isset($_SESSION['userid'])) { ?>
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>
      BlogPost
    </title>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/blogpost.css" type="text/css"  />
        <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
  </head>
  <body id="home">
      <?php include_once 'menu.php'; ?>

    <div class="add_blog">
    <h3>
     Skriv nytt inlegg
    </h3>
    <form action="blogpost_new.php" method="post">
	
      <table border="0">
        <tr>
          <td width="150">
            Tittel
          </td>
          <td>
            <input type="text" name="tittel" />
          </td>
        </tr>
        <tr>
          <td width="150">
            Tekst
          </td>
          <td>
            <textarea name="tekst" cols="75" rows="30">
            </textarea>
          </td>
        </tr>
          
        <tr>
            <td width="150">
                Tags
            </td>
            <td>
                <input type="text" name="tags">
            </td>
        </tr>
        
        <tr>
            <td width="150">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                Choose a jpg to upload  
            </td>
            <td>
                <input name="uploadedfile" type="file" /><br /> 
            </td>
        </tr>      
            
        <tr>
          <td>
            <input type="submit" name="ny" value="Legg Inn" class="key blue"/>
          </td>
          <td>
            <input type="reset" value="Blank ut" class="key blue"/>
          </td>     
        </tr>
      </table>
    </form>
      </div>
      
      
      
  </body>
</html>
        
    <?PHP }
    
    
    else { ?>
        <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>
      BlogPost
    </title>
    <meta http-equiv="Content-Type"
    content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/blogpost.css" type="text/css"  />
  </head>
  <body id="home">
      <?php include_once 'menu.php'; ?>
      You are not allowed to write here
  </body>
</html>
    <?PHP } ?>


