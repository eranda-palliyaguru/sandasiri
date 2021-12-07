<?php   
session_start();
include('../connect.php');

$d1=$_GET['d1'];
$d2=$_GET['d2'];
$work_day=0;
$item_sql = $db->query("SELECT COUNT(id) FROM day_avg WHERE date BETWEEN '$d1' AND '$d2' GROUP BY date ");
while ($row2 = $item_sql->fetch()){
$work_day+=1;

}
echo $work_day;

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

$avg=$qty/$work_day;


$sql = "INSERT INTO month_avg (name,code,view_code,item_id,qty,average_qty,bill,available_day,month,date_now,work_day) VALUES 
('$name','$code','$code_v','$item_id','$qty','$avg','$bill','$available_day','$month','$date','$work_day')";
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
  //  echo "Error: " . $sql . "<br>" . $db->error;
  }

}


$m=$m-1;
if($m==0){$y=$y-1;$m=12;
          };


$m=str_pad($m,2,"0",STR_PAD_LEFT);

$date1=$y."-".$m."-01";
$date1=$y."-".$m."-31";
header("location:set_average_sales.php?d1='$date1'&d2='$date2'");
?>
