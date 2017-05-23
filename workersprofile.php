<?php require_once('connection.php'); ?>
<?php
error_reporting(0);
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

$MM_restrictGoTo = "connection.php";
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
if(isset($_POST['btndel']))
	{
		$firstquery=mysql_query("select * from work_details  where Username='".$_SESSION['MM_Username']."'") or die(mysql_error());
		while($first=mysql_fetch_assoc($firstquery)){
		if(!empty($first['Img'])){	
		$sql=mysql_query("update work_details set Img=''  where Username='".$_SESSION['MM_Username']."'") or die(mysql_error());
		if($sql){
		echo"<script>alert('Photo successfully removed');</script>";
		echo"<script>document.getElementById('del').style.display='none';</script>";
		}
		}else{
			
			
			}
		}
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
			$upload_dir = 'workersprofile/'; // upload directory
	
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
			$stmt = $DB_con->prepare('UPDATE `work_details` 
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
				echo"<meta http-equiv='refresh' content='0'>";
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Profile</title>

<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
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
	background: rgba(51,51,51,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
	overflow-y:scroll;
	padding-bottom:50px;
}
li:focus{
	outline:none;
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
.table{
	border-spacing:0px 13px;
}
textarea{
	resize:none;
}
</style>
<script src="jquery-2.2.3.min.js" type="text/javascript"></script>
</head>

<body background="images/142.jpg">
<h1 align="center" style="color:rgb(255,255,255);">YOUR PROFILE</h1>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0" style="margin-left:470px; width:200px; padding:5px 5px 5px 5px; border-top-left-radius:200px;border-top-right-radius:200px; padding-bottom:8px; padding-top:8px; text-align:center;">Work Details</li>
    <li class="TabbedPanelsTab" tabindex="0" style=" width:200px; padding:5px 5px 5px 5px; border-top-left-radius:200px;border-top-right-radius:200px; text-align:center; padding-bottom:8px; padding-top:8px;">Demographic Details</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
  
  
    <div class="TabbedPanelsContent" style="background:url(images/101.jpg); width:100%; height:670px; padding-bottom:40px;">
    
    <div style="margin-left:60px; margin-top:60px; float:left; border:5px #CCCCFF solid;">
    <?php
    $result = "SELECT * FROM work_details WHERE Username =  '".$_SESSION['MM_Username']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
	?>
    <table style="width:700px; background:linear-gradient(rgba(102,0,255,0.5),rgba(102,0,153,0.5)); color:rgb(255,255,255); font-size:20px;" cellpadding="8" class="table">
    <tr><td style="width:200px;"><b>Name</b></td>
    <td style="width:500px;"><b><?php echo $row['Username'] ?></b></td></tr>
    
     <tr><td style="width:200px;"><b>Departments</b></td>
     <td style="width:500px;"><b>
	 <?php 
	 if(!empty($row['Department1'])&& !empty($row['Department2'])){
	 echo $row['Department1'].','.$row['Department2'];
	 }else if(!empty($row['Department2'])&& empty($row['Department1'])){
		 echo $row['Department2'];
		 }else{
			 echo $row['Department1'];
			 }
	 
	 ?></b></td></tr>
     
       <tr><td style="width:200px;"><b>Roles</b></td>
       <td style="width:500px;"><b><?php
	   echo $row['Role1'].'&nbsp;'.'&nbsp;'.$row['Role2'].'&nbsp;'.'&nbsp;'.$row['Role3'].'&nbsp;'.'&nbsp;'.$row['Role4'].'&nbsp;'.'&nbsp;'.$row['Role5'].'&nbsp;'.'&nbsp;'.$row['Role6'].'&nbsp;'.'&nbsp;'.$row['Role7']; 
	   
	   
	   ?></b></td></tr>
       
        <tr><td style="width:200px;"><b>Work ID</b></td>
        <td style="width:500px;"><b><?php echo $row['DCODE'].$row['DID'] ?></b></td></tr>
        
         <tr><td style="width:200px;"><b>Date signed onto system</b></td>
         <td style="width:500px;"><b><?php echo date('l jS F, Y',(strtotime($row['Date_of_signup']))) ?></b></td></tr>
    </table>
    <?php
		}
	?>
    </div>
    
    
      <div style="margin-right:60px; margin-top:60px; float:right;">
             <?php
		$result = "SELECT * FROM work_details WHERE Username =  '".$_SESSION['MM_Username']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
       <?php
	   if(empty($row['Img'])){
	   ?>
        <img src="workersprofile/noavatar92.png"  width="300px" height="250px" class="img" />
        
        <?php
		echo'<script>
		document.getElementById("del").style.display="none";
        </script>';
	   }else{
		   ?>
		   <a href="workersprofile.php?Profile=<?php echo $row['Username']; ?>&img=<?php echo $row['Img']; ?>#fullpic"> <img src="workersprofile/<?php echo $row['Img']; ?>"  width="300px" height="250px" class="img" /> </a>
          
		   <?php
		   echo' <script>
		document.getElementById("del").style.display="block";
        </script>';
	   }
	   ?>
        <div style="background:linear-gradient(rgba(51,51,51,1),rgba(51,0,102,1)); width:295px; padding-bottom:10px; padding-left:5px;  padding-top:10px;">
        <div align="center">
        <input type="button" value="Show Form" onClick="shower();"  class="btnh" id="show">
        <input type="button" value="Hide Form" onClick="hider();"  class="btnh" id="hide" style="display:none;">
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
    	
        <td colspan="2"><input class="btnup" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Update
        </button>
        <button type="submit" name="btndel" class="btn" id="del">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Remove
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
    
    </div>
    </div>
    </div>
    </div>
    </div>
    
    
    
   <div class="TabbedPanelsContent" style="background:url(images/14.jpg); width:100%; height:670px; padding-bottom:40px;">
    
    <div style="margin-left:60px; margin-top:60px; float:left; border:5px #CCCCFF solid; color:rgb(255,255,255); font-weight:bold;">
     
   
        <table style="border-spacing:0px 20px; background:linear-gradient(rgba(0,51,255,0.6),rgba(0,0,0,0.4));" cellpadding="8">
        <?php
	$demosql=mysql_query("SELECT * FROM `staff_and_management_demographic_details` WHERE `Name`='".$_SESSION['MM_Username']."'") or die(mysql_error());
	while($demo=mysql_fetch_assoc($demosql)){
	?>
        <tr><td style="width:100px;">Name</td><td style="width:350px;"><?php echo $demo['Name'] ?></td>
        <td style="width:100px;">Marital Status</td><td style="width:350px;"><?php echo $demo['Marital_status'] ?></td>
        </tr>
        
        <tr><td style="width:100px;">Date of Birth</td><td style="width:350px;"><?php echo date('l jS F, Y',(strtotime($demo['Date_of_birth']))) ?></td>
        <td style="width:100px;">Religion</td><td style="width:350px;"><?php echo $demo['Religion'] ?></td>
        </tr>
        
        <tr><td style="width:100px;">Gender</td><td style="width:350px;"><?php echo $demo['Gender'] ?></td>
        <td style="width:100px;">Hometown</td><td style="width:350px;"><?php echo $demo['Hometown'] ?></td>
        </tr>
        
        <tr><td style="width:100px;">Email</td><td style="width:350px;"><?php echo $demo['Email_Address'] ?></td>
        <td style="width:100px;">Place of Birth</td><td style="width:350px;"><?php echo $demo['Place_of_birth'] ?></td>
        </tr>
        
        <tr><td style="width:100px;">Contact Number</td><td style="width:350px;"><?php if(!empty($demo['Contact_No'])){ echo "0".$demo['Contact_No']; }?></td>
        <td style="width:100px;">National ID</td><td style="width:350px;"><?php echo $demo['National_ID_type'].'<br/>'.$demo['National_ID_No'] ?></td>
        </tr>
        
        <tr><td style="width:100px;">Nationality</td><td style="width:350px;"><?php echo strtoupper($demo['Nationality']) ?></td>
        <td style="width:100px;">Postal Address</td><td style="width:350px;"><?php echo $demo['Postal_Address'] ?></td>
        </tr>
         <?php
	}
	?> 
        </table>
     
    </div>
     
    </div>
     
    
    
  </div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
/*function rotate(){
var img = document.getElementById('img');
img.setAttribute("class", "rotate");
}
$("body").on("click","#btn", function(){
	$("#img").animate("transform","rotate(90deg)");
	
});*/
var delta= 0;
function rotate(){
	
	var img= document.getElementById("img");
	img.style.webkitTransform= "rotate("+delta+"deg)";
	delta+=90;
	}
</script>
<script>
function shower(){
	document.getElementById('form1').style.display="block";
	document.getElementById('show').style.display="none";
	document.getElementById('hide').style.display="block";
	}
function hider(){
	document.getElementById('form1').style.display="none";
		document.getElementById('show').style.display="block";
	document.getElementById('hide').style.display="none";
	}		
</script>
<style>
.rotate{
	-webkit-transform:rotate(90deg);
	-moz-transform:rotate(90deg);
	transform:rotate(90deg);
}

</style>
<div id="fullpic" class="modalDialog">
<a href="#close" title="Close" class="close">X</a>
 <?php
		$result = "SELECT * FROM work_details WHERE Username =  '".$_SESSION['MM_Username']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
<img src="workersprofile/<?php echo $row['Img']; ?>"  id="img" width="500px" height="500px"  style="margin-left:50px; border:10px rgb(255,215,0) groove; margin-top:50px;" />
<?php
		}
?>
<br/>
<input type="button" value="Rotate" style="height:80px; width:80px; border-radius:80px; background:linear-gradient(rgba(255,215,0,1),rgba(204,255,51,1)); margin-left:270px; margin-top:35px; font-weight:bolder; outline:none; border:10px  #000000 dashed; box-shadow:0.5px 0.5px 2px 5px rgba(255,215,0,0.6); cursor:pointer;" id="btn" onClick="rotate()">

<div style="float:right; margin-right:110px; width:460px; margin-top:-535px; padding-left:5px;">
<div style="background:rgba(7,2,53,1); color:rgb(255,255,255); text-align:center; font-weight:bold; padding-bottom:10px; padding-top:10px;">Comments</div>

<div style="height:410px; background:url(images/101.jpg); color:rgb(255,255,255); padding-left:8px; padding-top:5px;">
<?php
$dir="workersprofile/";
$getsql=mysql_query("select * from workprofilecomments where Img='".$_GET['img']."' order by id desc") or die(mysql_error());
while($get1=mysql_fetch_assoc($getsql)){
	$get2sql=mysql_query("select * from work_details where Username='".$get1['Username']."'") or die(mysql_error());
	while($get2=mysql_fetch_assoc($get2sql)){
		echo"<img src='".$dir."/".$get2['Img']."' width='30' height='30' style='border-radius:100%;'>".'&nbsp;'.'&nbsp;'.$get1['Username'].'<br/>'.'<b>'.$get1['Comment'].'</b>'.'<hr>';
		
		}
	}

?>
</div>

<div style="height:170px; background: rgba(7,2,53,1);">
<form method="post" action="">
<textarea name="cmt" style="width:270px; height:140px; margin-top:10px; margin-left:10px; " required></textarea>
<input type="submit" value="Comment" style="float:right;  " class="cmt" name="comment">
</form>
<style>
.cmt{
	background:url(images/Globe3_256x256.png); color:rgb(255,255,255); height:100px; width:100px;
	outline:none; border:none;
	background-size:cover;
	margin-top:35px;
	margin-right:30px;
	cursor:pointer;
	font-weight:bold;
	}
</style>
</div>
</div>
</div>

<?php
if(isset($_POST['comment'])){
$insertsql=mysql_query("INSERT INTO `workprofilecomments`(`Img`, `Username`, `Comment`) VALUES ('".$_GET['img']."','".$_SESSION['MM_Username']."','".mysql_real_escape_string($_POST['cmt'])."')") or die(mysql_error());	
	echo"<meta http-equiv='refresh' content='0'>";
	}
?>
</body>
</html>