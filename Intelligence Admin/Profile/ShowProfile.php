<?php
session_start();


include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    
    header('location:../../login.php');
} 
include "../../Auth/middleware.php";

isintelligenceAdmin();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Change Profile Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../includes/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../includes/plugins/summernote/summernote-bs4.css">
</head>
<?php include "../include/TopLayout.php";?>
<br>
<div class="content-wrapper" style="background-image:url('../../includes/images/bg-01.jpg')">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <span class="nav-icon fas fa-user"></span>
                            Profile Information
                        </h3>

                    </div>
                    <br><br>
                    <div class="content" >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card" style="background-image:url('../../includes/images/bg-01.jpg')">
                                        
                                        <div class="card-body">
                                            <?php
                                $username=$_SESSION['username'];
                                
                                $sql ="SELECT *FROM admin WHERE UserName=:username";
                                $query= $dbh -> prepare($sql);
                                $query->bindParam(':username',$username,PDO::PARAM_STR);
                                $query-> execute();
                                
                                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                     

                                    foreach($results as $row)
                                    {
                                        
                                    ?>

                                            <form action='ShowProfile.inc.php' method='POST'>
                                                <div class="mb-3">
                                                    <label class="form-label">User Name</label>
                                                    <input class="form-control" value="<?php echo $row['UserName']?>"
                                                        name='username'>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">New Password</label>
                                                    <input type='password' class="form-control" value=""
                                                        name='password'>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input  type='password' class="form-control" value="" name='confirmpassword'>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <input class="form-control" value="<?php echo $row['Department']?>"
                                                        name='department'>

                                                </div>
                                                


                                                <button name='change' class='btn btn-primary'>Change</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="card card-primary card-outline">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<?php include ('../include/notify.php')?>
<?php
  include('../include/footer.php');
  ?>
<script src="../../includes/plugins/jquery/jquery.min.js"></script>
<script src="../../includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../includes/dist/js/adminlte.min.js"></script>
<script src="../../includes/dist/js/demo.js"></script>
<script src="../../includes/plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
</body>

</html>