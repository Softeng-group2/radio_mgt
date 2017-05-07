


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Activity Form</title>

<style>
textarea{
	resize:none;
	width:300px;
	height:200px;
	border-radius:3px;
}
table{
	border:0 10px;
}
</style>
</head>

<body>
<form name="eventform" action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month; ?>&day=<?php echo $day; ?>&year=<?php echo $year; ?>&v=true&add=true" method="post">
<table cellpadding="10">
<tr><th colspan="2"><h2 align="center">Enter event details here</h2></th></tr>
<tr><td>Title</td><td><input type="text" name="title" value="" style="width:300px; padding-bottom:5px; padding-top:5px;" required></td></tr>
<tr><td>Details</td><td><textarea name="details" required></textarea></td></tr>
<tr><td></td><td><input type="submit" name="send" value="Upload" style="margin-right:30px; width:120px; border-top-left-radius:30px; border-top-right-radius:30px; background:linear-gradient(rgba(247,247,247,1),rgba(249,216,191,1)); cursor:pointer; padding-top:9px;outline:none; border:none; padding-bottom:9px;"><input type="reset" style=" width:120px; border-top-left-radius:30px; border-top-right-radius:30px; background:linear-gradient(rgba(247,247,247,1),rgba(249,216,191,1)); cursor:pointer; padding-top:9px; padding-bottom:9px; outline:none; border:none;"></td></tr>
</table>
</form>
</body>
</html>