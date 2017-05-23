<?php require_once('../Connections/se.php'); ?>
<?php require_once('connection.php'); ?>

<?php
session_start();
$_SESSION['topic']= $_POST["topic$i"];
$_SESSION['minute']= $_POST["minutes$i"];



//initialize the session
if (!isset($_SESSION)) {
  session_start();
  
  $profilequery=mysql_query("select * from work_details WHERE  Username='".$_SESSION['MM_Username']."'") or die(mysql_error());

while($profile=mysql_fetch_assoc($profilequery)){

		$_SESSION['MM_Img']=$profile['Img'];
		}
  
$_SESSION['MM_Img']; 
 
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	$getusertime= mysql_query("select * from attendance where `Name` ='".$_SESSION['MM_Username']."'") or die(mysql_error());
	while($get=mysql_fetch_assoc($getusertime)){
	$curUsertime=$get['Time_SignedIn'];
	$time1= strtotime($curUsertime);
	$time2 = strtotime(date('H:i:s'));
	$workedouthours= round(abs($time2 - $time1)/3600,1);
	
	$updatequery = mysql_query("UPDATE `attendance` SET `Time_SignedOut`='".date('H:i:s')."',`Hours_worked`='".$workedouthours."',`Signedin`='Yes',`Signedout`='Yes' WHERE `Name` ='".$_SESSION['MM_Username']."' and Date=CURRENT_DATE") or die(mysql_error());
	}
	
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "attendanceExit.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset1 = sprintf("SELECT * FROM work_details WHERE Username = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$colname_Recordset2 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_se, $se);
$query_Recordset2 = sprintf("SELECT Department1 FROM work_details WHERE Username = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $se) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);


?>
<?php
if(isset($_POST['save']))
{		
	$total = $_POST['total'];	
	for($i=1; $i<=$total; $i++)
	{
	$topic = $_POST["topic$i"];
		$minutes = $_POST["minutes$i"];			
		$sql=mysql_query("INSERT INTO `preagenda`(`Topics`, `Host`,  `Date`, `minutes`) VALUES ('".$topic."','".$_SESSION['MM_Username']."','".date('Y-m-d')."','".$minutes."')") or die(mysql_error());
		
		}
	if($sql){
		?>
        <script>
		window.location.href='ProgramLineUp.php';
		</script>
        <?php
		}	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" http-equiv="Cache-control" content="public">
<title>Home</title>
<style>
.h1 h1{
	color:rgb(0,255,255);
}
.h1 span{
	color:rgb(0,255,255);
}
.con-for-day{
	width:100%;
	background:linear-gradient(rgba(0,0,255,0.5),rgba(249,249,249,0.5));
	color:rgb(0,0,0);
	padding-left:5px;
	padding-right:5px;
	padding-bottom:5px;
	padding-top:5px;
	margin-top:-5px;
}
body{
	background-size:cover;
}
.con{
	width:62%;
	height:auto;
	background:rgba(255,255,255,0.5); 
	overflow:scroll;
	border:8px groove rgba(0,102,255,0.5);
	margin-left:-175px;
	}
	button{
		background:rgb(0,0,0);
		color:rgb(204,255,0);
		width:100px;
	padding-bottom:8px;
	padding-top:8px;
	border-radius:5px;}
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
	width: 730px;
	position: relative;
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
	overflow-y:scroll;
	padding-bottom:50px;
}	
a:link {
	text-decoration: none;
	color: rgb(255,255,255);
}
a:visited {
	text-decoration: none;
	color: rgb(0,255,255);
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: rgb(255,255,255);
}
 #menuBody {
            bottom: 0;
            text-align: center;
            width: 100%;
            border-radius: 10px 10px 0 0;
			
        }
        #menuBody li {
            list-style-type: none;
            display: inline-block;
            position: relative;
        }
   #menuBody li img {
          width: 64px;
          height: 64px;
          -webkit-box-reflect: below 2px
                    -webkit-gradient(linear, left top, left bottom, from(transparent),
                    color-stop(0.7, transparent), to(rgba(255,255,255,.5)));
          -webkit-transition: all 0.3s;
          -webkit-transform-origin: 50% 100%;
        }


#menuBody li:hover img { 
          -webkit-transform: scale(2);
          margin: 0 2em;
        }
        #menuBody li:hover + li img,
        #menuBody li.prev img {
          -webkit-transform: scale(1.5);
          margin: 0 1em;
        }

#menuBody li span {
            display: none;
            position: absolute;
            bottom: 140px;
            left: 0;
            width: 100%;
            background-color: rgba(51,51,51,0.8);
            padding: 4px 0;
            border-radius: 12px;
			z-index:99999;
        }
        #menuBody li:hover span {
            display: block;
            color: #fff;
			z-index:99999;
        }
		
#outerbox{
	background:rgba(255,255,255,0.5);
	width:200px;
	overflow:hidden;
	margin-left:-10px;
	margin-right:20px;
	margin-top:-10px;
}
#sliderbox{
	position:relative;
	width:200px;
	animation: slide  15s infinite;
}
#sliderbox img{
	
}
@keyframes slide{
	0%
	{
		left:0px;
	}
	20%
	{
		left:-0px;
	}
	25%
	{
		left:-490px;
	}
	45%
	{
		left:-580px;
	}
	50%{
		left:-660px;
	}
	70%{
		left:-760px;
	}
	75%{
		left:-860px;
	}
	95%{
		left:-940px;
	}
	100%{
		left:-1480px;
	}}
	@media(max-width:100%) and (min-width: 520px){
@viewport{
	width:200px;
}
	}
.img{
	-webkit-animation: anim 10s infinite linear;
	animation: anim 10s infinite linear;
	-moz-animation: anim 10s infinite linear;
	margin-left:100px;
	margin-top:0px;
}
@-moz-keyframes anim{
	from{-moz-transform:rotateY(0deg);}
	to{-moz-transform:rotateY(360deg);}
}
@-webkit-keyframes anim{
	from{-webkit-transform:rotateY(0deg);}
	to{-webkit-transform:rotateY(360deg);}
}
@keyframes anim{
	from{transform:rotateY(0deg);}
	to{transform:rotateY(360deg);}
	}	
</style>
<link rel="stylesheet" href="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/css/main1.css">
<link href="../SoftwareEngineering/jctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="slideshow-master/slideshow.css">		
</style>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<script src="js-script.js" type="text/javascript"></script>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<meta charset="utf-8">
<script type="text/javascript">
function profile(){
	window.open("programs.php?day=<?php echo date('l') ?>","width:1600,height:170,0,status=0,scrollbars=1","title:Personal Details");
	
	}
function msg(){
	window.open("messaging.php","width:1600,height:170,0,status=0,scrollbars=1","title:Inhouse Messaging");
	
	}
