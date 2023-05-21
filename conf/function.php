<?php  
	function encryptIt( $q ) {
	    $cryptKey  = 'Helper4webcall:9997772595';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );

	}

	function decryptIt( $q ) {
	    $cryptKey  = 'Helper4webcall:9997772595';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

	function words($value){

		include("conn.php");
		
		$not_fake = mysqli_real_escape_string($link , $value);

		return $not_fake;
	} 

    function limit_string($name, $limit){

        if (strlen($name) > $limit){
            $name = substr($name, 0, $limit) . '...';
        }else{
            $name = $name;
        }

        return $name;
    }

	function get_curr_age($birthday){
        //values
        $date_now = strtotime(date("Y-m-d"));
        $value = strtotime($birthday);

        //subtract in seconds
        $date_diff = $date_now-$value;
        //convert in days
        $days = $date_diff / 86400;
        //convert in years
        $years = $days / 365.25;

        //result
        $result = floor($years);

        return $result;
    }

    function get_year_two_param($before, $later){
        //values
        $value_one = strtotime($later);
        $value_two = strtotime($before);

        //subtract in seconds
        $date_diff = $value_one-$value_two;
        //convert in days
        $days = $date_diff / 86400;
        //convert in years
        $years = $days / 365.25;

        //result
        $result = floor($years);

        return $result;
    }

    function get_timeage($basetime, $currenttime){
        $secs = $currenttime - $basetime;
        $days = $secs / 86400;

        if ($days < 1 ) {
            $age = 1;
        }else{
            $age = 1 + $days;
        }

        //classify weather day, month or year
        if ($age < 30.5) {
            $creditage = floor($age)." day(s)";
        }else if ($age >= 30.5 && $age < 365.25) {
            $creditage = floor(($age / 30.5))." month(s)";
        }else{
            $creditage = floor(($age / 265.25))." year(s)";
        }

        return $creditage;
    }


    function get_status($stat_val){
    	if ($stat_val == 1) {
    		$your_stat_val = "Member";
    	}else{
    		$your_stat_val = "Non-Member";
    	}

    	return $your_stat_val;
    }

    function my_notify($note_text,$user){

    	include("conn.php");

    	$note_now = date("Y-m-d H:i:s");
    	$my_notification_full = $note_text." by ".$user;
    	
    	//insert to database
    	$insert_data=$link->query("INSERT Into gy_notification(gy_notif_text,gy_notif_date) Values('$my_notification_full','$note_now')");
    }

    function by_pin_get_user($pin, $type){

        include("conn.php");

        $encryptedPin = words(encryptIt($pin));
        
        //get the user id from 
        $getUserId=$link->query("SELECT 
                                gy_user_id 
                                From 
                                gy_optimum_secure 
                                Where 
                                gy_sec_value = '$encryptedPin' AND 
                                gy_sec_type = '$type'");
        $userId=$getUserId->fetch_array();

        return $userId['gy_user_id'];
    }

    function get_days($fromdate, $todate) {
        $fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
        $todate = \DateTime::createFromFormat('Y-m-d', $todate);
        return new \DatePeriod(
            $fromdate,
            new \DateInterval('P1D'),
            $todate->modify('+1 day')
        );
    }

    function data_verify($my_ver_data){
        if ($my_ver_data == "") {
            $my_ver_data_value = "No Data";
        }else{
            $my_ver_data_value = $my_ver_data;
        }

        return $my_ver_data_value;
    }

    function my_rand_str( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function my_rand_NumCaps( $length ) {
        $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function my_rand_int( $length ) {
        $chars = "0123456789";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function toAlpha($number){
        
        $alphabet = array('N', 'S', 'T', 'A', 'R', 'G', 'O', 'L', 'D', 'E');

        $count = count($alphabet);
        if ($number == 10){
            $alpha = "SN";
        } else if ($number <= $count) {
            return $alphabet[$number - 0];
        }
        $alpha = '';
        while ($number > 0) {
            $modulo = ($number - 0) % $count;
            $alpha  = $alphabet[$modulo] . $alpha;
            $number = floor((($number - $modulo) / $count));
        }
        return $alpha;
    }

    function toNumeric($char){

        if ($char == "S") {
            $char = "1";
        } else if ($char == "T") {
            $char = "2";
        } else if ($char == "A") {
            $char = "3";
        } else if ($char == "R") {
            $char = "4";
        } else if ($char == "G") {
            $char = "5";
        } else if ($char == "O") {
            $char = "6";
        } else if ($char == "L") {
            $char = "7";
        } else if ($char == "D") {
            $char = "8";
        } else if ($char == "E") {
            $char = "9";
        } else if ($char == "N") {
            $char = "0";
        } else {
            $char = "-";
        }
        
        return $char;
    }

    function toBeta($string){

        $length = strlen($string);
        $numericResult="";

        for ($i=0; $i<$length; $i++) {
            $numericResult .= toNumeric($string[$i]);
        }

        return $numericResult;

    }

    function RealNumber($value, $decimal){

        if ($value == 0) {
            $res = number_format(0, $decimal);
        } else {
            if ($decimal == "") {
                $res = number_format($value);
            } else {
                $res = number_format($value, $decimal);
            }
        }
        
        return $res;
    }

    function compare_update($old_data, $new_data, $type_data){

        if ($old_data != $new_data) {
            $my_data_res = $type_data." -> ".$new_data." , ";
        }else{
            $my_data_res = "";
        }

        return $my_data_res;
    }

    function dateOnly($datetime){
        
        return date("Y-m-d", strtotime($datetime));

    }

    function proper_date($date){

        $newdate = date("M d Y", strtotime($date));

        return $newdate;
    }

    function properDateWithDay($date){

        $newdate = date("M d Y (l)", strtotime($date));

        return $newdate;
    }

    function proper_time($time){
        
        $newtime = date("g:i A", strtotime($time));

        return $newtime;
    }

    function todayOrBefore($date){

        $dateToday = date("Y-m-d");
        $dateDay = date("Y-m-d", strtotime($date));

        if ($dateDay == $dateToday) {
            $res = date("g:i A", strtotime($date));
        } else {
            $res = date("Md Y g:i A", strtotime($date));
        }
        
        return $res;

    }

    function paymentMethod($var){

        if ($var == 0) {
            $res = "CASH";
        } else if ($var == 1) {
            $res = "CHEQUE";
        } else if ($var == 2) {
            $res = "CARD";
        } else if ($var == 3) {
            $res = "DEPOSIT";
        } else {
            $res = "-";
        }
        
        return $res;

    }

    function getChange($paymentMethod, $change, $royalFee){

        if ($paymentMethod == 1) {
            $res = $change - $royalFee;
        } else {
            $res = $change;
        }
        
        return $res;
    }

    function latest_code($ltable, $lcolumn, $lfirstcount){

        include("conn.php");

        $getlatest=$link->query("SELECT ".$lcolumn." FROM ".$ltable." ORDER BY ".$lcolumn." DESC LIMIT 1");
        $latestrow=$getlatest->fetch_array();
        $countl=$getlatest->num_rows;

        if ($countl == 0) {
            $mylatestcode = $lfirstcount;
        }else{
            $mylatestcode = $latestrow[$lcolumn] + 1;
        }

        return $mylatestcode;
    }

    function checkfile($file){

        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if ($ext == "csv") {
            $r_value = 1;
        }else{
            $r_value = 0;
        }

        return $r_value;
    }

    function none_if_empty($value){

        if ($value == "") {
            $res = "...";
        } else {
            $res = $value;
        }
        
        return $res;
    }

    function replaceIfEmpty($value, $replaceValue){

        if (empty($value)) {
            $res = $replaceValue;
        } else {
            $res = $value;
        }
        
        return $res;
    }

    function stringContains($string, $char){

        if (strpos($string, $char) !== false) {
            return true;
        }else{
            return false;
        }

    }

    function addCharsAfter($string, $chars){

        $res = $string."".$chars;

        return $res;

    }

    function removeCharThatStarts($string, $char){

        $res = substr($string, 0, strpos($string, $char));

        if (empty($res)) {
            return $string;
        } else {
            return $res;
        }

    }

    //methods_user

    function updateUserPassword($userId, $newPassword){

        include 'conn.php';

        $encryptThis = encryptIt($newPassword);

        $statement=$link->query("UPDATE gy_user 
                                SET 
                                gy_password='$encryptThis' 
                                Where 
                                gy_user_id='$userId'");

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function updateUserProfile($name, $newUsername, $userId){

        include 'conn.php';

        $statement=$link->query("UPDATE gy_user 
                                SET 
                                gy_full_name='$name', 
                                gy_username='$newUsername' 
                                Where 
                                gy_user_id='$userId'");
        
        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function updateUserPrinter($printer, $userId){

        include 'conn.php';

        $statement=$link->query("UPDATE gy_user 
                                SET 
                                gy_user_printer='$printer'
                                Where 
                                gy_user_id='$userId'");
        
        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function getUserRole($userType){

        if ($userType == "0") {
            $res = "Administrator";
        }else if ($userType == "1") {
            $res = "Salesman";
        }else if ($userType == "2") {
            $res = "Cashier";
        }else if ($userType == "3") {
            $res = "Moderator";
        }else if ($userType == "4") {
            $res = "Bodega Staff";
        }else if ($userType == "5") {
            $res = "Salesman Encoder";
        }else if ($userType == "6") {
            $res = "Canteen";
        }else{
            $res = "unknown";
        }

        return $res;

    }

    function getUserType($userId){

        include 'conn.php';

        $statement=$link->query("SELECT gy_user_type 
                                FROM
                                gy_user
                                Where 
                                gy_user_id='$userId'");
        
        $res=$statement->fetch_array();

        return $res['gy_user_type'];
    }

    function verifyUserCode($userCode){

        if (empty($userCode)) {
            $res = my_rand_int(8);
        }else{
            $res = $userCode;
        }

        return $res;
    }

    function getUserFullnameById($userid){

        include 'conn.php';

        $statement=$link->query("SELECT gy_full_name From gy_user 
                                Where 
                                gy_user_id='$userid'");
        $res=$statement->fetch_array();

        return $res['gy_full_name'];

    }

    function get_salesman_name($salesmanid){

        include 'conn.php';

        $statement=$link->query("SELECT gy_full_name From gy_user Where gy_user_id='$salesmanid'");
        $res=$statement->fetch_array();

        return $res['gy_full_name'];

    }   

    function count_cat_qty($cat, $date){

        include 'conn.php';

        if (empty($date)) {
            $query = "SELECT 
                    gy_product_id 
                    From 
                    gy_products 
                    Where 
                    gy_product_cat='$cat'";
        } else {
            $query = "SELECT 
                    gy_product_id 
                    From 
                    gy_products 
                    Where 
                    gy_product_cat='$cat'
                    AND
                    date(gy_product_update_date) 
                    BETWEEN
                    '$date' AND CURDATE()";
        }

        $statement=$link->query($query);
        $count=$statement->num_rows;

        return $count;

    }

    function countUsers(){

        include 'conn.php';

        $statement=$link->query("SELECT gy_user_id From gy_user");
        $count=$statement->num_rows;

        return $count - 1;

    }

    function selectCashiers(){

        include 'conn.php';

        $statement=$link->query("SELECT 
                                gy_user_id, 
                                gy_full_name 
                                From 
                                gy_user 
                                Where 
                                gy_user_type = 2 
                                Order By 
                                gy_user_id ASC");
        return $statement;

    }

    //methods_category

    function selectCategories(){

        include 'conn.php';

        $statement=$link->query("SELECT 
                                * 
                                From 
                                gy_category 
                                Order By 
                                gy_cat_id 
                                ASC");
        
        return $statement;

    }

    //methods_supplier

    function countSuppliers(){

        include 'conn.php';

        $statement=$link->query("SELECT gy_supplier_id From gy_supplier");
        $countres=$statement->num_rows;

        return $countres;

    }

    function selectSupplier($supplierCode){

        include 'conn.php';

        $statement=$link->query("SELECT * From gy_supplier
                                Where
                                gy_supplier_code = '$supplierCode'");

        return $statement;

    }

    //methods_products

    function countProducts(){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_id From gy_products Where gy_product_archive = 0");
        $countres=$statement->num_rows;

        return $countres;

    }

    function countProductArchives(){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_id From gy_products Where gy_product_archive = 1");
        $countres=$statement->num_rows;

        return $countres;

    }

    function selectProduct($productId){

        include 'conn.php';

        $statement=$link->query("SELECT * From gy_products
                                Where
                                gy_product_id = '$productId'");
        return $statement;

    }

    function addProductQty($qty, $productId){

        include 'conn.php';

        $statement=$link->query("UPDATE 
                                gy_products 
                                SET 
                                gy_product_quantity = gy_product_quantity + '$qty' 
                                Where 
                                gy_product_id='$productId'");
        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function takeProductQty($qty, $productId){

        include 'conn.php';

        $statement=$link->query("UPDATE 
                                gy_products 
                                SET 
                                gy_product_quantity = gy_product_quantity - '$qty' 
                                Where 
                                gy_product_id='$productId'");
        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function addProductQtyByCode($qty, $productCode){

        include 'conn.php';

        $statement=$link->query("UPDATE 
                                gy_products 
                                SET 
                                gy_product_quantity = gy_product_quantity + '$qty' 
                                Where 
                                gy_product_code='$productCode'");
        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function takeProductQtyByCode($qty, $productCode){

        include 'conn.php';

        $statement=$link->query("UPDATE 
                                gy_products 
                                SET 
                                gy_product_quantity = gy_product_quantity - '$qty' 
                                Where 
                                gy_product_code='$productCode'");
        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function selectProductByCode($productCode){

        include 'conn.php';

        $statement=$link->query("SELECT * From gy_products
                                Where
                                gy_product_code = '$productCode'");
        return $statement;

    }

    function verifyProductById($productId){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_id From gy_products
                                Where
                                gy_product_id = '$productId'");
        $count=$statement->num_rows;

        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    function selectConvertProduct($productId){

        include 'conn.php';

        $statement=$link->query("SELECT
                                gy_product_unit,
                                gy_product_name
                                From 
                                gy_products
                                Where
                                gy_product_id = '$productId'");
        return $statement;

    }

    function disableConvertBtn($productId){

        include 'conn.php';

        $statement=$link->query("SELECT gy_convert_item_code From gy_products
                                Where
                                gy_product_id = '$productId'");
        $res=$statement->fetch_array();

        if (verifyProductById($res['gy_convert_item_code']) == true) {
            $result = "";
        } else {
            $result = "disabled";
        }

        return $result;

    }

    function getConvertProductNameById($productId){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_name From gy_products
                                Where
                                gy_product_id = '$productId'");
        $res=$statement->fetch_array();

        if (empty($res['gy_product_name'])) {
            $result = "product_id";
        } else {
            $result = $res['gy_product_name'];
        }
        
        return $result;

    }

    function getProductNameById($productId){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_name From gy_products
                                Where
                                gy_product_id = '$productId'");
        $res=$statement->fetch_array();

        return $res['gy_product_name'];

    }

    function getProductNameByCode($productcode){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_name From gy_products
                                Where
                                gy_product_code = '$productcode'");
        $res=$statement->fetch_array();

        return $res['gy_product_name'];

    }

    function getProductUnitByCode($productcode){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_unit From gy_products
                                Where
                                gy_product_code = '$productcode'");
        $res=$statement->fetch_array();

        return $res['gy_product_unit'];

    }

    function getProductCategoryByCode($productcode){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_cat From gy_products
                                Where
                                gy_product_code = '$productcode'");
        $res=$statement->fetch_array();

        return $res['gy_product_cat'];

    }

    function getProductSrpByCode($productcode){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_price_srp From gy_products
                                Where
                                gy_product_code = '$productcode'");
        $res=$statement->fetch_array();

        return $res['gy_product_price_srp'];

    }

    function check_productid_exist($id){

        include 'conn.php';

        $statement=$link->query("SELECT gy_product_id From gy_products Where gy_product_id='$id'");
        $countres=$statement->num_rows;

        return $countres;

    }

    function removeProduct($productId, $userId){

        include 'conn.php';

        $getProduct=selectProduct($productId);
        $product=$getProduct->fetch_array();

        $productCode=words($product['gy_product_code']);
        $productName=words($product['gy_product_name']);

        $insertStatement=$link->query("INSERT INTO gy_delete
                                    (
                                        gy_del_date,
                                        gy_product_code,
                                        gy_product_name,
                                        gy_user_id
                                    ) 
                                    Values
                                    (
                                        NOW(),
                                        '$productCode',
                                        '$productName',
                                        '$userId'
                                    )");
        
        if ($insertStatement) {
            $statement=$link->query("DELETE FROM gy_products
                                    Where
                                    gy_product_id = '$productId'");
            
            return true;
        }else{
            return false;
        }

    }
    
    function archiveProduct($productId){

        include 'conn.php';

        $statement=$link->query("UPDATE
                                gy_products
                                SET
                                gy_product_archive = 1
                                Where
                                gy_product_id = '$productId'");
        
        if ($statement) {
            return true;
        } else {
            return false;
        }

    }
    
    function unarchiveProduct($productId){

        include 'conn.php';

        $statement=$link->query("UPDATE
                                gy_products
                                SET
                                gy_product_archive = 0
                                Where
                                gy_product_id = '$productId'");
        
        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    function checkDuplicate($productId, $newProductCode){

        include 'conn.php';

        if (empty($productId)) {
            $queryString = "SELECT gy_product_id From gy_products
                            Where 
                            gy_product_code = '$newProductCode'";
        } else {
            $queryString = "SELECT gy_product_id From gy_products
                            Where
                            gy_product_id != '$productId' AND
                            gy_product_code = '$newProductCode'";
        }

        $statement=$link->query($queryString);
        $count=$statement->num_rows;

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateProduct(
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
        ){

        include 'conn.php';

        $statement=$link->query("UPDATE gy_products 
                                SET 
                                gy_product_code='$my_code',
                                gy_product_cat='$my_category',
                                gy_supplier_code='$my_supplier',
                                gy_product_name='$my_name',
                                gy_product_desc='$my_desc',
                                gy_product_unit='$my_unit',
                                gy_product_price_cap='$my_price_cap',
                                gy_product_price_srp='$my_price_srp',
                                gy_product_quantity='$my_quantity',
                                gy_product_discount_per='$my_limit',
                                gy_product_restock_limit='$my_restock_limit',
                                gy_convert_item_code='$my_convert_item',
                                gy_convert_value='$my_convert_value',
                                gy_product_update_date=NOW() 
                                Where 
                                gy_product_id='$productId'");
        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function addProduct(
            $userId,
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
    ){

        include 'conn.php';

        $statement=$link->query("INSERT INTO 
                                gy_products
                                (
                                    gy_product_code, 
                                    gy_product_cat, 
                                    gy_supplier_code, 
                                    gy_product_name, 
                                    gy_product_desc, 
                                    gy_product_unit, 
                                    gy_product_price_cap, 
                                    gy_product_price_srp, 
                                    gy_product_quantity, 
                                    gy_product_discount_per, 
                                    gy_product_restock_limit, 
                                    gy_product_date_restock, 
                                    gy_product_date_reg, 
                                    gy_added_by,
                                    gy_convert_item_code,
                                    gy_convert_value,
                                    gy_update_code,
                                    gy_product_update_date
                                ) 
                                Values
                                (
                                    '$my_code',
                                    '$my_category',
                                    '$my_supplier',
                                    '$my_name',
                                    '$my_desc',
                                    '$my_unit',
                                    '$my_price_cap',
                                    '$my_price_srp',
                                    '$my_quantity',
                                    '$my_limit',
                                    '$my_restock_limit',
                                    NOW(),
                                    NOW(),
                                    '$userId',
                                    '$my_convert_item',
                                    '$my_convert_value',
                                    0,
                                    NOW()
                                )");

        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function getProductTableSkin($qty, $restockLimitQty){

        if ($qty <= $restockLimitQty) {
            $res = "danger";
        }else{
            $res = "default";
        }
        
        return $res;
    }

    //methods_deleted_item

    function countDeletedItemsToday(){

        include 'conn.php';

        $statement=$link->query("SELECT 
                                gy_del_id
                                FROM
                                gy_delete
                                Where
                                date(gy_del_date) = CURDATE()");
        $count=$statement->num_rows;

        return $count;

    }

    //methods_password_pins

    function getSecValue($userId, $type){

        include 'conn.php';

        $statement=$link->query("SELECT 
                                gy_sec_value 
                                From 
                                gy_optimum_secure
                                Where
                                gy_sec_type='$type' AND 
                                gy_user_id='$userId'");
        $res=$statement->fetch_array();

        return $res['gy_sec_value'];

    }

    function getPinType($type){

        if ($type == 'delete_pin') {

            $res = "Delete PIN";

        }else if ($type == 'delete_product') {

            $res = "Delete Product/Item";

        }else if ($type == 'add_discount') {

            $res = "Add Discount ";
            
        }else if ($type == 'delete_sales') {

            $res = "Void Sale/Transaction";
            
        }else if ($type == 'update_cash') {

            $res = "Update Beginning Balance";
            
        }else if ($type == 'delete_trans') {

            $res = "Void Order List";
            
        }else if ($type == 'remittance') {

            $res = "Add Remittance";
            
        }else if ($type == 'cash_breakdown') {

            $res = "Cash Breakdown";
            
        }else if ($type == 'void_remittance') {

            $res = "Void Remittance";
            
        }else if ($type == 'custom_breakdown') {

            $res = "Custom Breakdown";
            
        }else if ($type == 'expenses') {

            $res = "All Expenses Permission";
            
        }else if ($type == 'ref_rep') {

            $res = "Refund/Replace";
            
        }else if ($type == 'print') {

            $res = "Duplicate Thermal Print ";
            
        }else if ($type == 'restock_pullout_stock_transfer') {

            $res = "Re-Stock/Pull-Out/Stock Transfer ";
            
        }else if ($type == 'users') {

            $res = "System Users ";
            
        }else if ($type == 'delete_supplier') {

            $res = "Delete Supplier ";
            
        }else if ($type == 'void_tra') {

            $res = "TRA Void ";
            
        }else if ($type == 'void_ro') {

            $res = "Request Order Void ";
            
        }else if ($type == 'bodega') {

            $res = "Bodega Permissions";
            
        }else if ($type == 'download') {

            $res = "Download";
            
        }else{
            $res = "Unknown";
            
        }

        return $res;

    }

    function verify_password_pin($pin, $type){

        include 'conn.php';

        $encryptThis = encryptIt($pin);

        $statement=$link->query("SELECT gy_sec_id From gy_optimum_secure
                                Where
                                gy_sec_type = '$type' AND
                                gy_sec_value = '$encryptThis'");
        $countres=$statement->num_rows;

        if ($countres > 0) {
            $res = "success";
        }else{
            $res = "fail";
        }

        return $res;
    }

    //methods_disable
    
    function disableMeOneParams($condition, $conditionColumn, $tableColumn, $table){

        include 'conn.php';

        $statement=$link->query("SELECT ".$tableColumn." From ".$table." Where ".$conditionColumn."='$condition'");
        $res=$statement->fetch_array();

        if ($res[$tableColumn] > 0) {
            $finalres = "";
        } else {
            $finalres = "disabled";
        }

        return $finalres;

    }

    function disableMeTwoParams($condition, $conditionColumn, $condition1, $conditionColumn1, $tableColumn, $table){

        include 'conn.php';

        $statement=$link->query("SELECT ".$tableColumn." From ".$table." Where ".$conditionColumn."='$condition' AND ".$conditionColumn1."='$condition1'");
        $res=$statement->fetch_array();

        if ($res[$tableColumn] > 0) {
            $finalres = "";
        } else {
            $finalres = "disabled";
        }

        return $finalres;

    }
    
    //methods_notification

    function selectNotificationsToday(){

        include 'conn.php';

        $statement=$link->query("SELECT * From gy_notification 
                                Where
                                date(gy_notif_date) = CURDATE()
                                Order By 
                                gy_notif_id 
                                DESC");
        return $statement;

    }
?>