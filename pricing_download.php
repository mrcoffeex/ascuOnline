<?php
    include("conf/conn.php");
    include("conf/function.php");
    include("conf/my_project.php");

    if (isset($_POST['setting'])) {
        
        $my_secure_pin = words($_POST['pin']);

        if (!empty($my_secure_pin)) {

            $approved_info = by_pin_get_user($my_secure_pin, 'download');
    
            $get_secure_pin=$link->query("SELECT * From gy_optimum_secure Where gy_sec_type='download' AND gy_user_id='$approved_info'");
            $get_values=$get_secure_pin->fetch_array();
    
            if (encryptIt($my_secure_pin) == $get_values['gy_sec_value']) {
                
                $my_category = words($_POST['my_category']);

                if (!empty($my_category)) {

                    header("location: select_category_download?select=$my_category");

                } else {

                    header("location: select_category_download?select=all");

                } 

            }else{
                header("location: select_category_download?note=pin_out");
            }

        }else{
            header("location: select_category_download?note=pin_out");
        }

    } else if (isset($_POST['download_pricing'])) {

        $my_secure_pin = words($_POST['pin']);

        if (!empty($my_secure_pin)) {

            $approved_info = by_pin_get_user($my_secure_pin, 'download');
    
            $get_secure_pin=$link->query("SELECT * From gy_optimum_secure Where gy_sec_type='download' AND gy_user_id='$approved_info'");
            $get_values=$get_secure_pin->fetch_array();
    
            if (encryptIt($my_secure_pin) == $get_values['gy_sec_value']) {
                
                $my_category = words($_POST['my_category']);

                if (!empty($my_category)) {

                    if ($my_category == "7") {
                        $countingDate = date("Y-m-d", strtotime("-7 days"));
                        $filequery = "SELECT 
                                    * 
                                    FROM 
                                    gy_products 
                                    Where 
                                    date(gy_product_update_date) 
                                    BETWEEN
                                    '$countingDate' AND CURDATE()
                                    ORDER BY 
                                    gy_product_id 
                                    ASC";
                    } else if ($my_category == "30") {
                        $countingDate = date("Y-m-d", strtotime("-30 days"));
                        $filequery = "SELECT 
                                    * 
                                    FROM 
                                    gy_products 
                                    Where 
                                    date(gy_product_update_date) 
                                    BETWEEN
                                    '$countingDate' AND CURDATE()
                                    ORDER BY 
                                    gy_product_id 
                                    ASC";
                    } else {
                        $filequery = "SELECT * FROM gy_products ORDER BY gy_product_id ASC";
                    }

                } else {

                    $filequery = "SELECT * FROM gy_products ORDER BY gy_product_id ASC";

                }

                // Fetch records from database 
                $query = $link->query($filequery); 
            
                if($query->num_rows > 0){ 
                    $delimiter = ","; 
                    $filename = $my_category."-pricing-" . date('Y-m-d H-i-s') . ".csv"; 
                    
                    // Create a file pointer 
                    $f = fopen('php://memory', 'w'); 
                    
                    // Set column headers 
                    $fields = array('ID', 'Code', 'Name', 'Description', 'Category', 'Unit', 'CAP', 'SRP', 'DISCOUNT LIMIT', 'ARCHIVE'); 
                    fputcsv($f, $fields, $delimiter); 
                    
                    // Output each row of the data, format line as csv and write to file pointer 
                    while($row = $query->fetch_assoc()){ 
                        
                        $lineData = array($row['gy_product_id'], addCharsAfter($row['gy_product_code'], "_KOPI"), $row['gy_product_name'], $row['gy_product_desc'], $row['gy_product_cat'], $row['gy_product_unit'], $row['gy_product_price_cap'], $row['gy_product_price_srp'], $row['gy_product_discount_per'], $row['gy_product_archive']);

                        fputcsv($f, $lineData, $delimiter); 
                    } 
                    
                    // Move back to beginning of file 
                    fseek($f, 0); 
                    
                    // Set headers to download file rather than displayed 
                    header('Content-Type: text/csv'); 
                    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
                    
                    //output all remaining data on a file pointer 
                    fpassthru($f); 

                    exit; 
                } 

            }else{
                header("location: select_category_download?note=pin_out");
            }

        }else{
            header("location: select_category_download?note=pin_out");
        }

    }    

?>

<!DOCTYPE html>
<html>
<head>
    <title>downloading ...</title>
</head>
<body>
    <center><h1>downloading ...</h1></center>
</body>
</html>