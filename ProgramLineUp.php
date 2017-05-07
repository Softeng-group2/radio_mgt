<?php require_once('connection.php'); ?>

<?php
session_start();
$total = $_POST['total'];
		
	for($i=1; $i<=$total; $i++)
	{
echo $_SESSION['topic'];
	}

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Program LineUp</title>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<style>
textarea{
	resize:none;
	width:180px;
	height:100px;
	border-radius:10px;
}
.con{
	width:87%;
	height:560px;
	box-shadow:0 1px 2px rgba(255,255,255,1);
	background-image:url(images/brand-wallpaper-1366x768.jpg);
	background-position:right 10px top 20px left 10px;
	
	}
.msg{
	background:rgba(255,255,255,0.7);
	width:40%;
	height:554px;
	float:right;
	border:3px groove rgb(0,204,255);
}

.head{
	width:87%;
	height:30px;
	border-top-left-radius:20px;
	border-top-right-radius:20px;
	background:rgba(255,255,255,0.8);
	padding-top:2px;
}
.bot{
	width:87%;
	height:30px;
	border-bottom-left-radius:20px;
	border-bottom-right-radius:20px;
	background:rgba(255,255,255,0.8);
	}
.rep{
	width:100%;
	background:linear-gradient(rgba(0,255,204,0.7),rgba(0,51,204,0.7));
	height:200px;
}
th{
	color:rgb(255,255,255);
}
table{
	border-spacing:10px 0;
}
video{
	width:100%;
}
input{
	background:rgb(0,0,0);
	color:rgb(0,255,255);
	width:70px;
	padding-bottom:5px;
	padding-top:5px;
	border-radius:70px;
	height:70px;
	border:1px #000000;
	cursor:pointer;
	text-align:center;
}
h1{
	background:rgba(0,0,0,0.7);
}
input:hover{
	background:rgb(0,255,255);
	color:rgb(0,0,0);
	border:1px #00FFFF;
}
textarea:focus{
	outline:none;
}
.hp{
	border-top-right-radius:10px;
	width:54%;
	background:rgb(204,255,204);
	height:auto;
	float:left;
	margin-top:45px;
}
.agenda{
	width:54%;
	height:300px;
	float:left;
	background:rgba(0,0,0,0.5);
	overflow-y:scroll;
}
</style>
<script type="text/javascript">
function resize(iFrame){
	iFrame.width = iFrame.contentwindow.document.body.scrollWidth;
	iFrame.height = iFrame.contentwindow.document.body.scrollHeight;
	}
	window.addEventListener('DOMContentLoaded', function(e){
		var iFrame = document.getElementById('iframecon');
		resize(iFrame);
		//resizing all iframes
		
		var iframes = document.querySelectorAll("iframe");
		for( var i=0; i< iframes.length; i++){
			resize(iframes[i]);
		}
	});

</script>
</head>

<body background="images/fomef_icloud_design_5k-wallpaper-1366x768.jpg" onLoad="resize()">
<br/><br/>
<br/>
<!--<?php
/*$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `sunday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
	$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}
$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `monday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}

$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `tuesday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}
$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `wednesday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}

$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `thursday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}
$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `friday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}
$currentquery = mysql_query("SELECT COUNT(*) as `period` FROM `saturday` WHERE `Finish_time` > CURRENT_TIME") or die(mysql_error());
while($current = mysql_fetch_array($currentquery)){
	$time = $current['period'];
if($time==0){
		$deletesql= mysql_query("delete from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		?>
    <script>
	alert('There are no programs at this moment');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		}




		 	

if(date('l')=="Sunday"){
$dayquery=mysql_query("SELECT * FROM `sunday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());	
while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	}

	}
	
if(date('l')=="Monday"){
$dayquery=mysql_query("SELECT * FROM `monday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());	
while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	}	
	}
	
if(date('l')=="Tuesday"){
$dayquery=mysql_query("SELECT * FROM `tuesday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());	
	while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	}	
	}
	
if(date('l')=="Wednesday"){
$dayquery=mysql_query("SELECT * FROM `wednesday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());
	while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	}		
	}
	
if(date('l')=="Thursday"){
$dayquery=mysql_query("SELECT * FROM `thursday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());	
	while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
		
		
		
	}	
	}
	
if(date('l')=="Friday"){
$dayquery=mysql_query("SELECT * FROM `friday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());
	while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	
	}		
	}
	
if(date('l')=="Saturday"){
$dayquery=mysql_query("SELECT * FROM `saturday` WHERE `Finish_time` > CURRENT_TIME LIMIT 1") or die(mysql_error());
	while($getprogram = mysql_fetch_assoc($dayquery)){
	$presenter = $getprogram['Host'];
	$show = $getprogram['Program'];
	if($_SESSION['MM_Username']== $presenter && date('H:i')==$getprogram['Finish_time']){
	?>
    <script>
	alert('Your time is Up!!! Please wrap up!!!');
	</script>
    <?php
	}
	if($_SESSION['MM_Username']!== $presenter){
		?>
    <script>
	alert('it\'s not your turn yet!');
	window.location.href='workerhome.php';
	</script>
    
    <?php
		} 
	}		
	}		
}
}
}
}
}
}
}*/

