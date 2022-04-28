<?php
session_start();
include('../includes/config.php');    
if(isset($_POST['signup']))
  {   
    $username=trim($_POST['username']);
    $fullname=trim($_POST['fullname']);
    $password=$_POST['password'];
    $date=$_POST['date'];
    $role=$_POST['role'];
    $department=$_POST['department'];
    $status=0;

    if(is_numeric($username)){
        $_SESSION['status']="UserName Must Be Alphabet";
      $_SESSION['status_code']="warning";
      header('Location:../signup.php');
    }
    else{
    $password=md5($_POST['password']);
    $sql ="SELECT UserName FROM admin";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':UserName', $UserName, PDO::PARAM_STR);
    $query-> execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $res) {
      $user=$res["UserName"];
    }

    if($user==$username)
    {   
      $_SESSION['status']="Person with this Username Already Registered!";
      $_SESSION['status_code']="warning";
      header('Location:../signup.php');
      exist();
    }

    $sql="INSERT INTO  Admin(FullName,UserName,Password,Role,Department,Date,status)
                      VALUES(:fullname,:username,:password,:role,:department,:date,:status)";
    $query = $dbh->prepare($sql);
    $query->bindparam(':fullname',$fullname,PDO::PARAM_STR);
    $query->bindParam(':username',$username,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':role',$role,PDO::PARAM_STR);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
    $query->bindParam(':department',$department,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId)
    {
      $_SESSION['status']="Sign up Successfully!  Wait for Aprrovement";
      $_SESSION['status_code']="success";
      header('Location:../signup.php');

    }
    else 
    {
      $_SESSION['status']="Some Problem";
      $_SESSION['status_code']="error";
      header('Location:../signup.php');
    }
    }
}
?>