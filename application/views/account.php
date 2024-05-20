<div class="container">
    <h2>Account User Details</h2>

    <div class="row" style="padding-top: 3%; padding-bottom: 3%">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-10">
            <span id="user-name"><?= $fullName ?></span>
            <a id="edit-name-link" style="margin-left: 15px" href="#">Rename</a>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-3 control-label">Password</label>
        <div class="col-sm-10">
            ##########
            <a id="edit-password-link" style="margin-left: 15px" href="#">Edit</a>
        </div>
    </div>
</div>


<div class="modal" id="edit-name-modal" tabindex="-1" role="dialog" aria-labelledby="edit-name-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit-name-modal-label">Edit Name</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-name"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-name-change-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="edit-password-modal" tabindex="-1" role="dialog" aria-labelledby="edit-password-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit-password-modal-label">Edit Password</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="old-password" class="control-label">Current Password:</label>
                        <input type="password" class="form-control" id="old-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="control-label">New Password:</label>
                        <input type="password" class="form-control" id="new-password">
                    </div>
                    <div class="form-group">
                        <label for="verify-password" class="control-label">Verify Password:</label>
                        <input type="password" class="form-control" id="verify-password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-password-change-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
   $('#confirm-name-change-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/auth/editname",
            data: {
                fullName: $('#edit-name').val()
            },
            success: function(response) {
                $('#edit-name-modal').modal('hide');
                $('#user-name').text(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    $('#confirm-password-change-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/auth/editpassword",
            data: {
                oldPassword: $('#old-password').val(),
                newPassword: $('#new-password').val()
            },
            success: function(response) {
                $('#edit-password-modal').modal('hide');
                window.location.href = '<?= base_url() ?>index.php/auth/signin';
            },
            error: function(response) {
                console.log('error in password change')
                console.log(response);
            }
        });
    });

    $('#edit-name-link').click(function(e) {
        e.preventDefault();
        $('#edit-name').val($('#user-name').text());
        $('#edit-name-modal').modal('show');
    });

    $('#edit-password-link').on('click', function(e) {
        e.preventDefault();
        $('#edit-password-modal').modal('show');
    });

    $('[data-dismiss="modal"]').click(function() {
        $('.modal').modal('hide');
    });
</script>