function profile(){
	window.open("workersprofile.php","width:1600,height:170,0,status=0,scrollbars=1","title:Profile");
	
	}
	function profilepic(){
		window.open("workersprofile.php?Profile=<?php echo $_SESSION['MM_Username']; ?>&img=<?php echo $_SESSION['MM_Img']; ?>#fullpic","width:1600,height:170,0,status=0,scrollbars=1","title:Profile");
		}	
	function sod(){
		window.open("SOD.php?Worker=<?php echo $_SESSION['MM_Username']; ?>","width:1600,height:170,0,status=0,scrollbars=1","title:Staff On Duty");
		}	
		
</script>	
</head>

<body background="images/img108.jpg" onLoad="cyclenext()">



<h1 align="center"><span style="color:rgb(0,255,204);">HOME</span></h1>

<div style="float:left; margin-left:0px; width:140px; height:140px; border-radius:140px; border-radius: 140px; background: linear-gradient(rgba(0,0,51,1),rgba(0,0,255,1));  border: 5px rgba(0,153,255,1) solid;  color:rgb(255,255,255); padding:3px 3px 3px 3px;  text-align:center; position:absolute; margin-top:10px; font-size:19px;">



<script>
 $(document).ready(function(){
     setInterval(ajaxcall, 1000);
 });
 function ajaxcall(){
     $.ajax({
         url: 'clock.php',
         success: function(data) {
             data = data.split(':');
             $('#hours').html(data[0]);
             $('#minutes').html(data[1]);
             $('#seconds').html(data[2]);
         }
     });
 }
</script>
<div style="margin-top:55px;">
<span id="hours" style="font-size:20px;">0</span>:<span id="minutes" style="font-size:20px;">0</span>:<span id="seconds" style="font-size:20px;">0</span>
<a href="checkpointNav.php#transit"><input type="submit" value="Back" class="back"></a>
<?php
$btnquery=mysql_query("select count(*) as admincount from work_details WHERE Usertype='Admin' and Username='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($btn=mysql_fetch_assoc($btnquery)){
	if($btn['admincount']<1){
		echo'<style>.back{display:none;}</style>';
		
		}
	
	}

?>
</div>
</div>

<div style="float: left; height: 140px; width: 140px; border-radius: 140px; background: linear-gradient(rgba(0,0,51,1),rgba(0,0,255,1));  border: 5px rgba(0,153,255,1) solid; text-align: center; margin-left: 0px; margin-top: 175px;">
<br/>
<div align="center">
<?php
$profilequery=mysql_query("select * from work_details WHERE  Username='".$_SESSION['MM_Username']."'") or die(mysql_error());
?>


<?php
while($profile=mysql_fetch_assoc($profilequery)){
	if(empty($profile['Img'])){
?>
<img src="images/icontexto-user-web20-stumbleupon.ico" height="95" width="95" style="margin-top:0px;">
<?php
	}else{
		$_SESSION['MM_Img']=$profile['Img'];
		?>
<a href="javascript:void(0);" onClick="profilepic()"> <img src="workersprofile/<?php echo $profile['Img']?>" height="95" width="95" style="margin-top:5px; border-radius:100%;">	</a>	
		<?php
		}

}
?>



<a href="javascript:void(0);" onClick="profile()"><p style="margin-top:-30px;"><h4>Profile</h4></p></a>
</div>
</div>







</div>

<div style="float:left; height:140px;  width:140px; border-radius:140px; border-radius: 140px; background: linear-gradient(rgba(0,0,51,1),rgba(0,0,255,1));  border: 5px rgba(0,153,255,1) solid; text-align:center; margin-left:0px; margin-top:334px; margin-left:-150px;  padding:3px 3px 3px 3px; color:rgb(255,255,255);">
<br/>
<div align="center">
<a href="javascript:void(0);" onClick="msg()"><img src="images/Send_256x256.png" height="37" width="37" style="margin-top:0px;"></a>
<p style="margin-top:-30px;"><h4>Personal Chats</h4></p>
<a href="javascript:void(0);" onClick="gen()"><img src="images/icontexto-user-web20-myspace.ico" height="37" width="37" style="margin-top:-15px;"></a>
<p style="margin-top:-30px;"><h4>General Chats</h4></p>
</div>
</div>


<div style="float:left; margin-top:505px; margin-left:-155px; width:140px; height:140px; border-radius:140px;   color:rgb(255,255,255); padding:3px 3px 3px 3px;border-radius: 140px; background: linear-gradient(rgba(0,0,51,1),rgba(0,0,255,1));  border: 5px rgba(0,153,255,1) solid; text-align:center;  font-size:19px;">


<script type="text/javascript">

function logout(){
	
	if(window.confirm('Sure about logging out?')){
		alert('You have successfully logged out 😊');
	return true;
	}else{
		return false;
		}
}
</script>

<br/><br/>
<b>Logout</b><br/>
<div style="margin-top:10px;">
<a href="<?php echo $logoutAction ?>" title="logout"><img src="images/home (2).ico" width="40" height="40" onClick="return(logout());"></a>
</div>
</div>



<div align="center">
<script>
function programs(){
	window.open('programs.php?day=<?php echo date('l') ?>','width:100%,height:100%,0,status=0,scrollbars=1',"title:Events");
	}

</script>
<div id="menuBody">
 <div id="menu">
   <ul>
   <li style="margin-left:-110px;">
   <span>Staff On Duty</span>
   <a href="javascript:void(0);" onClick="sod()"><img src="images/icontexto-user-web20-favorites.ico" height="30" width="30"></a>
   </li>
   <li style="padding-bottom:20px; padding-top:20px; padding-right:70px; padding-left:90px;"><span>All workers</span>
   <a href=""><img src="images/icontexto-user-web20-flickr.ico"  height="30" width="30"></a>
   </li>
   <li style="padding-bottom:20px; padding-top:20px; padding-right:70px; padding-left:70px;">
   <span>Events</span>
   <a href="?&day=<?php echo date('d') ?>&month=<?php echo date('m') ?>&year=<?php echo date('Y') ?>#events"><img src="images/musical_vector-1280x800.jpg" height="30" width="30"></a>
   </li>
   <li style="padding-bottom:20px; padding-top:20px; padding-right:70px; padding-left:70px;">
   <span>Program Lineup</span>
   <a href="javascript:void(0);" onClick="programs()"><img src="images/Presentation_256x256.png" height="30" width="30"></a>
   </li>
   <li style="padding-bottom:20px; padding-top:20px; padding-right:70px; padding-left:70px;">
   <span>On Air</span>
   <a href=""><img src="images/iata-care-este-singurul-radio-din-romania-invitat-.jpg" height="30" width="30"></a>
   </ul>
   </div>
   </div>


<div class="con">

<div style="background:rgb(0,0,51); text-align:center; padding-bottom:5px; padding-top:5px; font-size:24px; color:rgb(0,255,204);">ENTER AGENDA FOR TODAY'S DISCUSSIONS HERE</div>
<div class="con-for-day">
<form method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">

<table>

