<?php session_start();?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign Up</title>

    <link rel="stylesheet" href="includes/Auth/css/style.css">
    <link rel="stylesheet" href="includes/dist/css/adminlte.min.css">
</head>
<style>
.register-logo {
    text-align: center;

}

.ss {
    text-align: center;
}
</style>




<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="www.ecc.gov.et"><b>MCC</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p style="color:blue" class="login-box-msg">Register a new membership</p>

                <form action="Auth/signup.inc.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="User Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">

                        <select name="department" class="form-control" required="" placeholder="Department">
                            <option value="">Select Department</option>
                            <option value="Admin">Admin</option>
                            <option value="igroup">Intelligence Group</option>
                            <!-- <option value="iuser">Intelligence User</option> -->
                            <option value="sgroup">Spot audit Group</option>
                            <!-- <option value="Suser">Spot audit User</option> -->
                        </select>
                    </div>
                    <div class="input-group mb-3">

                        <select name="role" class="form-control" required="" placeholder="Role">
                            <option value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="iadmin">Intelligence Admin</option>
                            <option value="iuser">Intelligence User</option>
                            <option value="sadmin">Spot audit Admin</option>
                            <option value="suser">Spot audit User</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <?php $date=new DateTime();?>
                        <input readonly type="date" name="date" class="form-control" placeholder="Date"
                            value=<?php echo $date->format('Y-m-d');?> </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="signup" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                      <label for=""></label>
                <a href="" class="text-center">Already Registered User</a>|<br>
                <a href="login.php" class="text-center">Login</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

</body>

<script src="includes/dist/js/adminlte.js"></script>
<script src="includes/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="includes/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="includes/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="includes/dist/js/demo.js"></script>
<?php require_once('includes/notify.php')?>
<script type="text/javascript">
$(document).ready(function() {
    $.validator.setDefaults({
        submitHandler: function() {

            include("Auth/signup.inc.php");
        }
    });
    $('#quickForm').validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 5
            },

        },
        messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
<script>
< /html>