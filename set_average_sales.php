<?php   
session_start();
include('../connect.php');

$d1=$_GET['d1'];
$d2=$_GET['d2'];

$item_sql = $db->query("SELECT COUNT(id) FROM day_avg WHERE date BETWEEN '$d1' AND '$d2' GROUP BY date ");
while ($row2 = $item_sql->fetch()){
$work_day=$row2['COUNT(id)'];

}

$stmt = $db->query("SELECT SUM(bill_qty),SUM(qty),COUNT(id),code FROM day_avg WHERE date BETWEEN '$d1' AND '$d2' GROUP BY code ");
while ($row1 = $stmt->fetch()){
$code=$row1['code'];
$qty=$row1['SUM(qty)'];
$count=$row1['COUNT(id)'];
$bill=$row1['SUM(bill_qty)'];

$item_sql = $db->query("SELECT * FROM item WHERE sys_id='$code' ");
while ($row2 = $item_sql->fetch()){
$name=$row2['name'];
$code_v=$row2['code'];
$item_id=$row2['id'];
}



    
$date=date('Y-m-d');
    
$sp = explode("-",$d1);
$y= $sp[0];
$m=$sp[1];
$month=$y."-".$m;    
$available_day=cal_days_in_month(CAL_GREGORIAN, $m, $y);




$sql = "INSERT INTO month_avg (name,code,view_code,item_id,qty,average_qty,bill,available_day,month,date_now,work_day) VALUES 
('$name','$code','$code_v','$item_id','$qty','$qty/$work_day','$bill','$available_day','$month','$date','$work_day')";
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
  //  echo "Error: " . $sql . "<br>" . $db->error;
  }

}

?>
