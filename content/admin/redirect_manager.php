<?php  
include("../../conf/conn.php");
include("../../conf/function.php");
include("session.php");
include("../../conf/my_project.php");

	$my_project_header_title = "Searching ...";	

	//search product
    if (isset($_POST['product_search'])) {
        $product_search = words($_POST['product_search']);

        if (ctype_space($product_search)) {
            header("location: products?note=invalid");
        }else if ($product_search == "0") {
            header("location: products?note=invalid");
        }else if ($product_search) {
            header("location: product_search?search_text=$product_search");
        }
    }

    //search archive
    if (isset($_POST['archive_search'])) {
        $archive_search = words($_POST['archive_search']);

        if (ctype_space($archive_search)) {
            header("location: archive?note=invalid");
        }else if ($archive_search == "0") {
            header("location: archive?note=invalid");
        }else if ($archive_search) {
            header("location: archive_search?search_text=$archive_search");
        }
    }

    //search suppliers
    if (isset($_POST['supplier_search'])) {
        $supplier_search = words($_POST['supplier_search']);

        if (ctype_space($supplier_search)) {
            header("location: search_suppliers?search_text=mrcoffeex_only_space");
        }else if ($supplier_search == "0") {
            header("location: search_suppliers?search_text=mrcoffeex_only_zero");
        }else if ($supplier_search) {
            header("location: search_suppliers?search_text=$supplier_search");
        }
    }

    //search note custom
    if (isset($_POST['submit_notif_condition'])) {
        $my_condition = words($_POST['my_condition']);
        $my_date_from = words($_POST['my_date_from']);
        $my_date_to = words($_POST['my_date_to']);

        if ($my_condition == "" && $my_date_from == "" && $my_date_to == "") {
            header("location: notification?note=invalid");
        }else{
            header("location: search_note_custom?condition=$my_condition&date_from=$my_date_from&date_to=$my_date_to");
        }
    }

    if (isset($_POST['notif_search'])) {
        $notif_search = words($_POST['notif_search']);

        if (ctype_space($notif_search)) {
            header("location: notification?note=invalid");
        }else if ($notif_search == "0") {
            header("location: notification?note=invalid");
        }else if ($notif_search) {
            header("location: search_note?search_text=$notif_search");
        }
    }

    //print masterlist
    if (isset($_POST['my_cat'])) {
        $my_cat = words($_POST['my_cat']);

        if (ctype_space($my_cat)) {
            header("location: masterlist?search_text=mrcoffeex_only_space");
        }else if ($my_cat == "0") {
            header("location: masterlist?search_text=mrcoffeex_only_zero");
        }else if ($my_cat) {
            header("location: masterlist?search_text=$my_cat");
        }
    }

    if (isset($_POST['search_master'])) {
        $search_master = words($_POST['search_master']);

        if (ctype_space($search_master)) {
            header("location: search_master?search_text=mrcoffeex_only_space");
        }else if ($search_master == "0") {
            header("location: search_master?search_text=mrcoffeex_only_zero");
        }else if ($search_master) {
            header("location: search_master?search_text=$search_master");
        }
    }

    //search deleted item
    if (isset($_POST['deleteitem_btn'])) {
        $d_from = words($_POST['delete_date_search_f']);
        $d_to = words($_POST['delete_date_search_t']);

        if ($d_from == "" || $d_to == "") {
            header("location: deleted_item?note=invalid");
        }else{
            header("location: search_delete_item?datef=$d_from&datet=$d_to");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $my_project_header_title; ?></title>
</head>
<body>
    <center><h1>Searching ...</h1></center>
</body>
</html>