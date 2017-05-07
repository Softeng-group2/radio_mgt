


<?php require_once('connection.php');
?>

<?php require_once('../Connections/se.php'); ?>
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
$query_Recordset1 = sprintf("SELECT * FROM admin_to_listener WHERE Sender = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset2 = sprintf("SELECT * FROM work_details WHERE Username = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $se) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
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
	width:700px;
	height:550px;
	margin-bottom:30px;
	float:right;
	margin-right:150px;
	margin-top:-20px;
	margin-bottom:80px;
}
.msghead{
width:700px;
 border-top-left-radius:85px; 
 border-top-right-radius:85px; 
 background:url(images/142.jpg);
  padding-bottom:3px; 
  padding-top:3px; 
  border:1px #000000 solid;	
  height:50px;
	}
.msgbody{
	height:510px;
	width:702px;
	 background:url(images/img186.jpg);
}
.msgcontent{
	height:310px;
	width:702px;
	background:rgba(255,255,255,0.8);
	overflow-y:scroll;
}
.msgcontrol{
	width:700px;
	height:auto;
	padding-bottom:10px;
	padding-top:10px;
	padding-left:2px;
	background:url(images/img184.JPG);
}
.con{
	float:left;
	width:200px;
	height:400px;
	margin-left:100px;
	margin-top:30px;
	margin-bottom:80px;
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

<body background="images/Abstract HD Wallpaper (48).jpg">

<div class="con">
<div class="phead">
  <h2 align="center" style="margin-top:-3px;">Listeners</h2><a href="adminhome.php" title="home"><img src="images/home (2).ico" height="30" width="30" style="margin-left:4px; margin-top:-30px;"></a></div>
<div style="width:240px; height:300px; padding:5px 5px 5px 5px; background:rgba(255,255,255,0.5); overflow-y:scroll; ">
<?php
$_SESSION["MM_Username"] = $row_Recordset1["Username"];
$sql="SELECT distinct Sender FROM `admin_to_listener` where Sender !='".$row_Recordset1['Username']."' and `Message` !='' ";
$run = mysql_query($sql) or die (mysql_error());
while($fetch = mysql_fetch_assoc($run))
{

$sql1="SELECT * FROM `listener_details` where  Username='".$fetch['Sender']."' order by '".$fetch['id']."'";
$run1 = mysql_query($sql1) or die (mysql_error());


while($fetch1 = mysql_fetch_array($run1)){
	$dir='profilepic';
	if($fetch1['Img']==""){
		$img="noavatar92.png";
		}else{
			$img = $fetch1['Img'];
			}
			
			
	echo"<li><a href='forumpersonalmessage2.php?Receipient=".$fetch1["Username"]." & Sender=".$_GET['Sender']."'>".$fetch1["Username"]."</a><a href='forumpersonalmessage2.php?Receipient=".$fetch1["Username"]."#modal'><img src='".$dir."/".$img."' width='30' height='30'></a></li>".'<br>';
	
}

}

?>
</div>
</div>

<h1 style="color:rgb(255,255,255);"><?php echo $row_Recordset1["Username"]; ?></h1>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
