<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    header('location:../../login.php');
    
}  
include "../../includes/homeMiddleware.php";

    isSpotAuditUser()
    
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MCC</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../includes/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="badge badge-danger navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"></span>
                        <div class="dropdown-divider"></div>
                        <a href="../Profile/ShowProfile.php" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../../logout.php" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            <span class="float-right text-muted text-sm"></span>
                        </a>

                </li>
        </nav>

        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <div class="sidebar">

                <a class="brand-link text-center" href="#"><img src="../../includes/images/mojo_customs_commission.png"
                        alt="AdminLTE Logo" class="img-circle" width="80%"></a>
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        
                        <li class="">
                            
                            <p class="text-info nav-link"><?php $mydate=new DateTime(); echo $mydate->format('Y-m-d')?></p>
                        </li>
                        <a href="../SpotAuditUsersHome.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Users Home
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <span class="badge badge-danger navbar-badge"></span>
                                <p>
                                    New Messages
                                    <i class="right fas fa-angle-left"></i>
                                    <?php
                                    $username=$_SESSION['username'];
                                     
                                            
                                            $sql ="SELECT FullName FROM admin WHERE status=1 && UserName='$username'";
                                            $query= $dbh -> prepare($sql);
                                            // $query-> bindParam(':UserName', $UserName, PDO::PARAM_STR);
                                            $query-> execute();
                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            foreach ($results as $res) {
                                              $user=$res["FullName"];
                                            //   print_r($user);
                                            //   die();
                                            }                   
                                    $query=$dbh->prepare("SELECT id From Message WHERE status=0 && Recipant_Name=:user  ORDER BY id");
                                    $query-> bindParam(':user', $user, PDO::PARAM_STR);
                                     $query->execute();
                                     
                                     
                                    $row=$query->rowCount();
                                    ?>
                                    <span class="right badge badge-danger"><?php echo $row;?></span>
                                </p>
                            </a>
                            

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="ShowMessage.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Show Message</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="Statistics.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Statistics </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="nav-icon fas fa-history"></i>

                                    Message Information
                                </h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="content">

                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div style="align:center" class="small-box bg-info">
                                                <div class="inner">
                                                    <?php
                                                    $username=$_SESSION['username'];
                                                    
                                                    $query=$dbh->prepare("SELECT id From message WHERE status=1 && Recipant_Name=:username  ORDER BY id");
                                                    $query-> bindParam(':username', $username, PDO::PARAM_STR);
                                                    $query->execute();
                                                    $row=$query->rowCount();
                                                    echo '<h1>'.$row.'</h1>';

                                                    ?>
                                                    <p style="color:blue">Seen</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                                <a href="ShowMessage.php" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-6">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <?php
                                        $username=$_SESSION['username'];
                                        $query=$dbh->prepare("SELECT id From Message WHERE status=0 && Recipant_Name=:username ORDER BY id");
                                        $query-> bindParam(':username', $username, PDO::PARAM_STR);
                                         $query->execute();
                                        $row=$query->rowCount();
                                        echo '<h1>'.$row.'</h1>';

                                        ?>

                                                    <p  style="color:red">Not Seen</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>
                                                <a href="ShowMessage.php" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <aside class="control-sidebar control-sidebar-dark">

                                </aside>

                            </div>
                            <?php require_once('../include/notify.php')?>
                        </div>
                    </div>
                </div>
        </div>
    </div> <!-- Main Footer -->
    <?php
  include('../include/footer.php');
  
  ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../includes/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../includes/dist/js/adminlte.min.js"></script>
</body>

</html>
