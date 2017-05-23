<?php require_once('connection.php'); ?>
<?php
session_start();

$existingsql=mysql_query("select * from sod where Start='".$_POST['date1']."'") or die(mysql_error());
while($existing=mysql_fetch_assoc($existingsql)){
	$name = $existing['Name'];
	$end = $existing['End'];
	}



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SOD</title>
<style>
body{
	background-size:cover;
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: 50px;
	text-align: center;
	top: 15px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
	
}

.close:hover { background: #00d9ff; }



.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
	width: 730px;
	position: relative;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	
	
}




.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
	overflow-y:scroll;
	padding-bottom:50px;
}	
#form{
	display:none;
}
.btn{
	outline:none;
	border:none;
	width:90px;
	padding-bottom:9px;
	padding-top:9px;
	border-radius:15px;
	cursor:pointer;
}
.btn:hover{
	background:linear-gradient(rgba(0,0,204,1),rgba(0,255,255,1));
	color:rgb(255,255,255);
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body background="images/img185.jpg">
<h1 align="center" style="color:rgb(255,255,255);">Staff On Duty <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;" class="btnhome"></a></h1>
<div style="margin-left:80px; width:100px; height:100px; background:rgba(0,0,0,0.5); padding-left:20px; padding-top:20px;">
<div style="width:60px; height:60px; padding-bottom:10px; padding-top:3px; padding-left:10px; padding-right:10px; border-radius:60px; background:linear-gradient(rgba(204,255,0,1),rgba(204,204,153,1));">

<div align="center">
<br/>
<?php
$get="SELECT * FROM `sod` WHERE `Start` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER by `id`  LIMIT 1";
$runget=mysql_query($get) or die(mysql_error());
while($fetch = mysql_fetch_array($runget)){
	/*$fd = date('m,d,Y',(strtotime($fetch['End'])));
	$sd = date('m,d,Y',(strtotime($fetch['Start'])));
	$target= mktime(0,0,0,$fd);
	$start= mktime(0,0,0,$sd);*/
	$today= time();
	//$countdown = round(($target - $today)/86400);
	$cd= round((strtotime($fetch['End']) - $today)/86400);
	
/*$start = new DateTime($fetch['Start']);
$end = new DateTime($fetch['End']);

$days = ($start->diff($end));*/
if($cd > 1){
echo $cd.'&nbsp;'.'days'.'<br/>'.'more';
}
else if($cd == 1){
echo $cd.'&nbsp;'.'day'.'<br/>'.'more';
}
else if($cd <1){
echo 'The'.'&nbsp;'.'shift'.'<br/>'.'ends Today';
}
else if($fetch['End']===date('Y-m-d')){
		echo 'The'.'&nbsp;'.'shift'.'<br/>'.'ends Today';
		}
}
?>
</div>
</div>
</div>
<script>
function allworkers(){
	window.location.href='?month=<?php echo date('n') ?>#allworkers';
	
	}
function dutystatus(){
	window.location.href='?month=<?php echo date('n') ?>#dutystatus';
	}
</script>
<div align="center" style="margin-top:-100px;">
<input type="button" value="See All Workers On Duty" onClick="allworkers()" style="width:238px; border-top-left-radius:238px; padding-bottom:4px; padding-top:4px; border:none; outline:none; cursor:pointer; border-top-right-radius:238px;" class="btnroaster">

<input type="button" style="width:4px; visibility:hidden; ">

<input type="button" onClick="dutystatus()" value="See Duty Status" style="width:238px; border-top-right-radius:238px; padding-bottom:4px; padding-top:4px; border:none; outline:none; cursor:pointer; border-top-left-radius:238px;">

<div style="background:rgba(0,0,0,0.6); width:500px; padding-top:10px; padding-bottom:40px; height:auto; margin-bottom:-40px;">

<table>
<?php
$url="<div align='center'><a href='SOD.php?Worker=".$_GET['Worker']."'>Back</a></div>";
$getcount=mysql_query("SELECT count(*) as count FROM `sod` WHERE `Start` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER by `id`  LIMIT 1") or die(mysql_error());
while($count=mysql_fetch_assoc($getcount)){
	if($count['count']<1){
		?>
      <tr><td colspan=100%><h2 align="center" style="color:rgb(255,255,255);">No worker is on duty at the moment</h2></td></tr>
        <?php
		}else{
	
$get="SELECT * FROM `sod` WHERE `Start` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER by `id`  LIMIT 1";
$runget=mysql_query($get) or die(mysql_error());
while($fetch = mysql_fetch_array($runget)){
?>
<tr style="color:rgb(255,255,255);"><td colspan=""><h3>Day: <?php echo date('l'); ?></h3></td></tr>
<tr style="color:rgb(255,255,255);"><td>Name:</td><td><?php echo'<div style="font-weight:bold;">'. $fetch['Name'].'</div>'; ?></td></tr>

<tr style="color:rgb(255,255,255);"><td colspan="2"><h3>Duration</h3></td></tr>
<tr style="color:rgb(255,255,255);"><td>From:</td><td><?php echo date('l jS F, Y',(strtotime($fetch['Start'])))?></td></tr>
<tr style="color:rgb(255,255,255) ;"><td>To:</td><td><?php echo date('l jS F, Y',(strtotime($fetch['End'])))?></td></tr>

<?php
}
}
}
if(isset($_POST['send']) && $_POST['date1']!="" && !empty($_POST['date2']) && !empty($_POST['name'])){
	$insert ="INSERT INTO `sod`( `Start`, `End`, `Name`) VALUES ('".$_POST['date1']."','".$_POST['date2']."','".$_POST['name']."')";
	$execute = mysql_query($insert) or die('<div style="padding:15px 15px 15px 15px; background:linear-gradient(rgba(251,251,251,1),rgba(251,251,251,1)); border-radius:10px; width:400px;">'.
		'You can\'t assign '.$_POST['name'].' on duty for the week of '.'<br/>'.date('l jS F, Y',(strtotime($_POST['date1']))).'&nbsp;'.'-'.'&nbsp;'.date('l jS F, Y',(strtotime($_POST['date2']))).
		'<br/>'.'<br/>'.$name.' has being assigned on duty for the week of '.'<br/>'.date('l jS F, Y',(strtotime($_POST['date1']))).'&nbsp;'.'-'.'&nbsp;'.date('l jS F, Y',(strtotime($end))).'<br>'.$url.'</div>');
	if($execute){
			?>
            <script>
			alert("Worker assigned successfully");
			</script>
            <?php
			}else{
				?>
                <script>
			alert("Error assigning worker!");
			</script>
				<?php
				}
	}
?>
</table>
</div>
</div>
<br/><br/>

<?php
$findsql=mysql_query("SELECT count(*) as count FROM `work_details` WHERE `Usertype`='Admin' and `Username`='".$_GET['Worker']."'") or die(mysql_error());
while($find=mysql_fetch_assoc($findsql)){
	if($find['count']<1){
		echo'<style>.ctrl{display:none;}.btnhome{display:none;} .btnroaster{display:none;} </style>';
		
		}
	
	}


?>
<div align="center">
<div style="width:500px; padding-top:10px; padding-bottom:10px; background:linear-gradient(rgb(0,255,204),rgba(0,255,255,1)); height:auto;" class="ctrl">
<h3 align="center">Click here to add a new worker on duty</h3>
<input type="button" value="Add" id="btn" onClick="show()" class="btn">
<br/><br/>
<div id="form">
<div align="center">
<input type="button" value="Hide" onClick="hide()" class="btn"><br/><br/>
</div>
<table>
<form action="" method="post" name="sod">
<tr><th>Start Date</th><th>Finish Date</th><th>Name</th></tr>
<tr><td><input type="date" name="date1" required style="padding-bottom:5px; padding-left:5px; padding-right:5px; padding-top:5px;"></td><td><input type="date" name="date2" required style="padding-bottom:5px; padding-left:5px; padding-right:5px; padding-top:5px;"></td><td>
<select required name="name" style="padding-bottom:5px; padding-left:5px; padding-right:5px; padding-top:5px;">
<?php
$sql="select * from work_details";
$run = mysql_query($sql) or die(mysql_error());
while($array = mysql_fetch_array($run)){
	echo'<option value="'.$array['Username'].'">'. $array['Username'].'</option>';
	
	}
?>
</select></td></tr>
<tr><td></td><td><input type="submit" name="send" value="Submit" class="btn" style="margin-left:15px;"></td></tr>
</form>
</table>

</div>
<marquee style="background:linear-gradient(rgba(204,255,0,0.8),rgba(102,255,0,0.8)); padding-bottom:5px; padding-top:5px; margin-bottom:-20px;">Copyright &copy;Software Engineering Group2, 2017</marquee>
</div>

<script>
function show(){
	document.getElementById('form').style.display="block";
	}
function hide(){
	document.getElementById('form').style.display="none";
	}	
</script>
</div>

<div id="allworkers" class="modalDialog" style="background:url(images/img185.jpg); background-size:cover;">

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
		
		document.location.href = "SOD.php?month="+monthstring+"&year="+year+"#allworkers";
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
	
	document.location.href = "SOD.php?month="+monthstring+"&year="+year+"#allworkers";
	}	
