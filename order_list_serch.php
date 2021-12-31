
<?php SESSION_START(); 
$q=$_GET['q'];
$group=$_GET['group'];
if($group==''){ if($_SESSION['group']=='0'){ $group=''; }else{ $group=$_SESSION['group']; } }
 ?>


<table class="table table-bordered table-striped">  
<thead>


<tr>


<th>Name</th>
<th>Code</th>
<th>Quantity</th>
<th>Stock Level</th>
<th>Re-Order</th>
<th>Sales Status</th>
<th>#</th>

</tr>



</thead>

<tbody >  
<?php  include('../connect.php'); $id =0;
$stmt = $db->query("SELECT  * FROM item WHERE  code = '$q'  ORDER by barcode DESC  LIMIT 100");
while ($row2 = $stmt->fetch()){ $id=$row2['id']; }

if($id > 0){
   $stmt = $db->query("SELECT  * FROM item WHERE  code = '$q'  ORDER by barcode DESC  LIMIT 100");
while ($row2 = $stmt->fetch()){
       $re=$row2['capacity'] - $row2['qty'];
   ?>
   <tr>  
      <td><?php echo $row2['name'] ?></td>  
      <td><?php echo $row2['code'] ?></td>
      <td><?php echo $row2['qty'] ?></td>
      <td><?php echo $row2['capacity'] ?></td>
      <td><?php echo round($re); if($re <= 0){$qty=1;}else{$qty=$re;} ?>
    </td>
      <td><?php $type=$row2['capacity_type']; if($type==1){echo"<b style='color:#1A65F8;'>Medium</b>";} if($type==2){ if($row2['capacity']==0){echo"<b style='color:red;'>Bad</b>";}else{echo"<b style='color:yellow;'>Low</b>";} } ?></td>
      <td><input id="soo" type="checkbox" name="techno[]" value="<?php echo $row2['id']; ?>"></td>  
   </tr>
   <?php } ?>  
   <tr>  
      <td colspan="4" align="center"></td>  
      <td align="center"><input class="btn btn-info btn-lg" type="submit" value="ADD TO LIST" name="sub"></td>
      <td colspan="2" align="center"><input type="checkbox" onClick="toggle(this)" /> Select All<br/></td>
   </tr>  


   <?php }else{ 
   if($group==''){
    $stmt = $db->query("SELECT  * FROM item WHERE  name LIKE '$q%' OR code LIKE '$q%'  ORDER by barcode DESC  LIMIT 100");
   }else{
    $stmt = $db->query("SELECT  * FROM item WHERE main_group='$group'  ORDER by barcode DESC  ");
   }
   while ($row2 = $stmt->fetch()){
       $re=$row2['capacity'] - $row2['qty'];
   ?>
   <tr>  
      <td><?php echo $row2['name'] ?></td>  
      <td><?php echo $row2['code'] ?></td>
      <td><?php echo $row2['qty'] ?></td>
      <td><?php echo $row2['capacity'] ?></td>
      <td><?php echo round($re); if($re <= 0){$qty=1;}else{$qty=$re;} ?>
    </td>
      <td><?php $type=$row2['capacity_type']; if($type==1){echo"<b style='color:#1A65F8;'>Medium</b>";} if($type==2){ if($row2['capacity']==0){echo"<b style='color:red;'>Bad</b>";}else{echo"<b style='color:yellow;'>Low</b>";} } ?></td>
      <td><input id="soo" type="checkbox" name="techno[]" value="<?php echo $row2['id']; ?>"></td>  
   </tr>
   <?php } ?>  
   <tr>  
      <td colspan="4" align="center"></td>  
      <td align="center"><input class="btn btn-info btn-lg" type="submit" value="ADD TO LIST" name="sub"></td>
      <td colspan="2" align="center"><input type="checkbox" onClick="toggle(this)" /> Select All<br/></td>
   </tr> 
   <?php } ?>  
</tbody>
</table>  
