<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $productId=@$_GET['productId'];
    $page=@$_GET['page'];
    $pagenum=@$_GET['pn'];
    $search_text=@$_GET['search_text'];

    if ($page == "archives") {
        $redirect = "archives?pn=$pagenum&";
    } else if ($page == "archive_search") {
        $redirect = "archive_search?pn=$pagenum&search_text=$search_text&";
    } else {
        $redirect = "archives?pn=$pagenum&";
    }

    if (isset($_POST['retrieve'])) {

        $request=unarchiveProduct($productId);

        if ($request == true) {
            my_notify(getProductNameById($productId)." has been retrieved from archives" ,$user_info);
            header("location: " . $redirect . "note=retrieve");
        }else{
            header("location: " . $redirect . "note=error");
        }
    } else {
        header("location: " . $redirect . "note=invalid");
    }
    
?>