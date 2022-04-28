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
    <link rel="stylesheet" href="../../includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>

<body class="hold-transition sidebar-mini">
<?php include "../include/TopLayout.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="form-floating mb-3">
                        

                        <div class="card-warning">
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
                                        <th>Sender Name</th>
                                        <th>Recipant Name</th>
                                        <th>ከ</th>
                                        <th>ለ</th>
                                        <th>ጉዳዩ</th>
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
                                        <th>Recipent Name</th>
                                        <th>Signature</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>information</th>
                                        <!-- <th>Delete</th> -->

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                            $username=$_SESSION['username'];
                                            
                                            $filename="Message List"; 
                                            $sql = "SELECT * from message";
                                            $query = $dbh -> prepare($sql);
                                            $query-> bindParam(':username', $username, PDO::PARAM_STR);
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
                                        <td><?php echo htmlentities($result->Sender_Name);?></td>
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
                                        <td><?php echo htmlentities($result->rname);?></td>
                                        <td><?php echo htmlentities($result->rsignature);?></td>
                                        <td><?php echo htmlentities($result->rdate);?></td>
                                        <td><?php echo htmlentities($result->rtime);?></td>
                                        <td>

                                            <?php if($result->status==0)
{?>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#pending"
                                                data-id="<?=$result->id?>">Not Seen</a>
                                        </td>
                                        <?php } else {?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#approved"
                                            data-id="<?=$result->id?>">Seen</a>

                                            <?php } ?>

                                            <!-- <td>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#abc"
                                                    data-id="<?=$result->id?>"> Delete</a>
                                            </td> -->
                                            </td>

                                    </tr>
                                    <?php $cnt=$cnt+1; }} ?>
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
   ?>

    <?=include "../include/script.php"?>;

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
});
</script>
    </script>
</body>

</html>