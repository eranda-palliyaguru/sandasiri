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


$item_sql = $db->query("SELECT sys_id,id FROM item WHERE last_update ='2022-01-02' ORDER by id DESC limit 1000 ");
while ($row2 = $item_sql->fetch()){
$code=$row2['sys_id'];
$id=$row2['id'];
$tot_avg=0;$capacity=0;

$item = $db->query("SELECT * FROM month_avg WHERE code='$code' AND month='2022-01' ORDER BY id DESC LIMIT 1,100 ");
while ($row = $item->fetch()){
$avgid=$row['id'];

//$sql = "DELETE FROM month_avg 
//WHERE id=? "; 
//$q = $db->prepare($sql);
//$q->execute(array($avgid));
echo $row['id'].'<br>';

}
}



//header("location:set_stock_capacity.php");
?>