<tr>
<td><div style="color:rgb(255,255,255);">Enter the number of topics to be discussed today</div></td>
</tr>

<tr>
<td>
<input type="text" name="no_of_rec" placeholder="how many records do you want to enter ? ex : 1 , 2 , 3 , 5" maxlength="2" pattern="[0-9]+" class="form-control" required size="35" />
</td>
</tr>

<tr>
<td><button type="submit" name="btn-form1" >Generate</button> 


</td>
</tr>

</table>

</form>
<?php
if(isset($_POST['btn-form1']))
{
	if($_POST['no_of_rec']=='0'){
		?>
      <div align="center" style="">
        <div style="width:60%; height:auto; padding-bottom:10px; padding-top:10px; padding-left:5px;
        padding-right:5px; border-radius:10px; background:rgba(0,255,255,0.8);">
        <h1>You must enter a positive whole number greater than zero!!!</h1>
        </div>
        </div>
        
       <?php 
		}else{
			if($_POST['no_of_rec']>'10'){
				?>
             <style>
			.con{
				height:500px;}
			 </style>   
             <?php   
				}
	?>
    
    <form method="post" action="">
    <input type="hidden" name="total" value="<?php echo $_POST["no_of_rec"]; ?>" />
	<table cellspacing="5">
    
<tr>
    <th>#</th>
    <th>Topic</th>
     <th >Anticipated number of minutes per topic</th>
     
	<?php
	for($i=1; $i<=$_POST["no_of_rec"]; $i++) 
	{
		?>
       
      
<tr>
<td><?php echo $i; ?></td>

<td style="margin-left:10px;"><input type="text" name="topic<?php echo $i; ?>" size="35" required></td>
<td style="margin-left:10px;"><input type="text" name="minutes<?php echo $i; ?>" size="35" required maxlength="2" pattern="[0-9]+" placeholder="allocate the number of minutes, ex : 1 , 2 , 3 , 5"></td>
        </tr>
        <?php
	}
	?>
    <tr>
    <td colspan="3">
    
    <button type="submit" name="save" >Next</button> 

    
    
    </td>
    </tr>
    </table>
    </form>
	<?php
}
}

?>
</div>
</div>
</div>
<style>
.con-msg{
	display:none;
	margin-left:237px;
	width:63.5%;
}
.btntoggle{
	width:106px;
	padding:5px 5px 5px 5px;
	border-radius:5%;
	background:url(images/168.jpg);
	border:none;
	outline:none;
	cursor:pointer;
	 padding-left:5px; padding-right:9px;
}

.btntoggle1{
	width:106px;
	padding:5px 5px 5px 5px;
	border-radius:5%;
	background:rgb(0,51,51);
	color:rgb(255,255,0);
	border:none;
	outline:none;
	cursor:pointer;
	 padding-left:5px; padding-right:9px;
}

.msg-body{
	width:836px;
	background:url(images/img231.jpg);
	height:550px;
	padding:5px 5px 5px 5px;
	display:none;
	}
.msg-body1{
	width:836px;
	background:url(images/abstract_0046.jpg);
	height:550px;
	padding:5px 5px 5px 5px;
	display:none;
	}	
	
.main-body{
	width:99%;
	height:350px;
	background:linear-gradient(rgba(0,0,51,0.9),rgba(0,0,0,0.9));
	border:3px rgba(153,153,153,1) inset;
	overflow-y:scroll;
}
.main-body1{
	width:99%;
	height:350px;
	background:linear-gradient(rgba(0,102,51,0.9),rgba(0,0,0,0.9));
	border:3px rgba(153,153,153,1) inset;
	overflow-y:scroll;
}
.control{
	width:99%;
	height:185px;
	border:3px rgba(153,153,153,1) inset;
	background:linear-gradient(rgba(255,251,254,1),rgba(0,0,51,1));
}
.control1{
	width:99%;
	height:185px;
	border:3px rgba(153,153,153,1) inset;
	background:linear-gradient(rgba(102,255,102,1),rgba(0,0,51,1));
}
textarea{
	resize:none;
	width:400px;
	margin:10px 10px 10px 10px;
}
.btnSend{
	margin-top:23px;
	margin-right:140px;
	float:right;
	width:140px;
	height:140px;
	border-radius:140px;
	outline:none;
	border:none;
	cursor:pointer;
	background:url(images/Globe1_256x256.png);
	background-size:cover;
	color:rgb(255,255,255);
	font-size:20px;
}
.btnSend1{
	margin-top:23px;
	margin-right:140px;
	float:right;
	width:140px;
	height:140px;
	border-radius:140px;
	outline:none;
	border:none;
	cursor:pointer;
	background:url(images/Globe2_256x256.png);
	background-size:cover;
	color:rgb(255,255,255);
	font-size:20px;
}
.back{
	display:none;
	width:100px;
	margin-top:15px;
	border-radius:50%;
	background:linear-gradient(rgba(0,153,255,1),rgba(0,0,51,1));
	color:rgb(255,255,255);
	border:1px #000000 solid;
	margin-left:20px;
	padding:5px 5px 5px 5px;
	cursor:pointer;
	margin-bottom:-0px;
	}
</style>

