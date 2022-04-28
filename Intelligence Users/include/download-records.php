<?php
session_start();
include "../../includes/config.php";
if(!isset($_SESSION['logged_in'])) {
    header('location:../../login.php');
    
 

}

	else{?>
<table border="1">
									<thead>
										<tr>
										    <th>#</th>
                                            <th>Sender Name</th>
                                            <th>Recipant Name</th>
											<th>ከ</th>
											<th>ለ</th>
											<th>ጉዳዩ</th>
											<th>importer</th>
											<th>importer Tin</th>
											<th>Agent</th>
											<th>Agent Tin</th>
											<th>Risk Level </th>
											<th>Section </th>
											<th>Declaration Number</th>
											<th>Goods Description</th>
											<th>Officer Name Who Gave The Information</th>
											<th>code</th>
											<th>Signature</th>
											<th>Date</th>
											<th>Time</th>
											<th>Approved By</th>
											<th>Reason For 	Good To Be Examined</th>
											<th>Recipent Name</th>
											<th>Signature</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
										</tr>
									</thead>

<?php 
$filename="Message list";
$username=$_SESSION['username'];
$sql = "SELECT * from  message where Sender_Name=:username ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	
    			

echo '  
<tr>  
        <td>'.$cnt.'</td> 
        <td>'.$Sender_Name= $result->Sender_Name.'</td> 
        <td>'.$Recipant_Name= $result->Recipant_Name.'</td> 
        <td>'.$fromm= $result->fromm.'</td> 
        <td>'.	$too= $result->too.'</td> 
        <td>'.$reason= $result->reason.'</td> 
        <td>'.$importer= $result->importer.'</td> 
        <td>'.$importer_tin= $result->importer_tin.'</td> 
        <td>'.$agent=$result->agent.'</td>	
        <td>'.$agent_tin=$result->agent_tin.'</td>	 
        <td>'.$risk_level=$result->risk_level.'</td>	
        <td>'.$section=$result->section.'</td>	
        <td>'.$declaration_no=$result->declaration_no.'</td>	
        <td>'.$goods_description=$result->goods_description.'</td> 					
        <td>'.$info_sender_officer=$result->info_sender_officer.'</td>
        <td>'.$code=$result->code.'</td>
        <td>'.$esignature=$result->esignature.'</td>
        <td>'.$edate=$result->edate.'</td>
        <td>'.$etime=$result->etime.'</td>
        <td>'.$approved_by=$result->approved_by.'</td>
        <td>'.$reasons_for_goods_examined=$result->reasons_for_goods_examined.'</td>
        <td>'.$rname=$result->rname.'</td>
        <td>'.$rsignature=$result->rsignature.'</td>
        <td>'.$rdate=$result->rdate.'</td>
        <td>'.$rtime=$result->rtime.'</td>
        <td>'.$status=$result->status.'</td>

</tr>  
';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-usersAdmin.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table>
<?php } ?>