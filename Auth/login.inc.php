<?php
session_start();
include('../includes/config.php');
 
if(isset($_POST['login']))
{
                            $UserName=$_POST['username'];
                            $Password=md5($_POST['password']);
                            
                            $sql ="SELECT *  FROM admin WHERE UserName=:UserName and Password=:Password";
                            $query= $dbh -> prepare($sql);
                            $query-> bindParam(':UserName', $UserName, PDO::PARAM_STR);
                            $query-> bindParam(':Password', $Password, PDO::PARAM_STR);
                            $query-> execute();
                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                           $cc=$query->rowCount() > 0;
                     foreach ($results as $res) 
                     {
                                             $Role= $res['Role'];
                                             $username=$res['UserName'];
                                             $Password=$res["Password"];
                                             $status= $res['status'];                    
                     }

                 if($cc>0)
                  { 
                      
                     if($status==FALSE)
                     {
                                 $_SESSION['status']="Not Approved!Contact Your  Admin";
                                 $_SESSION['status_code']="warning";
                                 header('Location:../login.php');
                                 exist();        
                     } 
                     
                  switch ($Role) 
                  {    
                        case 'Admin':       
                                    $_SESSION['logged_in'] = true;
                                    header('location:../Admin/AdminDashboard.php');
                                    $_SESSION['Role'] = 'Admin';
                                    $_SESSION['username'] = $_POST['username']; 
                                    break;
                        case "iadmin":
                                    $_SESSION['logged_in'] = true;
                                    header('Location:../intelligence Admin/IntelligenceAdminHome.php');
                                    $_SESSION['Role'] = 'iadmin';  
                                    $_SESSION['username'] = $_POST['username']; 
                                    break;
                        case "sadmin":
                                    $_SESSION['logged_in'] = true;
                                    header('Location:../Spot Audit Admin/SpotAuditAdminHome.php');
                                    $_SESSION['Role'] = 'sadmin';  
                                    $_SESSION['username'] = $_POST['username']; 
                                    break;
                        case "iuser":
                                    $_SESSION['logged_in'] = true;
                                    header('Location:../Intelligence Users/IntelligenceUsersHome.php');
                                    $_SESSION['Role'] = 'iuser';                                  
                                    $_SESSION['username'] = $_POST['username']; 
                                    break;
                        case "suser":
                                    $_SESSION['logged_in'] = true;
                                    header('Location:../SpotAudit Users/SpotAuditUsersHome.php');
                                    $_SESSION['Role'] = 'suser';  
                                    $_SESSION['username'] = $_POST['username']; 
                                    break;
                  }
            }
         else{
               $_SESSION['status']="Incorrect Username or Password";
               $_SESSION['status_code']="warning";
               header('Location:../login.php');
            }
 }
?>