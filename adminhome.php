<?php require_once('connection.php'); ?>

<?php require_once('../Connections/se.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_SESSION)){
	$sname = $_SESSION['MM_Username'];
	}
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset1 = sprintf("SELECT * FROM work_details WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset2 = sprintf("SELECT * FROM work_details WHERE Username = %s or CONCAT(`DCODE`,`DID`) = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $se) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset3 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset3 = sprintf("SELECT * FROM listener_details WHERE Username = %s or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset3, "text"));
$Recordset3 = mysql_query($query_Recordset3, $se) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin's page</title>
<style>
body{
	background-size:cover;
	color:rgb(255,255,255);
}
.con{
	width:54%;
	height:430px;
	background-image:url(images/miocrosoft_surface-1280x800.jpg);
	background-size:cover;
	margin-top:76px;
	
}
.con1{
	width:101%;
	height:430px;
	background:rgba(0,0,0,0.6);
	margin-top:76px;
}
a{
	color:rgb(255,255,255);
	text-decoration:none;
}
.img:hover{
	box-shadow:rgba(255,255,0,0.5) 0.5px 0.5px 2px 7px;
	border-radius:20px;
	z-index:9999999;
	}
 #menuBody {
            bottom: 0;
            text-align: center;
            width: 100%;
            border-radius: 10px 10px 0 0;
			
        }
        #menuBody li {
            list-style-type: none;
            display: inline-block;
            position: relative;
        }
   #menuBody li img {
          width: 64px;
          height: 64px;
          -webkit-box-reflect: below 2px
                    -webkit-gradient(linear, left top, left bottom, from(transparent),
                    color-stop(0.7, transparent), to(rgba(255,255,255,.5)));
          -webkit-transition: all 0.3s;
          -webkit-transform-origin: 50% 100%;
        }


#menuBody li:hover img { 
          -webkit-transform: scale(2);
          margin: 0 2em;
        }
        #menuBody li:hover + li img,
        #menuBody li.prev img {
          -webkit-transform: scale(1.5);
          margin: 0 1em;
        }

#menuBody li span {
            display: none;
            position: absolute;
            bottom: 140px;
            left: 0;
            width: 100%;
            background-color: rgba(51,51,51,0.8);
            padding: 4px 0;
            border-radius: 12px;
			z-index:99999;
        }
        #menuBody li:hover span {
            display: block;
            color: #fff;
			z-index:99999;
        }
table{
	width:100%;
	height:100%;
}
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: 40px;
	margin-right:40px;
	float:right;
	margin-bottom:10px;
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
	width: 70%;
	position: relative;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	
}

.modalDialog {
	position:absolute;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background:rgba(0,0,0,0.9);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
	width:696px;
	height:399px;
	margin-top:133px;
	margin-left:315px;
	border:15px rgba(255,255,255,0.5) inset;
	
}
.btn{
	width:150px;
	padding-bottom:10px;
	padding-top:10px;
	padding-left:5px;
	padding-right:5px;
	border-radius:10px;
	background:linear-gradient(rgba(51,255,0,1),rgba(255,255,0,1));
	border:1px #000000;
	margin-bottom:40px;
	cursor:pointer;
}
.btn:hover{
	background:rgb(0,255,0);
	}

</style>
  <link href="js-image-slider.css" rel="stylesheet" type="text/css" />
    <!--<script src="js-image-slider.js" type="text/javascript"></script>
<script type="text/javascript">
alert('<?php echo"Welcome"." ".$row_Recordset2['Username']; ?>');
</script>-->
<script src="jquery-2.2.3.min.js">

$(document).ready(function() {
    $(this).scrollTop(0);
});

</script>
</head>

