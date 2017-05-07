<?php require_once('connection.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Messaging</title>
<style>
.con2{
	background:linear-gradient(rgba(0,204,255,1),rgba(0,0,255,1));
	width:650px;
	height:400px;
	padding-bottom:5px;
	border-top-left-radius:35px;
	border-top-right-radius:35px;
	border:5px rgba(243,243,243,0.5) solid;
	margin-top:20px;
	margin-left:50px;
	}
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
	margin-top:100px;
	position: relative;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	
}
.img{
	border-radius:6px;
	box-shadow:0.5px 0.5px 2px 3px rgba(255,255,255,0.5);}
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
.headd{
	background:linear-gradient(rgba(0,255,255,1),rgba(0,0,153,1)); padding-bottom:10px; padding-top:10px; margin-top:-25px; border-top-right-radius:20px;border-top-left-radius:20px;
	width:700px;
	margin-left:-25px;
	}
table{
	color:rgb(255,255,255);
	margin-top:20px;
	border-spacing:10px 10px;
}
</style>
</head>

<body>
<?php include'listenerinboxmsg.php'; ?>
<br/><br/>
<div id="modal" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center"></h2>
	
		<a href="#close" title="Close" class="close">X</a>
        <?php $receipient=$_GET['Receipient'];?>
        
 
 <div class="con2">
 <div class="headd"><h1 align="center">Profile of <?php echo $_GET['Receipient'];?></h1>
 
 </div>
 
 
<table width="330" class="t2" style="margin-right:50px;">
            <?php
            $result = "SELECT * FROM listener_details WHERE Username = '".$_GET['Receipient']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
			
		?>
        
				
                	
        
        
        <tr ><td width="117" style="width:100px;">Name</td><td width="194">
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
		  $b = ','.$row['Interest2']; 
		   }else if($row['Interest2']==""){
			   $b = $row['Interest2'];
			   }   
		  
		  
		  if($row['Interest3']!="" && $row['Interest2']!=""){
	   $c = ','.$row['Interest3'];
	   }else if($row['Interest3']!="" && $row['Interest2']==""){
		  $c = ','.$row['Interest3']; 
		   }
		  else if($row['Interest3']==""){
		  $c = $row['Interest3']; 
		   } 
		  
		   
		   
		 if($row['Interest4']!="" && $row['Interest3']!=""){
	   $d = ','.$row['Interest4'];
	   }else if($row['Interest4']!="" && $row['Interest3']==""){
		  $d = ','.$row['Interest4']; 
		   } 
		else if($row['Interest4']==""){
		  $d = ','.$row['Interest4']; 
		   }   
		   
		   
		  if($row['Interest5']!="" && $row['Interest4']!=""){
	   $e =','. $row['Interest5'];
	   }else  if($row['Interest5']!="" && $row['Interest4']==""){
		  $e = ','.$row['Interest5']; 
		   }  
		 else  if($row['Interest5']==""){
		  $e = $row['Interest5']; 
		   }   
		   
		   
		     
		 if($row['Interest6']!="" && $row['Interest5']!=""){
	   $x = ','.$row['Interest6'];
	   }else if($row['Interest6']!="" && $row['Interest5']==""){
		  $x = ','.$row['Interest6']; 
		   }
		else if($row['Interest6']==""){
		  $x = $row['Interest6']; 
		   }   
		   
		   
		   
		   if($row['Interest7']!="" && $row['Interest6']!=""){
	   $y = ','.$row['Interest7'];
	   }else if($row['Interest7']!="" && $row['Interest6']==""){
		  $y = ','.$row['Interest7']; 
		   } 
		   else if($row['Interest7']==""){
		  $y = $row['Interest7']; 
		   }
		       
	    echo $a.$b.$c.$d.'<br/>'.$e.$x.$y;?>
		</td>
        		</tr>                
                
      
        <?php
		}
		

	
	?>
            </table>    
 
 
 
 
 
 <div style="margin-left:405px; margin-top:-280px; float:right; position:absolute;">
 <?php
$sql1="SELECT * FROM `listener_details` where  Username='".$receipient."' ";
$run1 = mysql_query($sql1) or die (mysql_error());


