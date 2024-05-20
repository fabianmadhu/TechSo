<div class="login-form-container center-block">
    <div class="login-panel panel-default">
        <div class="login-panel-body panel-body">
            <h2 class="text-center">Sign In</h2>



            <form id="loginForm" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="login-form-group form-group" style="display: flex; justify-content: center">
                        <input type="text" class="login-form-control form-control" id="username" name="username" placeholder="username">
                    </div>
                </div>
                <div class="login-form-group form-group" style="display: flex; justify-content: center">
                        <input type="password" class="login-form-control form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="login-form-group form-group" style="display: flex; justify-content: center">
                    <div>
                        <button type="submit" class="btn btn-primary">Signin</button>
                    </div>
                    <div style="margin-left: 25px">
                        <a href="<?= base_url() ?>index.php" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </form>
            <div id="errorDiv" style="color:red"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#loginForm').on('submit', function(e){
        e.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: '<?= base_url() ?>index.php/auth/authenticate',
            type: 'POST',
            dataType: 'json',
            data: {
                username: username,
                password: password
            },
            success: function(data){
                if(data.is_logged_in){
                    window.location.href = '';
                } else {
                    // Display error message
                    $('#errorDiv').html(data.error_msg);
                    $('#username').val('');
                    $('#password').val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    });
});
</script>