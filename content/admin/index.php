<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Dashboard";

    $note=@$_GET['note'];

?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'head.php'; ?>
<body>

    <div id="wrapper">

        <?php include 'nav.php'; ?>

        <!-- Modals -->
        <?php include('modal.php');?>
        <?php include('modal_password.php');?> 

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-dashboard"></i> <?= $my_project_header_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-dropbox fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?= RealNumber(countProducts(), 2) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="products" title="click to go to products ...">
                                            <div class="panel-footer">
                                                <span class="pull-left">Products</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-archive fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?= RealNumber(countProductArchives(), 0) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="archives" title="click to go to archives ...">
                                            <div class="panel-footer">
                                                <span class="pull-left">Archives</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel panel-yellow">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-trash fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?= RealNumber(countDeletedItemsToday(), 0) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="deleted_item" title="click to go to deleted items ...">
                                            <div class="panel-footer">
                                                <span class="pull-left">Deleted Items Today</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="list-group" id="auto">
                    </div>
                </div>

                

                <!-- Products Modal -->

                <div class="modal fade" id="products_search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" tabindex="-1" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search fa-fw"></i> Product Search <small style="color: #337ab7;">(press TAB to type/press ENTER to search)</small></h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel-body">
                                    <div class="row">
                                        <form method="post" enctype="multipart/form-data" action="redirect_manager">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="product_search" class="form-control" placeholder="Search for Product Bar Code/Product Name/Category/Supplier Name ..." autofocus required>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <?php  
        if ($note == "error") {
            echo "
                <script>
                    toastr.error('Error');
                </script>
            ";
        }else{
            echo "";
        }
    ?>

    <script type="text/javascript">
        $(document).ready( function(){
            $('#auto').load('refresh');
            refresh();
        });

        function refresh(){
            setTimeout( function(){
                $('#auto').load('refresh');
                refresh();
                }, 1000);
        }
    </script>

</body>

</html>