while($fetch1 = mysql_fetch_array($run1)){
	?>
       <?php
	   if(empty($fetch1['Img'])){
	   ?>
       
<img src="profilepic/noavatar92.png"  width="250px" height="250px" class="img" />

        <?php
	   }else{
		   ?>
           
		    <a href="listenerinboxmsg2.php?Receipient=<?php echo $fetch1['Username']; ?>#fullpicture"><img src="profilepic/<?php echo $fetch1['Img']; ?>"  width="250px" height="250px" class="img" /></a>
 
  <?php
}
}
?>	
 </div>
 </div>       
</div>



<div id="fullpicture" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center"></h2>
	
		<a href="#close" title="Close" class="close">X</a>



   <?php
   $result =  "SELECT * FROM listener_details WHERE Username = '".$_GET['Receipient']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
        <div style="width:630px; height:100px; background:url(images/img184.JPG); border-top-left-radius:30px;border-top-right-radius:30px; margin-left:30px; margin-top:-0px;">
        <br/>
        <?php echo '<h1 align="center">'.$row["Username"].'</h1>'; ?>
       </div> 
       
       <?php
	   if(!empty($row['Img'])){
		   ?>
   <img src="profilepic/<?php echo $row['Img']; ?>"  width="670px" height="500px" style="float:left; margin-left:30px; margin-top:-5px; z-index:99999;"/>
   
   
  
   
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
   
   if($run){
	   ?>
			   
               <?php
	   }
   
   ?>
   
   <div class="profilechat">
   <div style="height:50px; background:linear-gradient(rgba(51,51,51,0.7),rgba(102,102,102,0.7)); color:rgb(255,255,255); padding-top:1px; margin-top:-220px; "><h2 align="center">Comments</h2></div>
   <div style="height:380px; background:linear-gradient(rgba(0,255,255,0.7),rgba(0,153,255,0.7))">

   <div style="background:rgba(255,255,255,0.6); padding-top:5px;">
   <?php 
  $picquery=mysql_query("SELECT * FROM `profile_comments` WHERE `Sender`='".$_SESSION["MM_Username"]."' and `Receipient`='".$_GET['Receipient']."' and `Picture`='".$row['Img']."' union SELECT * FROM `profile_comments` WHERE `Sender`='".$_GET['Receipient']."' and `Receipient`='".$_SESSION["MM_Username"]."' and `Picture`='".$row['Img']."'") or die(mysql_error()); 
   
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
		   $formattime=$picrun['dateofcomment'];
		   }
	   echo "<a href='listenerinboxmsg3.php?Receipient=".$picrun['Sender']."#newprofile'>".$picrun['Sender']."</a>".'<br/>'.$picrun['Comment'].'<br/>'.$formattime.'&nbsp;'.'@'.'&nbsp;'.$picrun['timeofcomment'].'<br>'.'<hr>';
	   
	   }
   
   
    ?>
    </div>
   </div>
   
   <div style="height:170px; background:linear-gradient(rgba(0,0,51,0.7),rgba(51,51,51,0.7))">
   <form action="" method="post">
   <div align="center">
   <textarea name="comment" class="textarea"></textarea><br/><br/>
   <input type="submit" class="btncmnt" name="btncomment" value="Comment">
   </div>
   </form> 
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
	   
	   margin-right:0px;
	   width:350px;
	   height:600px;
	   float:right;
	   margin-right:170px;
	   
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
</div>
  
<style>  
textarea{
	resize:none;
	width:90%;
}
.con1{
	width:500px;
	height:520px;
	margin-bottom:30px;
	float:right;
	margin-right:150px;
	margin-top:-20px;
	margin-bottom:80px;
}
.msghead{
width:500px;
 border-top-left-radius:85px; 
 border-top-right-radius:85px; 
 background:url(images/mac_apple_logo_creative_94063_1920x1080.jpg);
  padding-bottom:3px; 
  padding-top:3px; 
  border:1px #000000 solid;	
  height:50px;
	}
.msgbody{
	height:480px;
	width:502px;
	 background:url(images/mac_apple_logo_creative_94063_1920x1080.jpg);
}
.msgcontent{
	height:280px;
	width:502px;
	background:rgba(255,255,255,0.8);
	overflow-x:scroll;
}
.msgcontrol{
	width:500px;
	height:auto;
	padding-bottom:10px;
	padding-top:10px;
	padding-left:2px;
	background:url(images/fomef_icloud_design_5k-wallpaper-1366x768.jpg);
}  
</style>        
<div class="con1">
<div class="msghead"><h3 align="center" style="color:rgb(255,255,255);">Conversations</h3></div>
<div class="msgbody">
<div class="msgcontent">
<?php
$date = date('l j-M-Y');
			$time = date('H:i:s');
