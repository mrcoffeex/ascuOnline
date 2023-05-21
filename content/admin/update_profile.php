<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    //update profile data
    if (isset($_POST['update_profile'])) {
    	//vars
    	$my_acc_name = words($_POST['my_acc_name']);
    	$my_prof_username = words($_POST['my_prof_username']);

		if (stringContains(basename($_SERVER['HTTP_REFERER']), "?") == true) {
			$updateRedirectTo = removeCharThatStarts(basename($_SERVER['HTTP_REFERER'])."&", "profileUpdateAlert");
		} else {
			$updateRedirectTo = removeCharThatStarts(basename($_SERVER['HTTP_REFERER'])."?", "profileUpdateAlert");
		}

    	if (updateUserProfile($my_acc_name, $my_prof_username, $user_id) == true) {
            my_notify("User Data Updated!", $user_info);
            header("location: ".$updateRedirectTo."profileUpdateAlert=profileUpdate");
    	}else{
            header("location: ".$updateRedirectTo."profileUpdateAlert=error");
    	}
    }
?>