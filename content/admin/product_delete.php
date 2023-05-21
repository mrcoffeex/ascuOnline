<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $productId=@$_GET['productId'];

    $productName = getProductNameById($productId);
    
    //delete query
    $request=removeProduct($productId, $user_id);

    if ($request == true) {
        my_notify($productName . " has been removed from products" ,$user_info);
        //close the page
        echo "'<script>window.close();</script>'";
    }else{
        header("location: product_details?note=error");
    }
?>