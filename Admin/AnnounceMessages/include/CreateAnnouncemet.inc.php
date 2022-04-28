<?php
session_start();
include('../../../includes/config.php');    
if(isset($_POST['announce']))
  {   
$message=trim($_POST['message']);
$date=$_POST['date'];

if(is_numeric($message)){
    $_SESSION['status']="Message Must Be Alphabet";
  $_SESSION['status_code']="warning";
   header('Location:../CreateAnnouncement.php');
}
else{

$step=$dbh->prepare("UPDATE Announcements SET message=:message,date=:date where id=1");
$step->bindParam(':message',$message,PDO::PARAM_STR);
$step->bindParam(':date',$date,PDO::PARAM_STR);


if($step->execute())
{

  $_SESSION['status']="Message Announced";
  $_SESSION['status_code']="success";
   header('Location:../CreateAnnouncement.php');

}
else 
{
$error="Something went wrong. Please try again";
}
}
}
?>