<?php   
session_start();
include('../connect.php');


$stmt = $db->query("SELECT SUM(cost_price),SUM(ret_price),SUM(qty),COUNT(id),item_code FROM INVOICE_DTL GROUP BY item_code ");
while ($row1 = $stmt->fetch()){
$sys_id=$row1['item_code'];
$tot=$row1['SUM(qty)'];
$count=$row1['COUNT(id)'];
$amount=$row1['SUM(ret_price)'];
$cost=$row1['SUM(cost_price)'];

$item_sql = $db->query("SELECT * FROM item WHERE sys_id='$sys_id' ");
while ($row2 = $item_sql->fetch()){
$name=$row2['name'];
$code=$row2['code'];
$item_id=$row2['id'];
}

$date=date('Y-m-d');
$available_day=cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));



$sql = "INSERT INTO item_avg (name,code,sys_id,item_id,total_qty,average_qty,date,amount,cost_amount,bill_count,available_day) VALUES ('$name','$code','$sys_id','$item_id','$tot','$tot/$available_day','$date','$amount','$cost','$count','$available_day')";
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
  //  echo "Error: " . $sql . "<br>" . $db->error;
  }

}

?>