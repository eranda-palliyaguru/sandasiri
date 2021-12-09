<?php   
session_start();
include('../connect.php');


$tot_avg=0;
$item_sql = $db->query("SELECT sys_id,id FROM item WHERE capacity= 0 ORDER by id DESC limit 100 ");
while ($row2 = $item_sql->fetch()){
$code=$row2['sys_id'];
$id=$row2['id'];

$stmt = $db->query("SELECT average_qty FROM month_avg WHERE code='$code' ORDER by month DESC limit 3  ");
while ($row1 = $stmt->fetch()){ 

    $tot_avg+=$row1['average_qty'];
}

$sql = "UPDATE item 
SET capacity=?
WHERE id=? "; 
$q = $db->prepare($sql);
$q->execute(array($tot_avg,$id));

}
//echo $work_day;


header("location:set_stock_capacity.php");
?>
