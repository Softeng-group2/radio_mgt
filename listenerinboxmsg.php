<?php require_once('../Connections/se.php'); ?>
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
$query_Recordset1 = sprintf("SELECT * FROM listener_details WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php require_once('connection.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
body{
	background-size:cover;
}
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
.con{
	float:left;
	width:200px;
	height:400px;
	margin-left:100px;
	margin-top:30px;
}
.phead{
	width:250px;
	height:50px;
	 border-top-left-radius:85px; 
 border-top-right-radius:85px;
 background:rgba(0,255,0,0.9);
 padding-top:20px;
}
h1{
	color:rgb(255,255,255);
}
a:link {
	color: rgb(0,0,0);
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: rgb(0,0,0);
}
a:hover {
	text-decoration: none;
}
li:hover {
	padding-bottom:20px;
	padding-top:10px;
	padding-left:2px;
	margin-bottom:-15px;
	margin-left:-4.5px;
	margin-right:-4.5px;
	text-decoration: none;
	cursor:pointer;
	background:rgb(255,255,204);
	color: rgb(0,0,0);
}

a:active {
	text-decoration: none;
	color: rgb(0,0,0);
}
li{
	background:linear-gradient(rgba(0,255,255,1),rgba(255,255,255,1));
	padding-bottom:20px;
	padding-top:10px;
	padding-left:2px;
	margin-left:-4.5px;
	margin-right:-4.5px;
	margin-bottom:-15px;
}
img{
	float:right;
	margin-right:10px;
	margin-bottom:5px;
}
</style>
</head>

<body background="images/img121.jpg">
<h1 align="center">Messaging Centre</h1>
<div style="float:right; background:rgba(255,255,255,0.5); width:70px; height:70px; margin-right:100px; padding-left:7px; padding-top:7px; border-radius:13px;"><a href="listenerhome.php" title="home"><img src="images/home (2).ico" height="60" width="60" style="margin-left:7px;"></a></div>

<div class="con">
<div class="phead">
  <h2 align="center" style="margin-top:-3px;">Listeners</h2></div>
<div style="width:240px; height:300px; padding:5px 5px 5px 5px; background:rgba(255,255,255,0.5); overflow-y:scroll; ">
<?php
$_SESSION["MM_Username"] = $row_Recordset1["Username"];
$sql="SELECT * FROM `listener_details` where Username !='".$row_Recordset1['Username']."' ORDER by `id` asc";
$run = mysql_query($sql) or die (mysql_error());

while($fetch = mysql_fetch_assoc($run)){
	$dir='profilepic';
	if($fetch['Img']==""){
		$img="noavatar92.png";
		}else{
			$img = $fetch['Img'];
			}
	echo"<li><a href='listenerinboxmsg2.php?Receipient=".$fetch["Username"]."' title='click on photo thubmnail to see profile'>".$fetch["Username"]."</a><a href='listenerinboxmsg2.php?Receipient=".$fetch["Username"]."#modal'><img src='".$dir."/".$img."' width='30' height='30'></a></li>".'<br>';
	
}



?>
</div>
</div>


</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
