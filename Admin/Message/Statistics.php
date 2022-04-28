<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    header('location:../../login.php');
    
}  
include "../../includes/homeMiddleware.php";

    isAdmin()
    
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

    <?php include "../include/TopLayout.php"?>

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
                                                    
                                                    $query=$dbh->prepare("SELECT id From message WHERE status=1  ORDER BY id");
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
                                    
                                        $query=$dbh->prepare("SELECT id From Message WHERE status=0 ORDER BY id");
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