</script>
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

<a href="SOD.php?Worker=<?php echo $_SESSION['MM_Username']?>" class="close">X</a>
<h1 align="center" style="color:rgb(255,255,255);">Duty Roaster For All Workers</h1>

<span style="float:right; margin-right:30px; margin-top:-0px; z-index:-99999;">
<table align="right" width="200" style="color:rgb(255,255,255);" border="1">
<tr><td colspan=100% style="text-align:center; padding-top:5px; padding-bottom:5px;">Legends</td></tr>
<tr><td width="40" style="padding-top:5px; padding-bottom:5px;text-align:center; padding-left:8px; padding-right:8px;">
<div align="center"><div style="width:10px; height:10px; background:rgb(204,255,0);"></div></div>
</td><td width="160" style="padding-top:5px; padding-bottom:5px; text-align:center; padding-left:8px; padding-right:8px;"> Current week  </td></tr>
<tr><td width="40" style="padding-top:5px; padding-bottom:5px;text-align:center; padding-left:8px; padding-right:8px;">
<div align="center"><div style="width:10px; height:10px; background:rgba(255,255,204,0.8);"></div></div>
</td><td width="160" style="padding-top:5px; padding-bottom:5px; text-align:center; padding-left:8px; padding-right:8px;">  All other weeks </td></tr>
</table>
</span>


