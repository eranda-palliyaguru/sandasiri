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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php // include("hed.php"); ?>
  <?php include("sidebar.php"); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

<?php $id=$_GET['id'];
$stmt = $db->query("SELECT  * FROM item WHERE id = '$id'  ");
                    while ($row2 = $stmt->fetch()){ ?>
                <h3 class="profile-username text-center"><?php echo $row2['name']; ?></h3>

                <p class="text-muted text-center">CODE: <?php echo $row2['sys_id']; ?></p>

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

$stmt = $db->query("SELECT  SUM(qty) FROM month_avg WHERE code='$code'   ");
while ($row1 = $stmt->fetch()){ 
    $tot_sales=$row1['SUM(qty)'];    
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
        <?php echo $tot_avg; ?>
                </p>

                <hr>
                <strong><i class="fas fa-book mr-1"></i> Average Per Bill (qty)</strong>

<p class="text-muted">
<?php echo $bill_avg; ?>
</p>

<hr>

<strong><i class="fas fa-book mr-1"></i> Total Sales QTY</strong>

<p class="text-muted">
<?php echo $tot_sales; ?>
</p>

<hr>

<strong><i class="fas fa-book mr-1"></i> Start Date</strong>

<p class="text-muted">
<?php echo $start; ?>
</p>

<hr>

<strong><i class="fas fa-book mr-1"></i> Last Update</strong>

<p class="text-muted">
<?php echo $update; ?>
</p>

<hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
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
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
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
