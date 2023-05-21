<?php 

	session_start();

	if(!isset($_SESSION['ascu_online_user_id'])){
        header("location: ../index");
    }else if (!$_SESSION['ascu_online_user_type']) {
        header("location: ../index");
    }

?>