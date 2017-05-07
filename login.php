<?php
session_start();
error_reporting(0);
$name = $_POST[noid];
$_SESSION['MM_Username']= $name;

?>
<?php require_once('connection.php'); ?>

<?php
if(isset($_POST['Submit'])){
	$sql="SELECT `Username`,`Usertype`,CONCAT(`DCODE`,`DID`),`Password` FROM `work_details` WHERE `work_details`.`Username`='".mysql_real_escape_string($_POST[noid])."' or CONCAT(`work_details`.`DCODE`,`work_details`.`DID`) = '".mysql_real_escape_string($_POST[noid])."' AND `work_details`.`Password`='".mysql_real_escape_string($_POST[pword])."'UNION SELECT `Username`,`Usertype`,`Email`,`Password` FROM `listener_details` WHERE `listener_details`.`Username` = '".mysql_real_escape_string($_POST[noid])."' or `listener_details`.`Email` = '".mysql_real_escape_string($_POST[noid])."' and `listener_details`.`Password` = '".mysql_real_escape_string($_POST[pword])."'";
	
	
	$run = mysql_query($sql) or die(mysql_error());
	
	$sql1="SELECT CONCAT(`DCODE`,`DID`) as uid from work_details where CONCAT(`DCODE`,`DID`) = '".mysql_real_escape_string($_POST[noid])."'";	
	
	$runsql = mysql_query($sql1) or die(mysql_error());
	$fetch = mysql_fetch_assoc($runsql);
	
	$rows = mysql_num_rows($run);
	$fetchArray = mysql_fetch_assoc($run);
	if((($fetchArray["Username"]==$_POST[noid])||($fetchArray["Email"]==$_POST[noid])||($fetch["uid"]==$_POST[noid]))&&($fetchArray["Password"]==$_POST[pword])){
		//redirecting to page based on role
		if($fetchArray['Usertype']=="Admin")
		{
			
$signinsql= mysql_query("SELECT COUNT(*) as timecount FROM `attendance` WHERE `Date` = CURRENT_DATE and `Name`= '".$_POST[noid]."'") or die(mysql_error());
			while($signin= mysql_fetch_array($signinsql)){
			if($signin['timecount']<1){		
					
			/*$getprevioussql = mysql_query("SELECT * FROM `attendance` WHERE `Date` = CURRENT_DATE order by id desc limit 1") or die(mysql_error());
			while($prev = mysql_fetch_array($getprevioussql)){		
			if($prev['Time_SignedIn']){		*/	
			$date1 = date('l j-M-Y');
			$date = date('Y-m-d');
			$time = date('H:i:s');
			
			
			$sql=mysql_query("INSERT INTO `attendance`(`Name`, `Date`, `Time_SignedIn`,`Signedin`, `Signedout`) VALUES ('".$_POST[noid]."','".$date."','".$time."','Yes','No')") or die(mysql_error());
			$sql1= mysql_query("INSERT INTO `login_times`(`Name`,  `Date`,`Time`) VALUES ('".$_POST[noid]."','".$date."','".$time."')");
			
			
			
			header("Location: checkpoint.php#transit");
			/*}else{
				
				}
			}*/
			}
			else{
				echo'<style>h1{margin-top:30px;}</style>';
				?>
                <script>
				alert("You can't sign in more than once for a day!!!");
				</script>
				<?php
				}
			
			}
			}
			
			
			
			
			
			
		if($fetchArray['Usertype']=="Worker" && $fetchArray['Usertype']!=="Admin")
		{
			$date = $date = date('Y-m-d');;
			$time = date('H:i:s');
			$sql=mysql_query("INSERT INTO `attendance`(`Name`, `Date`, `Time_SignedIn`,`Signedin`, `Signedout`) VALUES ('".$_POST[noid]."','".$date."','".$time."','Yes','No')") or die("<h1 align='center'>Error Signing In</h1>Possible causes:<br><ul> <li>You might have signed in already</li> <li>Your account may be invalid</li> <li>You might have been blocked by the Admin</li>  </ul>");
			$sql1= mysql_query("INSERT INTO `login_times`(`Name`,  `Date`,`Time`) VALUES ('".$_POST[noid]."','".$date."','".$time."','Yes','No')");
			header("Location: workerhome.php#welcome");
			}
			
			
		if($fetchArray['Usertype']=="Worker" && $fetchArray['Role1']== "Manager")
		{
			$date = date('Y-m-d');
			$time = date('H:i:s');
			$sql=mysql_query("INSERT INTO `attendance`(`Name`, `Date`, `Time_SignedIn`) VALUES ('".$_POST[noid]."','".$date."','".$time."')");
			$sql1= mysql_query("INSERT INTO `login_times`(`Name`,  `Date`,`Time`) VALUES ('".$_POST[noid]."','".$date."','".$time."')");
			header("Location: managerhome.php");
						}
			
		if($fetchArray['Usertype']=="Listener")
		{$date = date('Y-m-d');
			$time = date('H:i:s');
			$sql1= mysql_query("INSERT INTO `login_times`(`Name`,  `Date`,`Time`) VALUES ('".$_POST[noid]."','".$date."','".$time."')");
			header("Location: listenerhome.php");
			session_start();
$name = $_POST[noid];
$_SESSION['MM_Username']= $name;
			}
		
		}else{
			echo"<div style='margin-bottom:-26px;'>Wrong Username or Password</div>";
			
			}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link href="project_css/login.css" rel="stylesheet" type="text/css" media="only screen" />
<script type='text/javascript' src='analogclock.js'></script>
</head>

<body background="images/2009296.jpg" onLoad="myclock('analog-clock');">
<noscript>
<h1 align="center" style="color:rgb(255,0,0); height:200px; width:300px;">Please enable javascript to continue or use a browser that supports javascript</h1>
<style>
.container{display:none;
}
.h{display:none;
}
img{display:none;
}
a{display:none;
}
body{
	background:rgb(255,255,255);
	}
</style>
</noscript>
<h1 align="center" style="font-size:47px" class="h">Login Portal</h1>
<br/><br/><br/><br/>
<div style="width:250px; padding-left:20px;  height:290px; margin-left:50px; background:linear-gradient(rgba(0,0,255,0.5),rgba(255,255,255,0.5));">
<div style="background:rgba(0,0,0,0.7); color:rgb(255,255,255); margin-left:-20px; margin-bottom:10px; padding-bottom:6px; padding-top:6px;"><div align="center">
<?php $time = date(G);

if($time >= 0 && $time < 12){
	echo"<b>Good Morning</b>";
	}
if($time >= 12 && $time < 18){
	echo"<b>Good Afternoon</b>";
	}
if($time >= 18 && $time<=23){
	echo"<b>Good Evening</b>";
	}		
 ?></div></div>
 <canvas id="analog-clock" style="padding-bottom:5px;"></canvas>
 <div style="background:rgba(0,0,0,0.7); color:rgb(255,255,255); margin-left:-20px; margin-bottom:10px; padding-bottom:6px; padding-top:6px;"><div align="center">Time check:
 
 <script src="../SoftwareEngineering/jquery-2.2.3.min.js"></script>
<script>
 $(document).ready(function(){
     setInterval(ajaxcall, 1000);
 });
 function ajaxcall(){
     $.ajax({
         url: 'clock.php',
         success: function(data) {
             data = data.split(':');
             $('#hours').html(data[0]);
             $('#minutes').html(data[1]);
             $('#seconds').html(data[2]);
         }
     });
 }
</script>
<span id="hours">0</span>:<span id="minutes">0</span>:<span id="seconds">0</span>
 
  </div></div>
 </div>
<div align="center">
<br/><br/><br/><br/>
<div class="container">
<div class="con">
<marquee style="background:rgba(255,255,255,0.7); margin-left:4%; width:70%;border-bottom-left-radius:5px; border-bottom-right-radius:5px;">Log in with your Username or Email address and your password for listeners  👉  Log in with your Username or Departmental ID and your password for staff || Please note: only listeners can create an account</marquee>
<br/><br/><br/><br/>
<table cellpadding="10" style="margin-top:-7px;">
<form method="post">
<tr><td style="color:rgb(255,255,255);">Username</td><td><input type="text" name="noid" size="50" style="height:30px; border-radius:5px;" required></td></tr>
<tr><td style="color:rgb(255,255,255);">Password</td><td><input type="password" name="pword" size="50" style="height:30px; border-radius:5px;" required></td></tr>
<tr><td></td><td><input type="submit" name="Submit" value="Sign in" class="btnSubmit"><input type="reset" value="Reset" class="btnReset"></td></tr>
</form>
</table>

<a href="ResetPassword.php"><div class="div" style="background:radial-gradient(rgb(35,35,35),rgba(0,0,0,1)); color:rgb(255,255,255); float:left; width:24%; margin-top:20px; padding-left:1px; padding-right:1px;  border-top-right-radius:5px;" >Reset password here</div></a>
<a href="listener_reg.php"><div class="div" style="background:radial-gradient(rgb(35,35,35),rgba(0,0,0,1)); color:rgb(255,255,255); float:right; width:24%; margin-top:20px; padding-left:1px; padding-right:1px;  border-top-left-radius:5px;" >Create account here</div></a>
</div>
</div>
</div>
</body>
</html>