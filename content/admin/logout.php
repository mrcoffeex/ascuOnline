<?php 

	include("../../conf/conn.php");
	include("../../conf/function.php");
	include("session.php");

	my_notify("Logout Notification", $user_info);
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<meta http-equiv="refresh" content="1;url=../../">
</head>
<body>
	<div style="margin-top: 100px; text-align: center;">
		<p style="text-transform: uppercase; font-size: 20px; font-weight: bold;">
			saving logs
		</p>
		<img src="../../images/loader.gif" style="width: 75px;" alt="">
	</div>
</body>
</html>