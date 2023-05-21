<?php 

    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7); // 7 day cookie lifetime
    session_start();

	if(!isset($_SESSION['ascu_online_user_id'])){
        header("location: ../../index");
    }else if ($_SESSION['ascu_online_user_type'] != 0) {
        header("location: ../../index");
    }

    $user_id = $_SESSION['ascu_online_user_id'];
    $user_type = $_SESSION['ascu_online_user_type'];

    //find user
    $identify_user=$link->query("Select * From `gy_user` Where `gy_user_id`='$user_id'");
    $row=$identify_user->fetch_array();

    $user_id = $row['gy_user_id'];
    $user_info = $row['gy_full_name'];
    $user_username = $row['gy_username'];
    $user_codex = $row['gy_user_code'];
    $user_printer = $row['gy_user_printer'];

    $currPage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

?>