<?php 

    # ***  Set time stamp.Check for month requested(value from request form) 
    # ***  If no value has been set then make it for current month 

   if(!$year){$year=2000; } 
     if(!$req_month || $req_month=="none") 
      { 
         $dt_and_tm=time(); 
      } 
      else 
      { 
         $dt_and_tm=mktime(0,0,0,$req_month,1,$year); 
      } 
   # *** Find out the month number from the time stamp we just created   
    # *** Find out the day of the week from the same(0 to 6 for Sunday to   
    # *** Saturday) add "1" so that it becomes 1 to 7  
                         
         $month=date("n",$dt_and_tm); 
         $week_day=date("w",$dt_and_tm)+1;      

    # *** Set number days in requested month   
          
if($month==1 || $month==3 || $month==5 || $month==7 || $month==8 || $month==10 || 
$month==12) 
{     
   $no_of_days=31;     
} 
elseif($month==4 || $month==6 || $month==9 || $month==11) 
{   
   $no_of_days=30; 
}   

 # *** If the month requested is Feb. Check whether it is Leap Year      

elseif($month==2) 
{   
                   if(date("L",$dt_and_tm)) 
                   { $no_of_days=29 ;} 
                   else 
                   {$no_of_days=28;} 
} 
   $month_full=date("F",$dt_and_tm); 
     

# ************ HTML code goes from here  
# ************ First row in HTML table displays month and year   
# ************ Second row is allotted for week days 
# ************ Table contains six more rows (total 42 table cells)   
?> 
<html> 
<body> 
<table width=300> 
<tr bgcolor="#003366"><td colspan=7> 
<font face="Arial , Times New Roman " size=2 color="#ffffff"><b><?php echo "$month_full   
$year" ; ?></b></font></td></tr> 
<tr bgcolor="#006699"> 
<td><font face="Arial , Times New Roman " size=2 color="#ffffff">Sun</fon></td><td><font 
face="Arial , Times New Roman " size=2 color="#ffffff">Mon</font></td><td><font 
face="Arial , Times New Roman " size=2 color="#ffffff">Tue</font></td><td><font 
face="Arial , Times New Roman " size=2 color="#ffffff">Wed</font></td><td><font 
face="Arial , Times New Roman " size=2 color="#ffffff">Thu</font></td><td><font 
face="Arial , Times New Roman " size=2 color="#ffffff">Fri</font></td><td><font face="Arial , 
Times New Roman " size=2 color="#ffffff">Sat</font></td> 
</tr> 
<tr bgcolor="silver"> 
<?php 
# *** We need to start form week day and print total number of days  
# *** in this month.For that we need to find out the last cell.  
# *** While looping end current row and start new row for each 7 cells 

$last_cell=$week_day+$no_of_days;       
for($i=1;$i<=42;$i++) 
{ 
   if($i==$week_day){$day=1;} 
   if($i<$week_day || $i>=$last_cell) 
   { 
         
     echo "<td>?</td>"; 
      if($i%7==0){echo "</tr><tr bgcolor=\"silver\">\n";}    
   } 
   else 
   { 
         
        echo "<td>$day</td>"; 
        $day++; 
       if($i%7==0) { echo "</tr><tr bgcolor=\"silver\">\n"; } 
          
   } 
} 
?> 
</table></body></html>