$receiver= $_GET['Receipient'];
$sender=$row_Recordset1['Username'];
$sql="SELECT * FROM `listener_to_listener` where Sender='".$receiver."' union SELECT * FROM `listener_to_listener` where Sender='".$sender."' and Receipient='".$receiver."'  ORDER by `id` asc";
$run = mysql_query($sql) or die (mysql_error());

while($fetch = mysql_fetch_assoc($run)){
	 if($fetch['dateofmsg']===date('Y-m-d')){
		   $formattime="Today";
		   }
	  else if($fetch['dateofmsg']===date('Y-m-d',strtotime("-1 days"))){
		   $formattime="Yesterday";
		   }
		else   if($fetch['dateofmsg']===date('Y-m-d',strtotime("-2 days"))){
		   $formattime="2 days ago";
		   }
		  else if($fetch['dateofmsg']===date('Y-m-d',strtotime("-3 days"))){
		   $formattime="3 days ago";
		   }
		   else if($fetch['dateofmsg']>=date('Y-m-d',strtotime("-4 days"))){
		   $formattime=date('l j-M-Y',(strtotime($picrun['dateofmsg'])));
		   }
	
	
	
	echo'<div style="padding-left:7px;">';
	echo '<br>'.'<div style="font-weight:bold;">'.$fetch['Sender'].'</div>';
	echo '<br/>'.$fetch['Message'].'<br/>'.'<br/>'.'</div>'.'<div style="background:rgb(255,255,255); padding-top:5px; padding-bottom:5px; margin-bottom:-7px; padding-left:7px;">'.''.'&nbsp;'.$formattime.'&nbsp;'.'@'.'&nbsp;'.$fetch['timeofmsg'].'</div>'.'<hr>'.'<br/>';
	
}

?>

</div>
<div class="msgcontrol">
<div style="background:rgba(0,0,0,1); color:rgb(255,255,0); padding-bottom:6px; padding-top:6px; margin-top:-10px; margin-left:-2px;">

<div style=" font-weight:bold; margin-left:8px;">Receipient:  <?php if(isset($_GET['Receipient'])){ echo $_GET['Receipient'];} ?></div>

</div>
<?php
 if(isset($_POST['send'])){
	   if(!empty($_POST['msg'])){
	
		   
		   $sql="INSERT INTO `listener_to_listener`(`Sender`, `Receipient`, `Message`, `dateofmsg`, `timeofmsg`) VALUES ('".$_SESSION["MM_Username"]."','".$_GET['Receipient']."','".mysql_real_escape_string($_POST['msg'])."','".date('Y-m-d')."','".date('H:i:s A')."')";
		   $run= mysql_query($sql) or die(mysql_error());
		   echo"<meta http-equiv='refresh' content='0'>";
		   }else{
			   ?>
			   <script>
			   alert('You can\'t send an empty message!!!');
			   </script>
               <?php
			   }
	   
	   }
?>
<form action="" method="post">
<div align="center"><textarea name="msg" rows="9" cols="30" style="margin-top:20px; border-radius:7px;"></textarea></div><br/>

 <div align="center"><input type="submit" style="margin-left:0px; margin-top:5px; width:200px; padding-top:7px; padding-bottom:7px; border-top-left-radius:10px; border-top-right-radius:10px; cursor:pointer; background:linear-gradient(rgb(102,0,51),rgb(0,0,255)); color:rgb(255,255,255); border:1px #000000;" value="Send" name="send"></div>
<br/>
</form>
<div style="background:rgba(0,0,0,1); color:rgb(255,255,255); padding-bottom:6px; padding-top:6px; margin-left:-2px; margin-bottom:-10px;">

<div style="font-weight:bold; margin-left:300px;">Sender:  <?php echo $row_Recordset1['Username']; ?></div>

</div>

</div>


</div>
</div>

<br/>
<br/>
<br/>

<br/>
<br/>
<br/>   
    
   
</body>


</html>