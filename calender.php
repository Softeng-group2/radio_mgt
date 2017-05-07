<?php require_once('connection.php'); ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>New event</title>


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
	background:rgba(255,255,255,0.5);
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

<?php
		if(isset($_GET['add']) && !empty($_POST['title']) && !empty($_POST['details'])){
			$title = mysql_real_escape_string($_POST['title']);
			$detail = mysql_real_escape_string($_POST['details']);
			$eventdate = $year."-".$month."-".$day;
			
			$sql ="INSERT INTO `events`( `Title`, `Details`, `EventDate`, `DateAdded`) VALUES ('".$title."','".$detail."','".$eventdate."',now())";
			$run = mysql_query($sql) or die(mysql_error());
			if($run){
				
              
				 echo'<div align="center">'.'<div style="background:linear-gradient(rgba(255,255,255,0.5) 50%,rgba(192,120,22,0.2)); width:200px; padding-left:20px; padding-right:20px;padding-top:30px;padding-bottom:30px; color:black;">'."<h2>Successfully added</h2>".'</div>'.'</div>';
				
				
				}
				
				
				else{
				
			 echo'<div align="center">'.'<div style="background:linear-gradient(rgba(255,255,255,0.3),rgba(192,120,22,0.)); width:200px; padding-left:20px; padding-right:20px;padding-top:20px;padding-bottom:20px; color:white;">'."<h2>error adding events</h2>".'</div>'.'</div>';
				
					
					}
			
			}
?>
<h1 align="center">ADD EVENTS HERE</h1>
<div align="center">

<table border="1" bordercolor="#000000";>
<tr>
        <td><input type="button" name="prevBtn" onClick="prevMonth(<?php echo $month.", ".$year ?>)" value="<" class="input"></td>
        <td colspan="5" style="text-align:center; padding-top:7px; padding-bottom:7px;"><?php echo $monthname.", ".$year; ?></td>
        <td><input type="button" name="nextBtn" value=">"  onClick="nextMonth(<?php echo $month.", ".$year ?>)" class="input"></td>
        

</tr>
<tr><td colspan="7"><marquee>Click on a day to add a new event	</marquee></td></tr>
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
	if(isset($_GET['v'])){
		echo'<br/>'."<a href='".$_SERVER['PHP_SELF']."?month=".$month."&day=".$day."&year=".$year."&v=true&f=true' style='width:100%; background:rgba(0,0,0,0.9); padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px; color:yellow;'>Add Event</a>".'<br/>'.'<br/>';
		
		/*$trysql=mysql_query("select * from test where today='".$_GET['year'].'-'.$_GET['month'].'-'.$_GET['day']."'") or die(mysql_error());
while($try=mysql_fetch_array($trysql)){
	echo $try['User'].'&nbsp;'.$try['today'];
	}*/
	
		if(isset($_GET['f'])){
			include("eventform.php");
			
			}
		}
	
	?>
    	
</div>
<br/><br/>
<div align="center"><?php $get="SELECT * FROM `events` WHERE `EventDate` = '".date('m-d-Y')."'";
$runget = mysql_query($get) or die(mysql_error());
while($fetch= mysql_fetch_array($runget)){
	echo $fetch['EventDate'].'<br/>';
	
	}

 ?></div>   
</body>
</html>