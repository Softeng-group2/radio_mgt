<?php require_once('connection.php'); ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Number of hours worked</title>


<style>
.input{
	width:100%;
	padding-top:7px; 
	padding-bottom:7px;
	cursor:pointer;
	background:rgb(210,160,104);
	color:rgb(255,255,255);
	outline:none;
	border:none;
	}
.input:hover{
	background:rgb(0,0,0);
	color:rgb(255,255,0);
}
body{
	background-size:cover;
	
}
table{
	background:rgba(204,255,204,0.9);
}
a:link {
	color: rgb(0,0,0);
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: rgb(0,0,255);
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: rgb(0,0,0);
}
.td:hover{
	background:rgb(204,255,0);
}
</style>
<script>
function prevMonth(month, year){
	if(month == 1){
		//if it is the current one,decrease the year and set month to 12
		--year;
		month=13;
		}
		--month
		var monthstring = ""+month+"";
		var monthlength = monthstring.length;
		
		if(monthlength <= 1){
			
			monthstring = "0" + monthstring;
			
			}
		
		document.location.href = "<?php $_SERVER['PHP_SELF']; ?>?month="+monthstring+"&year="+year;
	}
function nextMonth(month, year){
	if(month == 12){
	++year;
	month = 0;
	}
	
	++month
		var monthstring = ""+month+"";
		var monthlength = monthstring.length;
		
		if(monthlength <= 1){
			
			monthstring = "0" + monthstring;
			
			}
	
	document.location.href = "<?php $_SERVER['PHP_SELF']; ?>?month="+monthstring+"&year="+year;
	}	
</script>
</head>

<body background="images/apple_mac_tiger-1280x800.jpg">
<?php
$day = date("j");
$month = date("n");
$year = date("Y");

//checking if day has a passing variable
if(isset($_GET['day'])){
	//if true get date from url
	$day = $_GET['day'];
	}else{
		//set today as day
		$day = date("j");
		
		}


//checking if month has a passing variable
if(isset($_GET['month'])){
	//if true get date from url
	$month = $_GET['month'];
	}else{
		//set current month as month
		$month = date("n");
		
		}
		
		
//checking if year has a passing variable
if(isset($_GET['year'])){
	//if true get date from url
	$year = $_GET['year'];
	}else{
		//set current year as year
		$year = date("Y");
		
		}	

//calender variables
$currentTimestamp = strtotime("01-$month-$year");

//current month name
$monthname = date('F',$currentTimestamp);

//number of days in the current month
$numberOfDays = date('t',$currentTimestamp);

//variable to initialize loop
$counter = 0;

	
?>


<h1 align="left">Click on date to get number of hours worked per week</h1>
<div align="left">

<table border="1" bordercolor="#000000";>
<tr>
        <td><input type="button" name="prevBtn" onClick="prevMonth(<?php echo $month.", ".$year ?>)" value="<" class="input"></td>
        <td colspan="5" style="text-align:center; padding-top:7px; padding-bottom:7px;"><?php echo $monthname.", ".$year; ?></td>
        <td><input type="button" name="nextBtn" value=">"  onClick="nextMonth(<?php echo $month.", ".$year ?>)" class="input"></td>
        

</tr>
<tr><td colspan="7"><marquee>Click on a day to see records for that week</marquee></td></tr>
<tr>
        <td width="60px">Sun</td>
        <td width="60px">Mon</td>
        <td width="60px">Tues</td>
        <td width="60px">Wed</td>
        <td width="60px">Thurs</td>
        <td width="60px">Fri</td>
        <td width="60px">Sat</td>

</tr>

		<?php
			echo"<tr>";
			//looping from one through to the number of days in the month
			for($i =1; $i<$numberOfDays+1; $i++,$counter++){
				//making timestamp for each day in the loop
				$timestamp = strtotime("$year-$month-$i");
				//checking if it's day 1
				if($i==1){
					//get which day day 1 fell on
					$firstday = date("w",$timestamp);
					//making a loop and a blank cell if it is not the first day
					for($j=0; $j < $firstday; $j++,$counter++){
						echo"<td>&nbsp;</td>";
						
						}
					
					}
					//checking if the day is on the last column and making a new row
					if($counter % 7==0){
						echo"<tr></tr>";
						
						}
				$monthstring = $month;
				$monthlength = strlen($monthstring);
				$daystring = $i;
				$daylength = strlen($daystring);		
						
					if($monthlength <= 1){
						$monthstring = "0".$monthstring;
						
						}
					if($daylength <= 1){
						$daystring = "0".$daystring;
						
						}		
					
						
				   echo"<td align='center' class='td'><a href='".$_SERVER['PHP_SELF']."?month=".$monthstring."&day=".$daystring."&year=".$year."&v=true'>".'<div style="display:block;">'.$i.'</div>'."</a></td>";
				   
				}
				
					
					
			echo"</tr>";
		?>
</table>

	<?php
	/*if(isset($_GET['v'])){
		echo'<br/>'."<a href='".$_SERVER['PHP_SELF']."?month=".$month."&day=".$day."&year=".$year."&v=true&f=true' style='width:100%; background:rgba(0,0,0,0.9); padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px; color:yellow;'>Add Event</a>".'<br/>'.'<br/>';
		
		$trysql=mysql_query("select * from test where today='".$_GET['year'].'-'.$_GET['month'].'-'.$_GET['day']."'") or die(mysql_error());
while($try=mysql_fetch_array($trysql)){
	echo $try['User'].'&nbsp;'.$try['today'];
	}
	
		
		}*/
	
	?>
    	
</div>
<br/><br/><?php
if(isset($_GET['v'])){
?>
<div style="float:right; margin-right:200px; height:auto; width:500px; background:rgba(255,255,255,0.8); padding:5px 5px 5px 5px; margin-top:-260px;">
<table cellpadding="8" style="width:500px;">
<?php
$time = strtotime($_GET["year"].'-'.$_GET["month"].'-'.$_GET["day"]);
$weekstartingdate= date('Y-m-d',strtotime("last Sunday",$time));
$weekendingdate= date('Y-m-d',strtotime("next Saturday",$time));
?>
<tr><td colspan="3" style="text-align:center; padding:5px 5px 5px 5px;">Between <?php echo date('l j-M-Y',(strtotime($weekstartingdate))) ?> and <?php echo date('l j-M-Y',(strtotime($weekendingdate)))?></td></tr>
            <tr><th style="text-align:justify;">##</th><th style="text-align:justify;">Worker</th><th style="text-align:justify;">Number of Hours worked</th></tr>





<?php
$worksql= mysql_query("SELECT `Name`, SUM(`Hours_worked`) as workhours FROM `attendance` WHERE `Date` BETWEEN '".$weekstartingdate."' AND '".$weekendingdate."' GROUP BY `Name`") or die(mysql_query());
$count = 1;
?>

<?php
while($work= mysql_fetch_array($worksql)){
	if(mysql_num_rows($worksql)<1){
		echo"<h2 align='center'>No records available for this week</h2>";
		}else{
			?>
            
            <tr><td><?php echo $count; ?></td><td><?php echo $work['Name']  ?></td><td><?php echo $work['workhours'] ?></td></tr>
            
			<?php
			}
	$count++;
	}
}
?>
</table>
</div>  


<?php
if($_GET['month']!=="" && $_GET['year']!==""){
$getmonthquery=mysql_query("select * from attendance where") or die(mysql_error());	
	
	
	
	}


 ?>
</body>
</html>