?>-->
<div align="center">
<div class="head"><div style="float:left; margin-left:10px;">On <i>Air</i>:
<?php
echo $presenter;
?>
</div>Program: 
<?php
echo $show;
//echo"<meta http-equiv='refresh' content='1'>";
//echo date('l');
			
?>
</div>
<div class="con">
<div class="msg">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Messages</li>
    <li class="TabbedPanelsTab" tabindex="0">Twitter Handle</li>
    <li class="TabbedPanelsTab" tabindex="0">Facebook Handle</li>
    <li class="TabbedPanelsTab" tabindex="0">Whatsapp</li>
    <li class="TabbedPanelsTab" tabindex="0">Instagram</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
  <div class="TabbedPanelsContent" style="background:linear-gradient(rgba(204,204,204,1),rgba(255,255,255,1)); background-size:cover; overflow-y:scroll;">
  <?php
  $listenermsgcount =  mysql_query("select count(*) as msgcount from listeners_msgs where Date_of_msg = CURRENT_DATE") or die(mysql_error());
  while($listenercount=mysql_fetch_assoc($listenermsgcount)){
  if($listenercount['msgcount']<1){
	  ?>
	  <h2 align='center'>No messages have been sent yet<img src="images/notification-icon.png" style="margin-left:30px;">(0)</h2>
	  <?php
	  }else{
  ?>
<?php  
  $listenermsg= mysql_query("select * from listeners_msgs where Date_of_msg = CURRENT_DATE") or die(mysql_error());
  while($listener=mysql_fetch_assoc($listenermsg)){
	  echo'<div style="padding-left:7px;" align="justify">';
	echo '<br>'.'<div style="font-weight:bold; color:black;">'.$listener['Username'].'</div>';
	echo '<br/>'.'<div style=" color:black;">'.$listener['Message'].'</div>'.'<br/>'.'</div>'.'<div style="background:rgba(0,0,0,0.6); padding-top:2px; padding-bottom:2px; margin-bottom:-7px; padding-left:7px;"></div>'.'<hr>'.'<br/>';
	 ?>
<?php
  }
	  }
  }
  ?>
  </div>
  
  
    <iframe src="http://www.twitter.com" style="height:525px; width:100%;"  id="iframecon"><div class="TabbedPanelsContent"></div></iframe>
    
    
    <iframe src="http://www.facebook.com" style="height:525px; width:100%;"  id="iframecon"><div class="TabbedPanelsContent"></div></iframe>
    
    
    <iframe src="http://web.whatsapp.com" style="height:525px; width:100%;"  id="iframecon"><div class="TabbedPanelsContent"></div></iframe>
    
    
    <iframe src="http://www.instagram.com" style="height:525px; width:100%;"  id="iframecon"><div class="TabbedPanelsContent"></div></iframe>
    
    
    
    
    </div>
  </div>

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</div>

<div class="hp">Agenda</div>
<div class="agenda" style="color:rgb(204,255,153);">
<br>
<style>
table{
	border-spacing:10px 10px;
	text-align:center;
}
th{
	padding:2px 2px 2px 2px;
}
td{
	font-size:20px;
}
</style>
<?php

	
	echo'<table>'.
		'<tr>'.
		'<th width="20px;">'.'#'.'</th>'.
		'<th width="300px">'.'Menu'.'</th>'.
		'<th width="300px">'.'Anticipated number of minutes'.'</th>'.
		'</tr>';
	$i=1;
	$getprogram=mysql_query("select * from preagenda where Host='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
		while($get=mysql_fetch_assoc($getprogram)){	
		echo'<tr>'.
		'<td>'.$i.'</td>'
		.'<td>'.$get['Topics'].'</td>'
		.'<td>'.$get['minutes'].'</td>'
		.'</tr>';
		$i++;
		}

	
	
		
	echo '</table>';	
?>

</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="rep">
<h1 align="center" style="color:rgb(255,255,255); margin-bottom:-10px;">Program Extras</h1>
<form action="" method="post">

<table>
<tr><th>Panelists</th><th>Details</th><th>Remarks</th><th></th></tr>
<tr><td><textarea name="panelists" required></textarea></td><td><textarea name="details" required></textarea></td><td><textarea name="remarks" required></textarea></td><td><input type="submit" name="submitnotes" value="Upload" style="text-align:center;"></td></tr>




</table>
</form>
</div>

</div>
<div class="bot"></div>
</div>
<br/><br/><br/><br/>
<?php

if(isset($_POST['submitnotes'])){
	$total = $_POST['total'];
		
	$insertquery1=mysql_query("INSERT INTO `show_details`(`Show_date`, `Host`, `Panelists`, `Notes`, `Remarks`) VALUES ('".date('Y-m-d')."','".$_SESSION['MM_Username']."','".mysql_real_escape_string($_POST['panelists'])."','".mysql_real_escape_string($_POST['details'])."','".mysql_real_escape_string($_POST['remarks'])."')") or die(mysql_error());
	
}
if($insertquery1){
	?>
    <script>
	alert('Activities successfully uploaded');
	window.location.href='workerhome.php';
	</script>
	<?php
	}else{
		?>
       <!--<script>
	alert('Error uploading activities!!!');
	</script>-->
	<?php
		
		}	
?>
</body>
</html>
