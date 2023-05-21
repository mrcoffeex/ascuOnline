
<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $condition = @$_GET['condition'];
    $my_date_from = @$_GET['date_from'];
    $my_date_to = @$_GET['date_to'];

    if ($condition != "") {

        if ($my_date_from == $my_date_to) {
            $date_format = date("M d, Y", strtotime($my_date_from));
        }else{
            $date_format = date("M d - ", strtotime($my_date_from))." ".date("M d, Y", strtotime($my_date_to));
        }

        //title
        $my_title = "Filter - ".$condition." -> Day of ".$date_format;

        //query
        $query_one=$link->query("SELECT * From gy_notification Where gy_notif_text LIKE '%$condition%' AND date(gy_notif_date) BETWEEN '$my_date_from' AND '$my_date_to' Order By gy_notif_id DESC");

    }else{

        //title
        if ($my_date_from == $my_date_to) {
            $date_format = date("M d, Y", strtotime($my_date_from));
        }else{
            $date_format = date("M d - ", strtotime($my_date_from))." ".date("M d, Y", strtotime($my_date_to));
        }

        $my_title = "Day of ".$date_format;

        //query
        $query_one=$link->query("SELECT * From gy_notification Where date(gy_notif_date) BETWEEN '$my_date_from' AND '$my_date_to' Order By gy_notif_id DESC");

    }

    $count=$query_one->num_rows;

    $my_project_header_title = "Notification Search: ".$my_title;
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
                    <h3 class="page-header"><i class="fa fa-search fa-fw"></i> <?= $my_project_header_title; ?> <a href="print_note?condition=<?= $condition; ?>&date_from=<?= $my_date_from; ?>&date_to=<?= $my_date_to; ?>"onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=1366,height=768,toolbar=1,resizable=0'); return false;"><button type="button" class="btn btn-success" title="click to print ..."><i class="fa fa-print fa-fw"></i> Print</button></a></h3>
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
                                            while ($data_row=$query_one->fetch_array()) {

                                        ?>
                                        <tr class="odd gradeX" id="rowy4">
                                            <td><?= $data_row['gy_notif_text']; ?></td>
                                            <td><span style="color: blue;"><?= date("F d, Y g:i:s A", strtotime($data_row['gy_notif_date'])); ?></span></td>
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

</body>

</html>
