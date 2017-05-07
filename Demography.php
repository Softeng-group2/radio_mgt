<?php require_once('../Connections/se.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "demographic_details")) {
  $insertSQL = sprintf("INSERT INTO staff_and_management_demographic_details (Name, Date_of_birth, Gender, Email_Address, Contact_No, Nationality, Religion, Marital_status, Hometown, Place_of_birth, National_ID_type, National_ID_No, Postal_Address) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['uname'], "text"),
                       GetSQLValueString($_POST['dob'], "text"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['con'], "int"),
                       GetSQLValueString($_POST['nation'], "text"),
                       GetSQLValueString($_POST['religion'], "text"),
                       GetSQLValueString($_POST['marital'], "text"),
                       GetSQLValueString($_POST['ht'], "text"),
                       GetSQLValueString($_POST['pob'], "text"),
                       GetSQLValueString($_POST['id_type'], "text"),
                       GetSQLValueString($_POST['idno'], "text"),
                       GetSQLValueString($_POST['addr'], "text"));

  mysql_select_db($database_se, $se);
  $Result1 = mysql_query($insertSQL, $se) or die(mysql_error());

  $insertGoTo = "WorkDetails.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  if( $Result1){
	?>
    <script type="text/javascript">
	alert("Demographic details successfully submitted - Now to the work details");
	</script>
    <?php  
	
	$msg ='<div align="center">
<div style="width:200px; height:100px; background:rgba(0,0,0,0.6); color:rgb(255,255,255); font-size:24px; padding-bottom:5px; padding-top:5px; padding-left:5px; padding-right:5px;">Demographic details successfully submitted - Now to the work details</div></div>';
	
  header("Location: WorkDetails.php?Message1=".urlencode($msg));
  }
}
if(isset($_GET['Message'])){
	
	print $_GET['Message'];
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Staff Demographic Details</title>
<style>
.txtbox{
	height:27px;
	width:400px;
	border-radius:5px;
}
table{
	border-spacing:5px 5px;
}
.radio{
	height:21px;
	width:30px;
	}
.radio:focus{
	color:rgb(255,255,255);
}
input:focus{
border-radius:5px;
}
td{
	background:linear-gradient(rgba(0,51,204,0.6),rgba(102,51,204,0.6));
	color:rgb(255,255,255);
	padding-bottom:5px;
	padding-left:5px;
	padding-right:5px;
	padding-top:5px;
}

table{
	background:rgba(0,51,204,0.4);
}
h2{
	color:rgb(255,255,255);
}
body{
	background-size:cover;
}
div{
	padding-bottom:10px;
}
.btn{
	padding-top:5px;
	padding-bottom:5px;
	padding-left:5px;
	padding-right:5px;
	width:120px;
	border-radius:7px;
	background:linear-gradient(rgba(0,51,204,0.6),rgba(102,51,204,0.6));
	cursor:pointer;
	color:rgb(255,255,255);
}
.btn:hover{
	box-shadow:2px 3px 4px 5px rgba(255,255,255,0.7);
}
.btn:focus{
	outline:none;
}
</style>
</head>

<body background="images/img183.jpg">

<h2 align="center" >Demographic Details <a href="adminhome.php"><img src="images/home.jpg" height="20" width="20" style="margin-top:-5px; margin-left:30px;"></a></h2>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" width="45%">
<form action="<?php echo $editFormAction; ?>" method="POST" name="demographic_details">
<tr><td>Name</td>
<td><input type="text" name="uname" value="" class="txtbox" required></td></tr>
<tr><td>Gender</td>
<td><input type="radio" value="Male" name="Gender" class="radio" autofocus required>Male 
<input type="radio" value="Female" name="Gender" class="radio">Female</td></tr>
<tr><td>Date of Birth</td>
<td><input type="date" name="dob" value="" class="txtbox" required></td></tr>
<tr><td>Nationality</td>
<td><select name="nation" class="txtbox" required>
 <option value="">-- select one --</option>
  <option value="afghan">Afghan</option>
  <option value="albanian">Albanian</option>
  <option value="algerian">Algerian</option>
  <option value="american">American</option>
  <option value="andorran">Andorran</option>
  <option value="angolan">Angolan</option>
  <option value="antiguans">Antiguans</option>
  <option value="argentinean">Argentinean</option>
  <option value="armenian">Armenian</option>
  <option value="australian">Australian</option>
  <option value="austrian">Austrian</option>
  <option value="azerbaijani">Azerbaijani</option>
  <option value="bahamian">Bahamian</option>
  <option value="bahraini">Bahraini</option>
  <option value="bangladeshi">Bangladeshi</option>
  <option value="barbadian">Barbadian</option>
  <option value="barbudans">Barbudans</option>
  <option value="batswana">Batswana</option>
  <option value="belarusian">Belarusian</option>
  <option value="belgian">Belgian</option>
  <option value="belizean">Belizean</option>
  <option value="beninese">Beninese</option>
  <option value="bhutanese">Bhutanese</option>
  <option value="bolivian">Bolivian</option>
  <option value="bosnian">Bosnian</option>
  <option value="brazilian">Brazilian</option>
  <option value="british">British</option>
  <option value="bruneian">Bruneian</option>
  <option value="bulgarian">Bulgarian</option>
  <option value="burkinabe">Burkinabe</option>
  <option value="burmese">Burmese</option>
  <option value="burundian">Burundian</option>
  <option value="cambodian">Cambodian</option>
  <option value="cameroonian">Cameroonian</option>
  <option value="canadian">Canadian</option>
  <option value="cape verdean">Cape Verdean</option>
  <option value="central african">Central African</option>
  <option value="chadian">Chadian</option>
  <option value="chilean">Chilean</option>
  <option value="chinese">Chinese</option>
  <option value="colombian">Colombian</option>
  <option value="comoran">Comoran</option>
  <option value="congolese">Congolese</option>
  <option value="costa rican">Costa Rican</option>
  <option value="croatian">Croatian</option>
  <option value="cuban">Cuban</option>
  <option value="cypriot">Cypriot</option>
  <option value="czech">Czech</option>
  <option value="danish">Danish</option>
  <option value="djibouti">Djibouti</option>
  <option value="dominican">Dominican</option>
  <option value="dutch">Dutch</option>
  <option value="east timorese">East Timorese</option>
  <option value="ecuadorean">Ecuadorean</option>
  <option value="egyptian">Egyptian</option>
  <option value="emirian">Emirian</option>
  <option value="equatorial guinean">Equatorial Guinean</option>
  <option value="eritrean">Eritrean</option>
  <option value="estonian">Estonian</option>
  <option value="ethiopian">Ethiopian</option>
  <option value="fijian">Fijian</option>
  <option value="filipino">Filipino</option>
  <option value="finnish">Finnish</option>
  <option value="french">French</option>
  <option value="gabonese">Gabonese</option>
  <option value="gambian">Gambian</option>
  <option value="georgian">Georgian</option>
  <option value="german">German</option>
  <option value="ghanaian">Ghanaian</option>
  <option value="greek">Greek</option>
  <option value="grenadian">Grenadian</option>
  <option value="guatemalan">Guatemalan</option>
  <option value="guinea-bissauan">Guinea-Bissauan</option>
  <option value="guinean">Guinean</option>
  <option value="guyanese">Guyanese</option>
  <option value="haitian">Haitian</option>
  <option value="herzegovinian">Herzegovinian</option>
  <option value="honduran">Honduran</option>
  <option value="hungarian">Hungarian</option>
  <option value="icelander">Icelander</option>
  <option value="indian">Indian</option>
  <option value="indonesian">Indonesian</option>
  <option value="iranian">Iranian</option>
  <option value="iraqi">Iraqi</option>
  <option value="irish">Irish</option>
  <option value="israeli">Israeli</option>
  <option value="italian">Italian</option>
  <option value="ivorian">Ivorian</option>
  <option value="jamaican">Jamaican</option>
  <option value="japanese">Japanese</option>
  <option value="jordanian">Jordanian</option>
  <option value="kazakhstani">Kazakhstani</option>
  <option value="kenyan">Kenyan</option>
  <option value="kittian and nevisian">Kittian and Nevisian</option>
  <option value="kuwaiti">Kuwaiti</option>
  <option value="kyrgyz">Kyrgyz</option>
  <option value="laotian">Laotian</option>
  <option value="latvian">Latvian</option>
  <option value="lebanese">Lebanese</option>
  <option value="liberian">Liberian</option>
  <option value="libyan">Libyan</option>
  <option value="liechtensteiner">Liechtensteiner</option>
  <option value="lithuanian">Lithuanian</option>
  <option value="luxembourger">Luxembourger</option>
  <option value="macedonian">Macedonian</option>
  <option value="malagasy">Malagasy</option>
  <option value="malawian">Malawian</option>
  <option value="malaysian">Malaysian</option>
  <option value="maldivan">Maldivan</option>
  <option value="malian">Malian</option>
  <option value="maltese">Maltese</option>
  <option value="marshallese">Marshallese</option>
  <option value="mauritanian">Mauritanian</option>
  <option value="mauritian">Mauritian</option>
  <option value="mexican">Mexican</option>
  <option value="micronesian">Micronesian</option>
  <option value="moldovan">Moldovan</option>
  <option value="monacan">Monacan</option>
  <option value="mongolian">Mongolian</option>
  <option value="moroccan">Moroccan</option>
  <option value="mosotho">Mosotho</option>
  <option value="motswana">Motswana</option>
  <option value="mozambican">Mozambican</option>
  <option value="namibian">Namibian</option>
  <option value="nauruan">Nauruan</option>
  <option value="nepalese">Nepalese</option>
  <option value="new zealander">New Zealander</option>
  <option value="ni-vanuatu">Ni-Vanuatu</option>
  <option value="nicaraguan">Nicaraguan</option>
  <option value="nigerien">Nigerien</option>
  <option value="north korean">North Korean</option>
  <option value="northern irish">Northern Irish</option>
  <option value="norwegian">Norwegian</option>
  <option value="omani">Omani</option>
  <option value="pakistani">Pakistani</option>
  <option value="palauan">Palauan</option>
  <option value="panamanian">Panamanian</option>
  <option value="papua new guinean">Papua New Guinean</option>
  <option value="paraguayan">Paraguayan</option>
  <option value="peruvian">Peruvian</option>
  <option value="polish">Polish</option>
  <option value="portuguese">Portuguese</option>
  <option value="qatari">Qatari</option>
  <option value="romanian">Romanian</option>
  <option value="russian">Russian</option>
  <option value="rwandan">Rwandan</option>
  <option value="saint lucian">Saint Lucian</option>
  <option value="salvadoran">Salvadoran</option>
  <option value="samoan">Samoan</option>
  <option value="san marinese">San Marinese</option>
  <option value="sao tomean">Sao Tomean</option>
  <option value="saudi">Saudi</option>
  <option value="scottish">Scottish</option>
  <option value="senegalese">Senegalese</option>
  <option value="serbian">Serbian</option>
  <option value="seychellois">Seychellois</option>
  <option value="sierra leonean">Sierra Leonean</option>
  <option value="singaporean">Singaporean</option>
  <option value="slovakian">Slovakian</option>
  <option value="slovenian">Slovenian</option>
  <option value="solomon islander">Solomon Islander</option>
  <option value="somali">Somali</option>
  <option value="south african">South African</option>
  <option value="south korean">South Korean</option>
  <option value="spanish">Spanish</option>
  <option value="sri lankan">Sri Lankan</option>
  <option value="sudanese">Sudanese</option>
  <option value="surinamer">Surinamer</option>
  <option value="swazi">Swazi</option>
  <option value="swedish">Swedish</option>
  <option value="swiss">Swiss</option>
  <option value="syrian">Syrian</option>
  <option value="taiwanese">Taiwanese</option>
  <option value="tajik">Tajik</option>
  <option value="tanzanian">Tanzanian</option>
  <option value="thai">Thai</option>
  <option value="togolese">Togolese</option>
  <option value="tongan">Tongan</option>
  <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
  <option value="tunisian">Tunisian</option>
  <option value="turkish">Turkish</option>
  <option value="tuvaluan">Tuvaluan</option>
  <option value="ugandan">Ugandan</option>
  <option value="ukrainian">Ukrainian</option>
  <option value="uruguayan">Uruguayan</option>
  <option value="uzbekistani">Uzbekistani</option>
  <option value="venezuelan">Venezuelan</option>
  <option value="vietnamese">Vietnamese</option>
  <option value="welsh">Welsh</option>
  <option value="yemenite">Yemenite</option>
  <option value="zambian">Zambian</option>
  <option value="zimbabwean">Zimbabwean</option>
</select>
</td></tr>
<tr><td>Religion</td>
<td>
<select name="religion" class="txtbox" required>
<option value="">-- select one --</option>
<option value="African Traditional & Diasporic">African Traditional & Diasporic</option>
  <option value="Agnostic">Agnostic</option>
  <option value="Atheist">Atheist</option>
  <option value="Baha'i">Baha'i</option>
  <option value="Buddhism">Buddhism</option>
  <option value="Cao Dai">Cao Dai</option>
  <option value="Chinese traditional religion">Chinese traditional religion</option>
  <option value="Christianity">Christianity</option>
  <option value="Confucianism">Confucianism</option>
  <option value="Hinduism">Hinduism</option>
  <option value="Islam">Islam</option>
  <option value="Jainism">Jainism</option>
  <option value="Juche">Juche</option>
  <option value="Judaism">Judaism</option>
  <option value="Neo-Paganism">Neo-Paganism</option>
  <option value="Nonreligious">Nonreligious</option>
  <option value="Rastafarianism">Rastafarianism</option>
  <option value="Secular">Secular</option>
  <option value="Shinto">Shinto</option>
  <option value="Sikhism">Sikhism</option>
  <option value="Spiritism">Spiritism</option>
  <option value="Tenrikyo">Tenrikyo</option>
  <option value="Unitarian-Universalism">Unitarian-Universalism</option>
  <option value="Zoroastrianism">Zoroastrianism</option>
  <option value="primal-indigenous">primal-indigenous</option>
  <option value="Other">Other</option>
</select>
</td></tr>
<tr><td>Marital Status</td>
<td>
<input type="radio" value="Male" name="marital" class="radio" required>Single 
<input type="radio" value="Female" name="marital" class="radio">Married
<input type="radio" value="Female" name="marital" class="radio">Divorced
</td></tr>
<tr><td>Hometown</td>
<td><input type="text" name="ht" value="" class="txtbox" required></td></tr>
<tr><td>Place of Birth</td>
<td><input type="text" name="pob" value="" class="txtbox" required></td></tr>
<tr><td>Postal Address</td>
<td><input type="text" name="addr" value="" class="txtbox" required></td></tr>
<tr><td>Contact Number</td>
<td><input type="text" name="con" value="" class="txtbox"></td></tr>
<tr><td>Email Address</td>
<td><input type="email" name="email" value="" class="txtbox"></td></tr>
<tr><td>National ID type</td>
<td>
<input type="radio" style="margin-left:10px;" name="id_type" value="NHIS ID" class="radio">NHIS ID 
<br/><input type="radio" style="margin-left:10px;" name="id_type" value="Voters ID" class="radio">Voters ID 
<br/> <input type="radio" style="margin-left:10px;" name="id_type" value="National ID" class="radio">National ID
 <br/> <input type="radio" style="margin-left:10px;" name="id_type" value="Driver's License" class="radio">Drivers' License
 <br/> <input type="radio" style="margin-left:10px;" name="id_type" value="Passport ID" class="radio">Passport ID &nbsp;&nbsp;

</td></tr>
<tr><td>ID Number</td>
<td><input type="text" name="idno" value="" class="txtbox"></td></tr>

<tr><td></td><td colspan="2"><input type="submit" name="submit" value="Submit" class="btn"><input type="reset" value="Reset" style="margin-left:50px;" class="btn"></td></tr>
<input type="hidden" name="MM_insert" value="demographic_details">
</form>
</table>
</div>




</body>
</html>