<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $productId=@$_GET['productId'];
    $page=@$_GET['page'];
    $pagenum=@$_GET['pn'];
    $search_text=@$_GET['search_text'];

    if ($page == "products") {
        $redirect = "products?pn=$pagenum&";
    } else if ($page == "product_search") {
        $redirect = "product_search?pn=$pagenum&search_text=$search_text&";
    } else {
        $redirect = "products?pn=$pagenum&";
    }

    if (isset($_POST['archive'])) {

        $request=archiveProduct($productId);

        if ($request == true) {
            my_notify(getProductNameById($productId)." has been archived from products" ,$user_info);
            header("location: " . $redirect . "note=archive");
        }else{
            header("location: " . $redirect . "note=error");
        }
    } else {
        header("location: " . $redirect . "note=invalid");
    }
    
?>