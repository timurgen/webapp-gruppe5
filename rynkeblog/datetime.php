<?php
/*
 * 
 * 
 */
?>
<script type="text/javascript">
function update() {

}
</script>

  <?php 
        
   echo " <form name=\"calendar\"  action=\"datetime.php\" method =\"get\">
    Vis innlegg for:
    <select name=\"month\">
        <option value=\"1\">January</option>
        <option value=\"2\">February</option>
        <option value=\"3\">March</option>
        <option value=\"4\">April</option>
        <option value=\"5\">May</option>
        <option value=\"6\">Juny</option>
        <option value=\"7\">July</option>
        <option value=\"8\">August</option>
        <option value=\"9\">September</option>
        <option value=\"10\">October</option>
        <option value=\"11\">November</option>
        <option value=\"12\">Desember</option>
    </select>
    <select name=\"year\">";
       
        
            $year = date('Y');
             for($i = ($year - 5); $i < $year+1; $i++){
                 if($i == $year) {
                     echo "<option selected=\"selected\" name=\"year\">".$i."</option>";
                 }
                 else{
                     echo "<option name=\"year\">".$i."</option>"; 
                 }
                 
             }
             
        echo "<input type=\"submit\" name=\"go\" value=\"go\"/>
        
      
    </select>
</form>";
  
        if(isset($_POST["go"]))
        {   
            require("blogentityhandler.class");
            $month = $_GET["month"];
            $year = $_GET["year"];
            
            $blogDatabase = new BlogEntityHandler();
            
            $blogger = $blogDatabase->getPostByM($month, $_year);
            
            echo $blogger;
        }else
        {
            echo "ssssssss";
        }
        
?>

 
      




           
 






                        

