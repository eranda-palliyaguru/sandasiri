<?php 
include('../connect.php');
$q=$_GET['q'];
$stmt = $db->query("SELECT  * FROM item WHERE name LIKE '$q%' OR code LIKE '$q%' ORDER by barcode DESC  LIMIT 1000");
                    while ($row2 = $stmt->fetch()){

?>
<tr>
                    <td><?php echo $row2['id'] ?></td>
                    <td><?php echo $row2['name'] ?></td>
                    <td><?php echo $row2['code'] ?></td>
                    <td><?php echo $row2['price'] ?></td>
                    <td><?php echo $row2['qty'] ?></td>
                    <td><?php echo $row2['capacity'] ?></td>
                    <td><?php echo round($row2['capacity'] - $row2['qty']); ?></td>
                    <td><?php $type=$row2['capacity_type']; if($type==1){echo"Medium";} if($type==2){ if($row2['capacity']==0){echo"Bad";}else{echo"Low";} } ?></td>
                    <td><a href="product_profile.php?id=<?php  echo $row2['id']; ?>" class="btn btn-primary btn-sm">Profile</a></td>
                    
                    </tr>     

                   <?php }
                  ?>