<?php
$query_Recordset2 = sprintf("SELECT Department1 FROM work_details WHERE Username = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $se) or die(mysql_error());

while($row_Recordset2 = mysql_fetch_assoc($Recordset2)){
	if($row_Recordset2['Department1']=="Video Production Unit"){
		echo'<style>.con-msg{display:block;}</style>';
		
		}else{
			echo'<style>.con-msg{display:none;}</style>';
			
			}
	
	}
	
$adminquery = mysql_query("select count(*) as admin from work_details where Usertype='Admin' and Username = '".$_SESSION['MM_Username']."'") or die(mysql_error());
while($admin= mysql_fetch_assoc($adminquery)){
		if($admin['admin']==1){
			echo'<style>.con-msg{display:block;}</style>';
			echo'<style>.back{display:block;}</style>';
			echo'<style>.forumcon{display:block;}</style>';
			}	
	
	}	
?>

<script>
function show(){
	document.getElementById('msg-body').style.display="block";
		$.ajax({
			url: "process.php",
			type: "POST",
			processData:false,
			error: function(){}           
		});
	 }
	
function hide(){
	document.getElementById('msg-body').style.display="none";
	}	
	
	function show1(){
	document.getElementById('msg-body1').style.display="block";
	 }
	
function hide1(){
	document.getElementById('msg-body1').style.display="none";
	}
	
</script>

<br/>
<div class="con-msg" id="con-msg">
<div style="background:rgba(204,255,255,1);"><h3 align="center" style="padding-bottom:5px; padding-top:5px;">Messages from the manager 
<span style="color:rgb(0,0,255); margin-left:10px;">
<?php
$getmessagecount= mysql_query("SELECT COUNT(*) as msgcount FROM `mgr_messages` WHERE `Status` = 0 and `Sender`!='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($msgcount= mysql_fetch_assoc($getmessagecount)){
	if($msgcount['msgcount']<0){
		
		echo"(0)Unread Messages";
		}else{
			
			echo "(".$msgcount['msgcount'].")Unread Message(s)";
			
			}
	
	}
?></span>
<span style="margin-left:10px;">
<?php
$getmessagecount= mysql_query("SELECT COUNT(*) as msgcount FROM `mgr_messages`") or die(mysql_error());
while($msgcount= mysql_fetch_assoc($getmessagecount)){
	if($msgcount['msgcount']<0){
		
		echo"(0)Conversations";
		}else{
			
			echo "(".$msgcount['msgcount'].")Conversation(s)";
			
			}
	
	}
?>
</span>
</h3></div>
<div align="center">
<div style="background:url(images/img231.jpg); padding-bottom:10px; padding-top:10px; margin-top:-18px;">
<form action="workerhome.php?rd=max-age=0" method="post" onSubmit="show()">
<input type="submit" value="Read Messages" id="msgshow" class="btntoggle" style="margin-left:-190px; padding-left:5px; padding-right:5px;">
</form>
<form action="workerhome.php" method="post" onSubmit="show()">
<input type="submit" value="Hide Messages" id="msghide" class="btntoggle" style="margin-right:195px;  float:right; margin-top:-25px;  padding-left:5px; padding-right:5px;" onClick="hide()">
</form>
</div>
</div>
<div class="msg-body" id="msg-body">
<div class="main-body" id="main-body">
<?php
$getmessage=mysql_query("SELECT * FROM mgr_messages order by id desc") or die(mysql_error());
while($msg = mysql_fetch_assoc($getmessage)){
	if($msg['Status']=='0'){
		$status = "";
		}else{
			 $status="<a href='workerhome.php?pid={$msg['id']}#info' onClick='getid()'>Info</a>";
			}
			
	echo '<div style="color:white; padding-left:10px; padding-top:14px; font-size:18px;">'.$msg['Message'].'</div>'.'<br/>'.'<div style="background:rgba(0,0,0,0.7); color:rgb(204,255,102); padding-bottom:4px; padding-top:4px; padding-left:4px; font-size:14px;">'.date('l jS F, Y',(strtotime($msg['Date_of_msg']))).'&nbsp;'.'@'.'&nbsp;'.date('H:i A',(strtotime($msg['Time_of_msg']))).'&nbsp;'.'&nbsp;'.'Sent by '.'&nbsp;'.$msg['Sender'].'&nbsp;'.'&nbsp;'.'<span style="color:rgba(0,0,255,1)">'.$status.'</span>'.'</div>'; 
	}
?>
</div>
<div class="control">
<form method="post" action="workerhome.php?rd=<?php echo $_SERVER['HTTP_CACHE_CONTROL']; ?>">
<textarea name="msg" required style="height:160px;"></textarea>
<input type="submit" name="send" value="Reply" class="btnSend" id="send">
</form>
</div>
</div>
</div>



<?php

if(isset($_POST['send']) && !empty($_POST['msg'])){
	
	
	$sql = mysql_query("INSERT INTO `mgr_messages`(`Message`, `Sender`, `Date_of_msg`, `Time_of_msg`) VALUES ('".mysql_real_escape_string($_POST['msg'])."','".$_SESSION['MM_Username']."','".date('Y-m-d')."','".date('h:i:s')."')") or die(mysql_error());
	echo"<meta http-equiv='refresh' content='0'>";
	if($sql){
		?>
<script>
        alert('Message sent successfully!!!');
		//alert('<?php echo mysql_insert_id()."<br/>".$row_Recordset1['DID']; ?>');
        </script>
		<?php
		}
}
if(isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] ===$_GET['rd']){
	
	echo'<script>
	document.getElementById("msg-body").style.display="block";
</script>';
	}


?>
<style>
.th{
	width:500px;
	padding:10px 10px 10px 10px;
}
.td{
	width:100px;
	padding:8px 8px 8px 8px;
}
.table{
	background:rgba(0,255,204,0.7);
}
</style>
<div id="info" class="modalDialog">
<div align="center">
<div style="width:600px; margin-top:120px; margin-left:350px;">
<table cellpadding="5" class="table">
<tr style="background:rgba(204,255,153,0.8);"><th colspan="3" class="th">Message has been seen by</th></tr>

<tr><td colspan="3" style="background:rgba(0,255,255,0.9); padding:8px 8px 8px 8px;" class="td">
<?php
$usersql = mysql_query("select * from mgr_messages where id='".$_GET['pid']."'") or die(mysql_error());
while($user=mysql_fetch_array($usersql)){
	$firstformattedstring = str_replace(",","\n\r",$user['Seen_by']);
	echo '<li>'.$firstformattedstring.'</li>';
	}

?>
</td></tr>


<tr><td colspan="3"style="background:rgba(204,255,153,0.6);" class="td"> <div align="center"><a href="workerhome.php?rd=max-age=0" onClick="return(<?php echo"<meta http-equiv='refresh' content='0'>";?>);" title="Close"><input type="submit" value="Close" style="margin:10px 10px 10px 10px; width:150px; padding:5px 5px 5px 5px; background:linear-gradient(rgba(0,255,255,1),rgba(204,255,102,1)); border-radius:50%; padding-bottom:10px; padding-top:10px; border:1px rgba(0,0,0,1); cursor:pointer;"></a></div></td></tr>
</table>
</div>
</div>

</div>

<style>
.forumcon{
	display:none;
	width:63.5%;
	margin-left:-17px;
	}

</style>
<?php
$adminquery = mysql_query("select count(*) as admin from work_details where Usertype='Admin' and Username = '".$_SESSION['MM_Username']."'") or die(mysql_error());
while($admin= mysql_fetch_assoc($adminquery)){

$forumquery = mysql_query("SELECT COUNT(*) as pro FROM `p_r_o` WHERE `Name`='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($forum = mysql_fetch_assoc($forumquery)){
	if($forum['pro']<1){
		echo'<style>.forumcon{display:none;}</style>';
		?>
        <?php
		}else if($forum['pro']==1 || $forum['pro']>1){
			echo'<style>.forumcon{display:block;}</style>';
			}else if($admin['admin']>0){
			echo'<style>.forumcon{display:block;}</style>';
			}
}
	}
?>
<br/><br/>
<div align="center">
<div class="forumcon">
<div style="background:rgba(0,255,255,1);"><h3 align="center" style="padding-top:7px; padding-bottom:10px;">Messages from the listeners
<?php
$listencountsql = mysql_query("SELECT count(*) as msgcount FROM `admin_to_listener` WHERE `Receipient`='".$_SESSION['MM_Username']."' or `Sender`='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($listencount= mysql_fetch_assoc($listencountsql)){
	
		echo'<span  style="margin-left:20px;">('.$listencount['msgcount'].') Conversation(s)</span>';
		
}
?>
</h3></div>
<div style="background:url(images/abstract_0046.jpg); padding:10px 10px 10px 10px; margin-top:-25px;">
<form action="workerhome.php?rd=1" method="post">
<input type="submit" value="Read Messages" onClick="show1()" style="margin-left:-190px;  padding-left:5px; padding-right:5px;" class="btntoggle1">
</form>
<form action="workerhome.php" method="post">
<input type="submit" value="Hide Messages" onClick="hide1()" style="margin-right:190px; float:right; margin-top:-25px;  padding-left:5px; padding-right:5px;" class="btntoggle1">
</form>
</div>
<div class="msg-body1" id="msg-body1">
<div class="main-body1">

