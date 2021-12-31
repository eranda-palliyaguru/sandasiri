<?php 
include('../connect.php');

  
$id=$_GET['id'];
$qty=1;


$sql = "UPDATE order_hed
        SET action='1'
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($id));


 
 
header("location:order.php");
?>