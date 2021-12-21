<?php 
include('../connect.php');

if(isset($_POST['sub']))  
{   
$id=$_POST['id'];
$sup_id=$_POST['sup_id'];
$note=$_POST['note']; 
   
//$in_ch=mysqli_query($con,"insert into request_quote(technology) values ('$chk')");

$product_id=$chk1;
$sql = $db->query("SELECT * FROM supplier WHERE id ='$sup_id'");
while ($row2 = $sql->fetch()){ 
$sup_code=$row2['sup_id'];
$sup_name=$row2['name'];
}
$date=date('Y-m-d');


$sql = "INSERT INTO order_hed (or_id,sup_code,sup_name,sup_id,note,date) VALUES (?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($id,$sup_code,$sup_name,$sup_id,$note,$date));
 
} 
header("location:order.php");
?>