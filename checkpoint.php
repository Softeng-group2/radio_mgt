<?php require_once('connection.php'); ?>

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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Transit</title>
<style>
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
	width:200px;
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
body{
	background-size:cover;
}
h1{
	color:rgb(255,255,255);
}
</style>
</head>

<body background="images/142.jpg">
<h1 align="center">Checkpoint: Hit any of the buttons to continue!!!</h1>
<div id="transit" class="modalDialog">
<div style="margin-left:180px; margin-top:40px; width:300px; height:300px; border-radius:100%; background:url(images/pexels-photo-66425.jpg);">
<div align="center">
<br/><br/><br/><br/><br/><br/>
<a href="adminhome.php#welcome"><input type="submit" class="btn" value="Continue to Admin's page"></a>
<br/><br/>
<a href="workerhome.php#welcome"><input type="submit" class="btn" value="Head over to the workers' page"></a>
</div>
</div>
</div>
</body>
</html>