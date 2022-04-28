<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    header('location:../../login.php');
    
}  
include "../../includes/homeMiddleware.php";

isintelligenceUser();
    
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
                        <a href="../profile/showprofile.php" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../../logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
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

                        <li class="">

                            <p class="text-info nav-link"><?php $mydate=new DateTime(); echo $mydate->format('Y-m-d')?>
                            </p>
                        </li>
                        <a href="../intelligenceUsersHome.php" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Intelligence User Home
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
                                    $query=$dbh->prepare("SELECT id From Message WHERE status=0 && Sender_Name=:username  ORDER BY id");
                                    $query-> bindParam(':username', $username, PDO::PARAM_STR);
                                     $query->execute();
                                     
                                     
                                    $row=$query->rowCount();
                                    ?>
                                    <span class="right badge badge-danger"><?php echo $row;?></span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="SendMessage.php" class="nav-link">
                                        <i class="far fa-circle nav-icon text-danger"></i>
                                        <p>Send Message</p>
                                    </a>
                                </li>
                            </ul>

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
                        <!-- 
                        <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <span class="badge badge-danger navbar-badge"></span>
                                <p>
                                Announcements
                                    <i class="right fas fa-angle-left"></i>
                                    
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../Announcement/seeannouncement.php" class="nav-link">
                                        <i class="far fa-circle nav-icon text-danger"></i>
                                        <p>See Announcement</p>
                                    </a>
                                </li>
                            </ul> -->
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="nav-icon fas fa-copy"></i>

                                    Send Message
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="content" style="background-image:url('../../includes/images/bg-01.jpg')">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card" style="background-image:url('../../includes/images/bg-01.jpg')">

                                    <div class="card-body">


                                        <form action='../include/SendMesage.inc.php' method='POST'>
                                            <div class="mb-3">
                                                <label class="form-label">Sender Name</label>

                                                <?php
                                                 $username=$_SESSION['username']; 
                                                $conn=mysqli_connect('localhost','root','','mcc');
                                                $sql = $conn->query("SELECT FullName FROM admin WHERE status=1 && UserName='$username' ") or die(mysqli_error());
                                                while($row = $sql->fetch_array())
                                                {                                                                                                                                                           
                                            ?>
                                                <input readonly name='Sender_Name' class="form-control"
                                                    value="<?php echo $row['FullName']?>">
                                                <?php
                                                            }
                                                            ?>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Select Recipant Name</label>
                                                <select class="form-control" name="Recipant_Name" id="Recipant_Name"
                                                    required>

                                                    <option required>
                                                        <?php 
                                                                $username=$_SESSION['username']; 
                                                                $conn=mysqli_connect('localhost','root','','mcc');
                                                                $sql = $conn->query("SELECT FullName FROM `admin` WHERE status=1 && Role='suser'  ORDER BY `FullName`") or die(mysqli_error());
                                                                while($row = $sql->fetch_array()){
                                                            ?>
                                                    <option value="<?php echo $row['FullName']?>">
                                                        <?php echo $row['FullName']?>
                                                    </option>
                                                    <?php
                                                            }
                                                            ?>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label">From</label>
                                                <input required class="form-control" name='from' value="Intelligence Team">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">To</label>
                                                <input required class="form-control" name='to' value="Spot Audit Team">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Reason</label>
                                                <input required class="form-control" name='reason'>

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">importer Name</label>
                                                <input required type="text" class="form-control" name='importer'>

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Importer TIN</label>
                                                <input required class="form-control" name='importertin'>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Agent</label>
                                                <input required class="form-control" name='agent'>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Agent TIN</label>
                                                <input required class="form-control" name='agenttin'>
                                            </div>
                                            <div class="input-group mb-3">

                                                <select name="risklevel" class="form-control" required=""
                                                    placeholder="Risk Level">
                                                    <option value="">Select Risk Level</option>
                                                    <option value="Red">Red</option>
                                                    <option value="Yellow">Yellow</option>
                                                    <option value="Green">Green</option>
                                                    <option value="Blue">Blue</option>
                                                    <option value="Orange">Orange</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header">
                                </div>
                                <div class="row" style="background-image:url('../../includes/images/bg-01.jpg')">
                                    <div class="col-sm-12">

                                        <div class="input-group mb-3">

                                            <select name="section" class="form-control" required=""
                                                placeholder="Section">
                                                <option value="">Select Section</option>
                                                <option value="EOG">EOG</option>
                                                <option value="TCS">TCS</option>
                                                <option value="AM">AM</option>
                                                <option value="BC">BC</option>
                                                <option value="MEF">MEF</option>
                                                <option value="MG">MG</option>
                                                <option value="IPS">IPS</option>
                                                <option value="GN">GN</option>
                                                <option value="ME">ME</option>
                                                <option value="IOG">IOG</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Declaration Number</label>
                                            <input class="form-control" name='declarationnumber'>
                                        </div>
                                        <div class="form-floating">
                                            <label for="floatingTextarea">Goods Description</label>
                                            <textarea required name="goodsdescription" class="form-control"
                                                id="floatingTextarea"></textarea>

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">The Officer Who Give The Info</label>
                                            <input required class="form-control" name='officername'>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Code</label>
                                            <input required class="form-control" name='code'>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Signature</label>
                                            <input required class="form-control" name='signature'>
                                        </div>
                                        <?php $mydate=new DateTime(); ?>
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input readonly class="form-control" type="Date" name='date'
                                                value="<?php echo $mydate->format('Y-m-d');?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Time</label>
                                            <input readonly class="form-control" type="Time" name='time'
                                                value="<?php $mytime=date('h:i'); echo $mytime?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Approved By</label>
                                            <input required class="form-control" name='approvedby'>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Reason for Goods To Be Examined</label>
                                            <textarea required name="reasontoexamine" class="form-control"
                                                id="floatingTextarea"></textarea>

                                        </div>


                                        <input type="hidden" class="form-control" name='id'>

                                        <a href='SendMessage.php' class='btn btn-danger'>Cancel</a>
                                        <button name='Send' class='btn btn-primary'>Send</button>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>


                        </div>

                    </div>
                </div>



                <?php
   include('../include/footer.php');
   include('../include/notify.php');
   include "../include/script.php"?>;
</body>

</html>