<table align="center" style="width:1000px; margin-left:100px;" border="1">
<tr>
        <td><button name="prevBtn" onClick="prevMonth(<?php echo $month.", ".$year ?>)"  style="width:150px; padding-top:10px; padding-bottom:10px; cursor:pointer; background:linear-gradient(rgba(0,0,0,0.5),rgba(153,153,153,0.5));"><img src="images/arrow-left.gif"  height="29" width="29"></button></td>
        
        <td colspan=70% style="text-align:center; padding-top:0px; padding-bottom:0px; width:700px; background:linear-gradient(rgba(153,153,153,1),rgba(0,0,0,1)); color:rgb(255,255,0);"><h3><?php echo $monthname.", ".$year; ?></h3></td>
        
        <td><button name="nextBtn"  onClick="nextMonth(<?php echo $month.", ".$year ?>)" style="width:150px; padding-top:10px; padding-bottom:10px; cursor:pointer; background:linear-gradient(rgba(0,0,0,0.5),rgba(153,153,153,0.5));"><img src="images/arrow-right.gif"  height="29" width="29"> </button></td>
        
</tr>
<?php
$dutycount=1;
if($month>=date('n')){
$curmonthcountsql=mysql_query("select count(*) as count from sod where MONTH(Start)='".$_GET['month']."'") or die(mysql_error());	
while($curmonthcount=mysql_fetch_assoc($curmonthcountsql)){
	if($curmonthcount['count']<1){
	?>	
  <tr style=" background:rgba(255,255,204,1);">  
  <td colspan=100%><h2 align="center">No information for this month</h2></td>
  
    </tr>
    
	<?php	
	}else{
		$curmonthsql=mysql_query("select *  from sod where MONTH(Start)='".$_GET['month']."' and MONTH(End)='".$_GET['month']."'") or die(mysql_error());	
while($curmonth=mysql_fetch_assoc($curmonthsql)){
	$firstday=date('Y-m-d',strtotime('sunday last week'));
	$lastday=date('Y-m-d',strtotime('sunday this week'));
	
	
	if($curmonth['Start']==$firstday)
		$classname1="thisweek1";
	
	else
		$classname1="allweeks1";
	
	
?>
<form action="" method="post">
<tr class="<?php if(isset($classname1)) echo $classname1;?>">
<td  style="text-align:center; width:30px; padding-bottom:5px; padding-top:5px;"><input type="radio" name="duty" value="<?php echo $curmonth['Name']; ?>" required class="rbtn" ></td>

<td width="400" style="text-align:center; padding-bottom:5px; padding-top:5px;" colspan="2" name="tvalue"><?php echo date('l jS F, Y',(strtotime($curmonth['Start'])))."&nbsp;"."&nbsp;"."-"."&nbsp;"."&nbsp;".date('l jS F, Y',(strtotime($curmonth['End'])))  ?><input type="hidden" name="tvalue1" value="<?php echo date('l jS F, Y',(strtotime($curmonth['Start'])))."&nbsp;"."&nbsp;"."-"."&nbsp;"."&nbsp;".date('l jS F, Y',(strtotime($curmonth['End'])))  ?>">
<input type="hidden" name="tvalue2" value="<?php echo $curmonth['Start'] ?>">

</td>
<td width="270" style="text-align:center; padding-bottom:5px; padding-top:5px;"><?php echo $curmonth['Name']  ?></td>
<td width="200" colspan=100% style="padding-bottom:5px; padding-top:5px;">
<input type="submit" name="edit" value="Edit" style="width:80px; padding-bottom:5px; padding-top:5px; margin-left:5px;" onClick="return(confirm('Sure about substituting worker?'))">
<input type="submit" name="delete" style="width:80px; margin-left:10px; padding-bottom:5px; padding-top:5px;" value="Delete" onClick="return(confirm('Sure about deleting record?'));"></td>
</tr>
</form>
<style>
.thisweek1{
	background:rgb(204,255,0);
	color:rgb(0,0,0);
}
.allweeks1{
	background:rgba(255,255,204,0.8);
}
</style>
<?php

	
}
	}
	
}
}else if($month < date('n')){
?>	
<tr>
<td>radio</td>
<td>week</td>
<td>worker</td>
</tr>
<?php	
}

