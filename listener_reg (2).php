<?php require_once('connection.php'); ?>

<?php
if(isset($_POST['submit'])){
	
	$role = mysql_real_escape_string($_POST['purpose']);
	$p2 = mysql_real_escape_string($_POST['p2']);
	$name = mysql_real_escape_string($_POST['uname']);
	$n1 = mysql_real_escape_string($_POST['prog1']);
	$n2 = mysql_real_escape_string($_POST['prog2']);
	$n3 = mysql_real_escape_string($_POST['prog3']);
	$n4 = mysql_real_escape_string($_POST['prog4']);
	$n5 = mysql_real_escape_string($_POST['prog5']);
	$n6 = mysql_real_escape_string($_POST['prog6']);
	$n7 = mysql_real_escape_string($_POST['prog7']);
	$utype="Listener";
	$phone = mysql_real_escape_string($_POST['phone']);
	$sex =$_POST['gender'];
	$email = mysql_real_escape_string($_POST['email']);
	$date = date('Y-m-d');
	$insert ="INSERT INTO `listener_details`(`Username`,`Usertype`, `Sex`, `Interest1`, `Interest2`, `Interest3`, `Interest4`, `Interest5`, `Interest6`, `Interest7`, `Telephone`, `Email`, `Password`, `Signup`, `role`) VALUES ('".$name."','".$utype."','".$sex."','".$n1."','".$n2."','".$n3."','".$n4."','".$n5."','".$n6."','".$n7."','".$phone."','".$email."','".$p2."','".$date."','".$role ."')";
	
	
	$run = mysql_query($insert) or die(mysql_error());
	if($run){
		?>
	<script type="text/javascript">
	
		alert("Successfully Registered");
		window.location.href='login.php';
    </script>    
      <?php  
		}else if(!$run){
		?>
     <script type="text/javascript">
	alert("error registering");
		
    </script>   	
	<?php		
			
	echo'<div align="center"><h1>Error registering-Please check and try again!!!</h1> </div>';		
			}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<style>
.con{
	margin-top:30px;
	width:440px;
	
	border-top-right-radius:10px;
	border-top-left-radius:10px;
	background:linear-gradient(rgba(0,0,43,0.5),rgba(102,204,51,0.5));
	height:auto;
	border: 1px solid rgb(0,0,0);
	padding-bottom:20px;
}
.head{
	border-top-right-radius:10px;
	border-top-left-radius:10px;
	background:rgba(0,0,0,0.7);
	margin-top:-22px;}
h1{
	color:rgb(255,255,255);
	padding-top:6px;
}
h4{
	padding-bottom:6px;
}
.rest{
	padding-left:10px;
	padding-right:10px;
	}
.news{
	padding-top:3px;
	padding-bottom:3px;
	background:rgba(0,0,0,0.8);
	color:rgb(255,255,0);
	border:groove 2px #00FF00;
}
.btnSubmit{
	cursor:pointer;
	margin-left:30px;
	margin-right:20px;
	background:linear-gradient(rgba(0,255,0,1),rgba(0,0,0,1));
	width:100px;
	padding-bottom:6px;
	padding-top:6px;
	border-radius:5px;
	color:rgb(255,255,0);
}
.btnReset{
	cursor:pointer;
	background:linear-gradient(rgba(0,255,0,1),rgba(0,0,0,1));
	width:100px;
	padding-bottom:6px;
	padding-top:6px;
	border-radius:5px;
	color:rgb(255,255,0);
	margin-bottom:5px;
	margin-top:5px;
}
.img{
	-webkit-animation: anim 10s infinite linear;
	animation: anim 10s infinite linear;
	-moz-animation: anim 10s infinite linear;
	margin-left:100px;
	margin-top:90px;
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


</head>

<body background="images/creation-1280x720.jpg">
<script type="text/javascript">

function validate(form){
	var uname = document["regform"]["uname"].value;
	var gender = document.getElementsByName('gender');
	var phone = document["regform"]["phone"].value;
	var email = document["regform"]["email"].value;
	var p1 = document["regform"]["p1"].value;
	var p2 = document["regform"]["p2"].value;
	atpos = email.indexOf("@");
         dotpos = email.lastIndexOf(".");
         
        
if(uname == null||uname == ""){
	alert("Please enter your username!!!");
	document.regform.uname.focus();
	return false;
	}
if(email == null){
	alert("Email field can't be empty!!!");
	document.regform.uname.focus();
	return false;
	}	
if(gender.checked == false){
	alert("Please choose your gender!!!");
	document.getElementsByName('gender').focus();
	return false;
	}	
	
if(document.regform.news1.checked ==false&&document.regform.news2.checked ==false&&document.regform.news3.checked ==false&&document.regform.news4.checked ==false&&document.regform.news5.checked ==false&&document.regform.news6.checked ==false&&document.regform.news7.checked ==false&&document.regform.news8.checked ==false) {
			alert('Please choose at least one news category!');
			return false;
		}	
		
if(!phone.match(/^[0-9]+$/)){
	alert('Your phone number must be 10 numeric digits');
	document.getElementsByName('phone').focus();
	return false;
	}	
	
if(phone.length ==""){
	alert('Please enter your phone number!');
	document.getElementsByName('phone').focus();
	return false;
	}	
if(phone.length < 10){
	alert('Your phone number is less than 10 numeric digits!!!');
	document.getElementsByName('phone').focus();
	return false;
	}	
if(phone.length > 10){
	alert('Your phone number is more 10 numeric digits!!!');
	document.getElementsByName('phone').focus();
	return false;
	}			
	 if (atpos < 1 || ( dotpos - atpos < 2 )) 
         {
            alert("Please enter the right email address format")
            document.regform.email.focus() ;
            return false;
         }
	if(p1.length < 8 || p1==""){
		alert("Your password must be at least eight characters")
            document.regform.p1.focus() ;
            return false;
		}
	if(p2.length < p1.length || p2=="" || p2.length  > p1.length || p1 != p2){
		alert("Passwords don\'t match!!!")
            document.regform.p2.focus() ;
            return false;
		
		}	
			return true;	 			
}
</script>
<div align="center">
<div class="con">
<div class="head">
<h1 align="center">Registration Portal</h1>
<h4 align="center" style="color:rgb(255,255,0)"><i>For listeners only</i></h4>
</div>
<div class="rest">
<form action="" method="post" name="regform" onSubmit="if(!validate()){return false;}">
<table cellpadding="10" style="color:rgb(255,255,255);">
<tr><td>Username</td><td><input type="text" name="uname" size="40" required value=""></td></tr>


<tr><td>Sex</td><td><input type="radio" value="Male" name="gender">Male  <input name="gender" type="radio" value="Female">Female</td></tr>


<tr><td>Programs of Interest</td><td><div class="news">
								  <input type="checkbox" value="Business" name="prog1" id="news[]">Business <br/><br/>
                                 
                                  <input type="checkbox" value="Education" name="prog2" id="news[]">Education <br/><br/> 
                                  
                                  <input type="checkbox" value="Entertainment" name="prog3" id="news[]">Showbiz<br/><br/>
                                  
                                  <input type="checkbox" value="Sports" name="prog4" id="news[]">Sports<br/><br/>
                                  
                                  
                                  <input type="checkbox" value="Religion" name="prog5" id="news[]">Christian<br/><br/>
                                 
                                  <input type="checkbox" value="Tech" name="prog6" id="news[]">Tech<br/><br/>
                                  <input type="checkbox" value="News" name="prog7" id="news[]">News
                                  </div>	
</td></tr>


<tr><td>Contact N<u>o</u></td><td><input type="text" name="phone" size="40" required value=""></td></tr>


<tr><td>Email</td><td><input type="email" name="email" size="40" required value=""></td></tr>


<tr><td>Password</td><td><input type="text" name="p1" size="40" required value=""></td></tr>
<tr><td>Repeat Password</td><td><input type="text" name="p2" size="40" required value=""></td></tr>
<tr><td>Purpose</td><td><select name="purpose" required>
<option value="">Please select an option</option>
<option value="Listening">Listening</option>
<option value="Listening & Advertisement">Listening & Advertisement</option>
<option value="Advertisement">Advertisement</option>
</select>
</td></tr>



<tr><td></td><td><input type="submit" name="submit" value="Sign up" class="btnSubmit" onClick="validate()"><input type="reset" value="Reset" style="margin-left:30px;" class="btnReset"></td></tr>
</table>
</form>
</div>

</div>
</div>
</body>
</html>