<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORDER LIST</title>
  <link rel="icon" href="img/Asset 67 (2).png">
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

  <script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('techno[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
$(function() {

$(".delbutton").click(function(){

//Save the link in a variable called element

var element = $(this);

//Find the id of the link that was clicked

var del_id = element.attr("id");

//Built a url to send

var info = 'id=' + del_id;

if(confirm("Sure you want to delete this Order? There is NO undo!"))

 {

$.ajax({

type: "GET",

url: "sales_dll.php",

data: info,

success: function(){

}

});

$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")

.animate({ opacity: "hide" }, "slow");

}

return false;

});

});
</script>
  <script>
     
function showResult(str) {
  if (str.length==0) {
    document.getElementById("serch").innerHTML="";
    document.getElementById("serch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("serch").innerHTML=this.responseText;
      document.getElementById("serch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","order_list_serch.php?q="+str+"&group=",true);
  xmlhttp.send();
  
}

function showResult2(str) {
  if (str.length==0) {
    document.getElementById("serch").innerHTML="";
    document.getElementById("serch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("serch").innerHTML=this.responseText;
      document.getElementById("serch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","order_list_serch.php?group="+str+"&q=",true);
  xmlhttp.send();
}
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
            <h2 class="text-center display-4">Search</h2>
            <div class="row">
                <div class="col-md-5 offset-md-2">
                    
                        <div class="input-group">
                            <input onkeyup="showResult(this.value)" type="search" class="form-control form-control-lg" placeholder="Type Product Name Or Code  here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    
                </div>
                <div class="col-md-3">
                <div class="form-group">
                  <select onchange="showResult2(this.value)" class="form-control form-control-lg select2"  >
                    
                    <?php $stmt = $db->query("SELECT  * FROM item_group WHERE type='ITEMGROU'");
                    while ($row2 = $stmt->fetch()){ ?>
                    <option value="<?php echo $row2['code']; ?>"><?php echo $row2['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
            </div>
        </div>
<br>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

          <form action="order_list_save.php" method="post" enctype="multipart/form-data">  
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
   <div id='serch' >  

   </div>  
</form>    
            <!-- /.card -->

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                  <h1>PRODUCT LIST</h1>
                <table id="example2" class="table table-bordered table-striped" data-show-fullscreen="true">
                  <thead>


                    <tr>

              <th>id</th>
              <th>Name</th>
              <th>Code</th>
              <th>Stock QTY</th>
              <th>Order QTY</th>
              <th>Stock Level</th>
              <th>Decision</th>
              <th>#</th>
                    </tr>



                    </thead>

                  <tbody >
                    <?php include('../connect.php');
                  date_default_timezone_set("Asia/Colombo");

$id=$_GET['id'];
                    $stmt = $db->query("SELECT  * FROM order_list WHERE order_id='$id' AND action < '5' ORDER by id DESC ");
                    while ($row2 = $stmt->fetch()){
                        $disi=$row2['stock_level']-$row2['stock_qty'];


?>
<tr class='record' >
                    <td><?php echo $row2['id'] ?></td>
                    <td><?php echo $row2['name'] ?></td>
                    <td><?php echo $row2['code'] ?></td>
                    <td><?php echo $row2['stock_qty'] ?></td>
                    <td><?php echo $row2['qty'] ?></td>
                    <td><?php echo $row2['stock_level'] ?></td>
                    <td><?php if($disi > 0){echo "<b style='color:#1D8348 ;'>GOOD</b>";}else{echo "<b style='color:red;'>Bad</b>";} ?></td>
                    <td> <a class="btn btn-danger btn-md delbutton" href="order_list_dll.php?id=<?php echo $row2['id']; ?>&ord=<?php echo $id; ?>&dip=order_list.php"><i class="fas fa-trash-alt"></i></a> </td>
                    </tr> 

                   <?php }
                  ?>                    
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table> <br>
                <form action="order_save.php" method="post" enctype="multipart/form-data">  
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <div class="row">
 
                <div class="col-md-3">
                <div class="form-group">
                <div class="input-group-addon">
                    <label>Supplier</label>
                  </div>
                  <select class="form-control form-control-lg select2" name="sup_id" >
                    
                    <?php $stmt = $db->query("SELECT  * FROM supplier ");
                    while ($row2 = $stmt->fetch()){ ?>
                    <option value="<?php echo $row2['id']; ?>"><?php echo $row2['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                <div class="input-group-addon">
                    <label>Note</label>
                  </div>
                  <input class="form-control form-control-md " name="note" type="text">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-3">
                <div class="form-group">
                <div class="input-group-addon">
                    <label>.</label>
                  </div>
                <input class="btn btn-danger btn-md" type="submit" value="SAVE ORDER" name="sub">
                </div>
                    </form>
                <!-- /.form-group -->
              </div>
              </div>

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