<?php


$listencountsql = mysql_query("SELECT count(*) as msgcount FROM `admin_to_listener` WHERE `Receipient`='".$_SESSION['MM_Username']."' or `Sender`='".$_SESSION['MM_Username']."'") or die(mysql_error());
while($listencount= mysql_fetch_assoc($listencountsql)){
	if($listencount['msgcount']<1){
		echo'<div align="center" style="color:white;"><h1>No messages here yet</h1></div>';
		}
	else{
		$listensql = mysql_query("SELECT distinct * FROM `admin_to_listener` where Sender='".$_SESSION['MM_Username']."'  union SELECT distinct * FROM `admin_to_listener` where Receipient='".$_SESSION['MM_Username']."'   ORDER by `id` desc") or die(mysql_error());
			while($listen= mysql_fetch_array($listensql)){
				?>
                <div style="text-align:justify;">
                <?php
			echo'<div style="padding-left:7px;">';
	echo '<br>'.'<div style="font-weight:bold; color:white;">'.$listen['Sender'].'</div>';
	echo '<br/>'.'<div style=" color:white;">'.$listen['Message'].'</div>'.'<br/>'.'<br/>'.'</div>'.'<div style="background:rgb(255,255,255); padding-top:5px; padding-bottom:5px; margin-bottom:-7px; padding-left:7px;">'.'@'.'&nbsp;'.$listen['timeofmsg'].'&nbsp;'.'on'.'&nbsp;'.date('l jS F, Y',(strtotime($listen['dateofmsg']))).'</div>'.'<hr>'.'<br/>';
    ?>
    </div>
		<?php	
			}
	
	}



	
	
	
	
	
	}
?>
</div>
<div class="control1">

<form method="post" action="workerhome.php?rd=1">

<span style="margin-left:-480px; position:absolute;"><textarea name="msg" required style=" height:140px; margin-top:5px; margin-bottom:20px;"></textarea>
</span>

<span style="color:rgb(255,255,0); margin-left:-470px; position:inherit;">Receipients</span>
<select style="width:405px; margin-left:-73px; margin-top:160px; position:absolute;" name="listmsg" required>
<?php



	$listenersql = mysql_query("SELECT DISTINCT `Sender` FROM `admin_to_listener` WHERE `Sender` != '".$_SESSION['MM_Username']."' and `Receipient` = '".$_SESSION['MM_Username']."'") or die(mysql_error());
	echo'<option value="">'."Receipients".'</option>';
	while($listener= mysql_fetch_assoc($listenersql)){
		echo'<option value="'.$listener['Sender'].'">'.$listener['Sender'].'</option>';
		
		
			}


?>
</select>

<input type="submit" name="sendmsg" value="Reply" class="btnSend1" id="send">
</form>

<?php

if($_GET['rd']==1 ){
	
	echo'<script>
	document.getElementById("msg-body1").style.display="block";
</script>';
}

if(isset($_POST['sendmsg']) && !empty($_POST['msg'])){
	
		
		$query = mysql_query("INSERT INTO `admin_to_listener`(`Sender`, `Receipient`, `Message`, `dateofmsg`, `timeofmsg`) VALUES ('".$_SESSION['MM_Username']."','".mysql_real_escape_string($_POST['listmsg'])."','".mysql_real_escape_string($_POST['msg'])."','".date('Y-m-d')."','".date('h:i a')."')") or die(mysql_error());
		}
	
    if($query){

		?>
        <script>
        
        alert('Message sent successfully');
        </script>
        <?php
		echo"<meta http-equiv='refresh' content='0'>";
		}
?>
</div>
</div>
</div>
</div>

<br/><br/>

<?php
$adminquery = mysql_query("select count(*) as admin from work_details where Usertype='Admin' and Username = '".$_SESSION['MM_Username']."'") or die(mysql_error());
while($admin= mysql_fetch_assoc($adminquery)){

$servicecount = mysql_query("SELECT COUNT(*) as sec FROM `work_details` WHERE `Username` = '".$_SESSION['MM_Username']."' and `Role2`='Secretary'") or die(mysql_error());
while($servicecounter = mysql_fetch_assoc($servicecount)){
	if($servicecounter['sec']<1){
		echo'<style>.services{display:none;}</style>';
		}else if($servicecounter['sec']>1){
			echo'<style>.services{display:block;}</style>';
			}else if($admin['admin']>0){
				echo'<style>.services{display:block;}</style>';
				}
	}
}
?>

<div class="services">
<div style="background:rgb(102,51,255); color:rgb(255,255,255);">
<h3 align="center" style="padding-bottom:8px; padding-top:8px;">Service requests from listeners</h3></div>


<div style="background:url(images/razer_adaro_headphones_stereo_headphones_glare_99445_300x187.jpg); padding:10px 10px 10px 10px; margin-top:-20px; background-size:cover;">
<form action="services.php?servicecode=1" method="post">
<input type="submit" value="Commercials"  style="margin-left:270px;  padding-left:5px; padding-right:5px;" class="servicebtntoggle2">
</form>
<form action="services.php?servicecode=2" method="post">
<input type="submit" value="Event Coverage"  style="margin-right:190px; float:right; margin-top:-25px;  padding-left:5px; padding-right:5px;" class="servicebtntoggle2">
</form>

</div>
</div>
<style>
.services{
	display:block;
	margin-left:237px;
	width:63.5%;
}


.servicebtntoggle2{
	width:106px;
	padding:5px 5px 5px 5px;
	border-radius:5%;
	background:url(images/razer_adaro_headphones_stereo_headphones_glare_99445_300x187.jpg);
	color:rgb(255,255,0);
	border:none;
	outline:none;
	cursor:pointer;
	 padding-left:5px; padding-right:9px;
}

.service-body{
	width:836px;
	background:url(images/img125.jpg);
	height:550px;
	padding:5px 5px 5px 5px;
	display:none;
	}	
	
.servicemain-body{
	width:99%;
	height:350px;
	background:linear-gradient(rgba(204,255,51,0.9),rgba(0,0,0,0.9));
	border:3px rgba(153,153,153,1) inset;
	overflow-y:scroll;
}

</style>




