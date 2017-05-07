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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "second")) {
  $insertSQL = sprintf("INSERT INTO work_details (Username, Usertype, Department1, Department2, Role1, Role2, Role3, Role4, Role5, Role6, Role7, DCODE, Date_of_signup, Password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['role'], "text"),
                       GetSQLValueString($_POST['fd1'], "text"),
                       GetSQLValueString($_POST['fd2'], "text"),
                       GetSQLValueString($_POST['fr1'], "text"),
                       GetSQLValueString($_POST['fr2'], "text"),
                       GetSQLValueString($_POST['fr3'], "text"),
                       GetSQLValueString($_POST['fr4'], "text"),
                       GetSQLValueString($_POST['fr5'], "text"),
                       GetSQLValueString($_POST['fr6'], "text"),
                       GetSQLValueString($_POST['fr7'], "text"),
                       GetSQLValueString($_POST['dcode'], "text"),
                       GetSQLValueString($_POST['sd'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_se, $se);
  $Result1 = mysql_query($insertSQL, $se) or die(mysql_error());

  $insertGoTo = "Demography.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  if($Result1){
	?>
    
    <script type="text/javascript">
	alert("Demographic details successfully submitted - Now to the work details");
	</script>
    <?php 
	$msg ='<div align="center">
<div style="width:250px; height:100px; background:rgba(0,0,0,0.6); color:rgb(255,255,255); font-size:24px; padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;">Work details successfully submitted - Now to the demographic details</div></div>';
		
		header("Location: Demography.php?Message=".urlencode($msg));
  
  }
}

mysql_select_db($database_se, $se);
$query_Recordset1 = "SELECT Name FROM staff_and_management_demographic_details order by id desc";
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);mysql_select_db($database_se, $se);
$query_Recordset1 = "SELECT Name FROM staff_and_management_demographic_details order by id desc";
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


