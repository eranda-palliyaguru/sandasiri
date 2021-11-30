<?php   
session_start();
include('../connect.php');


$stmt = $db->query("SELECT date, invo_no FROM sales WHERE date = '2019-01-01'  ");
while ($row1 = $stmt->fetch()){
$sys_invo=$row1['invo_no'];
$date=$row1['date'];


$sql = "UPDATE INVOICE_DTL 
SET date=?
WHERE sys_invo=? "; 
$q = $db->prepare($sql);
$q->execute(array($date,$sys_invo));

}

?>