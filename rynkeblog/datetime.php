<?php
//Funker bra Vitaly
?>
<script type="text/javascript">
function update() {
    alert(document.getElementById('mt').value)
}
</script>

  <?php 
        
   echo "<form action=\"blogpost_archive.php\" method =\"post\">
    Vis innlegg for:
    <select name=\"month[]\">
        <option value=\"January\">January</option>
        <option value=\"February\">February</option>
        <option value=\"March\">March</option>
        <option value=\"April\">April</option>
        <option value=\"May\">May</option>
        <option value=\"June\">June</option>
        <option value=\"July\">July</option>
        <option value=\"August\">August</option>
        <option value=\"September\">September</option>
        <option value=\"October\">October</option>
        <option value=\"November\">November</option>
        <option value=\"December\">December</option>
    </select>
        <input type=\"submit\" name=\"go\" value=\"go\"/>
    </select>
</form>";
  
  /*echo "<form action=\"blogpost_archive.php\" method=\"post\" onsubmit=\"return update()\">
      <input type=\"text\" id='mt' name=\"month\" />
      <input type=\"submit\" name=\"go\" value=\"go\"/>";/*
   
   
        /*<select name=\"year\">";
        $year = date('Y');
        for($i = ($year - 5); $i < $year+1; $i++){
        if($i == $year) {
        echo "<option selected=\"selected\" name=\"year\">".$i."</option>";
        }
        else{
        echo "<option name=\"year\">".$i."</option>"; 
        }}*/        
?>

 
      




           
 






                        

