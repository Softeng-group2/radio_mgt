<?php
error_reporting(0);
$host="127.0.0.1";
$user="root";
$password="christabel02";
$db="management_system_software_engineering";
$connect = mysql_connect($host,$user,$password);
if($connect){
	$db_select = mysql_select_db($db,$connect);
	if($db_select){
		//echo"<br/>".$db;
		}else{
			
			echo"<br/>"."unknown database";
			}
	}else{
		echo "error connecting to database!!!";
		
		}


?>