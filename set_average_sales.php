<?php   
session_start();
include('../connect.php');


$result1 = $db->prepare("SELECT SUM(qty),item_code FROM INVOICE_DTL GROUP BY item_code ");
$result1->bindParam(':userid', $res);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
echo $row1['item_code']."____".$row1['SUM(qty)']."<br>";
}

?>