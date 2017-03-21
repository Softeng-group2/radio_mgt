<?php require_once('connection.php'); ?>

<?php
if(isset($_POST['save']))
{	$lt = $_POST['lt'];	
	$total = $_POST['total'];
		if($lt == "Sunday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `sunday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." record(s) were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}
		
	if($lt == "Monday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `monday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}	
	
		
		
		
		
	if($lt == "Tuesday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `tuesday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}	


if($lt == "Wednesday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `wednesday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}
		

if($lt == "Thursday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `thursday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}
if($lt == "Friday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `friday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}
	if($lt == "Saturday"){
	for($i=1; $i<=$total; $i++)
	{
		$st = $_POST["st$i"];
		$ft = $_POST["ft$i"];
		$prog = $_POST["prog$i"];
		$host = $_POST["host$i"];		
		$sql="INSERT INTO `saturday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
		$runSql = mysql_query($sql,$connect);		
	}
	
	if($runSql)
	{
		?>
        <script>
		alert('<?php echo $total." records were inserted !!!"; ?>');
		window.location.href='lineUp.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while inserting , TRY AGAIN');
		</script>
        <?php
	}
		}	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Program LineUp Form</title>
<style>
.h1 h1{
	color:rgb(0,0,0);
}
.h1 span{
	color:rgb(255,255,0);
}
.con-for-day{
	width:100%;
	background:linear-gradient(rgba(102,255,0,0.5),rgba(102,255,51,0.5),rgba(102,255,153,0.5),rgba(102,255,102,0.5),rgba(102,255,0,0.5));
	color:rgb(0,0,0);
	padding-left:5px;
	padding-right:5px;
	padding-bottom:5px;
	padding-top:5px;
	margin-top:-5px;
}

.con{
	width:62%;
	height:auto;
	background:rgba(255,255,255,0.5); 
	overflow:scroll;
	border:8px groove rgba(0,255,51,1);}
	button{
		background:rgb(0,0,0);
		color:rgb(204,255,0);
		width:100px;
	padding-bottom:8px;
	padding-top:8px;
	border-radius:5px;}
	
</style>
</head>
<script src="js-script.js" type="text/javascript"></script>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
<body background="images/musical_party-1280x800.jpg">
<h1 align="center" class="h1"><span>UPLOAD PROGRAM LINE-UP HERE</span></h1>

<div align="center">
<div class="con">
<marquee style="background:rgba(204,255,0,1)">Please enter number of actvities for a day before going on to insert schedules for that day</marquee>

<div class="con-for-day">
<form method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">

<table>

<tr>
<td>Enter the number of records you want to insert for a Day</td>
</tr>

<tr>
<td>
<input type="text" name="no_of_rec" placeholder="how many records do you want to enter ? ex : 1 , 2 , 3 , 5" maxlength="2" pattern="[0-9]+" class="form-control" required size="35" />
</td>
</tr>

<tr>
<td><button type="submit" name="btn-form1" >Generate</button> 


</td>
</tr>

</table>

</form>
<?php
if(isset($_POST['btn-form1']))
{
	if($_POST['no_of_rec']=='0'){
		?>
      <div align="center">
        <div style="width:60%; height:auto; padding-bottom:10px; padding-top:10px; padding-left:5px;
        padding-right:5px; border-radius:10px; background:rgba(0,255,0,0.8);">
        <h1>You must enter a positive whole number greater than zero!!!</h1>
        </div>
        </div>
        
       <?php 
		}else{
			if($_POST['no_of_rec']>'10'){
				?>
             <style>
			.con{
				height:500px;}
			 </style>   
             <?php   
				}
	?>
    
    <form method="post">
    <input type="hidden" name="total" value="<?php echo $_POST["no_of_rec"]; ?>" />
	<table cellspacing="5">
    
    <br/>
    <label>Table</label><select name="lt" required>
<option value="">Select Program-line up table</option>
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
</select> 
<br/><br/>
<tr>
    <th>#</th><th>Start time</th>
     <th >Finish time</th>
     <th >Program</th>
     <th >Host</th></tr>
	<?php
	for($i=1; $i<=$_POST["no_of_rec"]; $i++) 
	{
		?>
       
      
<tr>
<td><?php echo $i; ?></td>
<td><input type="time" name="st<?php echo $i; ?>" required></td>
<td><input type="time" name="ft<?php echo $i; ?>" required></td>
<td style="margin-left:10px;"><input type="text" name="prog<?php echo $i; ?>" size="35" required></td>
<td style="margin-left:10px;"><input type="text" name="host<?php echo $i; ?>" size="35" required></td>
        </tr>
        <?php
	}
	?>
    <tr>
    <td colspan="3">
    
    <button type="submit" name="save" >Upload Records</button> 

    
    
    </td>
    </tr>
    </table>
    </form>
	<?php
}
}
?>
</div>
</div>
</div>
</body>
</html>