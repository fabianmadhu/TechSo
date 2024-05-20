<div class="form-signup center-block">
    <div class="panel panel-default">
        <div class="panel-body">
            <h2 class="text-center">TechSo<b> SignUp</b></h2>
            <form id="registerForm" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="fullName" class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmPassword" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Password">
                    </div>
                </div>
                <div id="errorDiv" style="color:red; text-align:center;"></div>
                <div class="form-group" style="justify-content: center; display: flex">
                    <div class="col-sm-4">
                        <a href="<?= base_url() ?>index.php/auth/signin" class="btn btn-primary">Already have an account?</a>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#registerForm').on('submit', function(e){
            e.preventDefault();

            var fullName = $('#fullName').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var confirmPassword = $('#confirmPassword').val();

            // Validation
            if (!fullName || !username || !password || !confirmPassword) {
                $('#errorDiv').html('All fields are required.');
                return false;
            }

            if (password !== confirmPassword) {
                $('#errorDiv').html('Passwords do not match.');
                return false;
            }

            $.ajax({
                url: '<?= base_url() ?>index.php/auth/confirmregister',
                type: 'POST',
                dataType: 'json',
                data: {
                    fullName: fullName,
                    username: username,
                    password: password
                },
                success: function(data){
                    if(data.is_registered){
                        window.location.href = data.redirect_url;
                    } else {
                        // Display error message
                        $('#errorDiv').html(data.error_msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                    $('#errorDiv').html('An error occurred. Please try again.');
                }
            });
        });
    });
</script>