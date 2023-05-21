<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Products";

    $note = @$_GET['note'];

    $query_one = "SELECT * From gy_products Where gy_product_archive = 0 Order By gy_product_name ASC";

    $query_two = "SELECT COUNT(gy_product_id) FROM gy_products Where gy_product_archive = 0 Order By gy_product_name ASC";

    $query_three = "SELECT * from gy_products Where gy_product_archive = 0 Order By gy_product_name ASC ";

    $my_num_rows = 50;

    include 'my_pagination.php';
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'head.php'; ?>
<body>

    <div id="wrapper">

        <?php include 'nav.php'; ?>

        <!-- Modals -->
        <?php include('modal.php'); ?>
        <?php include('modal_password.php'); ?> 

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-dropbox"></i> <?= $my_project_header_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Search Engine -->
                            <div class="form-group">
                                <form method="post" enctype="multipart/form-data" action="redirect_manager">
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Search for Product Bar Code/Product Name/Category/Supplier Name/Update Code ..." 
                                    name="product_search" 
                                    autofocus 
                                    required>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Buttons -->
                            <a href="add_product">
                                <button type="button" class="btn btn-primary">
                                    <i class="fa fa-plus fa-fw"></i> Add New Product
                                </button>
                            </a>
                             &nbsp;
                            <a 
                                href="select_category_download" 
                                onclick="
                                window.open(this.href, 'mywin', 'left=20, top=20, width=1280, height=720, toolbar=1, resizable=0'); return false;">
                                <button type="button" class="btn btn-success">
                                    <i class="fa fa-download fa-fw"></i> Download Pricing
                                </button>
                            </a>
                             &nbsp;
                            <a 
                                href="archives">
                                <button type="button" class="btn btn-warning">
                                    <i class="fa fa-archive fa-fw"></i> Archives
                                </button>
                            </a>
                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <ul class="pagination">
                                    <?= $paginationCtrls; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Static Data
                            <span class="text-primary text-bold pull-right"><?= countProducts() ?> result(s)</span>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Category</th>
                                            <th>Description</th>
                                            <th class="text-center text-primary">CAP</th>
                                            <th>SRP</th>
                                            <th>LIMIT</th>
                                            <th class="text-center">Unit</th>
                                            <th class="text-center">Convert</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Archive</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php  
                                        while ($product=$query->fetch_array()) {
                                    ?>

                                        <tr>
                                            <td class="text-center p-1">
                                                <a href="product_details?productId=<?= $product['gy_product_id']; ?>" 
                                                    title="click to view sold history ..." 
                                                    onclick="window.open(this.href, 'mywin', 'left=20, top=20, width=1280, height=720, toolbar=1, resizable=0'); return false;">
                                                    <button 
                                                    type="button" 
                                                    class="btn btn-primary" 
                                                    title="click to see product details">
                                                        <i class="fa fa-list fa-fw"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td class="text-center text-bold p-1"><?= $product['gy_product_code']; ?></td>
                                            <td class="text-center p-1"><?= $product['gy_product_cat']; ?></td>
                                            <td class="p-1"><?= $product['gy_product_name']; ?></td>
                                            <td class="text-center text-primary p-1"><?= RealNumber($product['gy_product_price_cap'], 2); ?></td>
                                            <td class="p-1"><?= number_format($product['gy_product_price_srp'],2); ?></td>
                                            <td class="p-1"><?= number_format($product['gy_product_discount_per'],2); ?></td>
                                            <td class="text-center p-1"><?= $product['gy_product_unit']; ?></td>
                                            <td class="text-center p-1">
                                                <button 
                                                type="button" 
                                                class="btn btn-success" 
                                                title="click to convert product" 
                                                data-target="#convert_<?= $product['gy_product_code']; ?>" 
                                                data-toggle="modal" 
                                                <?= disableConvertBtn($product['gy_convert_item_code']) ?> >
                                                    <i class="fa fa-recycle fa-fw"></i>
                                                </button>
                                            </td>
                                            <td class="text-center p-1">
                                                <a href="edit_product?productId=<?= $product['gy_product_id']; ?>&page=<?= $currPage ?>&pn=<?= $pagenum ?>">
                                                    <button 
                                                    type="button" 
                                                    class="btn btn-info" 
                                                    title="click to edit product details">
                                                        <i class="fa fa-edit fa-fw"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td class="text-center p-1">
                                                <button 
                                                type="button" 
                                                class="btn btn-warning" 
                                                title="click to acrhieve product" 
                                                data-target="#arc_<?= $product['gy_product_code']; ?>" 
                                                data-toggle="modal">
                                                    <i class="fa fa-archive fa-fw"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Convert Modal -->

                                        <div class="modal fade" id="convert_<?= $product['gy_product_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Convert <u><?= $product['gy_product_name']; ?></u></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="convert_item?productId=<?= $product['gy_product_id']; ?>&page=<?= $currPage ?>&pn=<?= $pagenum ?>">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <?php  
                                                                        //get the item name and unit
                                                                        $getConvertedItem=selectConvertProduct($product['gy_convert_item_code']);
                                                                        $convertedItem=$getConvertedItem->fetch_array();
                                                                    ?>
                                                                    <label>Convert To - <span class="text-primary"><?= $convertedItem['gy_product_name']; ?></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>QTY <span class="text-primary"><?= $product['gy_product_unit']; ?></span></label>
                                                                        <input type="number" min="0" step="0.01" max="<?= $product['gy_product_quantity']; ?>" name="my_quantity" id="quan_<?= $product['gy_product_code']; ?>" class="form-control" placeholder="number only ..." onkeyup="con_<?= $product['gy_product_code']; ?>()" autofocus required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Converted QTY <span class="text-primary"><?= $convertedItem['gy_product_unit']; ?></span></label>
                                                                        <input type="number" min="0" step="0.01" name="my_convert_quantity" id="conval_<?= $product['gy_product_code']; ?>" class="form-control" placeholder="number only ..." readonly required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <button type="submit" name="submit_convert" class="btn btn-success" title="click to convert ...">Convert <i class="fa fa-chevron-right fa-fw"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            function con_<?= $product['gy_product_id'] ?>(){

                                                var my_quantity = document.getElementById("quan_<?= $product['gy_product_code'] ?>").value;

                                                var final_quantity = parseFloat(my_quantity) * parseFloat(<?= $product['gy_convert_value'] ?>);

                                                if (!isNaN(final_quantity)) {
                                                    document.getElementById("conval_<?= $product['gy_product_code'] ?>").value = final_quantity;
                                                }
                                            }
                                        </script>

                                        <!-- Delete -->

                                        <div class="modal fade" id="arc_<?= $product['gy_product_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            <i class="fa fa-archive fa-fw"></i> Arhieve <?= $product['gy_product_name'] ?>
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="product_archive?productId=<?= $product['gy_product_id']; ?>&page=<?= $currPage ?>&pn=<?= $pagenum ?>">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="archive" class="btn btn-warning btn-block">Archive</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <ul class="pagination">
                                    <?= $paginationCtrls; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <?php  
        if ($note == "nice_update") {
            echo "
                <script>
                    toastr.success('Changes saved');
                </script>
            ";
        }else if ($note == "error") {
            echo "
                <script>
                    toastr.error('Error');
                </script>
            ";
        }else if ($note == "invalid") {
            echo "
                <script>
                    toastr.error('Invalid input');
                </script>
            ";
        }else if ($note == "restock") {
            echo "
                <script>
                    toastr.success('Product restocked');
                </script>
            ";
        }else if ($note == "converted") {
            echo "
                <script>
                    toastr.success('Product converted');
                </script>
            ";
        }else if ($note == "pullout") {
            echo "
                <script>
                    toastr.success('Product pulled out');
                </script>
            ";
        }else if ($note == "pin_out") {
            echo "
                <script>
                    toastr.error('Incorrect PIN');
                </script>
            ";
        }else if ($note == "delete") {
            echo "
                <script>
                    toastr.success('Product deleted');
                </script>
            ";
        }else if ($note == "archive") {
            echo "
                <script>
                    toastr.success('Product archived');
                </script>
            ";
        }else{
            echo "";
        }
    ?>

</body>

</html>
