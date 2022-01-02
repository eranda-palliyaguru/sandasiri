<?php   
session_start();
include('../connect.php');



$item_sql = $db->query("SELECT code, id FROM month_avg WHERE month ='2022-01'  GROUP BY  code  HAVING COUNT(id) > '0' LIMIT 100");
while ($row2 = $item_sql->fetch()){
$code=$row2['code'];
$id=$row2['id'];


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