?>
</table>
<table align="center">
<form action="" method="POST" name="updatepro">
<tr><th colspan="2">Edit Record</th></tr>

<tr><td>Name</td><td>Week Of Duty</td><td>Options</td></tr>

<tr>
<td><input type="text" id="name" name="oldname" value="<?php echo $_POST['duty']; ?>" readonly style="width:220px; padding:5px 5px 5px 5px;"></td>

<td>
<?php
$getuser  = mysql_query("Select * from sod where Name='".$_POST['duty']."'") or die("no records available");
while($fetchgetuser= mysql_fetch_array($getuser)){
	$postuser = $fetchgetuser['Name'];
	$postweek =  date('l jS F, Y',(strtotime($fetchgetuser['Start'])))."&nbsp;"."&nbsp;"."-"."&nbsp;"."&nbsp;".date('l jS F, Y',(strtotime($fetchgetuser['End'])));
	

?>

<?php
}

?>

<input type="text" id="post" name="oldpost" value="<?php echo $_POST['tvalue1'];  ?> " readonly style="width:300px; padding:5px 5px 5px 5px;">
<input type="hidden" name="dvalue" value="<?php echo $_POST['tvalue2'];  ?> ">
</td>

<td><a href="pro.php"><input type="button" value="Maintain" onClick="return(maintain());"></a></td>

</tr>


<tr><td><select name="ename" style="width:173px; padding:5px 5px 5px 5px;" required id="ename">
<?php

$finduser = mysql_query("SELECT distinct Name FROM `sod` WHERE `Name`  NOT in('".$_POST['duty']."')") or die(mysql_error());


while($fetchfinduser= mysql_fetch_array($finduser)){
	$founduser = $fetchfinduser['Name'];
	$foundpos =  date('l jS F, Y',(strtotime($fetchfinduser['Start'])))."&nbsp;"."&nbsp;"."-"."&nbsp;"."&nbsp;".date('l jS F, Y',(strtotime($fetchfinduser['End'])));
	

echo'<option value="'.$founduser.'">'.$founduser.'</option>';
}

?>
</select></td>
<td>
<input type="text" name="epos" value="<?php echo $_POST['tvalue1'];  ?>" readonly style="width:300px; padding:5px 5px 5px 5px;" id="epos">
<?php

?>
</td>
<td>

<input type="submit" value="Replace" name="updateduty">

</td>

</tr>


</form>

</table>
</div>
</div>
</div>