<div id="welcome" class="modalDialog" >
<div align="center">
<br/><br/><br/>
<div style="float:left; margin-left:590px; margin-top:90px; width:165px; height:165px; border-radius:165px; background:url(images/img184.JPG); background-position:190px top; background-size:; color:rgb(255,255,255); padding:3px 3px 3px 3px; border:5px groove rgba(204,204,204,1); text-align:center; position:absolute; margin-top:10px; font-size:19px;">
<br/><br/>
<b>Welcome</b><br/><br/>
<div style="margin-top:10px;">
<?php
echo $row_Recordset1['Username'];

?>

<script type="text/javascript">
var array = new Array();
array.push("Friendship is far more tragic than love. It lasts longer");
array.push("Advice is like castor oil, easy enough to give but dreadful uneasy to take.");
array.push("I can only help 1 person a day. And today's not your day. Tomorrow doesn't look good either");
array.push("No one ever says 'It's only a game', when their team is winning.");
array.push("The next time you feel like complaining, remember: Your garbage disposal probably eats better than thirty percent of the people in this world.");
array.push("Proverbs 29:20	Seest thou a man that is hasty in his words? there is more hope of a fool than of him.");
array.push("Proverbs 29:27	An unjust man is an abomination to the just: and he that is upright in the way is abomination to the wicked.");
array.push("Proverbs 29:25	The fear of man bringeth a snare: but whoso putteth his trust in the LORD shall be safe.");
array.push("Proverbs 10:2	Treasures of wickedness profit nothing: but righteousness delivereth from death.");
array.push("Money can't buy happiness, but it sure makes misery easier to live with. ");
array.push("As I grow older, part of my emotional survival plan must be to actively seek inspiration instead of passively waiting for it to find me.- Bebe Moore Campbell ");
array.push("How we remember, what we remember, and why we remember form the most personal map of our individuality.- Christina Baldwin");
array.push("To sing is to love and affirm, to fly and soar, to coast into the hearts of the people who listen, to tell them that life is to live, that love is there, that nothing is a promise, but that beauty exists, and must be hunted for and found.- Joan Baez");
array.push("Reconciliation is more beautiful than victory.- Violeta Barrios de Chamorro");
array.push("Nothing is so contagious as enthusiasm; it moves stones, it charms brutes. Enthusiasm is the genius of sincerity, and truth accomplishes no victories without it.- Edward Bulwer-Lytton");
array.push("Anger repressed can poison a relationship as surely as the crudest words.- Dr. Joyce Brothers");
array.push("Most great men and women are not perfectly rounded in their personalties, but are instead people whose one driving enthusiasm is so great it makes their faults seem insignificant.- Charles A. Cerami");
array.push("There's no point in burying a hatchet if you're going to put up a marker on the site.- Sydney J. Harris");
array.push("Enthusiasm is the divine particle in our composition: with it we are great, generous, and true; without it, we are little, false, and mean.- L. E. Landon");
array.push("Proverbs 10:4	He becometh poor that dealeth with a slack hand: but the hand of the diligent maketh rich.");	
function cyclenext(){
	var num = Math.round(Math.random()*8);
	add(num);
	return array;
	}
function add(i){
	var child = document.createTextNode(array[i]);
	var tab = document.getElementById("quotes");
	while(tab.hasChildNodes()){
		tab.removeChild(tab.firstChild);
		}
		tab.appendChild(child);
		
	}
	
	
</script>

</div>
<br/>
<br/><br/>
<br/>
<div style="width:300px; border:5px rgba(51,0,255,0.5) solid; height:250px; background:linear-gradient(rgba(102,255,255,1),rgba(255,255,204,1)); border-radius:5%; margin-left:-70px;">
<a href="workerhome.php" title="Close" style="width:50px; height:50px; padding:8px 8px 8px 8px; margin-top:10px; border-radius:150px; text-align:center; background:rgba(0,255,255,1); color:rgb(0,0,255);" class="closed">X</a>
<div style="background:rgb(0,255,255); color:rgb(0,0,0); margin-top:-17px;"><h3 align="center"><i>Quote of the day</i></h3>
</div>
<div style="text-align:center; color:rgb(0,0,0);" >
<table>
<tr><td id="quotes" width="300" align="center"></td></tr>
</table>
</div>
<div>
</div>
</div>
</div>
<style>
.closed:hover{
	background:rgba(0,102,255,1);
	color:rgb(0,0,0);
}
.TabbedPanelsTab:focus{
	background:linear-gradient(rgba(204,204,204,1),rgba(51,51,51,1));
	color:rgb(255,255,0);
	outline:2px rgb(255,255,0) solid ;
}
</style>


</div>
</div>

<div style="float:right; margin-right:14px; margin-top:-380px;">
<div class="container">
<div id="showcase" class="noselect" style="position: relative; overflow-x: hidden; overflow-y: hidden; visibility: visible; "> 

<img src="images/french_musicians_daft_punk-1280x800.jpg" width="100" height="100" class="cloud9-item"><img src="images/iata-care-este-singurul-radio-din-romania-invitat-.jpg" width="100" height="100" class="cloud9-item"><img src="images/mac_apple-1280x800.jpg"  class="cloud9-item" height="100" width="100">

<img src="images/satellite-soyuz-spaceship-space-station-41006.jpg" width="100" height="100" class="cloud9-item">

</div>
</div>
</div>

<div id="events" class="modalDialog" style="background:url(images/musical_vector-1280x800.jpg); background-size:cover;">
<a href="workerhome.php" title="Close" class="close">X</a>
<h1 align="center" style="color:rgb(255,255,255);">EVENTS</h1>
<script>
function prevMonth(month, year){
	if(month == 1){
		//if it is the current one,decrease the year and set month to 12
		--year;
		month=13;
		}
		--month
		var monthstring = ""+month+"";
		var monthlength = monthstring.length;
		
		if(monthlength <= 1){
			
			monthstring = "0" + monthstring;
			
			}
		
		document.location.href = "workerhome.php?month="+monthstring+"&year="+year+"#events";
	}
function nextMonth(month, year){
	if(month == 12){
	++year;
	month = 0;
	}
	
	++month
		var monthstring = ""+month+"";
		var monthlength = monthstring.length;
		
		if(monthlength <= 1){
			
			monthstring = "0" + monthstring;
			
			}
	
	document.location.href = "workerhome.php?month="+monthstring+"&year="+year+"#events";
	}	
</script>
<?php
$day = date("j");
$month = date("n");
$year = date("Y");

//checking if day has a passing variable
if(isset($_GET['day'])){
	//if true get date from url
	$day = $_GET['day'];
	}else{
		//set today as day
		$day = date("j");
		
		}


//checking if month has a passing variable
if(isset($_GET['month'])){
	//if true get date from url
	$month = $_GET['month'];
	}else{
		//set current month as month
		$month = date("n");
		
		}
		
		
//checking if year has a passing variable
if(isset($_GET['year'])){
	//if true get date from url
	$year = $_GET['year'];
	}else{
		//set current year as year
		$year = date("Y");
		
		}	

//calender variables
$currentTimestamp = strtotime("01-$month-$year");

