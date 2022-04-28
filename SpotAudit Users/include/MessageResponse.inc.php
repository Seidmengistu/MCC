<?php 
session_start();
include "../../includes/config.php";

if(isset($_POST['pending']))
	{
            
            
            $conn=mysqli_connect('localhost','root','','mcc');
             $eid=$_POST['pending'];
            $rname=trim($_POST['rname']);
            $rsignature=trim($_POST['rsignature']);
            $rdate=trim($_POST['rdate']);
            $rtime=trim($_POST['rtime']);
            $status=1;
            

          $sql="UPDATE  message SET rname='$rname', rsignature='$rsignature',rdate='$rdate',rtime='$rtime',status='$status' WHERE id='$eid' ";

          if(mysqli_query($conn,$sql))
          {

            $_SESSION['status']="Respond send Successfully!";
            $_SESSION['status_code']="success";
            header('Location:../message/ShowMessage.php');

          }
          else 
          {
            $_SESSION['status']="Respond Not Send";
            $_SESSION['status_code']="error";
            header('Location:../message/ShowMessage.php');

          }
        }


?>