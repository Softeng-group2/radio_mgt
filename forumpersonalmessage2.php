<?php require_once('../Connections/se.php'); ?>
<?php require_once('../Connections/se.php'); 

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
?>
<?php require_once('connection.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Listener's Private Messages</title>
<style>
.close {
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: 50px;
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
.img{
	width:50%;
	height:50%;}
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
</style>
</head>

<body>
<?php include'forumpersonalmessage1.php'; ?>
<?php
if(isset($_POST['send'])&& !empty($_POST['msg'])){
	$receipient=$_GET['Receipient'];
	
	
	
	$date = date('l j-M-Y');
			$time = date('H:i:s A');
			$msg = $_POST['msg'];
	$sql="INSERT INTO `admin_to_listener`(  `Sender`, `Receipient`, `Message`, `dateofmsg`, `timeofmsg`) VALUES ('".$_GET['Sender']."','".$receipient."','".mysql_real_escape_string($_POST['msg'])."','".$date."','".$time."')";		
	
	$runquery = mysql_query($sql) or die(mysql_error());
	if($runquery){
		?>
<script>
		alert("Message successfully sent to " + "<?php echo $receipient;?>");
		</script>
		<?php
		echo"<meta http-equiv='refresh' content='0'>";
		}else{
		?>	
<script>
		alert("Error sending message to " + "<?php echo $receipient;?>");
		</script>	
		<?php	
			}
			
	}


?>


<?php
mysql_free_result($Recordset1);
?>
<div class="con">
  <div class="msghead"><h2 align="center" style="color:rgb(255,255,255);">Messages From: <span style="color:rgb(0,255,255);"><?php echo $_GET['Receipient']?></span></h2></div>
  <div class="msgbody">
  <div class="msgcontent">
  <?php
  $receiver= $_GET['Receipient'];
$sender=$row_Recordset2['Username'];

$sql="SELECT * FROM `admin_to_listener` where Sender='".$_GET['Sender']."' union SELECT * FROM `admin_to_listener` where Receipient='".$_GET['Sender']."' and Sender='".$_GET['Receipient']."' order by id asc";
$run = mysql_query($sql) or die (mysql_error());

 while($fetch = mysql_fetch_assoc($run)){
	echo'<div style="padding-left:7px;">';
	echo '<br>'.'<div style="font-weight:bold;">'.$fetch['Sender'].'</div>';
	echo '<br/>'.$fetch['Message'].'<br/>'.'<br/>'.'</div>'.'<div style="background:rgb(255,255,255); padding-top:5px; padding-bottom:5px; margin-bottom:-7px; padding-left:7px;">'.'@'.'&nbsp;'.$fetch['timeofmsg'].'&nbsp;'.'on'.'&nbsp;'.$fetch['dateofmsg'].'</div>'.'<hr>'.'<br/>';
	
} 
	
  ?>
  </div>
 
  
  
  <div class="msgcontrol">
  <div style="background:rgba(0,0,0,1); color:rgb(255,255,0); padding-bottom:6px; padding-top:6px; margin-top:-10px; margin-left:-2px;">
  <div style=" font-weight:bold; margin-left:8px;">Receipient:  <?php if(isset($_GET['Receipient'])){ echo $_GET['Receipient'];} ?>
  
  </div>
  
  </div>
   
  <form action="" method="post">
<div align="center"><textarea name="msg" rows="9" cols="30" style="margin-top:20px; border-radius:7px;"></textarea></div><br/>

 <div align="center"><input type="submit" style="margin-left:0px; margin-top:5px; width:200px; padding-top:7px; padding-bottom:7px; border-top-left-radius:10px; border-top-right-radius:10px; cursor:pointer; background:linear-gradient(rgb(102,0,51),rgb(0,0,255)); color:rgb(255,255,255); border:1px #000000;" value="Send" name="send"></div>
<br/>
</form>
 
 
 <div style="background:rgba(0,0,0,1); color:rgb(255,255,255); padding-bottom:6px; padding-top:6px; margin-left:-2px; margin-bottom:-10px;">

<div style="font-weight:bold; margin-left:300px;">Sender:  <?php echo $_GET['Sender']; ?></div>

</div>
 </div>
  
  </div>
   <br/>
  <br/>
  <br/>
  <br/>
</div>  
  
  <br/>
  <br/>
  <br/>
  <br/>
  
  
  
  
      
<div id="modal" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Full Picture</h2>
	
		<a href="#close" title="Close" class="close">X</a>
        <?php $receipient=$_GET['Receipient'];?>

<?php
$sql1="SELECT * FROM `listener_details` where  Username='".$receipient."' ";
$run1 = mysql_query($sql1) or die (mysql_error());


while($fetch1 = mysql_fetch_array($run1)){
	?>
       <?php
	   if(empty($fetch1['Img'])){
	   ?>
       <div align="center">
<img src="profilepic/noavatar92.png"  width="250px" height="250px" class="img" />
</div>
        <?php
	   }else{
		   ?>
           <div align="center">
		    <img src="profilepic/<?php echo $fetch1['Img']; ?>"  width="250px" height="250px" class="img" />
  </div>
  <?php
}
}
?>	   
</div> 

</body>
</html>