<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 -->
<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php  include("hed.php"); ?>
  <?php include("sidebar.php"); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
          <br>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

<?php $id=$_GET['id'];
$stmt = $db->query("SELECT  * FROM item WHERE id = '$id'  ");
                    while ($row2 = $stmt->fetch()){ ?>
                <h3 class="profile-username text-center"><?php echo $row2['name']; ?></h3>

                <p class="text-muted text-center">CODE: <?php echo $row2['code']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>PRICE</b> <a class="float-right">Rs.<?php echo $row2['price']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>COST</b> <a class="float-right">Rs.<?php echo $row2['o_price']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>PROFIT</b> <a class="float-right">Rs.<?php echo $row2['price']-$row2['o_price']; ?></a>
                  </li>
                </ul>
<?php $code=$row2['sys_id']; } ?>
               
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php $tot_avg=0;$bill_avg=0;
            $y=DATE('Y');
            $m=DATE('m');
            $m=$m-12;
            if($m==0){$y=$y-1;$m=12;};
            $m=str_pad($m,2,"0",STR_PAD_LEFT);
            $date=$y."-".$m;


$stmt = $db->query("SELECT SUM(average_qty), COUNT(id), SUM(bill), SUM(qty) FROM month_avg WHERE code='$code' AND month > '$date'  ");
while ($row1 = $stmt->fetch()){ 

    $tot_avg=$row1['SUM(average_qty)'];
    $month_count=$row1['COUNT(id)'];
    $tot_bill=$row1['SUM(bill)'];
    $tot_qty=$row1['SUM(qty)'];    
}
if($tot_avg > 0){
$tot_avg = $tot_avg/$month_count;
$bill_avg = $tot_qty/$tot_bill;}

$stmt = $db->query("SELECT  SUM(qty), SUM(bill) FROM month_avg WHERE code='$code'   ");
while ($row1 = $stmt->fetch()){ 
    $tot_sales=$row1['SUM(qty)'];
    $no_bill=$row1['SUM(bill)'];    
}

$stmt = $db->query("SELECT  date FROM day_avg WHERE code='$code' ORDER BY date ASC LIMIT 1  ");
while ($row1 = $stmt->fetch()){ 
    $start=$row1['date'];    
}

$stmt = $db->query("SELECT  date FROM day_avg WHERE code='$code' ORDER BY date DESC LIMIT 1  ");
while ($row1 = $stmt->fetch()){ 
    $update=$row1['date'];    
}

$sql = "UPDATE item 
SET capacity=?
WHERE id=? "; 
$q = $db->prepare($sql);
$q->execute(array($tot_avg,$id));
 ?>
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">PRODUCT DATA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Day Average</strong>

                <p class="text-muted">
        <?php echo number_format($tot_avg,3); ?>
                </p>

                <hr>
                <strong><i class="fas fa-cube mr-1"></i> Average Per Bill (qty)</strong>

<p class="text-muted">
<?php echo number_format($bill_avg,3); ?>
</p>

<hr>

<strong><i class="fas fa-cubes mr-1"></i> Total Sales QTY</strong>

<p class="text-muted">
<?php echo $tot_sales; ?>
</p>

<hr>

<strong><i class="fas fa-file"></i> Number of Bills</strong>

<p class="text-muted">
<?php echo $no_bill; ?>
</p>

<hr>

<strong><i class="fas fa-calendar "></i> Start Date</strong>

<p class="text-muted">
<?php echo $start; ?>
</p>

<hr>

<strong><i class="fas fa-calendar "></i> Last Update</strong>

<p class="text-muted">
<?php echo $update; ?>
</p>

<hr>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="active nav-link" href="#timeline" data-toggle="tab">Activity</a></li>
                 
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          <?php echo $update; ?>
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <?php $stmt = $db->query("SELECT * FROM month_avg WHERE code='$code' ORDER BY month DESC  ");
                     while ($row1 = $stmt->fetch()){ 
                         $q_tot=0; $b_tot=0;
                                   ?>
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-file bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>
                          <h3 class="timeline-header"><a href="#"><?php echo $row1['month'] ?></a> </h3>

                          <a href="#" class="btn btn-primary btn-sm">Available Days <br> <?php echo $row1['available_day'] ?> </a>
                          <a href="#" class="btn btn-primary btn-sm">Work Days <br> <?php echo $row1['work_day'] ?> </a>                         
                          <a href="#" class="btn btn-primary btn-sm">Bill Days <br> <?php echo $row1['bill_day'] ?> </a>
                          <div class="timeline-body">
                          <table class="table table-bordered table-striped" data-show-fullscreen="true" >
                  <thead>


                    <tr>

        
              <th>Date</th>
              <th>QTY</th>
              <th>NO of Bill</th>
                    </tr>
                    </thead>

                  <tbody>
                    <?php $d1= $row1['month']."-"."01";
                    $d2= $row1['month']."-"."31";
                    $day_avg_sql = $db->query("SELECT  * FROM day_avg WHERE code='$code' AND date BETWEEN '$d1' AND '$d2' ORDER  by date ASC ");
                    while ($row2 = $day_avg_sql->fetch()){

                     ?>
                   <tr>
                    
                    <td><?php echo $row2['date']; ?></td>
                    <td><?php echo $row2['qty']; ?></td>
                    <td><?php echo $row2['bill_qty']; ?></td>

                    </tr>

                   <?php $q_tot+=$row2['qty'];$b_tot+=$row2['bill_qty']; }
                  ?>
                    
                  
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>TOTAL</th>
                      <th><?php echo $q_tot; ?></th>
                      <th><?php echo $b_tot; ?></th>
                    </tr>
                  </tfoot>
                </table>
                          </div>
                          <div class="timeline-footer">

                          </div>
                        </div>
                      </div>
                   <?php } ?>   <!-- END timeline item -->
                      
                    
                                           <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>


<!-- select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->

<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>

<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>


<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>


<script>
  $(function () {

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,"select": true,"searching": false,

      dom: 'Bfrtip',
       buttons: [
           {
               extend: 'print',
               customize: function ( win ) {
                   $(win.document.body)
                       .css( 'font-size', '8pt' )


                   $(win.document.body).find( 'table' )
                       .addClass( 'compact' )
                       .css( 'font-size', 'inherit' );
               }
           }
       ]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//--------------------------------------------------------------

//-------------------------------------------------
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


    $('#example').DataTable( {
         dom: 'Bfrtip',
         buttons: [
             {
                 extend: 'print',
                 customize: function ( win ) {
                     $(win.document.body)
                         .css( 'font-size', '10pt' )
                     $(win.document.body).find( 'table' )
                         .addClass( 'compact' )
                         .css( 'font-size', 'inherit' );
                 }
             }
         ]
     } );



  $('.select2').select2();
  $('.select2bs4').select2({
     theme: 'bootstrap4'
   })
  });
  $(document).ready(function(){

  })
</script>
<script src="jquery.tableTotal.js"></script>
</body>
</html>
