<?php 
include('../connect.php');

   
$id=$_POST['id'];
$qty=$_POST['qty'];
$type=$_POST['type'];

   

$sql = "UPDATE order_list 
        SET old_qty=qty, qty=?,edit_type=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$type,$id));
 
 
header("location:order.php");
?>