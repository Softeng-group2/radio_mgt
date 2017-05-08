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

<body background="images/abstract_0072.jpg">
<h1 align="center">Workers Demographic Records</h1>
<div align="center">
<table  border="1" cellpadding="6" width="1300px" style="background:rgba(255,255,255,0.8)">
<tr>
<td>##</td>
<td>Name</td>
<td>Sex</td>
<td>Date of Birth</td>
<td>Email</td>
<td>Phone no</td>
<td>Marital Status</td>
<td>Place of Birth</td>
<td>Hometown</td>
<td>Nationality</td>
<td>Religion</td>
<td>ID Card Details</td>
<td>Postal Address</td>
</tr>
<?php
$counter=1;
$workercount = mysql_query("SELECT count(*) as democount FROM `staff_and_management_demographic_details`") or die(mysql_error());
while($count=mysql_fetch_assoc($workercount)){
	if($count['democount']<1){
		?>
        <tr><td colspan="7"><h3 align="center">No records available</h3></td></tr>
        <?php
		}else{
			
$workerdetails = mysql_query("SELECT * FROM `staff_and_management_demographic_details`") or die(mysql_error());
while($listen=mysql_fetch_assoc($workerdetails)){
	?>
	<tr>
    <td><?php echo $counter ?></td>
    <td><?php echo $listen['Name'] ?></td>
    <td><?php echo $listen['Gender'] ?></td>
    <td ><?php echo date('l j-M-Y',(strtotime($listen['Date_of_birth'])))?></td>
    <td><?php echo $listen['Email_Address'] ?></td>
    <td><?php echo $listen['Contact_No'] ?></td>
    <td><?php echo $listen['Marital_status'] ?></td>
    <td><?php echo $listen['Place_of_birth'] ?></td>
    <td><?php echo $listen['Hometown'] ?></td>
    <td><?php echo $listen['Nationality'] ?></td>
    <td><?php echo $listen['Religion'] ?></td>
    <td><?php echo $listen['National_ID_type'].'<br/>'.$listen['National_ID_No'] ?></td>
    <td><?php echo $listen['Postal_Address'] ?></td>
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