<?php   
session_start();
include('../connect.php');


$stmt = $db->query("SELECT date, sys_invo FROM sales  ");
while ($row1 = $stmt->fetch()){
$sys_invo=$row1['sys_invo'];
$date=$row1['date'];


$sql = "UPDATE INVOICE_DTL SET date='$date' WHERE sys_invo='$sys_invo' ";

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {

  }

}

?>