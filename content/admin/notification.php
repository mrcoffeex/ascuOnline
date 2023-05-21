
<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Notifications";
    $note=@$_GET['note'];

    $getNotifications=selectNotificationsToday();
    $count=$getNotifications->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<body>

    <div id="wrapper">

        <?php include 'nav.php'; ?>

        <?php include('modal.php');?>
        <?php include('modal_password.php');?> 

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-globe fa-fw"></i> <?= $my_project_header_title; ?></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Search Engine -->
                            <div class="form-group">
                                <form method="post" enctype="multipart/form-data" action="redirect_manager">
                                    <input type="text" class="form-control" placeholder="Search here and press ENTER ..." minlength="4" name="notif_search" id="notif_search" style="border-radius: 0px;" autofocus required>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <form method="post" enctype="multipart/form-data" action="redirect_manager">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select type="text" class="form-control" name="my_condition" style="border-radius: 0px;">
                                                <option></option>
                                                <option>Update</option>
                                                <option>Discount</option>
                                                <option>Approved</option>
                                                <option>Product Update</option>
                                                <option>Stock-Transfer Alert</option>
                                                <option>Pull-Out Alert</option>
                                                <option>Restock Alert</option>
                                                <option>Void</option>
                                                <option>Removed</option>
                                                <option>Added</option>
                                                <option>Cash</option>
                                                <option>Cheque</option>
                                                <option>Card</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="my_date_from" id="my_date" style="border-radius: 0px;" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="my_date_to" id="my_date" style="border-radius: 0px;" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="submit" name="submit_notif_condition" class="btn btn-info" title="click to search ..."><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading text-bold">
                            Notifications
                            <span class="pull-right"><?= $count; ?> result(s)</span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover responsive">
                                    <thead class="ulo_lamisa4">
                                        <tr>
                                            <th>Notification</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            while ($notification=$getNotifications->fetch_array()) {

                                        ?>
                                        <tr class="odd gradeX" id="rowy4">
                                            <td><?= $notification['gy_notif_text']; ?></td>
                                            <td><span style="color: blue;"><?= date("M d, Y g:i:s A", strtotime($notification['gy_notif_date'])); ?></span></td>
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
        } else if ($note == "invalid") {
            echo "
                <script>
                    toastr.error('Invalid input');
                </script>
            ";
        } else {
            echo "";
        }
        
    ?>

</body>

</html>
