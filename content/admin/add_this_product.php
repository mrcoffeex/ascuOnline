<?php  
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");
    
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

        if (checkDuplicate("", $my_code) == true){

            header("location: add_product?note=duplicate");

        }else{
            //insert to database
            $insertData=addProduct(
                $user_id,
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

            if ($insertData == true) {   

                my_notify($my_name." is added to products" ,$user_info);
                header("location: add_product?note=nice");
                        
            }else{
                header("location: add_product?note=error");
            }
        }
    }
?>