<?php require_once('../Connections/se.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
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
	margin-top:86px;
	padding-bottom:47px;

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
</style>
  <link href="js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="js-image-slider.js" type="text/javascript"></script>
<script type="text/javascript">
alert('<?php echo"Welcome"." ".$row_Recordset2['Username']; ?>');
</script>
</head>

<body background="images/295199-lcd.jpg" onLoad="msg();">
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
        <a href="#"><img src="images/icontexto-user-web20-digg.ico"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Staff on duty</span>
        <a href="#"><img src="images/icontexto-user-web20-myspace.ico"/></a>
      </li>
      <li>
         <span>Listeners' Records</span>
         <a href="#"><img src="images/icontexto-user-web20-blinklist.ico"/></a>
      </li>  <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
         <span>Attendance Records</span>
         <a href="#"><img src="images/User_256x256.png"/></a>
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
        <a href="#"><img src="images/Calendar_256x256.png"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Commercials</span>
        <a href="#"><img src="images/Audio Disk_256x256.png"/></a>
      </li>
      <li>
         <span>Audio Archive</span>
         <a href="#"><img src="images/3.ico"/></a>
      </li>  <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
         <span>Costs</span>
         <a href="#"><img src="images/Properties_256x256.png"/></a>
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
        <span>Work Progress</span>
        <a href="#"><img src="images/apple_imac-1280x960.jpg"/></a>
      </li>
      <li style="padding-bottom:20px; padding-top:20px; padding-right:80px; padding-left:80px;">
        <span>Work hours</span>
        <a href="#"><img src="images/2.ico"/></a>
      </li>
      <li>
         <span>Program LineUp</span>
         <a href="#"><img src="images/Presentation_256x256.png"/></a>
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
<a href="<?php echo $logoutAction ?>"><img src="images/power_button1-wallpaper-220x176.jpg" width="32" height="32" style="margin-left:975px; margin-top:-5px;" class="img"></a>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
