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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updatepro")) {
  $updateSQL = sprintf("UPDATE p_r_o SET Name=%s WHERE `Position`=%s",
                       GetSQLValueString($_POST['ename'], "text"),
                       GetSQLValueString($_POST['epos'], "text"));

  mysql_select_db($database_se, $se);
  $Result1 = mysql_query($updateSQL, $se) or die(mysql_error());
  if($Result1){
	echo"<script>alert('Substitution has been successfully done!');</script>";
	}
}

?>
<?php require_once('connection.php'); ?>
<?php
session_start();
$_SESSION['name'] = $_POST['worker']; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Public Relations</title>
<style>
body{
	background-size:cover;
}

</style>

</head>

<body background="images/nature_0014.jpg">
<h1 align="center" style="color:rgb(255,255,255);">Public Relations <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;"></a></h1>
	<div style="float:right; margin-right:70px; width:180px; height:180px; padding:10px 10px 10px 10px; text-align:
center; background:rgba(255,255,255,0.7); border:5px #CC0033 groove;">
	For only six staff members. Admin, Manager and four other staff members.
	</div>


<div style=" margin-left:50px;">
<table style="border-spacing:10px 10px;" background="images/hd_imac_desk2-1280x800.jpg">
<form action="" method="post">

<tr style="text-align:center;"><td></td><td>#</td><td>Name</td><td>Position</td></tr>

<?php


	$idsql1=mysql_query("SELECT COUNT(*) as totalnum FROM `p_r_o`") or die("empty results");
while($fetchid1= mysql_fetch_assoc($idsql1)){
if($fetchid1['totalnum']==0){	
?>
<tr><td colspan="4" style="text-align:center;">No Records available</td></tr>

<?php
}else{
$counter = 1;
$sql=mysql_query("SELECT * FROM `p_r_o`") or die("empty results");
while($fetch= mysql_fetch_assoc($sql)){
	
	?>


    
	
<tr style="text-align:center;">
<td><input type="radio" name="worker" value="<?php echo $fetch["Name"]; ?>" required class="rbtn" ></td>
<td><?php echo $counter; ?></td>
<td><?php echo $fetch["Name"]; ?></td>
<td><?php echo $fetch["Position"]; ?></td>
<td><input type="submit" name="next" value="Edit" class="btn" /></td><td><input type="submit" name="del" value="Remove" class="btndel" onClick="return(confirm('Sure to remove worker?'));" /></td>
</tr>    
 
    
<?php    
	

$counter++;	
	}
}
}
?>
</form>
</table>

</div>

		<div style="margin-left:50px; margin-top:40px; color:white;">
		<table width="400px;">
<form action="" method="post" name="" onSubmit="return(confirm('Sure to add worker?'));">

<tr><th colspan="2"><h2>Add Worker here</h2></th></tr>
<tr style="font-weight:bold;"><td colspan="2">Status: 
<?php

$idsql=mysql_query("SELECT COUNT(*) as totalnum FROM `p_r_o`") or die("empty results");
while($fetchid= mysql_fetch_assoc($idsql)){
	$countid = $fetchid['totalnum'];
}
if($countid==6){
	echo"The table is full";
	}
	if($countid==0){
		echo"Six more slots to be filled";
		
		}
	if($countid==1){
		echo"Five more slots to be filled";
		
		}
if($countid==2){
		echo"Four more slots to be filled";
		
		}
if($countid==3){
		echo"Three more slots to be filled";
		
		}
if($countid==4){
		echo"Two more slots to be filled";
		
		}
if($countid==5){
		echo"One more slot to be filled";
		
		}
?>
</td></tr>
<tr><td>Name</td><td>Position</td></tr>
<tr>

<td><select name="name" style="width:200px;">
<?php
$sql1= mysql_query("SELECT * FROM `work_details`") or die("empty results");
	while($fetch1= mysql_fetch_assoc($sql1)){
?>
<option value="

<?php echo $fetch1['Username']; ?>"><?php echo $fetch1['Username']; ?></option>  
<?php		
	}
	

?>
</select>
  </td>
  
  <td>
  <select name="position" required style="width:200px;">
  <option value="">--- Select an option ---</option>
<option value="Admin">Admin</option> 
<option value="P.R.O">P.R.O</option> 
<option value="Assistant 1 P.R.O">Assistant 1 P.R.O</option> 
<option value="Assistant 2 P.R.O">Assistant 2 P.R.O</option> 
<option value="Assistant 3 P.R.O">Assistant 3 P.R.O</option>
<option value="Manager">Manager</option>  
</select>
  </td>




</tr>
<tr><td colspan="2"><div align="center">
<input type="submit" value="Add" name="add" >
</div>
</td></tr>
</form>
</table>

		</div>
        
 <?php
