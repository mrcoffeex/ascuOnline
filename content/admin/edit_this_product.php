<?php  
	include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $productId=@$_GET['productId'];
    $page=@$_GET['page'];
    $pagenum=@$_GET['pn'];
    $search_text=@$_GET['search_text'];

    $redirect = "edit_product?productId=$productId&pn=$pagenum&page=$page&search_text=$search_text&";

    //get product data
    $getProduct=selectProduct($productId);
    $product=$getProduct->fetch_array();

    $my_product_code = $product['gy_product_code'];
    $my_product_name = $product['gy_product_name'];
    $my_product_cat = $product['gy_product_cat'];
    $my_product_desc = $product['gy_product_desc'];
    $my_supplier_code = $product['gy_supplier_code'];
    $my_product_price_cap = $product['gy_product_price_cap'];
    $my_product_price_srp = $product['gy_product_price_srp'];
    $my_product_unit = $product['gy_product_unit'];
    $my_product_quantity = $product['gy_product_quantity'];
    $my_product_discount_per = $product['gy_product_discount_per'];
    $my_product_restock_limit = $product['gy_product_restock_limit'];
    $my_convert_item_code = $product['gy_convert_item_code'];
    $my_convert_values = $product['gy_convert_value'];

    //add member
    if (isset($_POST['my_code'])) {
    	//elements
        $my_code = words($_POST['my_code']);
        $my_name = words($_POST['my_name']);
        $my_category = words($_POST['my_category']);
        $my_desc = words($_POST['my_desc']);
        $my_supplier = 0;
        $my_price_cap = words($_POST['my_price_cap']);
        $my_price_srp = words($_POST['my_price_srp']);
        $my_unit = words($_POST['my_unit']);
        $my_quantity = 0;
        $my_limit = words($_POST['my_limit']);
        $my_restock_limit = words($_POST['my_restock_limit']);
        $my_convert_item = words($_POST['my_convert_item']);
        $my_convert_value = words($_POST['my_convert_value']);
        $date_now = date("Y-m-d H:i:s");

        if (checkDuplicate($productId, $my_code) == true){

            header("location: " . $redirect . "note=duplicate");

        }else{

            //update product
            $updateData=updateProduct(
                $productId,
                $my_code,
                $my_category,
                $my_supplier,
                $my_name,
                $my_desc,
                $my_unit,
                $my_price_cap,
                $my_price_srp,
                $my_quantity,
                $my_limit,
                $my_restock_limit,
                $my_convert_item,
                $my_convert_value
            );

            if ($updateData == true) {

                //data here
                $my_a = compare_update($my_product_code , $my_code , "Product Code");
                $my_b = compare_update($my_product_name , $my_name , "Product Description");
                $my_c = compare_update($my_product_cat , $my_category , "Product Category");
                $my_d = compare_update($my_product_desc , $my_desc , "Product Details");
                $my_e = compare_update($my_supplier_code , $my_supplier , "Supplier System ID");
                $my_f = compare_update($my_product_price_cap , $my_price_cap , "Product Capital Price");
                $my_g = compare_update($my_product_price_srp , $my_price_srp , "Product SRP");
                $my_h = compare_update($my_product_unit , $my_unit , "Product Unit");
                $my_i = compare_update($my_product_quantity , $my_quantity , "Quantity");
                $my_j = compare_update($my_product_discount_per , $my_limit , "Discount Limit");
                $my_k = compare_update($my_product_restock_limit , $my_restock_limit , "Restock Limit");
                $my_l = compare_update($my_convert_item_code , $my_convert_item , "Converted Product Code");
                $my_m = compare_update($my_convert_values , $my_convert_value , "Convert Value");

                my_notify($my_product_name." Product Update -> ".$my_a."".$my_b."".$my_c."".$my_d."".$my_e."".$my_f."".$my_g."".$my_h."".$my_i."".$my_j."".$my_k."".$my_l."".$my_m, $user_info);

                header("location: " . $redirect . "note=nice_update");
            }else{
                header("location: " . $redirect . "note=error");
            }
        }
    }
?>