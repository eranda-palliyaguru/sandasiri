<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CLOUD ARM</title>
  <link rel="icon" href="img/Asset 67 (2).png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body>
<meta http-equiv="refresh" content="1;URL='order.php">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
           SANDASIRI HARDWARE STORES.
          <small class="float-right">Date: <?php echo date('Y-m-d'); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>SANDASIRI HARDWARE STORES</strong><br>
          114. Colombo RD,<br>
          Minuwangoda<br>
          Phone: (011) 295-355<br>
         
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
            <?php include('../connect.php');
            $or_id = $_GET['id'];
            $stmt = $db->query("SELECT  * FROM order_hed WHERE  id ='$or_id' ");
            while ($row2 = $stmt->fetch()){ $sup_id=$row2['sup_id']; $date=$row2['date']; $list_id=$row2['or_id']; }


                    $stmt = $db->query("SELECT  * FROM supplier WHERE  id ='$sup_id' ");
                    while ($row2 = $stmt->fetch()){ ?>
          <strong><?php echo $row2['name']; ?></strong><br>
          <?php echo $row2['addr']; ?><br>
        </address>
       <?php } ?>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">

        <b>Order ID:</b> <?php echo $or_id; ?><br>
        <b>Date:</b> <?php echo $date; ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            
            <th>Product</th>
            <th>Serial #</th>
            <th>Description</th>
            <th>Qty</th>
          </tr>
          </thead>
          <tbody>
         <?php $stmt = $db->query("SELECT  * FROM order_list WHERE  order_id ='$list_id' AND action < '5' ");
                    while ($row2 = $stmt->fetch()){ ?>
          <tr>
            <td><?php echo $row2['name']; ?></td>
            <td><?php echo $row2['code']; ?></td>
            <td></td>
            <td><?php echo $row2['qty']; ?></td>
           
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
