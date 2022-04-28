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
    <title>MCC</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../includes/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../includes/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../includes/plugins/summernote/summernote-bs4.css">
</head>
<?php include "../include/TopLayout.php";?>
<br>


<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <span class="nav-icon fas fa-bullhorn"></span>
                            Create Announcement
                        </h3>
                    </div>
                    <form method="post" action="include/CreateAnnouncemet.inc.php">

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Announcements</label>
                            <div class="col-sm-8">

                                <div class="card-body pad">
                                    <div class="mb-3">
                                        <textarea class="textarea" rows="5" cols="50" name="message" required>
                                                    <?php 
                                             
                                            //  include('../../includes/config.php');
												$sql = "SELECT * from announcements WHERE id=1";
												$query = $dbh -> prepare($sql);

												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												
												if($query->rowCount() > 0)
												{
												foreach($results as $result)
												{		
												echo $result->message;
												}}
												?>
                                                    
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">

                                    <input type="date" name="date" value="<?=$result->Date?>"></input>
                                    </div>  
                                </div>

                                <div class=" form-group">
                                    <div class="col-sm-8 col-sm-offset-4">

                                        <button type="submit" name="announce" class="btn-primary btn">Announce</button>
                                    </div>
                                </div>
                            </div>
                    </form>
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
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>
</body>

</html>