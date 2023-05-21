
<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $productId=@$_GET['productId'];
    $page=@$_GET['page'];
    $pagenum=@$_GET['pn'];
    $search_text=@$_GET['search_text'];

    if ($page == "products") {
        $redirect = "products?pn=$pagenum&";
    } else if ($page == "product_search") {
        $redirect = "product_search?pn=$pagenum&search_text=$search_text&";
    } else {
        $redirect = "products?pn=$pagenum&";
    }

    $getProduct=selectProduct($productId);
    $product=$getProduct->fetch_array();

    $my_product_code = $product['gy_product_code'];

    $getSupplier=selectSupplier($product['gy_supplier_code']);
    $supplier=$getSupplier->fetch_array();

    $my_project_header_title = "Edit Product - ".$product['gy_product_name'];

    $note = @$_GET['note'];
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
                    <h3 class="page-header"><i class="fa fa-edit"></i> <?= $my_project_header_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <form method="post" enctype="multipart/form-data" action="edit_this_product?productId=<?= $productId; ?>&page=<?= $page ?>&pn=<?= $pagenum ?>&search_text=<?= $search_text ?>" onsubmit="return validateForm(this);">

                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Product Information
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-primary">Bar Code</label>
                                            <input type="text" 
                                            class="form-control" 
                                            maxlength="100" 
                                            name="my_code" 
                                            value="<?= $product['gy_product_code']; ?>" 
                                            required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="my_category" class="form-control" required>
                                                <option><?= $product['gy_product_cat']; ?></option>
                                                <?php  
                                                    //categories
                                                    $getCategories=selectCategories();
                                                    while ($category=$getCategories->fetch_array()) {
                                                ?>
                                                <option><?= $category['gy_cat_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <input 
                                            type="text" 
                                            class="form-control" 
                                            maxlength="100" 
                                            name="my_name" 
                                            value="<?= htmlentities($product['gy_product_name']); ?>" 
                                            required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Details</label>
                                            <textarea 
                                            class="form-control" 
                                            rows="2" 
                                            maxlength="100" 
                                            name="my_desc" 
                                            placeholder="text here ..."><?= htmlentities($product['gy_product_desc']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                Product Pricing / Conversion
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-primary">Price (Capital)</label>
                                            <input type="number" class="form-control" step="0.01" min="0" name="my_price_cap" id="my_price_cap" value="<?= $product['gy_product_price_cap']; ?>" onkeyup="get_the_price()" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="text-primary">Price (SRP)</label>
                                            <input type="number" class="form-control" step="0.01" min="0" name="my_price_srp" id="my_price_srp" value="<?= $product['gy_product_price_srp']; ?>" onkeyup="get_the_price()" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product Unit</label>
                                            <select class="form-control" name="my_unit" id="my_unit" onchange="getUnit()" required>
                                                <option><?= $product['gy_product_unit']; ?></option>
                                                <?php 
                                                    //my suppliers
                                                    $get_unit=$link->query("Select * From `gy_unit` Order By `gy_unit_id` ASC");
                                                    while ($unit_row=$get_unit->fetch_array()){
                                                ?>
                                                <option><?= $unit_row['gy_unit_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Restock Limit per <span class="text-primary" id="setUnit"><?= $product['gy_product_unit'] ?></span></label>
                                            <input type="number" class="form-control" name="my_restock_limit" min="0" value="<?= $product['gy_product_restock_limit']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount Perct. (%)</label>
                                            <select class="form-control" name="my_discount_limit" id="my_discount_limit" onchange="get_the_price()">
                                                <option value="0">0%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                                <option value="15">15%</option>
                                                <option value="20">20%</option>
                                                <option value="25">25%</option>
                                                <option value="30">30%</option>
                                                <option value="35">35%</option>
                                                <option value="40">40%</option>
                                                <option value="45">45%</option>
                                                <option value="50">50%</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount Limit</label>
                                            <input type="number" class="form-control" step="0.01" min="0" name="my_limit" value="<?= $product['gy_product_discount_per']; ?>" id="my_limit" onkeyup="get_the_discount()" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="number" class="form-control" step="0.01" min="0" value="<?= $product['gy_product_price_srp'] - $product['gy_product_discount_per']; ?>" name="discounted_value" id="discounted_value" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Convert ProductID - <span class="text-primary" title="<?= getConvertProductNameById($product['gy_convert_item_code']) ?>"><?= limit_string(getConvertProductNameById($product['gy_convert_item_code']), 17) ?></span></label>
                                            <input type="text" class="form-control" name="my_convert_item" id="my_convert_item" list="myProducts" value="<?= $product['gy_convert_item_code']; ?>" autocomplete="off" >
                                            <datalist id="myProducts"></datalist>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Convert Value /Unit</label>
                                            <input type="number" class="form-control" min="0" step="0.01" name="my_convert_value" value="<?= $product['gy_convert_value']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <!-- Submit Button Here -->
                    <div class="col-md-12 text-center">
                        <button type="submit" name="auth_update_product" ID="auth_update_product" class="btn btn-info"><i class="fa fa-check fa-fw"></i> Update</button>
                        &nbsp;
                        <button type="reset" class="btn btn-warning"><i class="fa fa-undo fa-fw"></i> Reset</button>
                        &nbsp;
                        <a href="<?= $redirect ?>"><button type="button" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> Exit</button></a>
                    </div>
                </form>
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
        }else if ($note == "duplicate") {
            echo "
                <script>
                    toastr.error('Duplicate code detected ... try another code');
                </script>
            ";
        }else if ($note == "error") {
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
        function validateForm(formObj) {
      
            formObj.auth_update_product.disabled = true; 
            formObj.auth_update_product.innerHTML = "processing ..."; 
            return true;  
      
        }

        function getUnit(){

            var myUnit = $("#my_unit option:selected").text();

            $("#setUnit").html(myUnit);

        }

        $(document).ready(function(){
            $("#my_price_cap").keyup(function(){
                //set price capital max to srp
                var mycap1 = $("#my_price_cap").val();
                var mysrp1 = $("#my_price_srp").val();

                if (mycap1 == "") {
                    mycap1 = 0;
                }

                if (mysrp1 == "") {
                    mysrp1 = 0;
                }

                var srptage = parseFloat(mysrp1) * parseFloat(5/100);
                var captage = parseFloat(mycap1) + srptage;

                if (mysrp1 == "") {
                    document.getElementById('my_price_cap').max = "";
                }else{
                    if (mycap1 == "") {
                        document.getElementById('my_price_cap').min = "0";
                        document.getElementById('my_price_cap').max = "";
                    }else{
                        document.getElementById('my_price_srp').min = Math.floor(captage);
                        document.getElementById('my_price_cap').max = Math.floor(mysrp1 - 1);
                    }
                }
            });
        });

        $(document).ready(function(){
            $("#my_price_srp").keyup(function(){
                //set price capital max to srp
                var mycap2 = $("#my_price_cap").val();
                var mysrp2 = $("#my_price_srp").val();

                if (mycap2 == "") {
                    mycap2 = 0;
                }

                if (mysrp2 == "") {
                    mysrp2 = 0;
                }

                var captage1 = parseFloat(mycap2) * parseFloat(5/100);

                var captage2 = parseFloat(mycap2) + captage1;

                if (mysrp2 == "") {
                    document.getElementById('my_price_srp').min = "";
                }else{
                    document.getElementById('my_price_srp').min = Math.floor(captage2);
                    document.getElementById('my_price_cap').max = Math.floor(mysrp2 - 1);
                }
            });
        });

        function get_the_price(){
            var b = document.getElementById('my_price_srp').value;

            var e = document.getElementById("my_discount_limit");
            var per_value = e.options[e.selectedIndex].value;

            var c = parseFloat(per_value) / 100; 

            var y = parseFloat(b) * parseFloat(c);

            var x = parseFloat(b) - parseFloat(y);

            if (!isNaN(x)) {
                document.getElementById('my_limit').value = x;
            }

            if (!isNaN(y)) {
                document.getElementById('discounted_value').value = y;
            }

        }

        function get_the_discount(){
            var aa = document.getElementById('my_price_srp').value;
            var ac = document.getElementById('my_price_cap').value;
            var ab = document.getElementById('my_limit').value;

            if (ab == "") {
                ab = 0;
            }

            var dis1 = parseFloat(ac) * parseFloat(5/100);

            var dis2 = parseFloat(ac) + dis1;

            var xx = parseFloat(aa) - parseFloat(ab);

            if (!isNaN(xx)) {
                document.getElementById('my_limit').min = Math.floor(dis2);
                document.getElementById('my_limit').max = Math.floor(aa);
                document.getElementById('discounted_value').value = xx;
            }
        }
    </script>

    <script type="text/javascript">
        var timer;
        $(document).ready(function(){
            $("#my_convert_item").keyup(function(){
                clearTimeout(timer);
                var ms = 200; // milliseconds
                $.get("live_search_id", {product_search: $(this).val()}, function(data){
                    timer = setTimeout(function() {
                        $("datalist").empty();
                        $("datalist").html(data);
                    }, ms);
                });
            });
        });
    </script>

</body>

</html>
