<?php require_once('connection.php'); ?>

<?php
if(isset($_POST['update']))
{
$sql="SELECT `Username` FROM `work_details` WHERE `work_details`.`Username`='".mysql_real_escape_string($_POST['uname'])."' UNION SELECT `Username` FROM `listener_details` WHERE `listener_details`.`Username` = '".mysql_real_escape_string($_POST['uname'])."'";

$run = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($run);

$sqlworkers ="SELECT `Username` FROM `work_details` WHERE `work_details`.`Username`='".mysql_real_escape_string($_POST['uname'])."'";

$runworkers = mysql_query($sqlworkers) or die(mysql_error());
$fetchworkers = mysql_fetch_assoc($runworkers);

$sqllisteners ="SELECT `Username` FROM `listener_details` WHERE `listener_details`.`Username` = '".mysql_real_escape_string($_POST['uname'])."'"; 

$runlisteners = mysql_query($sqllisteners) or die(mysql_error());
$fetchlisteners = mysql_fetch_assoc($runlisteners);



if($fetch['Username']!=$_POST['uname']){
?>
<script type="text/javascript">
alert("Username does not exist!!!");

</script>
<?php
	
	}
if(($fetch['Username']==$_POST['uname'])&&($fetchlisteners['Username']==$_POST['uname'])){
	
      $updatelistener="UPDATE `listener_details` SET `Password`='".mysql_real_escape_string($_POST['p1'])."' WHERE  `Username`='".mysql_real_escape_string($_POST['uname'])."'";
	  
	  if($_POST['p1']==$_POST['p2']){
		  if(strlen($_POST['p1']) < 8 || strlen($_POST['p2']) < 8 ){
			  ?>
<script type="text/javascript">
alert("Password cannot be less than 8 characters!!!");

</script>
<?php  
			  }else{
	  $runupdatelistener = mysql_query($updatelistener);
			  }
	  }else{
		?>
<script type="text/javascript">
alert("Passwords don't match!!!");

</script>
<?php  
		  
		  }
if($runupdatelistener){
	?>
<script type="text/javascript">
alert("Password successfully updated!");

</script>	
    
   <?php
   header("Location: login.php"); 
   ?>
<script type="text/javascript">
alert("Password successfully updated!");

</script>	
    
   <?php
	}else{
		?>
<script type="text/javascript">
alert("Error updating password! please try again or contact the Admin...");

</script>	
    
   <?php
		
		
		}	  
	  
		}
if(($fetch['Username']==$_POST['uname'])&&($fetchworkers['Username']==$_POST['uname'])){
		 $updateworker="UPDATE `work_details` SET `Password`='".mysql_real_escape_string($_POST['p1'])."' WHERE  `Username`='".mysql_real_escape_string($_POST['uname'])."'";
	  if($_POST['p1']==$_POST['p2']){
		  if(strlen($_POST['p1']) < 8 || strlen($_POST['p2']) < 8 ){
			  ?>
<script type="text/javascript">
alert("Password cannot be less than 8 characters!!!");

</script>
<?php  
			  }else{
	  $runupdateworker = mysql_query($updateworker);
			  }
	  }else{
		?>
<script type="text/javascript">
alert("Passwords don't match!!!");

</script>
<?php  
		  
		  }
if($runupdateworker){
	?>
<script type="text/javascript">
alert("Password successfully updated!");

</script>	
    
   <?php
   header("Location: login.php");
    ?>
<script type="text/javascript">
alert("Password successfully updated!");

</script>	
    
   <?php 
	}else{
		?>
<script type="text/javascript">
alert("Error updating password! please try or contact the Admin...");

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
<title>Reset Password</title>
<style>
label{
	color:rgb(255,255,255);
}
.txt{
	padding-bottom:6px; padding-top:6px; border-radius:6px;
	}
table{
	
	width:70%;
	padding-top:20px;
}
input:focus{
	outline:none;
}
.btn1{
	height:50px;
	border-bottom-left-radius:50px;
	border-bottom-right-radius:50px;
	width:100px;
	cursor:pointer;
	background:linear-gradient(rgb(0,153,204),rgb(102,0,255));
	color:rgb(255,255,255);
	border:1px #6600CC;
}
.btn{
	height:50px;
	border-top-left-radius:50px;
	border-top-right-radius:50px;
	width:100px;
	cursor:pointer;
	background:linear-gradient(rgb(102,0,255),rgb(0,153,204));
	color:rgb(255,255,255);
	border:1px #6600CC;
}
.btn:hover{
	border:1px #FFFFFF;
	background:linear-gradient(rgba(0,0,255,1),rgba(255,255,255,1));
}
.btn1:hover{
	background:linear-gradient(rgba(102,0,255,1),rgba(255,255,255,1));
	border:1px #FFFFFF;
}
</style>

</head>

<body background="images/beach_slippers-wallpaper-1366x768.jpg">
<h1 align="center">Reset Password</h1>
<div align="center">
<div style="width:65%; height:520px; background:rgba(0,0,51,0.8); border-radius:10px;">
<br/><br/><br/><br/>
<div style="width:90%; height:426px; background:linear-gradient(rgba(0,0,102,0.8),rgba(255,255,255,0.8)); margin-top:-25px;">
<table>
<form action="" method="post"  name="resetform">
<tr><td><div align="center"><label>Username</label></div><br/><input type="text" name="uname" style="width:100%; " class="txt" required><br/><br/></td></tr>
<tr><td><div align="center"><label>Enter Password</label></div><br/><input type="text" name="p1" style="width:100%; " class="txt" required><br/><br/></td></tr>
<tr><td><div align="center"><label>Repeat Password</label></div><br/><input type="text" name="p2" style="width:100%; " class="txt" required><br/><br/></td></tr>
<tr><td><div align="center"><input type="submit" name="update" value="Update" class="btn"><br/><input type="reset" value="Reset" class="btn1"></div></td></tr>
</form>
</table>
</div>

</div>

</div>
</body>
</html>
