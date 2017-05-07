<?php require_once('connection.php'); ?>
<?php
$conn = mysql_connect("localhost","root","christabel02");
mysql_select_db("management_system_software_engineering",$conn);
$result = mysql_query("SELECT table_name,table_rows,create_time  
FROM information_schema.tables 
WHERE table_schema='management_system_software_engineering' AND
    create_time BETWEEN '	
2017-02-23 13:15:10' AND '2017-02-23 13:36:24' order by create_time");

if(isset($_POST['next'])){
	$prog = $_POST['prog'];

?>

<script type="text/javascript">
function UpdateAction() {
var prog = document.getElementById('prog').value;
if(window.confirm('Sure about editing program lineup for '+prog)){
return true;
}else{
	return false;
	
	}
	
}
</script>
<?php
}

if(isset($_POST['del'])){
	$prog = $_POST['prog'];
	if($prog=="sunday"){
		$del = mysql_query("TRUNCATE TABLE sunday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="monday"){
		$del = mysql_query("TRUNCATE TABLE monday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="tuesday"){
		$del = mysql_query("TRUNCATE TABLE tuesday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="wednesday"){
		$del = mysql_query("TRUNCATE TABLE wednesday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="thursday"){
		$del = mysql_query("TRUNCATE TABLE thursday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="friday"){
		$del = mysql_query("TRUNCATE TABLE friday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}
	if($prog=="saturday"){
		$del = mysql_query("TRUNCATE TABLE saturday");
		if($del){
	?>	
      <script type="text/javascript">
    alert("Program schedules successfully deleted");
	//location.reload();
	
    	</script>
	<?php		}else{
		?>
         <script type="text/javascript">
    alert("Error deleting records!");
    	</script>
        
        
        		
		<?php	}
		}						
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Program LineUp</title>
<style>
h1{
	color:rgb(255,255,255);
}
.evenRow {
background:linear-gradient(rgba(204,255,0,0.9),rgba(255,255,255,0.9));
font-size:15px;
color:#101010;
}
.evenRow:hover {
background:rgba(204,255,204,0.9);
}
.oddRow {
background:linear-gradient(rgba(0,255,0,0.9),rgba(255,255,255,0.9));
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
.btn:focus{
	outline:none;
}
.btndel:focus{
	outline:none;
}
.btn{background:url(images/dragon_dark_wolf_bitdefender_antivirus_73443_300x187.jpg);
		color:rgb(255,255,255);
		width:120px;
	padding-bottom:3px;
	padding-top:3px;
	font-size:16px;
	border-radius:20px;
	cursor:pointer;
	border:3px groove rgb(0,204,0);}
	.btn:hover{
		background:rgba(0,0,0,1);
		color:rgb(0,255,0);
		border:3px groove rgb(0,204,0);
		}
		
.btndel{background:url(images/balloon_flight-t1.jpg);
		color:rgb(255,255,255);
		width:120px;
	padding-bottom:3px;
	padding-top:3px;
	font-size:16px;
	border-radius:20px;
	cursor:pointer;
	border:3px groove rgb(0,204,0);
	margin-left:0px;
	margin-top:0px;}
	.btn:hover{
		background:rgba(0,0,0,1);
		color:rgb(0,255,0);
		border:3px groove rgb(0,204,0);
		}
	.btndel:hover{
		background:rgb(0,0,0);
		color:rgb(204,255,0);
	}
		
.btn1{
	background:linear-gradient(rgba(255,204,0,1),rgba(255,255,51,1));
		color:rgb(0,0,0);
		width:100px;
	padding-bottom:5px;
	padding-top:5px;
	font-size:15px;
	border-radius:19px;
	cursor:pointer;
	border:2px groove rgbrgb(255,153,51);
	}		
.btn2{
	background:linear-gradient(rgba(204,255,0,1),rgba(255,255,51,1));
	margin-left:20px;
		color:rgb(0,0,0);
		width:100px;
	padding-bottom:5px;
	padding-top:5px;
	font-size:15px;
	border-radius:19px;
	cursor:pointer;
	border:2px groove rgbrgb(255,153,51);
	}			
</style>
</head>

<script src="js-script.js" type="text/javascript"></script>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
<body background="images/img181.jpg">
<h1 align="center" class="h1"><span>UPDATE PROGRAM LINE-UP HERE</span></h1>
<div align="center">
<div style="width:80%;">


<table border="0" cellpadding="10" cellspacing="1" width="80%" style="border:3px groove rgb(102,255,255)">
<tr>
<td  style="background:rgba(255,255,255,0.5)"></td>
<th >##</th>
<th >Program Table</th>
<th >Total Records</th>
<th >Date Created</th>
<th colspan="2">Options</th>
</tr>
<form name="progtablist" method="post" action="Edit_pl_next.php" onSubmit="if(!UpdateAction()){return false;}">
<?php
$counter = 1;
while($row = mysql_fetch_array($result)) {
if($counter%2==0)
$classname="evenRow";
else
$classname="oddRow";

?>
<tr class="<?php if(isset($classname)) echo $classname;?>">



<td><input type="radio" name="prog" value="<?php echo $row["table_name"]; ?>" required class="rbtn" id="prog"></td>
<td><?php echo $counter; ?></td>
<td><?php echo ucfirst($row["table_name"]); ?></td>
<td><?php echo $row["table_rows"]." "."record(s)"; ?></td>
<td><?php echo $row["create_time"]; ?></td>
<!--</tr>
<tr style="background:rgba(0,255,0,0.7); width:100%;">-->
<td><input type="submit" name="next" value="Update" class="btn"/></td><td><input type="submit" name="del" value="Delete" class="btndel" /></td>
</tr>
<?php

$counter++;
}
?>

</form>



</table>







</div>

</body>
</html>