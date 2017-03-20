<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Host</title>
<style>
table{
	/*border-spacing:10px 10px;
	background:rgb(204,255,204);*/
	float:right;
}
th{
	background:rgb(204,255,0);
}
.input{
	height:33px;
	border-radius:15px;
}
input:focus{
	outline:none;
}

</style>
</head>

<body>
<table  border="0" cellpadding="10" cellspacing="1" width="30%" style="border:3px groove rgb(102,255,255)">
<tr style="background:rgb(204,255,0);"><th colspan="2">Enter Topics to be discussed here</th></tr>
<form action="ProgramLineUp.php" method="post">
<tr ><td style="background:rgb(204,255,153);">Topic 1</td><td style="background:rgb(204,255,255);"><input type="text" name="t1" size="33" class="input"></td></tr>
<tr><td style="background:rgb(204,255,153);">Topic 2</td><td style="background:rgb(204,255,255);"><input type="text" name="t2" size="33" class="input"></td></tr>
<tr><td style="background:rgb(204,255,153);">Topic 3</td><td style="background:rgb(204,255,255);"><input type="text" name="t3" size="33" class="input"></td></tr>
<tr><td style="background:rgb(204,255,153);">Topic 4</td><td style="background:rgb(204,255,255);"><input type="text" name="t4" size="33"  class="input"></td></tr>
<tr><td style="background:rgb(204,255,153);">Topic 5</td><td style="background:rgb(204,255,255);"><input type="text" name="t5" size="33" class="input"></td></tr>
<tr><td style="background:rgb(204,255,153);">Topic 6</td><td style="background:rgb(204,255,255);"><input type="text" name="t6" size="33" class="input"></td></tr>
<tr style="display:none;"><td>Host</td><td><input type="text" name="host" value=""></td></tr>
<tr style="display:none;"><td>Date</td><td><input type="text" name="date" value="<?php echo date("Y-m-d"); ?>"></td></tr>
<tr ><td style="background:rgb(204,255,0);" colspan="2"><input type="submit" name="submit" value="GO !" style="background:rgb(0,0,0); color:rgb(204,255,0); border:1px #000000; cursor:pointer;" class="input"><input type="reset" value="Reset" style="margin-left:30px; background:rgb(0,0,0); color:rgb(204,255,0); border:1px #000000; cursor:pointer;" class="input"></td></tr>
</form>
</table>

</body>
</html>