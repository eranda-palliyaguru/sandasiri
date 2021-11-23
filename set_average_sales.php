<?php   
session_start();
include('../connect.php');


$result1 = $db->prepare("SELECT SUM(cost_price),SUM(ret_price),SUM(qty),COUNT(id),item_code FROM INVOICE_DTL GROUP BY item_code ");
$result1->bindParam(':userid', $res);
$result1->execute();
for($i=0; $row1 = $result1->fetch(); $i++){
$sys_id=$row1['item_code'];
$tot=$row1['SUM(qty)'];
$count=$row1['COUNT(id)'];
$amount=$row1['SUM(ret_price)'];
$cost=$row1['SUM(cost_price)'];

$result2 = $db->prepare("SELECT * FROM item WHERE sys_id='$sys_id' ");
$result2->bindParam(':userid', $res);
$result2->execute();
for($i=0; $row2 = $result2->fetch(); $i++){
$name=$row2['name'];
$code=$row2['code'];
$item_id=$row2['id'];
}

$date=date('Y-m-d');
$available_day=cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));



$sql = "INSERT INTO item_avg (name,code,sys_id,item_id,total_qty,average_qty,date,amount,cost_amount,bill_count,available_day) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$code,$sys_id,$item_id,$tot,$tot/$available_day,$date,$amount,$cost,$count,$available_day));



}

?>