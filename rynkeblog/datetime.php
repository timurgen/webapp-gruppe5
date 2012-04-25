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


<form name="calendar" onchange="update()">
    Vis innlegg for:
    <select name="month">
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="Juny">Juny</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="Desember">Desember</option>
    </select>
    <select name="year">
        <?PHP
       
        
            $year = date('Y');
             for($i = ($year - 5); $i < $year+1; $i++){
                 if($i == $year) {
                     echo "<option selected=\"selected\" name=\"year\">".$i."</option>";
                 }
                 else{
                     echo "<option name=\"year\">".$i."</option>"; 
                 }
                 
             }
              include ('BlogEntityHandler.class.php');
      
  
             
        ?>
        
    </select>
    
     <input name="btnGo" type="submit" id="btngo" value="show"> <br />
    
     
     
    
</form>






                        