if(isset($_POST['del'])){
$removequery = mysql_query("DELETE FROM `p_r_o` WHERE `Name`='".$_POST['worker']."'") or die(mysql_error());	
?>
<script>
alert('Worker has been successfully removed!');
</script>
<?php
	echo"<meta http-equiv='refresh' content='0'>";
	}			

if(isset($_POST['add'])){
	if(count($fetchid['id'])==5){
	?>
    <script>
	alert("The slots are full!!! You can't add another worker!!!");
	</script>
    <?php	
	}else{
		$getposition = mysql_query("SELECT * FROM `p_r_o` WHERE `Position`='".$_POST['position']."'") or die("No records found!");
		while($get = mysql_fetch_assoc($getposition)){
		$name = $get['Name'];
		}
		$insert = mysql_query("INSERT INTO `p_r_o`(`Name`, `Position`) VALUES ('".$_POST['name']."','".$_POST['position']."')") or die('<div style="padding:15px 15px 15px 15px; background:linear-gradient(rgba(251,251,251,1),rgba(153,153,153,0.7)); border-radius:10px; width:450px;">'.
		'You can\'t assign '.$_POST['name'].' to the position of '.$_POST['position'].
		'<br/>'.'<br/>'.
		'Position has already been occupied!!!'.'<br/>'.'<br/>'.
		'Position of:  '.$_POST['position'].'&nbsp;'.'is not vacant!!!'.'<br/>'.'<br/>'.'Position is currently occupied by '.$name.'</div>');
		
		
		if($insert){
			?>
			 <script>
	alert("Worker successfully added!");
	</script>
    <?php
	echo"<meta http-equiv='refresh' content='0'>";
			}
		}
	
	}
?>       
<style> 
.editform{
	display:none;
}
</style>   
  
 <?php
if(isset($_POST['next'])){
echo'<style> .editform{display:block;}</style>';	
	session_start();
	}
if(!isset($_POST['next'])){
	echo'<style> .etable{display:block;}</style>';
	}	
?> 
 
  <div style="margin-left:50px; margin-top:40px; color:white;">      
        
   <div class="editform">
<script type="text/javascript">

function maintain(){
	var uname = document.getElementById('name').value;
var position = document.getElementById('post').value;
	if(window.confirm('Sure about maintaining '+uname+' as '+position+' ?')){
		alert(uname+' still maintains the position of '+position);
	return true;
	}else{
		return false;
		}
}
</script>
<table class="etable">
<form action="<?php echo $editFormAction; ?>" method="POST" name="updatepro">
<tr><th colspan="2">Edit Record</th></tr>

<tr><td>Name</td><td>Position</td><td>Options</td></tr>

<tr>
<td><input type="text" id="name" name="oldname" value="<?php echo $_POST['worker']; ?>" readonly style="width:160px; padding:5px 5px 5px 5px;"></td>

<td>
<?php
$getuser  = mysql_query("Select * from p_r_o where Name='".$_POST['worker']."'") or die("no records available");
while($fetchgetuser= mysql_fetch_array($getuser)){
	$postuser = $fetchgetuser['Name'];
	$postpos = $fetchgetuser['Position'];
	

?>

<input type="text" id="post" name="oldpost" value="<?php echo $postpos;  ?> " readonly style="width:160px; padding:5px 5px 5px 5px;">

<?php
}

?>
</td>

<td><a href="pro.php"><input type="button" value="Maintain" onClick="return(maintain());"></a></td>

</tr>


<tr><td><select name="ename" style="width:173px; padding:5px 5px 5px 5px;" required id="ename">
<?php

$finduser = mysql_query("SELECT * FROM `work_details` WHERE `Username`  NOT in('".$_SESSION['name']."')") or die(mysql_error());


while($fetchfinduser= mysql_fetch_array($finduser)){
	$founduser = $fetchfinduser['Username'];
	$foundpos = $fetchfinduser['Position'];
	

echo'<option value="'.$founduser.'">'.$founduser.'</option>';
}

?>
</select></td>
<td>
<input name="epos" value="<?php echo $postpos; ?>" readonly style="width:160px; padding:5px 5px 5px 5px;" id="epos">
<?php

?>
</td>
<td>

<input type="submit" value="Replace" name="updatepro">

<?php
if(isset($_POST['updatepro'])){
	
	$updatequery= mysql_query("UPDATE `p_r_o` SET `Name`='".$_POST['ename']."' WHERE `Name`='".$_SESSION['name']."'") or die(mysql_error());
		
	}

?>
</td>

</tr>
<input type="hidden" name="MM_update" value="updatepro">

</form>
</table>

</div>
</div>
 
 
       
</body>
</html>
