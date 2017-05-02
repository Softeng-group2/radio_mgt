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

	<?php	
	if(isset($_POST['send']) && $_POST['action']!="" && $_POST['message']!="" ){
		$name = $_POST['name'];
		$msg = mysql_real_escape_string($_POST['message']);
		$date = $_POST['date'];
		$sql="INSERT INTO `listeners_msgs`(`Username`, `Date_of_msg`, `Message`) VALUES ('".$name."','".$date."','".$msg."')";
		$run= mysql_query($sql) or die(mysql_error());
		
		if($run){
			?>
            <script>
			alert("Message sent successfully");
			</script>
            <?php
			}else{
				?>
                <script>
			alert("Error sending message");
			</script>
				<?php
				}
		
		}
		
		
		
		if(isset($_POST['feed']) && $_POST['name1']!="" && $_POST['email']!="" && $_POST['message1']!=""){
		$name = $_POST['name'];
		$msg = mysql_real_escape_string($_POST['message']);
		$date = $_POST['date'];
		$sql="INSERT INTO `feedback`(`Name`, `Email`, `Message`, `DateAdded`) VALUES ('".$_POST['name1']."','".mysql_real_escape_string($_POST['email'])."','".mysql_real_escape_string($_POST['message1'])."',now())";
		$run= mysql_query($sql) or die(mysql_error());
		
		if($run){
			?>
            <script>
			alert("Your feedback has been sent!!!");
			</script>
            <?php
			}else{
				?>
                <script>
			alert("Error sending feedback!!!");
			</script>
				<?php
				}
		
		}
		
	?>
    
<html>
<head>
    <title></title>
    <style>
	table{
		border-spacing:20px 10px;
		
		margin-bottom:10px;}
		textarea{
			resize:none;
			width:245px;}
			.div{
				padding-bottom:20px;
				padding-top:20px;
				padding-left:20px;
				padding-right:20px;
				background:linear-gradient(rgba(102,255,204,1),rgba(0,0,255,1));
				width:400px;
				height:200px;
				border-radius:20px;
			}
			.div1{
				padding-bottom:45px;
				padding-top:20px;
				padding-left:20px;
				padding-right:20px;
				background:linear-gradient(rgba(0,255,51,1),rgba(204,255,51,1));
				width:400px;
				height:200px;
				border-radius:20px;
				margin-bottom:30px;
			}
			.btn{
				padding-bottom:10px;
				padding-top:10px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:100px;
				cursor:pointer;
				background:linear-gradient(rgba(0,255,255,1),rgba(0,102,204,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
			}
			.btn1{
				padding-bottom:10px;
				padding-top:10px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:100px;
				cursor:pointer;
				background:linear-gradient(rgba(0,255,51,1),rgba(204,255,51,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
			}
			
			.btn:hover{
				cursor:pointer;
				background:rgba(204,255,0,1);
				color:rgb(0,0,0);
			}
			.btn1:hover{
				cursor:pointer;
				background:rgba(0,255,204,;
				color:rgb(0,0,0);
			}
			body{
				background-size:cover;
			}
			
	</style>
    <meta charset="utf-8">
</head>
<body background="images/img184.JPG">
<h1 style="color:rgb(255,255,255);  background:rgba(0,0,0,0.8); padding-bottom:3px; padding-top:3px; padding-left:3px; padding-right:3px;">Air Your Views Here </h1>
<div class="div">
    <table>
    <form action="" method="POST">
    <tr><td>Your name:</td><td><input name="name" size="30" type="text" readonly value="<?php 
	
	
	echo $row_Recordset1['Username'];  ?>"></td></tr>
     <tr><td>Your message:</td><td><textarea name="message" rows="7" cols="30" required>
    </textarea></td></tr>
      <tr style="display:none;"><td></td><td><input type="text" value="<?php  echo date('Y-m-d');?>" name="date" style="display:none;"></td></tr>
       <tr><td colspan="2"><input value="Send message" name="send" type="submit" class="btn" style="margin-left:130px;"><input type="reset" class="btn" style="margin-left:20px;"></td></tr>
     
     
    
    
    
    </form>
    </table>
    </div>
    
    <br/><br/>
    
   <h1 style="color:rgb(255,255,255); background:rgba(0,0,0,0.8); padding-bottom:3px; padding-top:3px; padding-left:3px; padding-right:3px;">Your Feedback  </h1>
<div class="div1">
    <table>
    <form action="" method="POST">
    <tr><td>Your name:</td><td><input name="name1" size="30" type="text" readonly value="<?php echo $row_Recordset1['Username'];  ?>"></td></tr>
    <tr><td>Your email:</td><td><input name="email" size="30" type="email"></td></tr>
     <tr><td>Your message:</td><td><textarea name="message1" rows="7" cols="30" required>
    </textarea></td></tr>
      <tr style="display:none;"><td></td><td><input type="text" value="<?php  echo date('l j-M-Y');?>" name="date" style="display:none;"></td></tr>
       <tr><td colspan="2"><input value="Send feedback"  type="submit" class="btn1" style="margin-left:130px;" name="feed"><input type="reset" class="btn1" style="margin-left:20px;"></td></tr>
     
     
    
    
    
    </form>
    </table>
    </div> 
  
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
