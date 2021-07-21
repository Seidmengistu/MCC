<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    
    header('location:../../login.php');
} 
include "../../Auth/middleware.php";

    isStore();

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SMS</title>
    <link rel="stylesheet" href="../../includes/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?= include "../include/Layout/navbar.php"?>
        <?= include "../include/Layout/Layout.inc.php"?>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="nav-icon fas fa-envelope"></i>

                                    Show Message
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#personal">Message</a>
                        </li>

                    </ul>
                    <?php 
                       $conn=mysqli_connect('localhost','root','','sms');
                         $query="SELECT* FROM announcement ";
                        $query_run=mysqli_query($conn,$query);

                         ?>
                    <?php 
                                        if(mysqli_num_rows($query_run)>0)
                                          {
                                           while($row = mysqli_fetch_assoc($query_run))
                                         {
                                         ?>


                    <div class="tab-content pt-1">
                        <div id="personal" class="tab-pane">
                            <div class="row">
                                <div class="col-12 col-md-4">

                                    <p><strong class="label-colen">Message:</strong><?php echo $row['Message'];?></p>
                                    <p><strong class="label-colen">Date: </strong><?php echo $row['Date'];?></p>

                                </div>

                            </div>
                        </div>

                    </div>


                    <?php 
                                                               }
                                                           }
                                                           else
                                                           {
                                                               echo 'NO Record Found';
                                                           }
                                                               ?>


                </div>
        </div>
    </div>
    
    <?php
  include('../include/footer.php');
  include('../include/notify.php');
  ?>
    </div>
    <?=include "../include/script.php"?>;
</body>

</html>