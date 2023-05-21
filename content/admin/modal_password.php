<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                 <form method="post" enctype="multipart/form-data" action="update_security">
                    <div class="form-group">
                        <input 
                        type="password" 
                        class="form-control" 
                        name="old_password" 
                        minlength="6" 
                        maxlength="16" 
                        placeholder="Old Password" 
                        required>
                    </div>
                    <div class="form-group">
                        <input 
                        type="password" 
                        class="form-control" 
                        name="password1" 
                        id="password1" 
                        minlength="6" 
                        maxlength="16" 
                        placeholder="New Password" 
                        onkeyup="check_password('password1', 'password2', 'submitPassword', 'warningPane')" 
                        required>
                    </div>
                    <div class="form-group">
                        <input 
                        type="password" 
                        class="form-control" 
                        name="password2" 
                        id="password2" 
                        minlength="6" 
                        maxlength="16" 
                        placeholder="Re-type New Password" 
                        onkeyup="check_password('password1', 'password2', 'submitPassword', 'warningPane')" 
                        required>
                    </div>
                    <div class="form-group">
                        <label id="warningPane"></label>
                    </div>
                    <div class="form-group">
                        <button 
                        type="submit" 
                        name="submitPassword" 
                        id="submitPassword" 
                        class="btn btn-primary btn-block">Save Changes <i class="fa fa-angle-right fa-fw"></i></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>