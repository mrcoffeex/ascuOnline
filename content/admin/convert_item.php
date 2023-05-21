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

    //get product data
    $getProduct=selectProduct($productId);
    $product=$getProduct->fetch_array();

    $productCode = $product['gy_product_code'];
    $productName = $product['gy_product_name'];
    $productUnit = $product['gy_product_unit'];

    //get convert item values
    $getConvertedProduct=selectProduct($product['gy_convert_item_code']);
    $convertedProduct=$getConvertedProduct->fetch_array();

    $convertid = $convertedProduct['gy_product_id'];
    $convertName = $convertedProduct['gy_product_name'];
    $convertUnit = $convertedProduct['gy_product_unit'];

    //add member
    if (isset($_POST['submit_convert'])) {

    	$my_quantity = words($_POST['my_quantity']);
    	$my_convert_quantity = words($_POST['my_convert_quantity']);

    	//deduct the items from origin item
    	$takeItem=takeProductQty($my_quantity, $productId);

    	//add the items to convert item
    	$addItem=addProductQty($my_convert_quantity, $convertid);

    	if ($takeItem == true && $addItem == true) {
            my_notify($productName." converted ".$my_quantity." ".$productUnit." to ".$my_convert_quantity." ".$convertUnit." of ".$convertName ,$user_info);
    		header("location: " . $redirect . "note=converted");
    	}else{
    		header("location: " . $redirect . "note=error");
    	}
    }
?>