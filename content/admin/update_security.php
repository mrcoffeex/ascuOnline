<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    if(isset($_POST['submitPassword'])){

		$oldPassword = words($_POST['old_password']);
		$pass1 = words($_POST['password1']);
		$pass2 = words($_POST['password2']);

		if (stringContains(basename($_SERVER['HTTP_REFERER']), "?") == true) {
			$updateRedirectTo = removeCharThatStarts(basename($_SERVER['HTTP_REFERER'])."&", "profileUpdateAlert");
		} else {
			$updateRedirectTo = removeCharThatStarts(basename($_SERVER['HTTP_REFERER'])."?", "profileUpdateAlert");
		}

		if (encryptIt($oldPassword) == $row['gy_password']) {
			if (updateUserPassword($user_id, $password) == true) {
				header("location: ".$updateRedirectTo."profileUpdateAlert=passwordUpdate");
			}else{
				header("location: ".$updateRedirectTo."profileUpdateAlert=error");
			}
		} else {
			header("location: ".$updateRedirectTo."profileUpdateAlert=passwordMismatch");
		}
	}
?>