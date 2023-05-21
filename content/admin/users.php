<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");
    include("../../conf/my_project.php");

    $my_project_header_title = "Users";

    $note = @$_GET['note'];

    $query_one = "SELECT * From gy_user Where (gy_user_id!='1' AND gy_user_id!='$user_id') AND gy_user_status='0' Order By gy_user_id ASC";

    $query_two = "SELECT COUNT(gy_user_id) FROM gy_user Where (gy_user_id!='1' AND gy_user_id!='$user_id') AND gy_user_status='0' Order By gy_user_id ASC";

    $query_three = "SELECT * from gy_user Where (gy_user_id!='1' AND gy_user_id!='$user_id') AND gy_user_status='0' Order By gy_user_id ASC ";

    $my_num_rows = 25;

    include 'my_pagination.php';

    $count=$link->query($query_one)->num_rows;$res
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
                    <h3 class="page-header"><i class="fa fa-user"></i> <?= $my_project_header_title; ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Buttons -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user" title="click to add user ..."><i class="fa fa-plus fa-fw"></i> Add New User</button>
                            <a href="user_archive" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=1280,height=720,toolbar=1,resizable=0'); return false;"><button type="button" class="btn btn-warning" title="click to open user archive"><i class="fa fa-folder-open fa-fw"></i> User Archive</button></a>
                        </div>
                        <hr>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Users Data Table
                            <span class="pull-right text-primary text-bold"><?= $count ?> result(s)</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Archive</th>
                                            <th class="text-center">Acct. Code</th>
                                            <th class="text-primary">Name</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        while ($user=$query->fetch_array()) {
                                    ?>

                                        <tr>
                                            <td class="text-center">
                                                <button 
                                                type="button" 
                                                class="btn btn-warning" 
                                                title="click to move to archive ..." 
                                                data-toggle="modal" 
                                                data-target="#set_<?= $user['gy_user_id']; ?>">
                                                    <i class="fa fa-folder-open fa-fw"></i>
                                                </button>
                                            </td>
                                            <td class="text-center text-bold"><?= $user['gy_user_code']; ?></td>
                                            <td class="text-primary"><?= $user['gy_full_name']; ?></td>
                                            <td class="text-center text-bold"><?= $user['gy_username']; ?></td>
                                            <td class="text-center text-bold text-italic"><?= getUserRole($user['gy_user_type']) ?></td>
                                            <td class="text-center">
                                                <button 
                                                type="button" 
                                                class="btn btn-info" 
                                                title="click to edit user details ..." 
                                                data-toggle="modal" 
                                                data-target="#edit_<?= $user['gy_user_id']; ?>">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit -->

                                        <div class="modal fade" id="edit_<?= $user['gy_user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" tabindex="-1" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit fa-fw"></i> Edit User</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="edit_user?cd=<?= $user['gy_user_id']; ?>">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Acct. Code</label>
                                                                        <input type="text" name="my_code" minlength="6" maxlength="11" class="form-control" value="<?= verifyUserCode($user['gy_user_code']) ?>" readonly autocomplete="off" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Role</label>
                                                                        <select name="my_role" class="form-control" required>
                                                                            <option value="0">Administrator</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="my_name" minlength="4" maxlength="16" class="form-control" value="<?= $user['gy_full_name']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Username</label>
                                                                        <input type="text" name="my_username" minlength="6" maxlength="16" class="form-control" value="<?= $user['gy_username']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="password" name="my_password1" id="my_password1_<?= $user['gy_user_id']; ?>" onkeyup="check_password_<?= $user['gy_user_id']; ?>()" minlength="6" maxlength="16" class="form-control" value="<?= decryptIt($user['gy_password']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>ReType Password</label>
                                                                        <input type="password" name="my_password2" id="my_password2_<?= $user['gy_user_id']; ?>" onkeyup="check_password_<?= $user['gy_user_id']; ?>()" minlength="6" maxlength="16" class="form-control" value="<?= decryptIt($user['gy_password']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label id="warning_<?= $user['gy_user_id']; ?>"></label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <button type="submit" name="submit_user_edit" id="submit_user_<?= $user['gy_user_id']; ?>" class="btn btn-info" title="click to add user ...">Update User <i class="fa fa-angle-right fa-fw"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            function check_password_<?= $user['gy_user_id']; ?>(){
                                                var pass1 = document.getElementById('my_password1_<?= $user['gy_user_id']; ?>').value;
                                                var pass2 = document.getElementById('my_password2_<?= $user['gy_user_id']; ?>').value;

                                                if (pass1 == "" || pass2 == "") {
                                                    document.getElementById('submit_user_<?= $user['gy_user_id']; ?>').disabled = true;
                                                }else if (pass1 == "" && pass2 == "") {
                                                    document.getElementById('submit_user_<?= $user['gy_user_id']; ?>').disabled = true;
                                                }else if (pass1 != pass2) {
                                                    document.getElementById('submit_user_<?= $user['gy_user_id']; ?>').disabled = true;
                                                    document.getElementById('warning_<?= $user['gy_user_id']; ?>').innerHTML = "Password Mismatch";
                                                }else if (pass1 == pass2) {
                                                    document.getElementById('submit_user_<?= $user['gy_user_id']; ?>').disabled = false;
                                                    document.getElementById('warning_<?= $user['gy_user_id']; ?>').innerHTML = "";
                                                }else{
                                                    document.getElementById('submit_user_<?= $user['gy_user_id']; ?>').disabled = false;
                                                    document.getElementById('warning_<?= $user['gy_user_id']; ?>').innerHTML = "";
                                                }
                                            }
                                        </script>

                                        <!-- Set -->

                                        <div class="modal fade" id="set_<?= $user['gy_user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-folder-open fa-fw"></i> Archive <?= $user['gy_full_name']; ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" action="update_user_status?cd=<?= $user['gy_user_id']; ?>">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Secure PIN</label>
                                                                        <input type="password" name="my_secure_pin" class="form-control" autofocus required>
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

    <!-- modals -->

    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" tabindex="-1" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-fw"></i> Add User</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="add_user">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Acct. Code</label>
                                    <input type="text" name="my_code" minlength="6" maxlength="11" class="form-control" value="<?= my_rand_int(8); ?>" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="my_role" class="form-control" required>
                                        <option value="0">Administrator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="my_name" minlength="4" maxlength="16" class="form-control" autofocus autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="my_username" minlength="6" maxlength="16" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="my_password1" id="my_password1" onkeyup="check_password('my_password1', 'my_password2', 'submit_user', 'warning')" minlength="6" maxlength="16" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ReType Password</label>
                                    <input type="password" name="my_password2" id="my_password2" onkeyup="check_password('my_password1', 'my_password2', 'submit_user', 'warning')" minlength="6" maxlength="16" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label id="warning"></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="submit_user" id="submit_user" class="btn btn-primary" title="click to add user ..." disabled="false">Add User <i class="fa fa-angle-right fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <?php  
        if ($note == "nice") {
            echo "
                <script>
                    toastr.success('New user is added');
                </script>
            ";
        }else if ($note == "error") {
            echo "
                <script>
                    toastr.error('Theres something wrong here');
                </script>
            ";
        }else if ($note == "nice_update") {
            echo "
                <script>
                    toastr.success('User Information is Updated');
                </script>
            ";
        }else if ($note == "user_moved") {
            echo "
                <script>
                    toastr.success('User has been archived');
                </script>
            ";
        }else if ($note == "pin_out") {
            echo "
                <script>
                    toastr.error('Incorrect PIN');
                </script>
            ";
        }else if ($note == "code_duplicate") {
            echo "
                <script>
                    toastr.error('Network is busy try again');
                </script>
            ";
        }else if ($note == "delete") {
            echo "
                <script>
                    toastr.success('User has been removed');
                </script>
            ";
        }else{
            echo "";
        }
    ?>

</body>

</html>
