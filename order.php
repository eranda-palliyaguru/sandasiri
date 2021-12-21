<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORDER</title>

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
  <?php $_SESSION['group']=0; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
            <h2 class="text-center display-4">PRODUCT ORDER</h2>
        </div>
<br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


  
  
         <a href="order_list.php?id=<?php echo date('ymdhis'); ?>"> <input class="btn btn-success btn-md" type="submit" value="CREATE NEW ORDER" name="sub"></a>
            <!-- /.card -->

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                  <h3>PRODUCT ORDER LIST</h3>
                <table id="example2" class="table table-bordered table-striped" data-show-fullscreen="true">
                  <thead>


              <tr>
              <th>id</th>
              <th>Supplier Name</th>
              <th>Code</th>
              <th>Date</th>
              <th>Type</th>
              </tr>

                    </thead>

                  <tbody >
                    <?php include('../connect.php');
                  date_default_timezone_set("Asia/Colombo");

                    $stmt = $db->query("SELECT  * FROM order_hed WHERE action < 10 ORDER by id DESC ");
                    while ($row2 = $stmt->fetch()){

?>
<tr >
                    <td><?php echo $row2['id'] ?></td>
                    <td><?php echo $row2['sup_name'] ?></td>
                    <td><?php echo $row2['sup_code'] ?></td>
                    <td><?php echo $row2['date'] ?></td>
                    <td></td>
                    
                    </tr>

                   <?php }
                  ?>
                    
                  
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
      "responsive": true, "lengthChange": false, "autoWidth": true,"select": true,"searching": true,"paging": true,

      dom: 'Bfrtip',
        buttons: [
            
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
