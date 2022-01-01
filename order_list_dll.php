<?php 
include('../connect.php');

 
$id=$_GET['id'];
$ord=$_GET['ord'];
$dip=$_GET['dip'];

$sql = "UPDATE order_list 
        SET action='5'
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($id));

header("location:$dip?id=$ord");
?>