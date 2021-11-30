<?php   
session_start();
include('../connect.php');


$stmt = $db->query("SELECT TOP 100 , date, id, invo_no FROM sales WHERE ch ='0' ");
while ($row1 = $stmt->fetch()){
$sys_invo=$row1['invo_no'];
$date=$row1['date'];
$id=$row1['id'];


$sql = "UPDATE INVOICE_DTL 
SET date=?
WHERE sys_invo=? "; 
$q = $db->prepare($sql);
$q->execute(array($date,$sys_invo));

$ch="1";
$sql = "UPDATE sales 
SET ch=?
WHERE id=? "; 
$q = $db->prepare($sql);
$q->execute(array($ch,$id));

}

?>