<body background="images/295199-lcd.jpg">
<noscript>
<h1 align="center" style="color:rgb(255,0,0); height:200px; width:300px;">Please enable javascript to continue or use a browser that supports javascript</h1>
<style>
.con{display:none;
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
<h1 align="center" style="color:rgb(255,255,255);" class="h">HOME</h1>
<div align="center">

<div class="con">
<div class="con1">
<!--<?php

$query_Recordset2 = sprintf("SELECT * FROM work_details WHERE Username = %s or CONCAT(`DCODE`,`DID`) = %s", GetSQLValueString($colname_Recordset2, "text"), GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $se) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

echo $row_Recordset2['Username'].$row_Recordset2['Role'];
echo $row_Recordset3['Username'].$row_Recordset3['Role'];
?>

<input type="text" value="<?php echo $_SESSION['MM_Username'];?>">-->
<br/><br/>
<table>
<tr>

<div id="menuBody">
 <div id="menu">
   <ul>
      <li>
        <span>New Worker Record</span>
        <a href="#workmenu"><img src="images/icontexto-user-web20-digg.ico"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Staff on duty</span>
        <a href="SOD.php"><img src="images/icontexto-user-web20-myspace.ico"/></a>
      </li>
      <li>
         <span>Listeners' Records</span>
         <a href="#"><img src="images/icontexto-user-web20-blinklist.ico"/></a>
      </li>  <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
         <span>Workers' Records</span>
         <a href="workers'page"><img src="images/User_256x256.png"/></a>
      </li>
     
   </ul>
 </div>
</div>
</tr>
<tr>


<div id="menuBody">
 <div id="menu">
   <ul>
      <li>
        <span>Events</span>
        <a href="Eventshome.php"><img src="images/Calendar_256x256.png"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Audio Archive</span>
        <a href="#"><img src="images/Audio Disk_256x256.png"/></a>
      </li>
      <li>
         <span>Forum</span>
         <a href="#modal"><img src="images/Positive_256x256.png"/></a>
      </li>  <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
         <span>Adverts & Event Requests</span>
         <a href="#commercial"><img src="images/money_no_shadow.ico"/></a>
      </li>
     
   </ul>
 </div>
</div>
</tr>
<tr>


<div id="menuBody">
 <div id="menu">
   <ul>
      <li>
        <span>Feedback</span>
        <a href="#"><img src="images/apple_imac-1280x960.jpg"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Work hours</span>
        <a href="#time"><img src="images/2.ico"/></a>
      </li>
      <li>
         <span>Program LineUp</span>
         <a href="PL.php"><img src="images/Presentation_256x256.png"/></a>
      </li>  <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
         <span>Messaging</span>
         <a href="messaging.php"><img src="images/Send_256x256.png"/></a>
      </li>
     
   </ul>
 </div>
</div>
</tr>
<tr></tr>
</table>

</div>
</div>
</div>
<a href="checkpoint.php#transit"><input type="submit" value="Checkpoint" class="back" style="float:left; margin-left:430px; margin-top:1px;
width:100px;
	border-radius:50%;
	background:linear-gradient(rgba(204,51,255,1),rgba(0,0,51,1));
	color:rgb(255,255,255);
	border:1px #000000 solid;
	padding:5px 5px 5px 5px;
	cursor:pointer;
"></a>

<a href="<?php echo $logoutAction ?>" title="logout"><input type="submit" value="Logout" class="back" style="float:left; margin-left:280px; margin-top:1px;
width:100px;
	border-radius:50%;
	background:linear-gradient(rgba(204,51,255,1),rgba(0,0,51,1));
	color:rgb(255,255,255);
	border:1px #000000 solid;
	padding:5px 5px 5px 5px;
	cursor:pointer;
"></a>

<div id="modal" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Options</h2>
	
		<a href="#close" title="Close" class="close">X</a><br/><br/>
        <div align="center">
        <br/>
        <a href="forumpersonalmessage1.php?Sender=<?php echo $row_Recordset2['Username']?>"><input type="button" value="Private Questions" class="btn" style="margin-top:-10px; margin-left:180px;"></a>
        <br/>
        <a href="forum.php"><input type="button" value="General Questions" class="btn" style="margin-top:5px;  margin-left:180px;"></a>
        
        </div>
            </div>
            
            
            
	   
</div>


<div id="workmenu" class="modalDialog">
<br/>
<h2 style="color:rgb(255,255,255);" align="center">Add Worker Here</h2>

<a href="#close" title="Close" class="close">X</a>
<div align="center">
<br/><br/><br/>
<div class="lnk">

<a href="Demography.php" style="display:block; float:left; margin-left:140px;"><img src="images/icontexto-user-web20-favorites.ico" width="72" height="72" ><p>New Worker</p></a>
</div>
<div class="lnk1">
<a href="pro.php" style="float:right; display:block; padding-right:20px;" ><img src="images/icontexto-user-web20-flickr.ico" width="72" height="72"><p>Public Relations</p></a><br/>
</div>
</div>
<marquee style="background:linear-gradient(rgba(255,255,255,0.6),rgba(204,0,153,0.2)); padding-bottom:3px; padding-top:3px; color:rgb(255,255,255); margin-top:104px;">Click on new worker to add work and demographic details  ||  click on public relations to add workers to handle public relations</marquee>


</div>

<div id="commercial" class="modalDialog">
<br/>
<h2 style="color:rgb(255,255,255);" align="center">Menu</h2>

<a href="#close" title="Close" class="close">X</a>
<div align="center">
<br/><br/><br/>
<div class="lnk">

<a href="services.php" style="display:block; float:left; margin-left:140px;"><img src="images/Properties_256x256.png" width="72" height="72" ><p>View Requests</p></a>
</div>
<div class="lnk1">
<a href="charges.php" style="float:right; display:block; padding-right:20px;" ><img src="images/wizard.ico" width="72" height="72"><p>Charges Page</p></a><br/>
</div>
</div>
<marquee style="background:linear-gradient(rgba(204,255,204,1),rgba(204,255,51,1)); padding-bottom:3px; padding-top:3px; color:rgb(0,0,0); margin-top:104px;">See requests for services here || And also assign charges here</marquee>


</div>

<div id="time" class="modalDialog">
<br/>
<h2 style="color:rgb(255,255,255);" align="center">Menu</h2>

<a href="#close" title="Close" class="close">X</a>
<div align="center">
<br/><br/><br/>
<div class="lnk">

<a href="attendance.php" style="display:block; float:left; margin-left:140px;"><img src="images/icontexto-user-web20-icontexto.ico" width="72" height="72" ><p>View Attendance</p></a>
</div>
<div class="lnk1">
<a href="workhours.php?month=<?php echo date('m') ?>&year=<?php echo date('Y') ?>" style="float:right; display:block; padding-right:20px;" ><img src="images/timer.png" width="72" height="72"><p>Hours worked</p></a><br/>
</div>
</div>
<marquee style="background:linear-gradient(rgba(204,255,204,1),rgba(204,255,51,1)); padding-bottom:3px; padding-top:3px; color:rgb(0,0,0); margin-top:104px;">See requests for services here || And also assign charges here</marquee>


</div>



<div id="welcome" class="modalDialog">
<div align="center">
<div style=" margin-left:100px; margin-top:70px; padding:5px 5px 5px 5px; width:400px; height:200px; background:linear-gradient(rgba(255,255,255,0.6),rgba(153,0,204,0.6)); border-radius:5%; border:25px rgba(204,204,204,0.3) solid;">
<br/><br/>
<?php echo"Welcome"." ".$row_Recordset2['Username'].'<br/>'; ?>
<br/>
<?php
$timesql = mysql_query("SELECT * FROM `login_times` WHERE `Name` ='".$row_Recordset2['Username']."' ORDER BY `id` DESC LIMIT 1") or die(mysql_error());
while($gettime = mysql_fetch_assoc($timesql)){
	
	 echo"You signed in at "." ".date('G:i:s A',(strtotime($gettime['Time']))); 
	}

 ?>
 <br/>
 <br><br/>

 <a href="#close" title="Close"><input type="submit" value="Close" style="cursor:pointer; background:linear-gradient(rgba(255,255,255,0.9),rgba(153,0,204,1)); width:150px; padding-bottom:7px; padding-top:7px; padding-left:7px; padding-right:7px; outline:none; border:1px #000000; box-shadow:0.5px 0.5px 2px 4px rgba(0,0,0,0.5);"></a>
</div>
</div>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
