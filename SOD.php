<?php require_once('connection.php'); ?>
<?php
if(isset($_POST['send']) && $_POST['date1']!="" && !empty($_POST['date2']) && !empty($_POST['name'])){
	$insert ="INSERT INTO `sod`( `Start`, `End`, `Name`) VALUES ('".$_POST['date1']."','".$_POST['date2']."','".$_POST['name']."')";
	$execute = mysql_query($insert) or die(mysql_error());
	if($execute){
			?>
            <script>
			alert("Record uploaded successfully");
			</script>
            <?php
			}else{
				?>
                <script>
			alert("Error uploading record!");
			</script>
				<?php
				}
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SOD</title>
<style>
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
</style>
</head>

<body background="images/img185.jpg">
<h1 align="center" style="color:rgb(255,255,255);">Staff On Duty <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;"></a></h1>
<div style="margin-left:80px; width:100px; height:100px; background:rgba(0,0,0,0.5); padding-left:20px; padding-top:20px;">
<div style="width:60px; height:60px; padding-bottom:10px; padding-top:5px; padding-left:10px; padding-right:10px; border-radius:60px; background:linear-gradient(rgba(204,255,0,1),rgba(204,204,153,1));">
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
echo 'Your'.'&nbsp;'.'shift'.'<br/>'.'has ended';
}
else if($fetch['End']===date('Y-m-d')){
		echo 'Your'.'&nbsp;'.'shift'.'<br/>'.'has ended';
		}
}
?>
</div>
</div>
</div>
<div align="center" style="margin-top:-100px;">
<div style="background:rgba(0,0,0,0.6); width:500px; padding-top:10px; padding-bottom:40px; height:auto; margin-bottom:-40px;">
<table>
<?php
$get="SELECT * FROM `sod` WHERE `Start` > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER by `id`  LIMIT 1";
$runget=mysql_query($get) or die(mysql_error());
while($fetch = mysql_fetch_array($runget)){
?>
<tr style="color:rgb(255,255,255);"><td colspan=""><h3>Day: <?php echo date('l'); ?></h3></td></tr>
<tr style="color:rgb(255,255,255);"><td>Name:</td><td><?php echo'<div style="font-weight:bold;">'. $fetch['Name'].'</div>'; ?></td></tr>

<tr style="color:rgb(255,255,255);"><td colspan="2"><h3>Duration</h3></td></tr>
<tr style="color:rgb(255,255,255);"><td>From:</td><td><?php echo date('l j-M-Y',(strtotime($fetch['Start'])))?></td></tr>
<tr style="color:rgb(255,255,255);"><td>To:</td><td><?php echo date('l j-M-Y',(strtotime($fetch['End'])))?></td></tr>

<?php
}
?>
</table>
</div>
</div>
<br/><br/>
<div align="center">
<div style="width:500px; padding-top:10px; padding-bottom:10px; background:linear-gradient(rgb(0,255,204),rgba(0,255,255,1)); height:auto;">
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

</body>
</html>