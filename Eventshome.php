<?php require_once('connection.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Events Home</title>
<style>
th{
	text-align:center;
}
td{
	text-align:center;
}
table{
	float:left;
	position:absolute;
}
input{
	background:linear-gradient(rgba(204,255,51,1),rgba(102,204,51,1));
	border:1px #00FFFF;
	cursor:pointer;
	padding:2px 2px 2px 2px;
	padding-bottom:3px;
	padding-left:3px;
	padding-right:3px;
	padding-top:3px;
}
input:focus{
	outline:none;
}
input:hover{
	background:rgb(0,0,0);
	color:rgb(255,255,0);
}
.dv:hover{
	background:rgba(0,0,0,0.5);
}
body{
	background-size:cover;
}
p {
  margin-top: 0;
}

.modal-container {
  position: fixed;
  background-color: #fff;
  width: 70%;
  max-width: 400px;
  left: 50%;
  padding: 20px;
  border-radius: 5px;

  -webkit-transform: translate(-50%, -200%);
  -ms-transform: translate(-50%, -200%);
  transform: translate(-50%, -200%);

  -webkit-transition: -webkit-transform 200ms ease-out;
  transition: transform 200ms ease-out;
  z-index:9999;
}

.modal:before {
  content: "";
  position: fixed;
  display: none;
  background-color: rgba(0,0,0,.8);
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.modal:target{
  display: block;
}

.modal:target .modal-container {
  top: 20%;

  -webkit-transform: translate(-50%, 0%);
  -ms-transform: translate(-50%, 0%);
  transform: translate(-50%, 0%);
}

#modal-close {}
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
	width: 400px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	
}
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

<body background="images/img130.jpg">
<h1 style="color:rgb(255,255,255); margin-left:200px;">Events Home <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;"></a></h1>
<br/><br/><br/><br/>
<div style="width:400px; padding:10px 10px 10px 10px; margin-left:80px; border-radius:400px; border:1px #0000 groove; height:400px; box-shadow:rgba(0,0,204,0.5) 0.5px 0.5px 2px 7px; background-image:url(images/pexels-photo-270288.jpg);" class="dv">


<div style="background:linear-gradient(rgba(255,255,255,0.4),rgba(102,204,51,0.4));  width:420px; border-radius:420px; height:420px; margin-top:-10px; margin-left:-10px;">
<a href="#today"><input type="submit" style="height:109px; width:109px; padding:4px 4px 4px 4px; border-radius:109px; margin-left:150px; margin-top:20px;" value="Today's Events"></a><br/>
<a href="#all"><input type="submit" style="height:109px; width:109px; padding:4px 4px 4px 4px; border-radius:109px; margin-top:30px; margin-left:20px;" value="All Events"></a>
<a href="#upcoming"><input type="submit" style="height:109px; width:109px; padding:4px 4px 4px 4px; border-radius:109px;  margin-left:150px;" value="Upcoming Events"></a>
<a href="#past"><input type="submit" style="height:109px; width:109px; padding:4px 4px 4px 4px; border-radius:109px; margin-left:150px; margin-top:20px;" value="Past Events"></a>
</div>
</div>










<!--<div style="width:650px; height:200px; background:rgba(255,255,255,0.5);">



<table style="width:700px; height:auto;">
<tr><th height="11" colspan="3">Today's Events</th></tr>
<tr><th height="6">Date</th><th height="6">Title</th><th height="6">Details</th></tr>

<?php


$select ="SELECT *, DATE_FORMAT(EventDate, '%d %m %Y')".date()." as datee FROM `events` WHERE `EventDate` = CURRENT_DATE - INTERVAL 5 DAY ";
$run = mysql_query($select) or die(mysql_error());
while($fetch = mysql_fetch_array($run)){
	date_default_timezone_set('UTC');
	
		
		
	 
?>
<tr>
<td height="24"><?php echo $fetch['datee']; ?></td>
<td height="24"><?php echo $fetch['Title']; ?></td>
<td height="24"><?php echo $fetch['Details'];  ?></td>

</tr>
<?php	
	
	
	
	}
?>

</table>
</div>-->




<iframe src="calender.php"  style="height:700px; float:right; position:absolute; top:0; right:0; width:50%;"></iframe>

 <div id="today" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Events For Today</h2>
	
		<a href="#close" title="Close" class="close">X</a>
	
</div>

 <div id="all" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">All Events</h2>
	
		<a href="#close" title="Close" class="close">X</a>
        <div align="center" style="color:rgb(255,255,255)">
        <style>
		table{
			width:680px;
			border-spacing:1px 1px;
			margin-left:-80px;
			
			}
			td{
				background:linear-gradient(rgba(204,204,204,1),rgba(0,0,255,1));
				padding-top:9px;
			padding-bottom:9px;
			}
			th{
				border-top-left-radius:8px;
				border-top-right-radius:8px;
				background:linear-gradient(rgba(0,0,255,1),rgb(0,255,255));
				padding-bottom:10px;
				padding-top:10px;
			}
		</style>
	<?php
	$sql ="SELECT * FROM `events`";
	$exec = mysql_query($sql);
	echo'<table>';
	echo'<tr class="th">'.'<th>'.'Title'.'</th>'.'<th>'.'Details'.'</th>'.'<th>'.'Day of Event'.'</th>'.'</tr>';
	while($array=mysql_fetch_assoc($exec)){
	echo'<tr>'.'<td>'.$array['Title'].'</td>'.'<td>'.$array['Details'].'</td>'.'<td>'.date('l j-M-Y',(strtotime($array['EventDate']))).'</td>'.'</tr>';	
		
		
		}
	echo'</table>';	
	?>
    </div>
</div>

 <div id="past" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Past Events</h2>
	
		<a href="#close" title="Close" class="close">X</a>
	
</div>

 <div id="upcoming" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Upcoming Events</h2>
	
		<a href="#close" title="Close" class="close">X</a>
	
</div>

</body>
</html>