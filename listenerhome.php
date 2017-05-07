<?php require_once('../Connections/se.php'); ?>
<?php
$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = 'christabel02';
	$DB_NAME = 'management_system_software_engineering';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

if(isset($_POST['btnsave']))
	{
		$username = $_POST['user_name'];// user name
		$userjob = $_POST['user_job'];// user email
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		
		
		if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'profilepic/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE `listener_details` 
									     SET Img=:upic 
								       WHERE Username=:uname');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':upic',$userpic);
			
			if($stmt->execute())
			{
				?>
                <script>
                alert('Photo successfully updated');
                </script>
                <?php
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>

<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
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
$query_Recordset1 = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $se) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<style>
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
.btn{
				padding-bottom:10px;
				padding-top:10px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:100px;
				cursor:pointer;
				background:linear-gradient(rgba(0,255,255,1),rgba(140,128,253,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
				margin-bottom:1px;
				
			}
			
.btnh{
				padding-bottom:3px;
				padding-top:3px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:80px;
				cursor:pointer;
				background:linear-gradient(rgba(0,255,255,1),rgba(140,128,253,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
				margin-bottom:1px;
				
			}			
.btnh:hover{
	background:linear-gradient(rgba(0,255,51,1),rgba(204,255,51,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
				cursor:pointer;
	}			
.btnup{
				padding-bottom:5px;
				padding-top:5px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:200px;
				cursor:pointer;
				background:linear-gradient(rgba(0,0,51,1),rgba(140,128,253,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
				margin-bottom:5px;
				
			}			
			
			.btn:hover{
				padding-bottom:10px;
				padding-top:10px;
				padding-left:5px;
				padding-right:5px;
				border-radius:5px;
				width:100px;
				cursor:pointer;
				background:linear-gradient(rgba(0,255,51,1),rgba(204,255,51,1));
				outline:none;
				border:none;
				box-shadow:0.5px 0.5px 2px 5px rgba(0,0,0,0.5);
				margin-bottom:5px;
			}
			li{
				list-style:none;
				display:inline-block;
			}
			.ul2{
				width:60px;
				padding-top:20px;
				padding-bottom:10px;
				background:linear-gradient(rgb(0,0,255),rgb(102,0,204));
				border-top-left-radius:20px;
				border-top-right-radius:20px;
				padding-right:80px;
				margin-bottom:-3px;
				margin-right:30px;
				float:right;
				margin-top:-64px;
				background-position:center;
			}
			
			.ul{
				width:660px;
				padding-top:20px;
				padding-bottom:10px;
				background:linear-gradient(rgb(0,0,255),rgb(102,0,204));
				border-top-left-radius:20px;
				border-top-right-radius:20px;
				padding-right:80px;
				margin-bottom:-3px;
			}
			
			.ul1{
				width:60px;
				padding-top:20px;
				padding-bottom:10px;
				background:linear-gradient(rgb(0,0,255),rgb(102,0,204));
				border-top-left-radius:20px;
				border-top-right-radius:20px;
				padding-right:80px;
				margin-bottom:-3px;
				float:left;
				margin-top:1px;
				margin-left:30px;
				background-position:center;
			}
			.ul1 btn:hover{
				margin-bottom:5px;
				padding-bottom:5px;
			}
			
			h1{
				color:rgb(255,255,255);
			}
t2{
	float:left;
	width:300px;
	color:rgb(255,255,255);
}
table{
	border-spacing:10px 20px;
	
	
}
t1{
	float:right;
	margin-right:80px;
	margin-top:-100px;
	
}

.img{
	border-radius:6px;
	box-shadow:0.5px 0.5px 2px 3px rgba(255,255,255,0.5);
}
	tr{
		color:rgb(255,255,255);
	}
	
.con1{
	background:linear-gradient(rgba(204,255,153,0.5),rgba(102,102,102,0.5));
	width:300px;
	height:500px;
	padding-bottom:5px;
	padding-top:10px;
	padding-left:0px;
	padding-right:0px;
	border-top-left-radius:20px;
	border-top-right-radius:20px;
	border:5px rgba(243,243,243,0.5) solid;
	float:right;
	margin-right:80px;
	
	
	}	
.con2{
	background:linear-gradient(rgba(0,204,255,1),rgba(0,0,255,1));
	width:780px;
	height:500px;
	padding-bottom:5px;
	padding-top:10px;
	padding-left:0px;
	padding-right:0px;
	border-top-left-radius:35px;
	border-top-right-radius:35px;
	border:5px rgba(243,243,243,0.5) solid;
	margin-left:50px;
	}
	
.btn1{
	width:80px;
	background:linear-gradient(rgba(153,153,153,1),rgba(204,255,204,1));
	outline:none;
	padding-top:5px;
	padding-bottom:5px;
	cursor:pointer;
}
.btn1:hover{
	background:rgb(0,0,0);
	color:rgb(255,255,0);
}
.btn2{
	width:120px;
	background:linear-gradient(rgba(255,255,51,0.9),rgba(0,255,255,0.9));
	outline:none;
	padding-top:10px;
	padding-bottom:10px;
	padding-left:10px;
	padding-right:10px;
	border-radius:10px;
	
	cursor:pointer;
	margin-top:30px;
	margin-left:0px;
	color:rgb(255,255,0);
	}
.btn2:hover{
	background:linear-gradient(rgba(102,0,102,1),rgba(204,255,153,1));
	color:rgb(255,255,255);
	}	
#form{
	display:none;

}
.btn2{
	width:150px;
	padding-bottom:10px;
	padding-top:10px;
	padding-left:5px;
	padding-right:5px;
	border-radius:10px;
	background:linear-gradient(rgba(204,102,0,1),rgb(102,102,255));
	border:1px #000000;
	margin-bottom:40px;
	cursor:pointer;
}
.btn2:hover{
	background:linear-gradient(rgba(0,255,255,1),rgba(0,255,0,1));
	color:rgb(0,0,0);
	}
h2 .n1{
	color:rgb(0,255,255);
}
h2 .n2{
	color:rgb(255,255,0);
}
</style>
</head>

<body background="images/img121.jpg" onLoad="scrollcontent()">

<script type="text/javascript">
function loadlistenermsg(){
	window.open("listenerinboxmsg.php","width:1300,height:170,0,status=0,scrollbars=1","title:Personal Details");
	
	}
</script>


<h1 align="center">Home</h1>
<div align="center">
<ul class="ul1"><li><a href="#news">
<input type="submit" value="My News" style="margin-left:0px;" class="btn"></a></li></ul>

<ul class="ul">
<li><a href="#submenu"><input type="submit" value="Forum" style="margin-left:60px;" class="btn"></a></li>
<li><a href="#advert"><input type="submit" value="Other Services" style="margin-left:60px;" class="btn"></a></li>
<li><a href="#profile"><input type="submit" value="Profile" style="margin-left:60px;" class="btn"></a></li>
<li><a href="listenerinboxmsg.php"><input type="submit" value="Chat" style="margin-left:60px;" class="btn"></a></li>
</ul>

<ul style="margin-left:50px;" class="ul2">
<li>
 <a href="<?php echo $logoutAction ?>"><input type="image" src="images/exit.ico" width="30" height="30" style="margin-left:40px;" onClick="return(confirm('Are you sure about logging out?'));"></a></li>
</ul>
</div>


 <div id="advert" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Options</h2>
		<a href="#close" title="Close" class="close">X</a>

 <div align="center">
 <div style="background:rgba(204,255,153,0.5); width:300px; height:300px; border-radius:300px; border:5px rgba(255,255,255,0.5) solid; margin-left:500px; margin-top:150px; cursor:pointer;">
 <br/><br/><br/><br/><br/>
        <a href="#service"><input type="button" value="Request for a service" class="btn2" style="margin-top:-0px;"></a>
        <br/>
        <form action="services.php?customer=<?php echo $_SESSION['MM_Username']; ?>" method="post">
        <input type="submit" value="View Requests" class="btn2" style="margin-top:5px;">
        </form>
        </div>

</div>
</div>


<!--- Menu for forum options -->
 <div id="submenu" class="modalDialog">
 
		<a href="#close" title="Close" class="close">X</a>

 <div align="center">
 <br>
<div style="width:300px; height:300px; border-radius:300px; box-shadow:0.5px 0.5px 2px 3px rgba(255,255,255,0.7); background:url(images/pexels-photo.jpg); margin-left:480px; margin-top:180px;">
<br/><br/>
 <h2 style="color:rgb(255,255,255); margin-top:30px;" align="center">Options</h2>
        <a href="#inbox"><input type="button" value="Private Questions" class="btn2" style="margin-top:-17px;"></a>
        <br/>
        <a href="#forum"><input type="button" value="General Forum" class="btn2" style="margin-top:5px;"></a>
        </div>
        </div>

</div>





<iframe src="stream.php" style="float:left; top:130; left:0; width:50%; height:100%; position:absolute;"></iframe>
<iframe src="listenermsg.php" style="float:right; top:130; right:0; height:100%; width:50%; position:absolute;"></iframe>
<div id="forum" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Forum</h2>
	
		<a href="listenerhome.php?#submenu" title="Close" class="close">X</a>
        
        
        
        <div style="width:840px; height:580px; background:url(images/168.jpg); border:5px groove rgb(204,204,204); margin-left:190px;">
        
        
        
        <div style="height:38px; background:rgba(0%,0%,20%,1); width:105%; padding-left:5px; padding-top:5px; padding-bottom:15px; margin-left:-23px; margin-top:-7px; border-top-left-radius:7px; border-top-right-radius:7px;">
        
        <h2 align="justify" style="color:rgb(0,255,255);"> 
		
		
		<?php
		
		$result = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
       <?php
	   if(empty($row['Img'])){
		   echo'<div class="n1">'."Now active: ".'</div>'."&nbsp;". '<div class="n2">'.$row['Username'].'</div>'."&nbsp;";
		   
	   ?>
        <img src="profilepic/noavatar92.png"  width="40px" height="40px" class="img" style="float:right;margin-right:20px; border-radius:40px; margin-top:-15px;" />
        <?php
	   }else{
		    echo"Now active: "."&nbsp;". $row['Username']."&nbsp;";
		   ?>
		   <a href="listenerhome.php?Profile=<?php echo $row['Username']; ?>#fullpic"> <img src="profilepic/<?php echo $row['Img']; ?>"  width="40px" height="40px" class="img"  style="float:right; margin-right:20px; border-radius:40px; margin-top:-15px;"/> </a>
		   <?php
	   }
		}
		 ?> </h2></div>
         <script type="text/javascript" src="jquery-2.2.3.min.js">
         function scrollcontent(){
			 var div = document.getElementById("msg");
			 div.scrollTop = div.scrollHeight;
			 }
         </script>
        <div style="height:370px; background:rgba(255,255,255,0.7); padding-top:10px; padding-left:5px; width:104%; margin-left:-20px; overflow-y:scroll;" id="msg">
        <?php
		if(isset($_POST['btnforum'])&& !empty($_POST['generalforum'])){
			$forumsql = mysql_query("INSERT INTO `general_forum`(`Username`, `Message`, `Messagetime`, `Messagedate`) VALUES ('".$_SESSION['MM_Username']."','".mysql_real_escape_string($_POST['generalforum'])."','".date('H:i:s A')."','".date('Y-m-d')."')") or '"'.'<script>'.'alert'.(die(mysql_error())).'</script>'.'"';
			
			}
			
		$getforumsql= mysql_query("select * from general_forum order by id asc") or die(mysql_error());	
		while($fetchsql= mysql_fetch_array($getforumsql)){
			
			 if($fetchsql['Messagedate']===date('Y-m-d')){
		   $reframe="Today";
		   }
	  else if($fetchsql['Messagedate']===date('Y-m-d',strtotime("-1 days"))){
		   $reframe="Yesterday";
		   }
		else   if($fetchsql['Messagedate']===date('Y-m-d',strtotime("-2 days"))){
		   $reframe="2 days ago";
		   }
		  else if($fetchsql['Messagedate']===date('Y-m-d',strtotime("-3 days"))){
		   $reframe="3 days ago";
		   }
		   else if($fetchsql['Messagedate']>=date('Y-m-d',strtotime("-4 days"))){
		   $reframe=$picrun['dateofcomment'];
		   }
			
			?>
            
          
            <?php
			echo $fetchsql['Message'].'<br/>'.'<br/>'.'<div style="font-size:11px; padding-top:12px;">'.$fetchsql['Username'].'&nbsp;'.'-'.'&nbsp;'.$reframe.'&nbsp;'.'@'.'&nbsp;'.$fetchsql['Messagetime'].'<hr>'.'</div>'; 
			?>
           
            <?php
			}
        ?>
        </div>
        <div style="height:170px; background:rgba(0,0,51,0.7); width:104.5%; margin-left:-19px; border-bottom-left-radius:5px; border-bottom-right-radius:5px;">
        <form method="post">
        <textarea name="generalforum" style="margin-left:50px; width:350px;"></textarea>
        <input type="submit" value="Post" class="btnforum"  name="btnforum">
        </form>
        </div>
        
        
	</div>
</div>
 
 
 
 
 
 
 <div id="inbox" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Inbox <a href="#help"><input type="image" src="images/help.png" style="margin-left:60px; height:20px; width:20px;"></a></h2>
	<h3 style="color:rgb(255,255,255);" align="center">Messages from Admin & Workers</h3>
		<a href="listenerhome.php?#submenu" title="Close" class="close">X</a>
	<div align="center">
    <div class="con-for-msg">
    <div class="conhead">
    Message Box
  <br/>
  <?php
  $adminsql=mysql_query("select distinct * from p_r_o") or die(mysql_error());
	while($row2=mysql_fetch_assoc($adminsql)){
	?>
    <a href="listenerhome.php?Profile=<?php echo $row2['Name']; ?>#inbox"><input type="button" style="width:120px; text-align:center; cursor:pointer; margin-bottom:5px; margin-top:5px; text-align:center;" value="<?php echo $row2['Name']; ?>"></a>
    <?php
	}
  ?>
    </div>
    
    <div class="conmsg" style="text-align:left;">
    <?php
	$adminsql=mysql_query("select distinct * from p_r_o") or die(mysql_error());
	while($row2=mysql_fetch_assoc($adminsql)){
		if(!isset($_GET['Profile'])){
			$user = $row2['Username'];
		}else if(isset($_GET['Profile'])){
			$user = $_GET['Profile']; 
		}
	}
	
	
			 $usersql=mysql_query("SELECT distinct * FROM `admin_to_listener` where Sender='".$user."'  union SELECT distinct * FROM `admin_to_listener` where Sender='".$_SESSION['MM_Username']."' and Receipient='".$user."'  ORDER by `id` asc") or die(mysql_error());
			
			while($fetch1= mysql_fetch_assoc($usersql)){
				
				echo'<div style="padding-left:7px;">';
	echo '<br>'.'<div style="font-weight:bold;">'.$fetch1['Sender'].'</div>';
	echo '<br/>'.$fetch1['Message'].'<br/>'.'<br/>'.'</div>'.'<div style="background:rgb(255,255,255); padding-top:5px; padding-bottom:5px; margin-bottom:-7px; padding-left:7px;">'.'@'.'&nbsp;'.$fetch1['timeofmsg'].'&nbsp;'.'on'.'&nbsp;'.date('l j-M-Y',(strtotime($fetch1['dateofmsg']))).'</div>'.'<hr>'.'<br/>';
				
				
			}
			
		
	
	
	

    ?>
    </div>
    <div class="control">
    
    <?php
    if(isset($_POST['sub']) && !empty($_POST['msgforadmin'])){
	
		
		$query = mysql_query("INSERT INTO `admin_to_listener`(`Sender`, `Receipient`, `Message`, `dateofmsg`, `timeofmsg`) VALUES ('".$_SESSION['MM_Username']."','".mysql_real_escape_string($_POST['receipient'])."','".mysql_real_escape_string($_POST['msgforadmin'])."','".date('Y-m-d')."','".date('h:i a')."')") or die(mysql_error());
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
    <form method="post">
      <div style="color:rgb(255,255,255);">
    
    
    <br/>
    Receipient: <select name="receipient" required> <?php
	$adminsql=mysql_query("select * from p_r_o") or die(mysql_error());
	echo'<option value="">'."Receipients".'</option>';
	while($row2=mysql_fetch_array($adminsql)){
		
		 
		unset($name,$receipient); 
		$name= $row2['Name'];
	 $receipient =$row2['Position'];
	echo'<option value="'.$name.'">'.$receipient.'&nbsp;'.'&nbsp;'.'-'.''.$name.'</option>'; 
	
	 
	}
	  ?>
      </select>
      </div>
      <div style="margin-top:-20px;">
    <textarea name="msgforadmin" required></textarea>
    <input type="submit" class="btn" style="float:right; margin-right:10px; margin-top:50px;" name="sub" value="Send Message">
    </div>
    </form>
    </div>
    </div>
    </div>
    
    <div style="float:right; margin-right:300px; width:290px; height:auto; padding:5px 5px 5px 5px; border-radius:5%; background:linear-gradient(rgba(0,255,255,1),rgba(204,255,255,1)); text-align:center; border:5px rgba(0,0,255,0.3) solid; margin-top:-600px;">
    <h3>Click on any of the buttons for assistance from any of the following people: </h3><br/>
    <?php
	$adminsql=mysql_query("select * from p_r_o") or die(mysql_error());
	while($row2=mysql_fetch_array($adminsql)){
		$name= $row2['Name'];
	 $receipient =$row2['Position'];
	echo $name.'&nbsp;'.'&nbsp;'.'-'.'&nbsp;'.'&nbsp;'.$receipient.'<br/>'.'<br/>'; 
	}
	?>
    
    
    </div>
<style>    
.con-for-msg{
	width:400px;
	height:650px;    
}
 .conhead{
	 font-weight:bold;
	 width:400px;
	 height:100px;
	 border-top-left-radius:30px;
	 border-top-right-radius:30px;
	 text-align:center;
	 padding-bottom:5px;
	 background:rgb(0,51,255);
	 color:rgb(255,255,0);
	 padding-bottom:0px;
	 padding-top:5px;
	 
 }
 .conmsg{
	 width:400px;
	 height:350px;
	 background:linear-gradient(rgba(204,204,204,1),rgba(255,255,255,1));
	 color:rgb(0,0,0);
	 overflow-y:scroll;
 }
 textarea{
	 resize:none;
	 width:270px;
	 height:100px;
	 margin-top:30px;
	 border:2px groove rgb(255,255,0);
 }
 .control{
	 width:400px;
	 height:150px;
	 background:rgb(0,0,102);
	 color:rgb(0,255,0);
	 padding-bottom:15px;
 }
 .btnforum{
	 width:100px; height:100px; border-radius:100px; float:right; margin-right:70px; margin-top:40px; cursor:pointer; border:1px #000000;  box-shadow:2px 2px 4px 6px rgba(255,255,255,0.5);
	  background:radial-gradient(rgba(0,255,255,1),rgba(0,0,255,1));
	  
 }
 .btnforum:hover{
	 background:linear-gradient(rgba(0,255,255,1),rgba(204,255,51,1));
	
	 color:rgb(0,0,0);
	 box-shadow:2px 2px 4px 6px rgba(204,255,51,1));
 }
</style>    
    
    
</div> 






 

   


  









 <div id="profile" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Profile</h2>
			<a href="#close" title="Close" class="close">X</a>
            
        <div id="form">    
     <div class="con1">
     <div style="background:linear-gradient(rgba(102,0,102,1),rgba(204,255,153,1)); width:100%; padding-bottom:10px; padding-top:10px; margin-top:-10px; border-top-right-radius:20px;border-top-left-radius:20px;">
     <h1 align="center" >Edit Profile</h1>
     </div>  
          
            <table class="t1">
	<?php
	

	$result = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		if($row['id']==""){
			
		echo'<h1 align="center">No records available</h1>';
		?>
        <tr><td colspan="2" style="background:rgba(255,255,255,0.5);"><h1 align="center">No records available</h1></td></tr>
        <?php
		}
		else{
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";	
		?>
        
       
        <?php
		if(isset($_POST['updatebtn'])){
			if(!is_numeric($_POST['phone'])){
				?>
                <script>
                alert('Your telephone number must be numeric!!!');
				</script>
                <?php
				
					}
					else if(strlen($_POST['phone'])> 10 || strlen($_POST['phone'])< 10){
					?>
                <script>
				
                alert('Your telephone number cannot be less or more than 10 characters!!!');
				</script>
                <?php
				}else if(is_numeric($_POST['phone']) && strlen($_POST['phone'])== 10){
			
			$update= mysql_query("UPDATE `listener_details` SET `Username`='".$_POST['name']."',`Telephone`='".$_POST['phone']."',`Email`='".$_POST['email']."',`role`='".$_POST['purpose']."' WHERE `Username`='".$row['Username']."'") or die(mysql_error());
			
			}
			
		}
			if($update){
				?>
                <script>
                alert('Profile successfully updated!');
				</script>
                <?php
				}
				
			

        ?>
        
        <form  method="post" action="" onSubmit="chch()">
				<tr class="<?php if(isset($classname)) echo $classname;?>"></tr>
                	
        
        
        <tr><td>Your name</td><td>
		<input type="text" name="name" value="<?php echo $row['Username'];?>" class="input"  />
        </td></tr>
       <tr> <td>Contact Number</td><td>
		<input type="text" name="phone" value="<?php echo $row['Telephone'];?>"  class="input" />
		
        </td></tr>
        <tr><td>Email Address</td><td>
        <input type="email" name="email" value="<?php echo $row['Email'];?>"   class="input" />
        </td></tr>
       <tr> <td>Listener's Domain</td><td>
		<select name="purpose" required  class="input">
        <?php echo'<option value="">'.$row['role'].'</option>'  ?>
<option value="">Please select an option</option>
<option value="Listening">Listening</option>
<option value="Listening & Advertisement">Listening & Advertisement</option>
<option value="Advertisement">Advertisement</option>
</select>
		</td>
   		  </tr>
         <tr><td></td><td colspan="5" id="hbn"><input type="submit" name="updatebtn" value="Update" class="btn1" id="btn" onClick="return confirm('Are you sure you want to continue?');"/></td></tr>
         <tr><td></td><td colspan="5" id="hbn"><input type="button" name="update" value="Close" class="btn2" id="btnClose" onClick="hide()" /></td></tr>
</form> 
        <?php
		}
		}

	
	?>
    </table>
    </div>
    </div>
    
    
   <div class="con2">
    <div style="width:780px; background:linear-gradient(rgba(0,255,255,1),rgba(0,0,153,1)); padding-bottom:10px; padding-top:10px; margin-top:-10px; border-top-right-radius:20px;border-top-left-radius:20px; margin-left:-26px;">
    <h1 align="center">Your profile</h1> 
    </div>
            <table width="330" class="t2" style="margin-right:50px;">
            <?php
            $result = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		if($row['id']==""){
			
		echo'<h1 align="center">No records available</h1>';
		?>
        <tr><td colspan="2" style="background:rgba(255,255,255,0.5);"><h1 align="center">No records available</h1></td></tr>
        <?php
		}
		else{
			$counter = mysql_num_rows($result);
			if($counter%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";	
		?>
        <form  method="post" action="" onSubmit="return confirm('Are you sure you want to continue?');">
				<tr class="<?php if(isset($classname)) echo $classname;?>"></tr>
                	
        
        
        <tr ><td width="117" style="width:100px;">Your name</td><td width="194">
		<?php echo $row['Username'];?>
        </td></tr>
       <tr> <td style="width:100px;">Contact Number</td><td>
		<?php echo $row['Telephone'];?>
		
        </td></tr>
        <tr><td style="width:100px;">Email Address</td><td>
        <?php echo $row['Email'];?>
        </td></tr>
       <tr> <td style="width:100px;">Listener's Domain</td><td>
       <?php echo $row['role'];?>
		</td>
        		</tr>
                
        <tr> <td style="width:100px;">Date of Signup</td><td>
       <?php echo date('l j-M-Y',(strtotime($row['Signup'])));?>
		</td>
        		</tr>
                
        <tr> <td >Interests</td><td>
       <?php
	   
		   
		  if($row['Interest1']!=""){
	   $a = $row['Interest1'];
	   }else{
		  $a = $row['Interest1']; 
		   } 
		   
		   
		 if($row['Interest2']!="" && $row['Interest1']!=""){
	   $b = ','.$row['Interest2'];
	   }else if($row['Interest2']!="" && $row['Interest1']==""){
		  $b = $row['Interest2']; 
		   }else if($row['Interest2']==""){
			   $b = $row['Interest2'];
			   }   
		  
		  
		  if($row['Interest3']!="" && $row['Interest2']!=""){
	   $c = ','.$row['Interest3'];
	   }else if($row['Interest3']!="" && $row['Interest2']==""){
		  $c = $row['Interest3']; 
		   }
		  else if($row['Interest3']==""){
		  $c = $row['Interest3']; 
		   } 
		  
		   
		   
		 if($row['Interest4']!="" && $row['Interest3']!=""){
	   $d = ','.$row['Interest4'];
	   }else if($row['Interest4']!="" && $row['Interest3']==""){
		  $d = $row['Interest4']; 
		   } 
		else if($row['Interest4']==""){
		  $d = $row['Interest4']; 
		   }   
		   
		   
		  if($row['Interest5']!="" && $row['Interest4']!=""){
	   $e =','. $row['Interest5'];
	   }else  if($row['Interest5']!="" && $row['Interest4']==""){
		  $e = $row['Interest5']; 
		   }  
		 else  if($row['Interest5']==""){
		  $e = $row['Interest5']; 
		   }   
		   
		   
		     
		 if($row['Interest6']!="" && $row['Interest5']!=""){
	   $x = ','.$row['Interest6'];
	   }else if($row['Interest6']!="" && $row['Interest5']==""){
		  $x = $row['Interest6']; 
		   }
		else if($row['Interest6']==""){
		  $x = $row['Interest6']; 
		   }   
		   
		   
		   
		   if($row['Interest7']!="" && $row['Interest6']!=""){
	   $y = ','.$row['Interest7'];
	   }else if($row['Interest7']!="" && $row['Interest6']==""){
		  $y = $row['Interest7']; 
		   } 
		   else if($row['Interest7']==""){
		  $y = $row['Interest7']; 
		   }
		       
	    echo $a.$b.$c.$d.'<br/>'.$e.$x.$y;?>
		</td>
        		</tr>                
                
         <tr><td></td><td colspan="5" id="hbn"><input type="button"  value="Edit Profile" class="btn1" id="btnEdit" onClick="show()" /></td></tr>
</form> 
        <?php
		}
		}

	
	?>
            </table>
            <div style="margin-left:420px; margin-top:-380px; float:right; position:absolute;">
             <?php
		$result = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
       <?php
	   if(empty($row['Img'])){
	   ?>
        <img src="profilepic/noavatar92.png"  width="300px" height="250px" class="img" />
        <?php
	   }else{
		   ?>
		   <a href="listenerhome.php?Profile=<?php echo $row['Username']; ?>#fullpic"> <img src="profilepic/<?php echo $row['Img']; ?>"  width="300px" height="250px" class="img" /> </a>
		   <?php
	   }
	   ?>
        <div style="background:linear-gradient(rgba(51,51,51,1),rgba(51,0,102,1)); width:295px; padding-bottom:10px; padding-left:5px;  padding-top:10px;">
        <div align="center">
        <input type="button" value="Change" onClick="shows();" class="btnh">
        
         <div id="form1" style="display:none;">
        <form method="post" enctype="multipart/form-data" class="form-horizontal">
	    <?php
		}
        ?>
        <table>
    
    <tr style="display:none;">
    	<td><label class="control-label">Username.</label></td>
        <td><input class="form-control" type="text" name="user_name" placeholder="Enter Username" value="<?php echo $_SESSION['MM_Username']; ?>" /></td>
    </tr>
    
    <tr>
    	
        <td colspan="2"><input class="btnup" type="file" name="user_image" accept="image/*"  required/></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn">
        <span class="glyphicon glyphicon-save"></span> &nbsp; save
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
<input type="button" value="Hide" onClick="hider();" style="margin-left:30px;" class="btnh">
        </div>
        </div>
       
</div>
        </div>
            </div>
    
</div>  







<div id="help" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Help</h2>
			<a href="#close" title="Close" class="close">X</a>
            <div align="center">
            <div style="width:300px; background:linear-gradient(rgba(204,204,204,1),rgba(255,255,255,1)); border-radius:10px; color:rgb(0,0,0); height:auto; padding-bottom:20px; padding-top:20px;">
            When wanting to get a personal message or help,send your messages privately from the inbox menu.
            </div>
			</div>
</div> 




<div id="fullpic" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center">Full Picture</h2>
			<a href="#close" title="Close" class="close">X</a>
   <div align="center">
   <?php
   $result = sprintf("SELECT * FROM listener_details WHERE Username = %s  or Email = '".$_SESSION['MM_Username']."'", GetSQLValueString($colname_Recordset1, "text"));
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
        <div style="width:650px; height:100px; background:url(images/img60.jpg); border-top-left-radius:30px;border-top-right-radius:30px;">
        <br/>
        <?php echo '<h1 align="center">'.$row["Username"].'</h1>'; ?>
       </div> 
       
       <?php
	   if(!empty($row['Img'])){
		   ?>
   <img src="profilepic/<?php echo $row['Img']; ?>"  width="650px" height="500px"/>
   <div class="profilechat">
   <div style="height:50px; background:linear-gradient(rgba(51,51,51,0.7),rgba(102,102,102,0.7)); color:rgb(255,255,255); padding-top:1px;"><h2 align="center">Comments</h2></div>
   <div style="height:380px; background:linear-gradient(rgba(0,255,255,0.7),rgba(0,153,255,0.7)); text-align:justify;">
   
      <?php 
  $picquery=mysql_query("SELECT * FROM `profile_comments` WHERE `Sender`='".$_SESSION["MM_Username"]."' and `Receipient`='".$_GET['Receipient']."' and `Picture`='".$row['Img']."' union SELECT * FROM `profile_comments` WHERE `Sender`='".$_GET['Receipient']."' or `Receipient`='".$_SESSION["MM_Username"]."' and `Picture`='".$row['Img']."' order by id asc") or die(mysql_error()); 
   
   while($picrun= mysql_fetch_array($picquery)){
	     if($picrun['dateofcomment']===date('Y-m-d')){
		   $formattime="Today";
		   }
	  else if($picrun['dateofcomment']===date('Y-m-d',strtotime("-1 days"))){
		   $formattime="Yesterday";
		   }
		else   if($picrun['dateofcomment']===date('Y-m-d',strtotime("-2 days"))){
		   $formattime="2 days ago";
		   }
		  else if($picrun['dateofcomment']===date('Y-m-d',strtotime("-3 days"))){
		   $formattime="3 days ago";
		   }
		   else if($picrun['dateofcomment']>=date('Y-m-d',strtotime("-4 days"))){
		   $formattime=date('l j-M-Y',(strtotime($picrun['dateofcomment'])));
		   }
	   echo "<a href='listenerhome1.php?Receipient=".$picrun['Sender']."#pic'>".$picrun['Sender']."</a>".'<br/>'.$picrun['Comment'].'<br/>'.$formattime.'&nbsp;'.'@'.'&nbsp;'.$picrun['timeofcomment'].'<br>'.'<hr>';
	   
	   }
   
   
    ?>
   
   </div>
   
   <div style="height:170px; background:linear-gradient(rgba(0,0,51,0.7),rgba(51,51,51,0.7))">
   <form action="" method="post">
   <textarea name="comment" class="textarea"></textarea><br/><br/>
   <input type="submit" class="btncmnt" name="btncomment" value="Comment">
   </form>
   
   <?php
   if(isset($_POST['btncomment'])){
	   if(!empty($_POST['comment'])){
	
		   
		   $sql="INSERT INTO `profile_comments`(`Sender`, `Comment`, `Receipient`,`Picture`, `dateofcomment`, `timeofcomment`) VALUES ('".$_SESSION["MM_Username"]."','".mysql_real_escape_string($_POST['comment'])."','".$_GET['Receipient']."','".$row['Img']."','".date('Y-m-d')."','".date('H:i:s A')."')";
		   $run= mysql_query($sql) or die(mysql_error());
		   echo"<meta http-equiv='refresh' content='0'>";
		   }else{
			   ?>
			   <script>
			   alert('You can\'t send an empty comment!!!');
			   </script>
               <?php
			   }
	   
	   }
   
   ?>
   </div>
   </div>
   <style>
   .btncmnt{
	   width:100px;
	   padding-bottom:5px;
	   padding-top:5px;
	   border-radius:10px;
	   border: 1px #000000;
	   cursor:pointer;
   }
   .btncmnt:hover{
	   background:rgb(0,255,255);
   }
   .btncmnt:focus{
	   outline:none;
   }
   .profilechat{
	   margin-left:800px;
	   margin-top:-605px;
	   
	   margin-right:10px;
	   width:350px;
	   height:600px;
	   background:linear-gradient(rgba(255,255,255,1),rgba(204,204,204,1));
   }
   .textarea{
	   resize:none;
	   width:200px;
	   height:100px;
	   margin-left:-5px; 
	   margin-top:8px;
   }
   </style>
   <?php
	   }
		}
   ?>
   </div>         
</div>            



<script>
function show(){
	document.getElementById('form').style.display="block";
	document.getElementById('form').style.float="right";
	
	}
function hide(){
	document.getElementById('form').style.display="none";
	}
function shows(){
	document.getElementById('form1').style.display="block";
	
	}
function hider(){
	document.getElementById('form1').style.display="none";
	}		
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
