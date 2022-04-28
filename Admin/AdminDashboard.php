<?php
session_start();
include "../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    
    header('location:../login.php');
} 
include "../includes/homeMiddleware.php";

    isAdmin();

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MCC</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../includes/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../includes/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>

<body class="hold-transition sidebar-mini">

    <?php include "include/header.php"?>;


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-image:url('../includes/images/back1.jpg')">
        <!-- Content Header (Page header) -->
        <div class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">


                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
                <div class="container-fluid">
                <?php
                                                 $username=$_SESSION['username']; 
                                                $conn=mysqli_connect('localhost','root','','mcc');
                                                $sql = $conn->query("SELECT FullName FROM admin WHERE status=1 && UserName='$username' ") or die(mysqli_error());
                                                while($row = $sql->fetch_array())
                                                {  
                                                                                                                                                                                                             
                                            ?>   
                    <h3 style="text-align:center;background-color:gold">WelCome <?php 
                     echo $row['FullName'] ?></h3>

                    <?php
                 }?>
                </div>
                <!-- /.row -->
            </div>
    </div>
    </div> <!-- Main Footer -->
    <?php
  include('include/footer.php');
  ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../includes/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../includes/dist/js/adminlte.min.js"></script>
</body>

</html>