<?php   
session_start();
include('../connect.php');
$ch=1;
$y=date('Y');
$m=date('m')-12;
if($m<1){
    $m=12+$m;
    $y=$y-1;
}
$m=str_pad($m,2,"0",STR_PAD_LEFT);
$date=$y.'-'.$m;


$item_sql = $db->query("SELECT sys_id,id FROM item WHERE ch ='0' ORDER by id DESC limit 1000 ");
while ($row2 = $item_sql->fetch()){
$code=$row2['sys_id'];
$id=$row2['id'];
$tot_avg=0;$capacity=0;

$stmt = $db->query("SELECT COUNT(id), SUM(qty),SUM(average_qty) FROM month_avg WHERE code='$code' AND month > '$date' ORDER by month DESC   ");
while ($row1 = $stmt->fetch()){ 

    $tot_avg=$row1['SUM(average_qty)'];
    $qty=$row1['SUM(qty)'];
    $count=$row1['COUNT(id)'];
}

$stmt = $db->query("SELECT qty FROM month_avg WHERE code='$code' AND month > '$date' ORDER by qty DESC LIMIT 1 ");
while ($row1 = $stmt->fetch()){ 

    $bet_qty=$row1['qty'];
}
if($count>0){
$capacity=$qty/$count;
$capacity=$capacity+$bet_qty;
$cap_type=1;
}else{ $cap_type=2;
    $stmt = $db->query("SELECT COUNT(id), SUM(qty),SUM(average_qty) FROM month_avg WHERE code='$code' ORDER by month DESC LIMIT 4   ");
while ($row1 = $stmt->fetch()){ 

    $tot_avg=$row1['SUM(average_qty)'];
    $qty=$row1['SUM(qty)'];
    $count=$row1['COUNT(id)'];
}

$stmt = $db->query("SELECT qty FROM month_avg WHERE code='$code' ORDER by month DESC LIMIT 1 ");
while ($row1 = $stmt->fetch()){ 

    $bet_qty=$row1['qty'];
}
if($count>0){
    $capacity=$qty/$count;
    $capacity=$capacity+$bet_qty;
    };
}

$capacity=round($capacity);

$sql = "UPDATE item 
SET capacity=?, ch=? , capacity_type=?
WHERE id=? "; 
$q = $db->prepare($sql);
$q->execute(array($capacity,$ch,$cap_type,$id));


echo "QTY:".$qty."___CAP:".$capacity."__SUM:".$count."<br>";
}



header("location:set_stock_capacity.php");
?>
