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

<body background="images/abstract_0017.jpg">
<h1 align="center" style="color:rgb(204,255,51); background:rgba(0,0,0,0.8);">Workers Job Records</h1>
<div align="center">
<table  border="1" cellpadding="6" width="1000px" style="background:rgba(255,255,255,0.8)">
<tr>
<td>##</td>
<td>Name</td>
<td>Rank</td>
<td>Department 1</td>
<td>Department 2</td>

<td>Roles</td>
<td>Work ID</td>
<td>Date of Signup</td>
<td>Profile Picture</td>
</tr>
<?php
$counter=1;
$workercount = mysql_query("SELECT count(*) as democount FROM `work_details`") or die(mysql_error());
while($count=mysql_fetch_assoc($workercount)){
	if($count['democount']<1){
		?>
        <tr><td colspan="7"><h3 align="center">No records available</h3></td></tr>
        <?php
		}else{
			
$workerdetails = mysql_query("SELECT * FROM `work_details`") or die(mysql_error());
while($listen=mysql_fetch_assoc($workerdetails)){
	?>
	<tr>
    <td><?php echo $counter ?></td>
    <td><?php echo $listen['Username'] ?></td>
    <td><?php echo $listen['Usertype'] ?></td>
    
    <td><?php echo $listen['Department1'] ?></td>
    <td><?php echo $listen['Department2'] ?></td>
    <td><?php echo $listen['Role1'].'&nbsp;'.$listen['Role2'].'&nbsp;'.$listen['Role3'].'&nbsp;'.$listen['Role4'].'&nbsp;'.$listen['Role5'].'&nbsp;'.$listen['Role6'].'&nbsp;'.$listen['Role7'].'&nbsp;' ?></td>
    <td><?php echo $listen['DCODE'].$listen['DID'] ?></td>
    <td ><?php echo date('l jS F, Y',(strtotime($listen['Date_of_signup'])))?></td>
    <td>  <?php
	   if(empty($listen['Img'])){
	   ?>
        <img src="profilepic/noavatar92.png"  width="100px" height="100px" class="img" />
        <?php
	   }else{
		   ?>
		   <img src="workersprofile/<?php echo $listen['Img']; ?>"  width="100px" height="100px" class="img" /> 
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