<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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

<?php include'listenerinboxmsg2.php'; ?>
<div style="float:right; background:rgba(255,255,255,0.5); width:70px; height:70px; margin-right:100px; padding-left:7px; padding-top:7px; border-radius:13px;"><a href="listenerhome.php" title="home"><img src="images/home (2).ico" height="60" width="60" style="margin-left:7px;"></a></div>
<div id="newprofile" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center"></h2>
	
		<a href="#close" title="Close" class="close">X</a>
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
           
		    <a href="listenerinboxmsg3.php?Receipient=<?php echo $fetch1['Username']; ?>#Profilepicture"><img src="profilepic/<?php echo $fetch1['Img']; ?>"  width="250px" height="250px" class="img" /></a>
 
  <?php
}
}
?>	
 </div>
 </div>
 </div>
         
        
</div>        
<div id="Profilepicture" class="modalDialog">
 <h2 style="color:rgb(255,255,255);" align="center"></h2>
	
		<a href="#close" title="Close" class="close">X</a>
        
        <?php
   $result =  "SELECT * FROM listener_details WHERE Username = '".$_GET['Receipient']."'";
	$run = mysql_query($result) or die(mysql_error());
	
		while($row= mysql_fetch_array($run)){
		?>
        <div style="width:630px; height:100px; background:url(images/img184.JPG); border-top-left-radius:30px;border-top-right-radius:30px; margin-left:310px; margin-top:-0px;">
        <br/>
        <?php echo '<h1 align="center">'.$row["Username"].'</h1>'; ?>
       </div> 
       
       <?php
	   if(!empty($row['Img'])){
		   ?>
   <img src="profilepic/<?php echo $row['Img']; ?>"  width="670px" height="500px" style="float:left; margin-left:310px; margin-top:-5px; z-index:99999;"/>
   
   <?php
	   }}
		?>
 </div>       

</body>
</html>