<?php
if(isset($_POST['edit'])){
	
	
	
	}
if(isset($_POST['delete'])){
	
	
	
	}


?>


<div id="dutystatus" class="modalDialog">
<a href="SOD.php?Worker=<?php echo $_SESSION['MM_Username']?>" class="close">X</a>
<h1 align="center" style="color:rgb(255,255,255);">Your Duty Roaster For This Month</h1>

<span style="float:right; margin-right:50px; margin-top:-0px; z-index:-99999;">
<table align="right" width="200" style="color:rgb(255,255,255);" border="1">
<tr><td colspan=100% style="text-align:center; padding-top:5px; padding-bottom:5px;">Legends</td></tr>
<tr><td width="40" style="padding-top:5px; padding-bottom:5px;text-align:center; padding-left:8px; padding-right:8px;">
<div align="center"><div style="width:10px; height:10px; background:rgb(255,255,0);"></div></div>
</td><td width="160" style="padding-top:5px; padding-bottom:5px; text-align:center; padding-left:8px; padding-right:8px;"> Current week  </td></tr>
<tr><td width="40" style="padding-top:5px; padding-bottom:5px;text-align:center; padding-left:8px; padding-right:8px;">
<div align="center"><div style="width:10px; height:10px; background:rgb(0,255,255);"></div></div>
</td><td width="160" style="padding-top:5px; padding-bottom:5px; text-align:center; padding-left:8px; padding-right:8px;">  All other weeks </td></tr>
</table>
</span>

<table width="700" align="center" style="border:4px rgba(0,0,255,0.3) solid; margin-left:350px;">
<tr style="background:rgba(0,255,255,0.7);"><th colspan=100%><h3 align="center">Roaster for month of <?php echo date('F'); ?></h3></th></tr>
<tr style="background:linear-gradient(rgba(255,255,255,0.9),rgba(0,255,255,0.9)); text-align:center; ">
<td width="100" style="padding-top:10px; padding-bottom:10px;">##</td>
<td width="300" style="padding-top:10px; padding-bottom:10px;">From</td>
<td width="300" style="padding-top:10px; padding-bottom:10px;">To</td>
</tr>
<?php
$counter=1;
$rdatecountsql=mysql_query("select count(*) as count from sod where MONTH(Start)='".date('m')."' AND MONTH(End)='".date('m')."' AND Name='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($rdatecount=mysql_fetch_assoc($rdatecountsql)){
if($rdatecount['count']<1){
	?>
    <tr style=" background:linear-gradient(rgba(255,255,255,0.7),rgba(0,255,255,0.7));"><td colspan=100% style="text-align:center; font-weight:bold; font-size:20px; padding-bottom:20px; padding-top:20px; padding-left:5px; padding-right:5px;">No duty roaster information available for this month</td></tr>
	<?php
	}else{
?>

<?php
$rdatesql=mysql_query("select * from sod where MONTH(Start)='".date('m')."'   AND Name='".$_SESSION['MM_Username']."' union select * from sod where  MONTH(End)='".date('m')."' AND Name='".$_SESSION['MM_Username']."' order by Start asc") or die(mysql_error());
while($rdate=mysql_fetch_array($rdatesql)){
	$firstday=date('Y-m-d',strtotime('sunday last week'));
	$lastday=date('Y-m-d',strtotime('sunday this week'));
	
	
	if($rdate['Start']==$lastday)
		$classname="thisweek";
	else
		$classname="allweeks";
		
	?>
    
    <tr class="<?php if(isset($classname)) echo $classname;?>">
    <td width="100" style="padding-top:5px; padding-bottom:5px; padding-left:5px;"><?php echo $counter ?></td>
<td width="300" style="padding-top:5px; padding-bottom:5px; padding-left:5px;"><?php echo date('l jS F, Y',(strtotime($rdate['Start']))) ?></td>
<td width="300" style="padding-top:5px; padding-bottom:5px; padding-left:5px;"><?php echo date('l jS F, Y',(strtotime($rdate['End'])))?></td>
    </tr>
	<?php
	$counter++;
	}
}
}

?>
</table>

<style>
.thisweek{
	background:rgb(255,255,0);
}
.allweeks{
	background:linear-gradient(rgba(255,255,255,0.9),rgba(0,255,255,0.7));
	}
</style>
</div>
</body>
</html>