<?php   
session_start();
include('../connect.php');



$item_sql = $db->query("SELECT code, id FROM month_avg WHERE month ='2021-11'  GROUP BY  code  HAVING COUNT(id) > 1 LIMIT 100");
while ($row2 = $item_sql->fetch()){
$code=$row2['code'];
$id=$row2['id'];


$item = $db->query("SELECT id, code FROM month_avg WHERE code='$code' AND month='2021-11' ORDER BY id DESC LIMIT 1,100 ");
while ($row = $item->fetch()){
$avgid=$row['id'];

$sql = "DELETE FROM month_avg 
WHERE id=? "; 
$q = $db->prepare($sql);
$q->execute(array($avgid));
echo $row['code'].'<br>';

}
}



//header("location:set_stock_capacity.php");
?>
