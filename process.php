<?php 
session_start();
require_once('connection.php'); ?>
<?php
$getmessage=mysql_query("SELECT * FROM mgr_messages order by id desc limit 1") or die(mysql_error());
while($msg = mysql_fetch_assoc($getmessage)){
if($msg['Sender']!==$_SESSION['MM_Username']){	
$update=mysql_query("UPDATE `mgr_messages` SET `Status`=1 WHERE `Status`=0") or die(mysql_error());
$getperson = mysql_query("select max(id) as maximum from mgr_messages") or die(mysql_error());
while($personid= mysql_fetch_assoc($getperson)){
if($msg['Seen_by']!==""){
	$seen = $msg['Seen_by'].','.$_SESSION['MM_Username'];
	}else{
		$seen = $_SESSION['MM_Username'];
		
		}	
		$formattedvalue= explode(',',$msg['Seen_by']);
		if(!in_array($_SESSION['MM_Username'],$formattedvalue)){
$update1=mysql_query("UPDATE `mgr_messages` SET `Seen_by`= '".$seen."'  WHERE `id`= '".$personid['maximum']."'") or die(mysql_error());
		}
}
}else{
	
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>