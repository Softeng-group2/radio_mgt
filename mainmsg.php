<?php require_once('connection.php'); ?>
<?php

  session_start();
$session = $_SESSION["MM_Username"];

$sender=  $row_Recordset1['Username'];
if(isset($_POST['send'])){
	$receipient=$_GET['Receipient'];
	
	$date = date('l j-M-Y');
			$time = date('H:i:s A');
			$msg = $_POST['msg'];
	$sql="INSERT INTO `messages`( `Sender`, `Message`, `Receipient`, `PeriodTime`, `PeriodDate`) VALUES ('".$session."','".$msg."','".$receipient."','".$time."','".$date."')";		
	
	$runquery = mysql_query($sql) or die(mysql_error());
	if($runquery){
		?>
<script>
		alert("Message successfully sent to " + "<?php echo $receipient;?>");
		</script>
		<?php
		}else{
		?>	
<script>
		alert("Error sending message to " + "<?php echo $receipient;?>");
		</script>	
		<?php	
			}
			
	}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Messaging</title>
<style>
textarea{
	resize:none;
	width:90%;
}
.con{
	width:500px;
	height:520px;
	margin-bottom:30px;
	float:right;
	margin-right:150px;
	margin-top:-20px;
	margin-bottom:80px;
}
.msghead{
width:500px;
 border-top-left-radius:85px; 
 border-top-right-radius:85px; 
 background:url(images/mac_apple_logo_creative_94063_1920x1080.jpg);
  padding-bottom:3px; 
  padding-top:3px; 
  border:1px #000000 solid;	
  height:50px;
	}
.msgbody{
	height:480px;
	width:502px;
	 background:url(images/mac_apple_logo_creative_94063_1920x1080.jpg);
}
.msgcontent{
	height:280px;
	width:502px;
	background:rgba(255,255,255,0.8);
	overflow-x:scroll;
}
.msgcontrol{
	width:500px;
	height:auto;
	padding-bottom:10px;
	padding-top:10px;
	padding-left:2px;
	background:url(images/fomef_icloud_design_5k-wallpaper-1366x768.jpg);
}
</style>
</head>

<body>

<?php include'messaging.php'; ?>
<br/>
<div class="con">
<div class="msghead"><h3 align="center" style="color:rgb(255,255,255);">Conversations</h3></div>
<div class="msgbody">
<div class="msgcontent">
<?php
$date = date('l j-M-Y');
			$time = date('H:i:s');
$receiver= $_GET['Receipient'];
$sender=$row_Recordset1['Username'];
$sql="SELECT * FROM `messages` where Sender='".$receiver."' union SELECT * FROM `messages` where Sender='".$sender."' and Receipient='".$receiver."'  ORDER by `id` asc";
$run = mysql_query($sql) or die (mysql_error());

while($fetch = mysql_fetch_assoc($run)){
	echo'<div style="padding-left:7px;">';
	echo '<br>'.'<div style="font-weight:bold;">'.$fetch['Sender'].'</div>';
	echo '<br/>'.$fetch['Message'].'<br/>'.'<br/>'.'</div>'.'<div style="background:rgb(255,255,255); padding-top:5px; padding-bottom:5px; margin-bottom:-7px; padding-left:7px;">'.'@'.'&nbsp;'.$fetch['PeriodTime'].'&nbsp;'.'on'.'&nbsp;'.$fetch['PeriodDate'].'</div>'.'<hr>'.'<br/>';
	
}

?>

</div>
<div class="msgcontrol">
<div style="background:rgba(0,0,0,1); color:rgb(255,255,0); padding-bottom:6px; padding-top:6px; margin-top:-10px; margin-left:-2px;">

<div style=" font-weight:bold; margin-left:8px;">Receipient:  <?php if(isset($_GET['Receipient'])){ echo $_GET['Receipient'];} ?></div>

</div>
<form action="" method="post">
<div align="center"><textarea name="msg" rows="9" cols="30" style="margin-top:20px; border-radius:7px;"></textarea></div><br/>

 <div align="center"><input type="submit" style="margin-left:0px; margin-top:5px; width:200px; padding-top:7px; padding-bottom:7px; border-top-left-radius:10px; border-top-right-radius:10px; cursor:pointer; background:linear-gradient(rgb(102,0,51),rgb(0,0,255)); color:rgb(255,255,255); border:1px #000000;" value="Send" name="send"></div>
<br/>
</form>
<div style="background:rgba(0,0,0,1); color:rgb(255,255,255); padding-bottom:6px; padding-top:6px; margin-left:-2px; margin-bottom:-10px;">

<div style="font-weight:bold; margin-left:300px;">Sender:  <?php echo $row_Recordset1['Username']; ?></div>

</div>

</div>


</div>
</div>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>













</body>
</html>