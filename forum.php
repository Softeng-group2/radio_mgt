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

mysql_select_db($database_se, $se);
$query_Recordset1 = "SELECT * FROM general_forum";
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Forum</title>
<style>
.con1{
	width:750px;
	height:580px;
	border:1.3px groove rgb(204,255,0);
	background:linear-gradient(rgba(255,255,0,0.9),rgba(0,0,51,0.9));
	box-shadow:3.5px 3.5px 5px 8px rgba(0,0,0,0.7);
}
.control{
	height:200px;
	background:rgba(0,0,51,0.6);
}
.msgbody{
	height:380px;
	background:linear-gradient(rgba(232,232,0,0.6),rgba(0,0,108,0.6));
}
body{
	background-size:cover;
}
textarea{
	resize:none;
	width:320px;
	height:150px;
	float:left;
	margin-left:5%;
	margin-top:3%;
}
.msgbtn{
	float:right;
	margin-right:20%;
	margin-top:8%;
	height:100px;
	width:100px;
	border-radius:100px;
	background:linear-gradient(rgba(255,255,0,1),rgba(0,0,108,1));
	border:1px #000000;
}
.msgbtn:hover{
	box-shadow:3.5px 3.5px 5px 8px rgba(255,255,0,0.7);
	cursor:pointer;
}
</style>

</head>

<body background="images/mac_apple_logo_creative_94063_1920x1080.jpg">
<h1 align="center" style="text-decoration:underline; color:rgb(0,0,0);">GENERAL FORUM QUESTIONS AND VIEWS</h1>
<div align="center">
<div class="con1">
<div class="msgbody">
<div style="float:right; background:rgba(0,0,0,1); width:30px; height:30px;"><a href="adminhome.php" title="go home"><img src="images/home (2).ico" height="20" width="20"></a></div>
<?php echo $_SESSION['MM_Username']; ?>

</div>
<div class="control">
<form action="" method="post">
<textarea name="msg" required></textarea>

<input type="submit" value="Send" class="msgbtn">
</form>
</div>
</div>
</div>
 
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
