<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Product Archives";

    $note = @$_GET['note'];

    $query_one = "SELECT * From gy_products Where gy_product_archive = 1 Order By gy_product_name ASC";

    $query_two = "SELECT COUNT(gy_product_id) FROM gy_products Where gy_product_archive = 1 Order By gy_product_name ASC";

    $query_three = "SELECT * from gy_products Where gy_product_archive = 1 Order By gy_product_name ASC ";

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
                    <h3 class="page-header"><i class="fa fa-archive"></i> <?= $my_project_header_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Search Engine -->
                            <div class="form-group">
                                <form method="post" enctype="multipart/form-data" action="redirect_manager">
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Search for Product Bar Code/Product Name/Category/Supplier Name/Update Code ..." 
                                    name="archive_search" 
                                    autofocus 
                                    required>
                                </form>
                            </div>
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
                            <span class="text-primary text-bold pull-right"><?= countProductArchives() ?> result(s)</span>
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
                                            <th class="text-center">Retrieve</th>
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
                                            <td class="text-center text-primary p-1"><?= toAlpha($product['gy_product_price_cap']); ?></td>
                                            <td class="p-1"><?= number_format($product['gy_product_price_srp'],2); ?></td>
                                            <td class="p-1"><?= number_format($product['gy_product_discount_per'],2); ?></td>
                                            <td class="text-center p-1"><?= $product['gy_product_unit']; ?></td>
                                            <td class="text-center p-1">
                                                <button 
                                                type="button" 
                                                class="btn btn-success" 
                                                title="click to retrieve product" 
                                                data-target="#ret_<?= $product['gy_product_code']; ?>" 
                                                data-toggle="modal">
                                                    <i class="fa fa-undo fa-fw"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Retrieve -->

                                        <div class="modal fade" id="ret_<?= $product['gy_product_code']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">
                                                            <i class="fa fa-undo fa-fw"></i> Retrieve <?= $product['gy_product_name'] ?>
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="product_retrieve?productId=<?= $product['gy_product_id']; ?>&page=<?= $currPage ?>&pn=<?= $pagenum ?>">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="retrieve" class="btn btn-success btn-block">Retrieve</button>
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
        }else if ($note == "retrieve") {
            echo "
                <script>
                    toastr.success('Product retrieved');
                </script>
            ";
        }else{
            echo "";
        }
    ?>

</body>

</html>
