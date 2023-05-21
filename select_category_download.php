<?php
    include("conf/conn.php");
    include("conf/function.php");
    include("conf/my_project.php");

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
    
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= @$my_project_header_title; ?></title>
     <link rel = "shortcut icon" href = "img/logo.png">

     <link href="dist/css/kent.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/toastr.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
    function kemfet(){
        var element = document.getElementById("data");
            element.scrollTop = element.scrollHeight;
        }

    </script>

</head>

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
            background-image: url(img/upload.png);
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

        <div id="page-wrapper" style="margin-left: 0px;">

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <p style="text-align: center;">
                                <span style="font-size: 20px; font-weight: bold;">
                                    <i class="fa fa-download"></i> <?= $my_project_header_title; ?>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="my_category" class="form-control" required>
                                                        <option value="<?= $selected ?>"><?= $optionName ?></option>
                                                        <option value="all">all</option>
                                                        <option value="7">last 7 days</option>
                                                        <option value="30">last 30 days</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="password" name="pin" id="pin" class="form-control" placeholder="password pin ..." autofocus required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" name="setting" class="btn btn-warning btn-block"><i class="fa fa-eye"></i> Show Results</button>
                                            </div>
                                            <div class="col-md-2">
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
    
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="bower_components/chart.js/chart.min.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
    <script src="dist/js/toastr.min.js"></script>

    <script>

        //toastr custom options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });

        // tooltip demo
        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })

        // popover demo
        $("[data-toggle=popover]")
            .popover()

        //modal autofocus
        $(document).on('shown.bs.modal', function() {
          $(this).find('[autofocus]').focus();
          $(this).find('[autofocus]').select();
        });

        // disable f12
        $(document).keydown(function (event) {
            if (event.keyCode == 123) { // Prevent F12
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                return false;
            }
        });

        //disable inspect element
        $(document).on("contextmenu", function (e) {        
            e.preventDefault();
        });

        //disable back function
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };

    </script>

    <?php  
        //profile and password alerts

        $profileUpdateAlert = @$_GET['profileUpdateAlert'];

        if ($profileUpdateAlert == "error") {
            echo "
                <script>
                    toastr.error('Error');
                </script>
            ";
        }else if ($profileUpdateAlert == "passwordUpdate") {
            echo "
                <script>
                    toastr.success('Password is updated');
                </script>
            ";
        }else if ($profileUpdateAlert == "passwordMismatch") {
            echo "
                <script>
                    toastr.error('Old password doesnt match');
                </script>
            ";
        }else if ($profileUpdateAlert == "profileUpdate") {
            echo "
                <script>
                    toastr.success('Profile is updated');
                </script>
            ";
        }else if ($profileUpdateAlert == "printerUpdate") {
            echo "
                <script>
                    toastr.success('Registered printer is updated');
                </script>
            ";
        }else{
            echo "";
        }
        
    ?>

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
        } else if ($note == "pin_out") {
            echo "
                <script>
                    toastr.error('PIN mismatched!');
                </script>
            ";
        } else {
            echo "";
        }
        
    ?>

</body>

</html>