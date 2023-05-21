<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Deleted Items";

    $note = @$_GET['note'];

    $my_query = "SELECT * From gy_delete Where date(gy_del_date) = CURDATE() ORDER BY gy_del_date ASC";

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
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i> <?php echo $my_project_header_title; ?> <a href="print_del?mode=normal" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=1366,height=768,toolbar=1,resizable=0'); return false;"><button type="button" class="btn btn-success" title="click to print ..."><i class="fa fa-print"></i> Print</button></a></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" id="my_form" action="redirect_manager">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="delete_date_search_f" id="delete_date_search_f" style="border-radius: 0px;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="delete_date_search_t" id="delete_date_search_t" style="border-radius: 0px;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" name="deleteitem_btn" class="btn btn-success" title="click to search"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>                  
                    </div>

                    <div class="row" style="margin-top: 0px;">
                        <div class="col-md-12">

                            <p>Deleted Items <b><?= countDeletedItemsToday() ?></b> result(s)</p>

                            <table class="table table-striped table-bordered table-hover" style="width: 100%; margin-bottom: 20px;">
                                <thead>
                                    <tr>
                                        <th><center>No.</center></th>
                                        <th><center>Date/Time</center></th>
                                        <th><center>Code</center></th>
                                        <th><center>Description</center></th>
                                        <th><center>User</center></th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        //vars
                                        $numrow = 0;
                                        // Select ordered items
                                        $sql_item_detail=$link->query($my_query);

                                        while ($row_item_detail=$sql_item_detail->fetch_array()) {
                                            $numrow++;  

                                            //get user info
                                            $thisuser=$row_item_detail['gy_user_id'];
                                            $getuserinfo=$link->query("SELECT gy_full_name From gy_user Where gy_user_id='$thisuser'"); 
                                            $userinforow=$getuserinfo->fetch_array();       
                                    ?>                  
                                    <tr>
                                        <td style="font-size: 13px;"><center><?php echo $numrow; ?></center></td>
                                        <td style="font-size: 13px;"><center><?php echo date("M d, Y - g:i A", strtotime($row_item_detail['gy_del_date'])); ?></center></td>
                                        <td style="font-size: 13px;"><center><?php echo $row_item_detail['gy_product_code']; ?></center></td>
                                        <td style="font-size: 13px;"><center><?php echo $row_item_detail['gy_product_name']; ?></center></td>
                                        <td style="font-size: 13px;"><center><?php echo $userinforow['gy_full_name']; ?></center></td>
                                    </tr>
                                                
                                <?php } ?>
                                    
                                </tbody>
                            </table>
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
        }else if ($note == "invalid") {
            echo "
                <script>
                    toastr.error('Invalid input');
                </script>
            ";
        }else{
            echo "";
        }
    ?>

</body>

</html>
