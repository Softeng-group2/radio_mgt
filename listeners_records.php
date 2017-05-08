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
</style>
</head>

<body background="images/168.jpg">
<h1 align="center">Listeners' Records <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;"></a></h1>
<div align="center">
<table  border="1" cellpadding="6" width="1200px" style="background:rgba(255,255,255,0.8)">
<tr>
<td>##</td>
<td>Name</td>
<td>Sex</td>
<td>Contents of Interest</td>
<td>Email</td>
<td>Phone no</td>
<td>Date of SignUp</td>
<td>Profile Picture</td>
</tr>
<?php
$counter=1;
$listenercount = mysql_query("SELECT count(*) as listenercount FROM `listener_details`") or die(mysql_error());
while($count=mysql_fetch_assoc($listenercount)){
	if($count['listenercount']<1){
		?>
        <tr><td colspan="7"><h3 align="center">No records available</h3></td></tr>
        <?php
		}else{
			
$listenerdetails = mysql_query("SELECT * FROM `listener_details`") or die(mysql_error());
while($listen=mysql_fetch_assoc($listenerdetails)){
	?>
	<tr>
    <td><?php echo $counter ?></td>
    <td><?php echo $listen['Username'] ?></td>
    <td><?php echo $listen['Sex'] ?></td>
    <td width="150"><?php echo $listen['Interest1'].'&nbsp;'.'&nbsp;'.$listen['Interest2'].'&nbsp;'.'&nbsp;'.$listen['Interest3'].'&nbsp;'.'&nbsp;'.$listen['Interest4'].'&nbsp;'.'&nbsp;'.$listen['Interest5'].'&nbsp;'.'&nbsp;'.$listen['Interest6'].'&nbsp;'.'&nbsp;'.$listen['Interest7'].'&nbsp;'.'&nbsp;' ?></td>
    <td><?php echo $listen['Email'] ?></td>
    <td><?php echo $listen['Telephone'] ?></td>
    <td><?php echo date('l j-M-Y',(strtotime($listen['Signup']))) ?></td>
    <td>  <?php
	   if(empty($listen['Img'])){
	   ?>
        <img src="profilepic/noavatar92.png"  width="100px" height="100px" class="img" />
        <?php
	   }else{
		   ?>
		   <img src="profilepic/<?php echo $listen['Img']; ?>"  width="100px" height="100px" class="img" /> 
		   <?php
	   }
	   ?></td>
    </tr>
	<?php
	$counter++;
	}
}
}
?>
</table>
</div>
</body>
</html>