//current month name
$monthname = date('F',$currentTimestamp);

//number of days in the current month
$numberOfDays = date('t',$currentTimestamp);

//variable to initialize loop
$counter = 0;

	
?>
<?php
//$sql=mysql_query("SELECT * FROM `events` WHERE WEEKOFYEAR(`EventDate`) = WEEKOFYEAR(NOW()) + 1") or die(mysql_error());
$sql=mysql_query("SELECT * FROM `events` WHERE WEEKOFYEAR(`EventDate`) = WEEKOFYEAR(NOW()) + 2") or die(mysql_error());
?>
<table align="center" style="width:800px;" border="1">
<tr>
        <td style="width:150px;"><button name="prevBtn" onClick="prevMonth(<?php echo $month.", ".$year ?>)"  style="width:150px; padding-top:10px; padding-bottom:10px; cursor:pointer; background:linear-gradient(rgba(0,0,0,0.5),rgba(153,153,153,0.5));"><img src="images/arrow-left.gif"  height="29" width="29"></button></td>
        
        <td colspan="5" style="text-align:center; padding-top:0px; padding-bottom:0px; width:500px; background:linear-gradient(rgba(153,153,153,1),rgba(0,0,0,1)); color:rgb(255,255,0);"><h3><?php echo $monthname.", ".$year; ?></h3></td>
        
        <td style="width:150px;"><button name="nextBtn"  onClick="nextMonth(<?php echo $month.", ".$year ?>)" style="width:150px; padding-top:10px; padding-bottom:10px; cursor:pointer; background:linear-gradient(rgba(0,0,0,0.5),rgba(153,153,153,0.5));"><img src="images/arrow-right.gif"  height="29" width="29"> </button></td>
        
</tr>

