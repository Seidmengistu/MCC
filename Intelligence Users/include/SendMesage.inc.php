<?php
session_start();
include('../../includes/config.php');    
if(isset($_POST['Send']))
  {  
$Sender_Name=$_POST['Sender_Name'];
$Recipant_Name=$_POST['Recipant_Name']; 
$from=$_POST['from'];
$to=$_POST['to'];
$reason=$_POST['reason'];
$importer=$_POST['importer'];
$importertin=$_POST['importertin'];
$agent=$_POST['agent'];
$agenttin=$_POST['agenttin'];
$risklevel=$_POST['risklevel'];
$section=$_POST['section'];
$declarationnumber=$_POST['declarationnumber'];
$goodsdescription=$_POST['goodsdescription'];
$officername=$_POST['officername'];
$code=$_POST['code'];
$signature=$_POST['signature'];
$date=$_POST['date'];
$time=$_POST['time'];
$approvedby=$_POST['approvedby'];
$reasontoexamine=$_POST['reasontoexamine'];
$status=0;
// print_r($from);print_r(" ");
// print_r($to);print_r(" ");print_r($reason);print_r(" ");
// print_r($importer);print_r(" ");print_r($importertin);print_r(" ");
// print_r($agent);print_r(" ");print_r($agenttin);print_r(" ");print_r($risklevel);print_r(" ");
// print_r($section);print_r(" ");print_r($declarationnumber);print_r(" ");print_r($goodsdescription);print_r(" ");
// die();
$sql="INSERT INTO  message(Sender_Name,Recipant_Name,fromm,too,reason,importer,importer_tin,agent,agent_tin,risk_level,section,declaration_no,
                           goods_description,info_sender_officer,code,esignature,edate,etime,approved_by,reasons_for_goods_examined,status)

                   VALUES(:Sender_Name,:Recipant_Name,:from,:to,:reason,:importer,:importertin,:agent,:agenttin,:risklevel,:section,:declarationnumber,
                          :goodsdescription,:officername,:code,:signature,:date,:time,:approvedby,:reasontoexamine,:status)";

$query = $dbh->prepare($sql);
$query->bindParam(':Sender_Name',$Sender_Name,PDO::PARAM_STR);
$query->bindParam(':Recipant_Name',$Recipant_Name,PDO::PARAM_STR);
$query->bindParam(':from',$from,PDO::PARAM_STR);
$query->bindParam(':to',$to,PDO::PARAM_STR);
$query->bindParam(':reason',$reason,PDO::PARAM_STR);
$query->bindParam(':importer',$importer,PDO::PARAM_STR);
$query->bindParam(':importertin',$importer,PDO::PARAM_STR);
$query->bindParam(':agent',$agent,PDO::PARAM_STR);
$query->bindParam(':agenttin',$agenttin,PDO::PARAM_STR);
$query->bindParam(':risklevel',$risklevel,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->bindParam(':declarationnumber',$declarationnumber,PDO::PARAM_STR);
$query->bindParam(':goodsdescription',$goodsdescription,PDO::PARAM_STR);
$query->bindParam(':officername',$officername,PDO::PARAM_STR);
$query->bindParam(':code',$code,PDO::PARAM_STR);
$query->bindParam(':signature',$signature,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':approvedby',$approvedby,PDO::PARAM_STR);
$query->bindParam(':reasontoexamine',$reasontoexamine,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

if($lastInsertId)
{
  $_SESSION['status']="Message Send Successfully";
  $_SESSION['status_code']="success";
   header('Location:../Message/SendMessage.php');

}
else 
{
  $_SESSION['status']="Some Problem";
  $_SESSION['status_code']="error";
   header('Location:../signup.php');
}
}

?>