<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("../../conf/my_project.php");
    include("session.php");

    $my_project_header_title = "Download Pricing";

    $note=@$_GET['note'];
    $select=@$_GET['select'];

    if (empty($select)) {
        $selected = "all";
        $optionName = "all";
    } else {
        $selected = $select;

        if ($selected == "7") {
            $optionName = "last 7 days";
        } else if ($selected == "30") {
            $optionName = "last 30 days";
        } else {
            $optionName = "all";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'head.php'; ?>

    <style type="text/css">
        img{
            max-width:180px;
        }

        input[type=file]{
            padding:0px;
        }

        @media print{
            .no-print{
                display: none !important;
            }

            .my_hr{
                height: 5px;
                color: #000;
                background-color: #000;
                border: none;
            }

            td{
                background-color: rgba(255,255,255, 0.1);
            }
        }

        .my_hr{
            height: 5px;
            color: #000;
            background-color: #000;
            border: none;
        }

        td{
            background-color: rgba(255,255,255, 0.1);
            font-size: 14px;
        }

        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }

        .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
         }

        .files{ position:relative}

        .files:after {  pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(../../img/upload.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }

        .color input{ background-color:#f1f1f1;}

        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;  pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " or drag it here. ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
    </style>
<body>

    <div id="wrapper">

        <!-- Modals -->
        <?php include('modal.php');?>
        <?php include('modal_password.php');?> 

        <div id="page-wrapper" style="margin-left: 0px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <p style="text-align: center;">
                                <span style="font-size: 20px; font-weight: bold;">
                                    <i class="fa fa-download"></i> <?php echo $my_project_header_title; ?>
                                </span>
                                <br>
                            </p>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0px;">

                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <center><b><i class="fa fa-download"></i> Download Pricing</b></center>
                                </div>
                                <div class="panel-body">
                                    <form method="post" enctype="multipart/form-data" action="pricing_download">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="my_category" class="form-control" required>
                                                        <option value="<?= $selected ?>"><?= $optionName ?></option>
                                                        <option value="all">all</option>
                                                        <option value="7">last 7 days</option>
                                                        <option value="30">last 30 days</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" name="setting" class="btn btn-warning btn-block"><i class="fa fa-eye"></i> Show Results</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" name="download_pricing" class="btn btn-info btn-block"><i class="fa fa-download"></i> Download CSV</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" style="width: 100%; margin-bottom: 20px;">
                                <thead>
                                    <tr class="info">
                                        <th><center>Category</center></th>
                                        <th><center>No. of items</center></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        if ($selected == "all") {
                                            $countingDate = "";
                                        } else if ($selected == "7") {
                                            $countingDate = date("Y-m-d", strtotime("-7 days"));
                                        } else if ($selected == "30") {
                                            $countingDate = date("Y-m-d", strtotime("-30 days"));
                                        } else {
                                            $countingDate = "";
                                        }
                                        
                                        $results=0;
                                        $category=$link->query("SELECT * From gy_category");
                                        while ($categoryrow=$category->fetch_array()) {
                                            $results += count_cat_qty($categoryrow['gy_cat_name'], $countingDate);
                                    ?>                  
                                    <tr>
                                        <td style="font-weight: bold;"><center><?= $categoryrow['gy_cat_name'] ?></center></td>
                                        <td style="font-weight: bold;"><center><?= count_cat_qty($categoryrow['gy_cat_name'], $countingDate) ?></center></td>
                                    </tr>
                                                
                                <?php } ?>
                                                     
                                    <tr>
                                        <td style="font-weight: bold; color: blue;"><center>Total</center></td>
                                        <td style="font-weight: bold; color: blue;"><center><?= $results ?></center></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br><br><br><br>
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
                    toastr.error('Invalid');
                </script>
            ";
        } else if ($note == "upload_success") {
            echo "
                <script>
                    toastr.success('Data Upload Successful');
                </script>
            ";
        } else if ($note == "file_not_allowed") {
            echo "
                <script>
                    toastr.error('Your file is not CSV');
                </script>
            ";
        } else {
            echo "";
        }
        
    ?>

    <script type="text/javascript">
        function upload_comeon(formObj){
            formObj.upload_pricing.disabled = true;
            formObj.upload_pricing.innerHTML = "Uploading data ...";
            return true;  
        }
    </script>

</body>

</html>