<tr style="background:linear-gradient(rgba(204,204,204,1),rgba(0,153,204,1)); width:100%;" bordercolorlight="#CCFFFF">
 <td style="width:800px; padding-top:10px; padding-bottom:10px; padding-left:3px; padding-right:3px;" colspan=100%><div id="TabbedPanels1" class="TabbedPanels">
   <ul class="TabbedPanelsTabGroup">
     <li class="TabbedPanelsTab" tabindex="0" style="width:382px;padding-top:10px; padding-bottom:10px; background:linear-gradient(rgba(153,153,153,1),rgba(0,0,0,1)); color:rgb(255,255,0); text-align:center;">Categories</li>
     
     <li class="TabbedPanelsTab" tabindex="0"  style="width:382px;padding-top:10px; padding-bottom:10px; background:linear-gradient(rgba(153,153,153,1),rgba(0,0,0,1)); color:rgb(255,255,0); text-align:center;">All Events</li>
   </ul>
   <div class="TabbedPanelsContentGroup">
     <div class="TabbedPanelsContent">
     <table width="800px" style="background:linear-gradient(rgba(255,255,255,1),rgba(0,0,153,0.4));">
     <tr><td colspan=100% style="text-align:center">Today's Events</td></tr>
     <?php
   $date1countsql=mysql_query("SELECT count(*) as eventcount FROM `events`  WHERE `EventDate` = CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."'") or die(mysql_error());
while($date1count=mysql_fetch_assoc($date1countsql)){
	if($date1count['eventcount']<1){
		?>
        <tr><td colspan=100%><h3 align="center">There are no events for this day <br/> <?php 
		if(($_GET['month']==date('m'))&&($_GET['year']==date('Y')))
		{ echo date('l jS F, Y');} ?></h3></td></tr>
		<?php
		}else{
			?>
               <tr><th width="400px" style=" background:rgba(0,0,51,1); color:rgb(255,255,0); text-align:center; padding-bottom:4px; padding-top:4px;">Event</th><th colspan="2" width="400px" style="text-align:center;background:rgba(0,0,51,1); color:rgb(255,255,0); padding-bottom:4px; padding-top:4px;">Details</th></tr>
            <?php
			$date1sql=mysql_query("SELECT * FROM `events`  WHERE `EventDate` = CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."' order by `EventDate` asc") or die(mysql_error());
			while($date1=mysql_fetch_assoc($date1sql)){
				?>
             
                <tr><td style="text-align:justify; padding-bottom:4px; padding-top:4px; padding-left:2px; background:rgba(255,255,255,0.4);"><?php echo $date1['Title'] ?></td><td colspan="2" style="text-align:justify; padding-left:2px; padding-bottom:4px; padding-top:4px;background:rgba(255,255,255,0.4);"><?php echo $date1['Details'] ?></td></tr>
                <?php
			}
			}
	
	}
   ?>
     </table>
     </div>
     
     
     <div class="TabbedPanelsContent">
       <table width="800px" style="background:linear-gradient(rgba(255,255,255,1),rgba(0,0,153,0.4));">
       <?php
	   if(date('m')==$_GET['month'] && date('Y')==$_GET['year'] ){
	   ?>
     <tr><td colspan=100% style="text-align:justify; background:rgba(0,0,51,1); color:rgb(255,255,0); font-weight:bold; font-size:22; padding-bottom:10px; padding-top:10px; padding-left:5px;">Past Events</td></tr>
    
        <?php
   $date1countsql=mysql_query("SELECT count(*) as eventcount FROM `events` WHERE `EventDate` < CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."'") or die(mysql_error());
while($date1count=mysql_fetch_assoc($date1countsql)){
	if($date1count['eventcount']<1){
		?>
        <tr><td colspan=100%><h3 align="center">There are no past events for this month <br/> <?php 
		if(($_GET['month']==date('m'))&&($_GET['year']==date('Y')))
		{ echo date('l jS F, Y');} ?></h3></td></tr>
		<?php
		}else{
			?>
               <tr style="padding-top:10px;"><th width="200px" style="text-align:justify">Date</th><th width="200px" style="text-align:justify">Event</th><th colspan="2" width="400px" style="text-align:justify">Details</th></tr>
            <?php
			$date1sql=mysql_query("SELECT * FROM `events`  WHERE `EventDate` < CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."' order by `EventDate` asc") or die(mysql_error());
			while($date1=mysql_fetch_assoc($date1sql)){
				?>
              
                
                <tr>
                <td style="text-align:justify" width="200px"><?php echo date('l jS F, Y',(strtotime($date1['EventDate']))) ?></td>
                <td style="text-align:justify" width="200px"><?php echo $date1['Title'] ?></td>
                <td style="text-align:justify;" width="400px"><?php echo $date1['Details'] ?></td></tr>
                <?php
			}
			}
	
	}
   ?>
    
    <tr><td colspan=100%><br/></td></tr>
     <tr><td colspan=100% style="text-align:justify; background:rgba(0,0,51,1); color:rgb(255,255,0); font-weight:bold; font-size:22; padding-bottom:10px; padding-top:10px; padding-left:5px;">Today's Events</td></tr>
      <?php
   $date1countsql=mysql_query("SELECT count(*) as eventcount FROM `events` WHERE `EventDate` = CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."'") or die(mysql_error());
while($date1count=mysql_fetch_assoc($date1countsql)){
	if($date1count['eventcount']<1){
		?>
        <tr><td colspan=100%><h3 align="center">There are no events for this day <br/> <?php 
		if(($_GET['month']==date('m'))&&($_GET['year']==date('Y')))
		{ echo date('l jS F, Y');} ?></h3></td></tr>
		<?php
		}else{
			?>
               <tr style="padding-top:10px;"><th width="200px" style="text-align:justify">Date</th><th width="200px" style="text-align:justify">Event</th><th colspan="2" width="400px" style="text-align:justify">Details</th></tr>
            <?php
			$date1sql=mysql_query("SELECT * FROM `events`  WHERE `EventDate` = CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."' order by `EventDate` asc") or die(mysql_error());
			while($date1=mysql_fetch_assoc($date1sql)){
				?>
                
               
                
                <tr>
                <td style="text-align:justify" width="200px"><?php echo date('l jS F, Y',(strtotime($date1['EventDate']))) ?></td>
                <td style="text-align:justify" width="200px"><?php echo $date1['Title'] ?></td>
                <td style="text-align:justify;" width="400px"><?php echo $date1['Details'] ?></td></tr>
                <?php
			}
			}
	
	}
   ?>
    <tr><td colspan=100%><br/></td></tr>
     <tr style="text-align:justify; background:rgba(0,0,51,1); color:rgb(255,255,0);"><td colspan=100% style="font-weight:bold; font-size:22; padding-bottom:10px; padding-top:10px; padding-left:5px;">Upcoming Events</td></tr>
      <?php
   $date1countsql=mysql_query("SELECT count(*) as eventcount FROM `events` WHERE `EventDate` > CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."'") or die(mysql_error());
while($date1count=mysql_fetch_assoc($date1countsql)){
	if($date1count['eventcount']<1){
		?>
        <tr><td colspan=100%><h3 align="center">There are no future events for this month <br/> <?php 
		if(($_GET['month']==date('m'))&&($_GET['year']==date('Y')))
		{ echo date('l jS F, Y');} ?></h3></td></tr>
		<?php
		}else{
			?>
               <tr style="padding-top:10px;"><th width="300px" style="text-align:justify">Date</th><th width="200px" style="text-align:justify">Event</th><th colspan="2" width="300px" style="text-align:justify">Details</th></tr>
            <?php
			$date1sql=mysql_query("SELECT * FROM `events`  WHERE `EventDate` > CURRENT_DATE AND MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."' order by `EventDate` asc") or die(mysql_error());
			while($date1=mysql_fetch_assoc($date1sql)){
				?>
             
                
                <tr>
                <td style="text-align:justify" width="300px"><?php echo date('l jS F, Y',(strtotime($date1['EventDate']))) ?></td>
                <td style="text-align:justify" width="200px"><?php echo $date1['Title'] ?></td>
                <td style="text-align:justify;" width="300px"><?php echo $date1['Details'] ?></td></tr>
                <?php
			}
			}
	
	}
   ?>
     <tr><td colspan=100%><br/></td></tr>
     <?php
	   }else{
	 ?>
     <tr><th colspan=100% style="text-align:center;  background:rgba(0,0,51,1); color:rgb(255,255,0); font-weight:bold; font-size:22; padding-bottom:10px; padding-top:10px; padding-left:5px;">All Events</th></tr>
     <tr><td colspan=100%><br/></td></tr>
      <?php
   $date1countsql=mysql_query("SELECT count(*) as eventcount FROM `events`  WHERE MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."'") or die(mysql_error());
while($date1count=mysql_fetch_assoc($date1countsql)){
	if($date1count['eventcount']<1){
		?>
        <tr><td colspan=100%><h3 align="center">There are no events for this month <br/> <?php 
		if(($_GET['month']==date('m'))&&($_GET['year']==date('Y')))
		{ echo date('l jS F, Y');} ?></h3></td></tr>
		<?php
		}else{
			?>
               <tr><th width="300px" style="text-align:justify">Date</th><th width="200px" style="text-align:justify">Event</th><th colspan="2" width="300px" style="text-align:justify">Details</th></tr>
            <?php
			$date1sql=mysql_query("SELECT * FROM `events`  WHERE  MONTH(`EventDate`) = '".$_GET['month']."' AND YEAR(`EventDate`)= '".$_GET['year']."' order by `EventDate` asc") or die(mysql_error());
			while($date1=mysql_fetch_assoc($date1sql)){
				?>
             
                
                <tr>
                <td style="text-align:justify" width="300px"><?php echo date('l jS F, Y',(strtotime($date1['EventDate']))) ?></td>
                <td style="text-align:justify" width="200px"><?php echo $date1['Title'] ?></td>
                <td style="text-align:justify;" width="300px"><?php echo $date1['Details'] ?></td></tr>
                <?php
			}
			}
	
	}
   ?>
     <tr></tr>
     <?php
	   }
	 ?>
     </table>
     
     </div>
   </div>
 </div></td>
        
       
</tr>        
</table>

</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>

 <script src="slideshow-master/slideshow.js"></script>
<script src="jquery-2.2.3.min.js"></script> 
<script src="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/jquery.reflection.js"></script> 
<script src="3D-Cover-Flow-Style-Image-Carousel-Plugin-with-jQuery-Cloud-9-Carousel/jquery.cloud9carousel.js"></script> 
<script>
    $(function() {
      var showcase = $("#showcase")

      showcase.Cloud9Carousel( {
        yPos: 42,
        yRadius: 48,
        mirrorOptions: {
          gap: 12,
          height: 0.2
        },
        buttonLeft: $(".nav > .left"),
        buttonRight: $(".nav > .right"),
        autoPlay: true,
        bringToFront: true,
        onRendered: showcaseUpdated,
        onLoaded: function() {
          showcase.css( 'visibility', 'visible' )
          showcase.css( 'display', 'none' )
          showcase.fadeIn( 1500 )
        }
      } )

      function showcaseUpdated( showcase ) {
        var title = $('#item-title').html(
          $(showcase.nearestItem()).attr( 'alt' )
        )

        var c = Math.cos((showcase.floatIndex() % 1) * 2 * Math.PI)
        title.css('opacity', 0.5 + (0.5 * c))
      }

      // Simulate physical button click effect
      $('.nav > button').click( function( e ) {
        var b = $(e.target).addClass( 'down' )
        setTimeout( function() { b.removeClass( 'down' ) }, 80 )
      } )

      $(document).keydown( function( e ) {
        //
        // More codes: http://www.javascripter.net/faq/keycodes.htm
        //
        switch( e.keyCode ) {
          /* left arrow */
          case 37:
            $('.nav > .left').click()
            break

          /* right arrow */
          case 39:
            $('.nav > .right').click()
        }
      } )
    })
  </script> 
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
