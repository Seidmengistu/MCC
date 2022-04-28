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
    <link rel="stylesheet" href="../../includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
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

                            <p class="text-info nav-link"><?php $mydate=new DateTime(); echo $mydate->format('Y-m-d')?>
                            </p>
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
                    <div class="form-floating mb-3">
                        <!-- Navbar -->
                        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                            class="fas fa-bars"></i></a>
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

                        <div class="card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <span class="fas fa-user"></span>

                                    Message Status
                                </h3>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <a href="../include/download-records.php" style="color:blue; font-size:16px">Download
                                    Message List</a>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Recipant_Name</th>
                                        <th>From</th>
                                        <th>TO</th>
                                        <th>Reason</th>
                                        <th>Importer</th>
                                        <th>Importer Tin</th>
                                        <th>Agent</th>
                                        <th>Agent Tin</th>
                                        <th>Risk Level</th>
                                        <th>Section</th>
                                        <th>Declaration Number</th>
                                        <th>Goods Description</th>
                                        <th>Officer Name</th>
                                        <th>Code</th>
                                        <th>Signature</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Approved By</th>
                                        <th>Edit</th>
                                        <!-- <th>Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $username=$_SESSION['username']; 
                                            
                                    $sql ="SELECT FullName FROM admin WHERE status=1 && UserName='$username'";
                                    $query= $dbh -> prepare($sql);
                                    // $query-> bindParam(':UserName', $UserName, PDO::PARAM_STR);
                                    $query-> execute();
                                    $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                
                                    foreach ($results as $res) {
                                      $user=$res["FullName"];
                                    
                                    }                   
                                            $username=trim($_SESSION['username']);
                                            
                                            $filename="Message List"; 
                                            $sql = "SELECT * from message WHERE Recipant_Name=:user ";
                                            $query = $dbh -> prepare($sql);
                                            $query-> bindParam(':user', $user, PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {			
 
                                
                                        ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($result->Recipant_Name);?></td>
                                        <td><?php echo htmlentities($result->fromm);?></td>
                                        <td><?php echo htmlentities($result->too);?></td>
                                        <td><?php echo htmlentities($result->reason);?></td>
                                        <td><?php echo htmlentities($result->importer);?></td>
                                        <td><?php echo htmlentities($result->importer_tin);?></td>
                                        <td><?php echo htmlentities($result->agent);?></td>
                                        <td><?php echo htmlentities($result->agent_tin);?></td>
                                        <td><?php echo htmlentities($result->risk_level);?></td>
                                        <td><?php echo htmlentities($result->section);?></td>
                                        <td><?php echo htmlentities($result->declaration_no);?></td>
                                        <td><?php echo htmlentities($result->goods_description);?></td>
                                        <td><?php echo htmlentities($result->info_sender_officer);?></td>
                                        <td><?php echo htmlentities($result->code);?></td>
                                        <td><?php echo htmlentities($result->esignature);?></td>
                                        <td><?php echo htmlentities($result->edate);?></td>
                                        <td><?php echo htmlentities($result->etime);?></td>
                                        <td><?php echo htmlentities($result->approved_by);?></td>
                                        <td>

                                            <?php if($result->status==0)
{?>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#pending"
                                                data-id="<?=$result->id?>">Not Seen</a>
                                        </td>
                                        <?php
                                         }
                                        
                                        else
                                         {
                                             ?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#approved"
                                            data-id="<?=$result->id?>">Seen</a>

                                            <?php
                                         }
                                          ?>

                                            <!-- <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#abc"
                                                    data-id="<?=$result->id?>"> Delete</a>
                                            </td> -->
                                            </td>

                                    </tr>
                                    <?php
                                     $cnt=$cnt+1;
                                      }
                                      }
                                       ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="abc" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete
                                            Warning
                                        </h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Are You Sure To Delete it?</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>

                                        <form action="../include/ApproveShowMessage.inc.php" method="GET">
                                            <button type='submit' class='btn btn-success' name='del'>Yes</button>
                                            <input type='hidden' name='del' value="" id="deleteId">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="pending" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color:blue" class="modal-title" id="exampleModalLabel">Sending
                                            Response Message To The
                                            Intelligence User
                                        </h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    
                                    
                                        

                                        <form action="../include/MessageResponse.inc.php" method="POST">
                                     <div class="modal-body">

                                        <div class="mb-3">
                                            <?php
                                            $username=$_SESSION['username']; 
                                            
                                            $sql ="SELECT FullName FROM admin WHERE status=1 && UserName='$username'";
                                            $query= $dbh -> prepare($sql);
                                            // $query-> bindParam(':UserName', $UserName, PDO::PARAM_STR);
                                            $query-> execute();
                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                        
                                            foreach ($results as $res) {
                                              $user=$res["FullName"];
                                             
                                            }                   
                                            $sql = "SELECT Recipant_Name from message WHERE Recipant_Name=:user ";
                                            $query = $dbh -> prepare($sql);
                                            $query-> bindParam(':user', $user, PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {	
                                            ?>
                                            <label class="form-label">Recipant Name</label>
                                            <input readonly type="text" class="form-control" name='rname' value="<?php echo htmlentities($result->Recipant_Name);?>">
                                        </div>
                                        
                                    <?php
                                }
                                }
                                ?>
                                        <div class="mb-3">
                                            <label class="form-label">Signature</label>
                                            <input readonly class="form-control" name='rsignature' required value="<?php echo htmlentities($result->Recipant_Name);?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input readonly type="date" class="form-control" name='rdate' Value="<?php $mydate=new DateTime(); echo $mydate->format('Y-m-d')?>" diabled>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Time</label>
                                            <input readonly type="time" class="form-control" name='rtime' required value="<?php $mytime=date('h:i:s'); echo $mytime?>"  diabled>
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                        <button type='submit' class='btn btn-success' name='pending'>Yes</button>
                                            <input type='hidden' name='pending' value="" id="pendingId">
                                        </div>

                                     </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="approved" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Not Seen Warning
                                        </h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Are You Sure!To Put it In Not Seen State?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                        <form action="../include/ApproveShowMessage.inc.php" method="GET">
                                            <button type='submit' class='btn btn-success' name='approved'>Yes</button>
                                            <input type='hidden' name='approved' value="" id="approvedId">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

        </div>

    </div>
    <?php
   include('../include/footer.php');
   include('../include/notify.php');
   include "../include/script.php"?>
    <script>
    $('#abc').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        document.getElementById('deleteId').value = button.data('id');
    });

    $('#pending').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        document.getElementById('pendingId').value = button.data('id');
    });

    $('#approved').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        document.getElementById('approvedId').value = button.data('id');
    });
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": true,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
  $('#quickForm').validate({
    rules: {
      rname: {
        required: true,
        email: true,
      },
      rsignature: {
        required: true,
        minlength: 5
      },
      rdate: {
        required: true
      },
      rtime: {
        required: true
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
    </script>
</body>

</html>