
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Profile Background</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="update_profile">
                    <div class="form-group">
                        <label>Name</label>
                        <input 
                        type="text" 
                        name="my_acc_name" 
                        value="<?= $user_info ?>" 
                        class="form-control" 
                        placeholder="Enter Your Profile Username here ..." required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input 
                        type="text" 
                        name="my_prof_username" 
                        value="<?= $user_username ?>" 
                        class="form-control" 
                        placeholder="Enter Your Profile Username here ..." required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update_profile" class="btn btn-info btn-block">Save Changes <i class="fa fa-angle-right fa-fw"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>