if(isset($_GET['Message1'])){
	
	print $_GET['Message1'];
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Work Details</title>
<style>
body{
	background-size:cover;
	background-position:40px left;
}
.chk{
	width:20px;
	height:20px;
	border-radius:20px;
}
.btn{
background:linear-gradient(rgba(255,255,255,0.65),rgba(0,255,255,0.65));
width:150px;
padding-bottom:10px;
padding-top:10px;
border-radius:20px;
cursor:pointer;
border:1px #00FFFF solid;
	}
	
.btn0{
background:linear-gradient(rgba(0,255,153,0.8),rgba(102,255,0,0.8));
width:150px;
padding-bottom:10px;
padding-top:10px;
border-radius:20px;
cursor:pointer;
border:1px #00FFFF solid;
	}	
	
.txt{
	padding-bottom:10px;
padding-top:7px;
border-radius:7px;
width:300px;
	}
.txt1{
	padding-bottom:5px;
padding-top:5px;
border-radius:7px;
width:250px;
	}
.txt1:focus{
	outline:none;
}		
.txt:focus{
	background:rgb(232,253,253);
}
.btn:focus{
	outline:none;
}
th{
	background:linear-gradient(rgba(0,0,255,0.4),rgba(0,255,255,0.4));
	padding-bottom:10px;
	padding-top:10px;
	width:100%;
}
table{
	margin-top:5%;
	background:rgba(0,255,255,0.5);
	padding-left:1px;
	padding-bottom:1px;
	box-shadow:rgba(0,0,0,0.5) 1px 1px 1px 17px;
}
td{
	background:rgba(255,255,255,0.5);
	padding-left:3px;
	padding-right:3px;

}
</style>
<script type="text/javascript">
function checkbox() {
	dept= document.getElementById('d[]').value;
	role = document.getElementById('r[]').value;
	password = document.getElementById('pass').value;
if(dept == "")
{ alert('please choose a department!!!'); 
return false;
}
if(role == "")
{ 
alert('Please select a role!!'); 
return false;
}
if(password.length<8){
alert('Password can\'t be less than 8 characters!!'); 
return false;	
	}
return true;
}


</script>
</head>

<body background="images/img22.jpg">
<div align="center">
<table class="first">
<form name="first" action="" method="post" class="firstform" onSubmit="return(checkbox());">
<tr><th colspan="2">Workplace Information</th></tr>
<tr><td>Username</td><td><input type="text" name="uname" value="<?php echo $row_Recordset1['Name']; ?>" class="txt" readonly></td></tr>
<tr><td>Department</td><td>
<div style="background:linear-gradient(rgba(0,255,255,0.5),rgba(255,255,255,0.5));  border-radius:7px; padding-top:7px; padding-bottom:7px; padding-right:10px;">
<input type="checkbox" value="Video Production Unit" name="d1" class="chk" id="d[]">Video Production Unit<br/>
<input type="checkbox" value="Valley View Radio Department" name="d2" class="chk" id="d[]">Valley View Radio Department
</div>
</td></tr>
<tr><td>Role</td><td>
<div style="background:linear-gradient(rgba(255,255,255,0.6),rgba(0,255,255,0.6)); border-radius:7px; padding-top:7px; padding-bottom:7px; padding-right:10px; ">
<input type="checkbox" name="r0" value="Manager" class="chk" id="r[]">Manager<br/>
<input type="checkbox" name="r1" value="Secretary" class="chk" id="r[]">Secretary<br/>
<input type="checkbox" name="r2" value="Producer" class="chk" id="r[]">Producer<br/>
<input type="checkbox" name="r3" value="Technical Producer" class="chk" id="r[]">Technical Producer<br/>
<input type="checkbox" name="r4" value="Presenter" class="chk" id="r[]">Presenter<br/>
<input type="checkbox" name="r5" value="Reporter" class="chk" id="r[]">Reporter<br/>
<input type="checkbox" name="r6" value="Work Study" class="chk" id="r[]">Work Study<br/>
</div>
</td></tr> 
<tr><td>Signup Date</td><td><input type="date" name="sd" class="txt" required></td></tr>
<tr><td>Password</td><td><input type="password" name="pass" value=""  id="pass"class="txt" required></td></tr>
<tr><td colspan="2"><input type="submit" value="Submit" name="next" class="btn" style="margin-left:20px;"><input type="reset" class="btn" style="margin-left:50px;"></td></tr>
</form>
</table>
<?php
if(isset($_POST['next'])){
?>	
<style>
.first{
	display:none;
}
.firstform{
	display:none;
}
</style>
<table>

<form name="second" action="<?php echo $editFormAction; ?>" method="POST">
<tr><th colspan="2">Final Details</th></tr>
<tr><td>Username</td><td><div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="name" value="<?php echo $_POST['uname']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>

<tr class="tr"><td>Department(s)</td><td>

<?php
if($_POST['d1']==""){
	?>
    <style>.d1{ display:none;}</style>
<?php    
	}
if($_POST['d2']==""){
?>
    <style>.d2{display:none;}</style>
<?php	
	}	
if($_POST['d2']=="" && $_POST['d1']==""){
	?>
    <style>.tr{display:none;}</style>
<?php
	
	}	
?>



<div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="fd1" value="<?php echo $_POST['d1']; ?>" readonly class="d1" style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"><br/><br/>

<input type="text" name="fd2" value="<?php echo $_POST['d2']; ?>" readonly class="d2" style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>

<tr><td>Departmental Code</td><td><div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="dcode" value="<?php 
if($_POST['d1']!="" && $_POST['d2']!=""){
	echo"MCVVVRD";
	}else if($_POST['d1']!="" && $_POST['d2']==""){
		echo"MCVD";
		
		}else if($_POST['d1']=="" && $_POST['d2']!=""){
			echo"MCVVRD";
			
			}

?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>
<tr><td>Role(s)</td>
<td>
<?php
if($_POST['r0']==""){
?>
    <style>.r0{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r1']==""){
?>
    <style>.r1{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r2']==""){
?>
    <style>.r2{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r3']==""){
?>
    <style>.r3{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r4']==""){
?>
    <style>.r4{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r5']==""){
?>
    <style>.r5{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}
if($_POST['r6']==""){
?>
    <style>.r6{ display:none;} .div{height:auto;}</style>
<?php 	
	
	}	
?>
<div class="div">
<div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;">
<input type="text" name="fr1" value="<?php echo $_POST['r0']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r0"><br/><br/>
<input type="text" name="fr2" value="<?php echo $_POST['r1']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r1"><br/><br/>
<input type="text" name="fr3" value="<?php echo $_POST['r2']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r2"><br/><br/>
<input type="text" name="fr4" value="<?php echo $_POST['r3']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r3"><br/><br/>
<input type="text" name="fr5" value="<?php echo $_POST['r4']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r4"><br/><br/>
<input type="text" name="fr6" value="<?php echo $_POST['r5']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r5"><br/><br/>
<input type="text" name="fr7" value="<?php echo $_POST['r6']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;" class="r6">
</div>
</div>
</td>
</tr>
<tr><td>Signup Date</td><td><div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="sd" value="<?php echo $_POST['sd']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>
<tr><td>Password</td><td><div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="password" value="<?php echo $_POST['pass']; ?>" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>

<tr style="display:none;"><td>Usertype</td><td><div style="padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;"><input type="text" name="role" value="Worker" readonly style="padding-bottom:5px;padding-top:5px;border-radius:7px;width:250px;"></div></td></tr>

<tr><td colspan="2"><div align="center"><input type="submit" value="Submit" name="finalsubmit" class="btn0"></div></td></tr>
<input type="hidden" name="MM_insert" value="second">
</form>
</table>	
<?php    
	}

?>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
