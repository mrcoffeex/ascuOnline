
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../bower_components/chart.js/chart.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script src="../../dist/js/toastr.min.js"></script>

    <script>

        //toastr custom options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

    <!-- Custom -->

    <script>
        
        function check_password(input1, input2, submitBtn, alertPane){

            var pass1 = document.getElementById(input1).value;
            var pass2 = document.getElementById(input2).value;

            if (pass1 == "" || pass2 == "") {
                document.getElementById(submitBtn).disabled = true;
            }else if (pass1 == "" && pass2 == "") {
                document.getElementById(submitBtn).disabled = true;
            }else if (pass1 != pass2) {
                document.getElementById(submitBtn).disabled = true;
                document.getElementById(alertPane).innerHTML = "Password Mismatch";
            }else if (pass1 == pass2) {
                document.getElementById(submitBtn).disabled = false;
                document.getElementById(alertPane).innerHTML = "";
            }else{
                document.getElementById(submitBtn).disabled = false;
                document.getElementById(alertPane).innerHTML = "";
            }
        }

        //count deliveries
        function load_sidebar_delivery_count() {
            $.ajax({
                type: "GET",
                url: "auto_delivery_count.php",
                dataType: "html",              
                success: function (response) {
                    $("#sidebar_delivery_count").html(response);
                    setTimeout(load_sidebar_delivery_count, 3000)
                }
            });
        }

        function load_sidebar_cod_count() {
            $.ajax({
                type: "GET",
                url: "auto_cod_count.php",
                dataType: "html",              
                success: function (response) {
                    $("#sidebar_cod_count").html(response);
                    setTimeout(load_sidebar_cod_count, 3000)
                }
            });
        }

        load_sidebar_cod_count();
        load_sidebar_delivery_count();

        // system options
        $(document).ready(function(){
            $("#priceChangeOpt").click(function(){

                var optType = "price_change";

                if($("#priceChangeOpt").is(":checked")){
                    var optValue = 1;
                } else {
                    var optValue = 0;
                }

                //run ajax
                $.ajax({
                    type: 'POST',
                    url: 'updatePriceChange.php',
                    data: { optType: optType, optValue: optValue },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });

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


