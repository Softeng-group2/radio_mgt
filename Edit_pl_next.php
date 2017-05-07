<?php require_once('connection.php'); ?>
<?php
$count = count($_POST['st']);
$count = count($_POST['ft']);
$count = count($_POST['prg']);
$count = count($_POST['hst']);
if(isset($_POST['updateSun'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
		$sqlQuery = mysql_query("UPDATE `sunday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "'LIMIT 1");
	
		
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	++$i;	
	}
}

if(isset($_POST['deleteSun'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `sunday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	

if(isset($_POST['updateMon'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("UPDATE `sunday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "'LIMIT 1");
	
		
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	if(isset($_POST['deleteMon'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `monday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	
if(isset($_POST['updateTues'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];
	
	$sqlQuery = mysql_query("UPDATE `tuesday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "'LIMIT 1");
		
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	if(isset($_POST['deleteTues'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `tuesday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	
if(isset($_POST['updateWed'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("UPDATE `wednesday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "'LIMIT 1");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	if(isset($_POST['deleteWed'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `wednesday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	
	if(isset($_POST['deleteThurs'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `thursday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	
if(isset($_POST['updateThurs'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("UPDATE `thursday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "'LIMIT 1");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
if(isset($_POST['deleteFri'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `friday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
	if(isset($_POST['updateFri'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("UPDATE `friday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."'WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
	
if(isset($_POST['updateSat'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];
	
	$sqlQuery = mysql_query("UPDATE `saturday` SET `Start_time`='".$st[$i]."',`Finish_time`='".$ft[$i]."',`Program`='".$prog[$i]."',`Host`='".$host[$i]."' WHERE id='" . $_POST['id'][$i] . "' LIMIT 1");
		
		
	if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) updated !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while updating , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;	
	}
	
	if(isset($_POST['deleteSat'])){
	$i=0;
	while($i<$count){
	$st = $_POST['st']; $prog = $_POST['prg'];	
	$ft = $_POST['ft']; $host = $_POST['hst'];	
	
	$sqlQuery = mysql_query("DELETE FROM `saturday` WHERE id='" . $_POST['id'][$i] . "'LIMIT 1 ");
	
		
		if($sqlQuery)
	{
		?>
        <script>
		alert('<?php echo $count." record(s) deleted !!!"; ?>');
		window.location.href='Edit_pl.php';
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert('error while deleting , TRY AGAIN');
		document.referrer
		</script>
        <?php
	}
	}
	++$i;
	}
							
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Program Lineup</title>
<style>
h1{
	color:rgb(255,255,255);
}
.evenRow {
background:linear-gradient(rgba(204,255,0,0.8),rgba(255,255,255,0.8));
font-size:15px;
color:#101010;
}
.evenRow:hover {
background:rgba(204,255,204,0.9);
}
.oddRow {
background:linear-gradient(rgba(0,255,0,0.8),rgba(255,255,255,0.8));
font-size:17px;
color:#101010;
}
.oddRow:hover {
background:rgba(255,255,255,0.9);
}
th{
	text-align:center;
	background:rgba(204,255,0,0.9);
}
td{
	text-align:center;
}
.btn{background:linear-gradient(rgba(0,255,0,1),rgba(0,102,102,1));
		color:rgb(255,255,255);
		width:120px;
	padding-bottom:8px;
	padding-top:8px;
	font-size:24px;
	border-radius:10px;
	cursor:pointer;
	border:3px groove rgb(0,204,0);}
	.btn:hover{
		background:rgba(0,0,0,1);
		color:rgb(0,255,0);
		border:3px groove rgb(0,204,0);
		}
</style>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
</head>

<body>
<?php include('Edit_pl.php');  ?>
 <table border="0" cellpadding="10" cellspacing="1" width="64%" style="border:3px groove rgb(102,255,255)">
 <tr>
<td colspan="5" style="background:rgba(255,255,255,0.9);">Edit Program<br/><h3>Day: <?php echo ucfirst($_POST['prog']); ?></h3></td>
</tr>


<tr>
<th>#</th>
<th><label>Start Time</label></th>
<th><label>Finish Time</label></th>
<th><label>Program</label></th>
<th><label>Host</label></th>
</tr>
 

<?php
$rowCount = count($_POST['prog']);
for($i=0;$i<$rowCount;$i++) {
if($_POST['prog']=="sunday"){
	
	$result1 = mysql_query("select count(*) as total FROM sunday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		?>
        <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM sunday]");
			while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";	
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
         <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateSun" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteSun" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
			}

if($_POST['prog']=="monday"){
	
		$result1 = mysql_query("select count(*) as total FROM monday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		
		?>
        <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM monday");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
         <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateMon" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteMon" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
	}

if($_POST['prog']=="tuesday"){
	
		$result1 = mysql_query("select count(*) as total FROM tuesday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		
		?>
        <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM tuesday");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
         <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateTues" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteTues" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
	}
	
if($_POST['prog']=="wednesday"){
	
		$result1 = mysql_query("select count(*) as total FROM wednesday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		
		?>
        <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM wednesday");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
         <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateWed" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteWed" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
	}
	
if($_POST['prog']=="thursday"){
	
		$result1 = mysql_query("select count(*) as total FROM thursday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		
		?>
        <tr><td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td></tr>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM thursday");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
              <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateThurs" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteThurs" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
	}
	
if($_POST['prog']=="friday"){
	
		$result1 = mysql_query("select count(*) as total FROM friday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
		
		?>
        <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM friday");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
         <script type="text/javascript">
		document.getElementById('hbn').style.display="none";
		
		</script>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
              <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateFri" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteFri" value="Delete" class="btn2" id="btn" /></td>
</form> 
        <?php
		}
		}
	}
	
if($_POST['prog']=="saturday"){
	
		$result1 = mysql_query("select count(*) as total FROM saturday");
	while($row1= mysql_fetch_array($result1)){
		$countedrows = $row1['total'];
	}
		
		if($countedrows==0){
			
	
		?>
        <script type="text/javascript">
		document.getElementsByName('update').style.visibility='hidden';
		
		</script>
       <tr> <td colspan="5" style="background:rgba(255,255,255,0.7);"><h1 align="center" style=" color:rgb(0,0,0);">No records available</h1></td></tr>
        <?php
		}
		else{
			$result = mysql_query("SELECT * FROM saturday where id is not null");
	while($row= mysql_fetch_array($result)){
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>">
                	<td style="text-align:center;">
    	<input type="hidden" name="id[]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td><td>
		<input type="text" name="st[]" value="<?php echo $row['Start_time'];?>"  />
        </td>
        <td>
		<input type="text" name="ft[]" value="<?php echo $row['Finish_time'];?>"  />
		
        </td>
        <td>
        <input type="text" name="prg[]" value="<?php echo $row['Program'];?>"  />
        </td>
        <td>
		<input type="text" name="hst[]" value="<?php echo $row['Host'];?>"  />
		</td>
        		</tr>
            <td colspan="5" id="hbn" style="background:linear-gradient(rgba(204,153,0,0.9),rgba(204,153,102,1))"><input type="submit" name="updateSat" value="Update" class="btn1" id="btn" /><input type="submit" name="deleteSat" value="Delete" class="btn2" id="btn" /></td>
</form> 
 </table>    
        <?php
		}
		}
	}
}
?>

 
 
 

</body>
</html>