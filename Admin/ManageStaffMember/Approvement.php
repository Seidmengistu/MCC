<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    
    header('location:../../login.php');
} 
include "../../Auth/middleware.php";

    isAdmin();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Approve Admins</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../includes/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../includes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">


</head>

<?php include "../include/TopLayout.php"?>
<br>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <span class="fas fa-user"></span>

                            Approve Users
                        </h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>UserName</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                           
                                            $sql = "SELECT * from Admin  WHERE Role='iadmin'|| Role='sadmin' ";
                                            $query = $dbh -> prepare($sql);
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
                                    <td><?php echo htmlentities($result->UserName);?></td>
                                    <td><?php echo htmlentities($result->Department);?></td>
                                    <td><?php echo htmlentities($result->Role);?></td>
                                    <td><?php echo htmlentities($result->Date);?></td>
                                    <td>

                                        <?php if($result->status==0)
{?>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#pending"
                                            data-id="<?=$result->id?>">Pending</a>
                                    </td>
                                    <?php } else {?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#approved"
                                        data-id="<?=$result->id?>">Approved</a>

                                        <?php } ?>

                                        <td>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#abc"
                                                data-id="<?=$result->id?>"> Delete</a>
                                        </td>
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

                                    <form action="include/ApproveStaffMember.inc.php" method="GET">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Pending Warning
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3>Are You Sure To Approve it?</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                    <form action="include/ApproveStaffMember.inc.php" method="GET">
                                        <button type='submit' class='btn btn-success' name='pending'>Yes</button>
                                        <input type='hidden' name='pending' value="" id="pendingId">

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
                                    <h5 class="modal-title" id="exampleModalLabel">Pending Warning
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Are You Sure!To Put it In pending State?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                    <form action="include/ApproveStaffMember.inc.php" method="GET">
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
<?php include 'include/notify.php'?>
<?php include "../include/footer.php"?>


<script src="../../includes/plugins/jquery/jquery.min.js"></script>
<script src="../../includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../includes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../includes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../includes/dist/js/adminlte.min.js"></script>

<script src="../../includes/dist/js/demo.js"></script>

<script>
    $('#abc').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('deleteId').value = button.data('id');
    });

    $('#pending').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('pendingId').value = button.data('id');
    });

    $('#approved').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        document.getElementById('approvedId').value = button.data('id');
    });

    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>
