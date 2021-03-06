<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CLOUD ARM</title>
  <link rel="icon" href="img/Asset 67 (2).png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition dark-mode  sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->

<?php  include("hed.php");  ?>
<?php include("sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
<?php if($_SESSION['POSITION']=='admin'){ ?>
      <div class="row">
        <?php $date = date('Y-m-d');
        $stmt = $db->query("SELECT  sum(amount), sum(cost_total), count(id) FROM sales WHERE date='$date'  ORDER BY id DESC ");
        while ($row2 = $stmt->fetch()){ 
          $sales=$row2['sum(amount)'];
          $cost=$row2['sum(cost_total)'];
          $count=$row2['count(id)'];
          } 
          ?>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL SALES</span>
                <span class="info-box-number">Rs.<?php echo $sales ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PROFIT</span>
                <span class="info-box-number">Rs.<?php echo $sales-$cost; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">BILL COUNT</span>
                <span class="info-box-number"><?php echo $count; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cloud-upload-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LAST UPDATE</span>
                <span class="info-box-number"><?php $stmt = $db->query("SELECT  * FROM sales  ORDER BY id DESC LIMIT 1");
                                  while ($row2 = $stmt->fetch()){ echo $row2['date'];} ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

      </div>


  <div class="row">
    <div class=" col-md-5">
      <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Best Sales Person</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Bill</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php $date=date('Y-m').'-01'; $date2=date('Y-m').'-31';
                  $stmt = $db->query("SELECT  SUM(amount), person, COUNT(amount) FROM sales WHERE date BETWEEN '$date' AND '$date2' GROUP BY person ORDER BY SUM(amount) DESC LIMIT 7");
                  while ($row2 = $stmt->fetch()){ $em_code=$row2['person'];?>
                  <tr>
                    <td>
                      <img src="user_pic/hemantha.jpeg" alt="Product 1" class="img-circle img-size-32 mr-2">
                      <?php $slp= $db->query("SELECT name FROM employee WHERE code='$em_code'");
                      while($row = $slp->fetch()){ echo $row['name']; } ?>
                    </td>
                    <td>Rs.<?php echo $row2['SUM(amount)'] ?></td>
                    <td>                     
                    <?php echo $row2['COUNT(amount)'] ?>
                    </td>                   
                  </tr>
                  <?php } ?>                                        
                  </tbody>
                </table>
              </div>
            </div>
      </div>
      <div class=" col-md-7">
                  <!-- solid sales graph -->
                  <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">

              <?php $month=date('Y-m');
              $y=date('Y');$m=date('m');
              $available_day=cal_days_in_month(CAL_GREGORIAN, $m, $y);

              $stmt = $db->query("SELECT  amount FROM month_target WHERE month= '$month'");
              while ($row1 = $stmt->fetch()){ $target=$row1['amount'];} 

              $date1=date('Y-m').'-01';
              $date2=date('Y-m-d');

              $stmt = $db->query("SELECT  SUM(amount) FROM month_avg  WHERE month='$month'");
              while ($row1 = $stmt->fetch()){ $ach=$row1['SUM(amount)'];}

                      $sday= strtotime( $date1);
                      $nday= strtotime($date2);
                      $tdf= abs($nday-$sday);
                      $nbday1= $tdf/86400;
                      $s_date= intval($nbday1)+1;

              $available_day1=$available_day/100;
              $day_cap=$s_date/$available_day1;
              $day_cap=round($day_cap,0); // day %

              $target1=$target/100;
              $ach_cap=$ach/$target1;
              $ach_cap=round($ach_cap,0); // target %

              $day_tag=$target/$available_day;
              $cur_tag=$day_tag*$s_date;
              $cur_tag1=$cur_tag/100;
              $cur_cap=$ach/$cur_tag1;
              $cur_cap=round($cur_cap,0); // current %
              ?>


                <div class="row">
                  <div class="col-4 text-center">
                    
                    <input type="text" class="knob" data-readonly="true" value="<?php echo $ach_cap ?>" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Target Achievement <?php echo $ach_cap ?>%</div>
                    
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="<?php echo $cur_cap ?>" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Current Achievement <?php echo $cur_cap ?>%</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="<?php echo $day_cap ?>" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Working Days <?php echo $day_cap; ?>%</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
    </div>
          <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">TOP 10 SALES</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Invoice NO.</th>
                      <th>DATE</th>
                      <th>AMOUNT</th>
                      <th>COST</th>
                      <th>DISCOUNT</th>
                      <th>PROFIT</th>
                      <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $y=date('Y');
                        $m=date('m')-12;
                        if($m<1){
                            $m=12+$m;
                            $y=$y-1;
                        }
                        $m=str_pad($m,2,"0",STR_PAD_LEFT);
                        $date=$y.'-'.$m."-01";
                        $date2=date('Y-m-d');

                        $stmt = $db->query("SELECT  * FROM sales WHERE amount > '100000' AND date BETWEEN '$date' AND '$date2' ORDER BY amount DESC LIMIT 10");
                                  while ($row2 = $stmt->fetch()){  
                        ?>
                    <tr>
                      <td><?php echo $row2['id'] ?></td>
                      <td><?php echo $row2['date'] ?></td>
                      <td>Rs.<?php echo $row2['amount'] ?></td>
                      <td>Rs.<?php echo $row2['cost_total'] ?></td>
                      <td>Rs.<?php echo $row2['dis'] ?></td>
                      <td>Rs.<?php echo $row2['amount']-$row2['cost_total'] ?></td>
                      <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-<?php echo $row2['id'] ?>">
                      VIew</button></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table> 
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              </div>
              <!-- /.card-footer -->
            </div>
            <?php } ?>
        <div class="row">
          <div class="col-md-6">
            
            
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-12">

          <!-- BAR CHART -->
          <div class="card card-">
              <div class="card-header">
                <h3 class="card-title">Number OF Bill </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- LINE CHART -->
            <div class="card card-">
              <div class="card-header">
                <h3 class="card-title">Quantity</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
            <?php 
                    $stmt = $db->query("SELECT  * FROM sales WHERE amount > '100000' AND date BETWEEN '$date' AND '$date2' ORDER BY amount DESC LIMIT 10");
                    while ($row2 = $stmt->fetch()){

                  ?>
                <div class="container-fluid">
        <div class="row">

          <div class="modal fade" id="modal-<?php echo $row2['id'] ?>">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">INVOICE NO:-<?php echo $row2['sys_invo'] ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table id="example2" class="table table-bordered table-striped" >
                  <thead>


              <tr>             
              <th>Name</th>
              <th>QTY</th>
              <th>COST</th>
              <th>AMOUNT</th>
              <th>PROFIT</th>
                    </tr>
                    </thead>
                  <tbody >
                    <?php $id=$row2['invo_no'];
                    $stmt2 = $db->query("SELECT  * FROM INVOICE_DTL WHERE sys_invo='$id' ");
                    while ($row = $stmt2->fetch()){ $item=$row['item_code'];
                         ?>
                    <tr >
                    
                    <td><?php $stmtr = $db->query("SELECT  name FROM item WHERE sys_id='$item' ");
                    while ($row3 = $stmtr->fetch()){ echo $row3['name']; }?></td>
                    <td><?php echo $row['qty'] ?></td>
                    <td>Rs.<?php echo $row['cost_price'] ?></td>
                    <td>Rs.<?php echo $row['amount'] ?></td>
                    <td>Rs.<?php echo $row['amount']-$row['cost_price'] ?></td>                   
                    </tr>

                   <?php }
                  ?>
                    
                  
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
                <p> <b class="text-info">Date:</b> <?php echo $row2['date'];?> <br>
                    <b class="text-info">Total Amount:</b> Rs.<?php echo $row2['amount'];?> <br>
                    <b class="text-info">Total Cost:</b> Rs.<?php echo $row2['cost_total'];?> <br>
                    <b class="text-info">Total Profit:</b>  Rs.<?php echo $row2['amount']-$row2['cost_total'];?> <br></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php } ?>


          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $(function () {

      // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels: [<?php 
    $y=date('Y')-1;
    $m=date('m');

    $da=$y."-".$m;
          $stmt = $db->query("SELECT  month FROM month_avg WHERE month > '$da' GROUP BY month ORDER BY month ASC LIMIT 12");
                    while ($row2 = $stmt->fetch()){  echo "'".$row2['month']."',"; }?>],
    datasets: [
      {
        label: 'Sales Value',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        data: [<?php 
          $stmt = $db->query("SELECT  SUM(amount) FROM month_avg WHERE month > '$da' GROUP BY month ORDER BY month ASC LIMIT 12");
                    while ($row2 = $stmt->fetch()){  echo $row2['SUM(amount)'].","; }?>]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 2000000,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    //- LINE CHART -
    //--------------
    var qty_Data = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : '<?php echo date('Y'); ?>',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php 
          $s_date=date('Y')."-01";
          $e_date=date('Y')."-12";
          $stmt = $db->query("SELECT  SUM(qty) FROM month_avg WHERE month BETWEEN '$s_date' AND '$e_date' GROUP BY month ORDER BY month ASC");
                    while ($row2 = $stmt->fetch()){  echo $row2['SUM(qty)'].","; }?>]
        },
        {
          label               : '<?php echo $y=date('Y')-1; ?>',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php 
          $s_date=$y."-01";
          $e_date=$y."-12";
          $stmt = $db->query("SELECT  SUM(qty) FROM month_avg WHERE month BETWEEN '$s_date' AND '$e_date' GROUP BY month ORDER BY month ASC");
                    while ($row2 = $stmt->fetch()){  echo $row2['SUM(qty)'].","; }?>]
        },
      ]
    }

    var bill_Options = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }


    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, bill_Options)
    var lineChartData = $.extend(true, {}, qty_Data)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var bill_Data = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : '<?php echo date('Y'); ?>',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php 
          $s_date=date('Y')."-01";
          $e_date=date('Y')."-12";
          $stmt = $db->query("SELECT  SUM(bill) FROM month_avg WHERE month BETWEEN '$s_date' AND '$e_date' GROUP BY month ORDER BY month ASC");
                    while ($row2 = $stmt->fetch()){  echo $row2['SUM(bill)'].","; }?>]
        },
        {
          label               : '<?php echo $y=date('Y')-1; ?>',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php 
          $s_date=$y."-01";
          $e_date=$y."-12";
          $stmt = $db->query("SELECT  SUM(bill) FROM month_avg WHERE month BETWEEN '$s_date' AND '$e_date' GROUP BY month ORDER BY month ASC");
                    while ($row2 = $stmt->fetch()){  echo $row2['SUM(bill)'].","; }?>]
        },
      ]
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, bill_Data)
    var temp0 = bill_Data.datasets[0]
    var temp1 = bill_Data.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
  })
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
