<?php require_once('connection.php'); ?>

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO test (`User`, name) VALUES (%s, %s)",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['datee'], "text"));

  mysql_select_db($database_enac, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());
}

if(!$Result1){
		echo"error inserting into database";
		}
function NOW(){
	echo date('d-m-Y');
	
	}
if(isset($_POST['submit'])){
	$name = $_POST['user'];
	$dater = $_POST['datee'];
	$host =  "localhost";
	$user = "root";
	$pass = "christabel02";
	$db  = "enactus_vvu";
	$date = date('d-m-y');
	$conn = mysql_connect($host,$user,$pass);
	if($conn){
		$select = mysql_select_db($db,$conn);
		if($select){
	$sql="INSERT INTO `test`(`User`,`name`) VALUES('".$name."','".date('y-m-d')." @ ".date('H:i:s A')."')";
	$run = mysql_query($sql,$connect);
	if(!$run){
		echo"error inserting into database";
		}else{
			 include('Agenda.php');
			}
		}else{
			echo"database not found";
			
			}
	}else{
		echo"error connecting to database";
		}
	}
if(isset($_POST['sub'])){
	$st = $_POST['st'];
	$ft = $_POST['ft'];
	$prog = $_POST['prog'];
	$host = $_POST['host'];
	$lt = $_POST['lt'];
	if($lt == "Sunday"){
	$sql="INSERT INTO `sunday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Monday"){
	$sql="INSERT INTO `monday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Tuesday"){
	$sql="INSERT INTO `tuesday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Wednesday"){
	$sql="INSERT INTO `wednesday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Thursday"){
	$sql="INSERT INTO `thursday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Friday"){
	$sql="INSERT INTO `friday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}
	if($lt == "Saturday"){
	$sql="INSERT INTO `saturday`(`Start_time`, `Finish_time`, `Program`, `Host`) VALUES ('".$st."','".$ft."','".$prog."','".$host."')";
	$runSql = mysql_query($sql,$connect);
	if($runSql){
		echo"successfully submitted!!!";
		}else{
			die (mysql_error());
			echo'<h1 align="center">Fatal error!!!</h1>';
			return false;
						
			}
	}						
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
.con{
	width:300px;
	height:300px;
	background:rgba(255,255,255,0.5);}
body{
	background:rgb(0,0,0);
	color:rgb(255,255,255);
	}
</style>
</head>

<body>
<noscript>
<h1 align="center">Please enable javascript to continue</h1>
<style>
.con{display:none;
}
</style>
</noscript>
<div class="con">
<form action="<?php echo $editFormAction; ?>" name="form" method="POST">
<input type="text" name="user">
<input type="text" name="datee" value="<?php echo date('l j-M-Y'); ?>">
<input type="submit" name="submit" value="signin">
<input type="hidden" name="MM_insert" value="form">
</form>
<br/><br/><br/>
<form action="" method="post">
<label>Table</label><select name="lt">
<option value="">Select Program-line up table</option>
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
</select>
<br/><br/>

<table>
<tr><th><label>Time commenced</label></th><th><label>Time ended</label></th><th><label>Program</label></th><th><label>Host</label></th></tr>
<tr><td><input type="time" name="st"></td><td><input type="time" name="ft"></td><td><input type="text" name="prog"></td><td><input type="text" name="host"></td></tr>
<tr><td></td><td></td><td><input type="submit" name="sub" value="Submit"></td><td></td></tr>

</table>





<br/><br/>

<br/><br/>

<br/><br/>

</form>
</div>


<br/><br/>
<?php
$table = array();
$query1 = mysql_query("show TABLES from management_system_software_engineering LIKE '%day%'");
$query = mysql_query("SELECT table_name  
FROM information_schema.tables 
WHERE table_schema='management_system_software_engineering' AND
    create_time BETWEEN '	
2017-02-23 13:15:10' AND '2017-02-23 13:36:24' order by create_time");
echo'<table>';
echo'<tr>'.'<td>'."Tables".'</td>'.'</tr>';
while($row = mysql_fetch_array($query)) {
	echo'<tr>'.'<td>'.$row['table_name'].'</td>'.'</tr>';
  /*$table[] = $row[0];
}
//Now sort the array using asort (alphabetical) or arsort (reverse alphabetical):

asort($table);
//Now you can list the tables in alphabetical order by simply looping through the array:

foreach($table as $table_list) {
  echo "<li>$table_list</li>";*/
}
echo'</table>';


?>
<br/><br/>
<script>
var b = document.documentElement;

b.setAttribute('data-useragent', navigator.userAgent);

b.setAttribute('data-platform', navigator.platform);

jQuery(function ($) {

    var supportsAudio = !!document.createElement('audio').canPlayType;

    if (supportsAudio) {

        var index = 0;
	}}
	);
</script>
<style>
@import url("//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400");

.container { position:relative; margin:0 auto; width:700px; }

.column { width:inherit; }

​

@media only screen and (min-width: 768px) and (max-width: 959px) {

.container { width:556px; }

}

​


</style>



<div class="container">

    <div class="column center">

        <h1>HTML5 Audio Player</h1>

        <h6>w/ responsive playlist</h6>

    </div>

    <div class="column add-bottom">

        <div id="mainwrap">

            <div id="nowPlay">

                <span class="left" id="npAction">Paused...</span>

                <span class="right" id="npTitle"></span>

            </div>

            <div id="audiowrap">

                <div id="audio0">

                    <audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio>

                </div>

                <div id="tracks">

                    <a id="btnPrev">&laquo;</a>
                    <a id="btnNext">&raquo;</a>

                </div>
            </div>

            <div id="plwrap">

                <ul id="plList"></ul>
                </div>
                </div>
                </div>
                </div>
                
</body>
</html>