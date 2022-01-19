<?php 
include('../connect.php');

if(isset($_POST['sub']))  
{   
$id=$_POST['id'];
$qty=$_POST['qty'];

   

$sql = "UPDATE item 
        SET bulk=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($qty,$id));
 
} 
header("location:product_profile.php?id=$id");
?>