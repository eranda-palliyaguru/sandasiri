<?php 
include('../connect.php');

if(isset($_POST['sub']))  
{   
$id=$_POST['id'];
$checkbox1=$_POST['techno'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   
//$in_ch=mysqli_query($con,"insert into request_quote(technology) values ('$chk')");

$product_id=$chk1;
$sql = $db->query("SELECT * FROM item WHERE id ='$product_id'");
while ($row2 = $sql->fetch()){ 
$cod=$row2['code'];
$name=$row2['name'];
$s_qty=$row2['qty'];
$level=$row2['capacity'];
$qty=$level-$s_qty;
if($qty<=0){
  $qty=1;
}

$date=date('Y-m-d');
}

$sql = "INSERT INTO order_list (order_id,product_id,code,stock_qty,stock_level,qty,date,name) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($id,$product_id,$cod,$s_qty,$level,$qty,$date,$name));
   } 

 
} 
header("location:order_list.php?id=$id");
?>