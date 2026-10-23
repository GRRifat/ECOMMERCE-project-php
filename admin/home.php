<?php 
  include 'includes/session.php';
  include 'includes/format.php'; 
?>
<?php 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

  $conn = $pdo->open();
?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Dashboard Styling -->
<style>
  .content-header h1 {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
  }
  .stat-card {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
    margin-bottom: 25px;
    color: #fff;
    position: relative;
  }
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  }
  .stat-card .inner {
    padding: 22px 20px;
    position: relative;
    z-index: 2;
  }
  .stat-card h3 {
    font-size: 32px;
    font-weight: 800;
    margin: 0 0 6px 0;
    letter-spacing: -0.5px;
  }
  .stat-card p {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 600;
    margin-bottom: 0;
    opacity: 0.9;
  }
  .stat-card .icon-watermark {
    position: absolute;
    right: 18px;
    bottom: 12px;
    font-size: 68px;
    opacity: 0.18;
    z-index: 1;
    transition: all 0.3s ease;
  }
  .stat-card:hover .icon-watermark {
    transform: scale(1.12);
    opacity: 0.28;
  }
  .stat-card-footer {
    display: block;
    background: rgba(0,0,0,0.12);
    padding: 10px 20px;
    color: rgba(255,255,255,0.92);
    font-weight: 600;
    font-size: 13px;
    text-decoration: none !important;
    transition: all 0.2s ease;
  }
  .stat-card-footer:hover {
    background: rgba(0,0,0,0.22);
    color: #fff;
  }
  /* Modern Gradient Colors */
  .card-gradient-blue {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
  }
  .card-gradient-green {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
  }
  .card-gradient-purple {
    background: linear-gradient(135deg, #8e2de2 0%, #4a00e0 100%);
  }
  .card-gradient-orange {
    background: linear-gradient(135deg, #ff512f 0%, #f09819 100%);
  }
  .chart-box {
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #eef2f6;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    background: #ffffff;
    margin-top: 5px;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Header -->
    <section class="content-header" style="padding-top: 20px; padding-bottom: 15px;">
      <h1>
        <i class="fa fa-dashboard" style="color: #3c8dbc; margin-right: 6px;"></i> E-Commerce Overview
      </h1>
      <ol class="breadcrumb" style="padding-top: 8px;">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main Content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible' style='border-radius: 8px;'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible' style='border-radius: 8px;'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

      <!-- Modern Metrics Row -->
      <div class="row">
        <!-- 1. Total Sales Card -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="stat-card card-gradient-blue">
            <div class="inner">
              <?php
                // Fetch only sales records that currently exist in the sales table
                $stmt = $conn->prepare("SELECT * FROM details 
                                        INNER JOIN sales ON sales.id=details.sales_id 
                                        LEFT JOIN products ON products.id=details.product_id");
                $stmt->execute();

                $total = 0;
                foreach($stmt as $srow){
                  $subtotal = $srow['price'] * $srow['quantity'];
                  $total += $subtotal;
                }

                echo "<h3>&#2547; ".number_format_short($total, 2)."</h3>";
              ?>
              <p>Total Revenue</p>
            </div>
            <i class="fa fa-line-chart icon-watermark"></i>
            <a href="sales.php" class="stat-card-footer">View Full Sales <i class="fa fa-arrow-right pull-right" style="margin-top: 3px;"></i></a>
          </div>
        </div>

        <!-- 2. Products Count Card -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="stat-card card-gradient-green">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products");
                $stmt->execute();
                $prow = $stmt->fetch();

                echo "<h3>".$prow['numrows']."</h3>";
              ?>
              <p>Total Products</p>
            </div>
            <i class="fa fa-cubes icon-watermark"></i>
            <a href="products.php" class="stat-card-footer">Manage Inventory <i class="fa fa-arrow-right pull-right" style="margin-top: 3px;"></i></a>
          </div>
        </div>

        <!-- 3. Customers Card -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="stat-card card-gradient-purple">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE type = 0");
                $stmt->execute();
                $urow = $stmt->fetch();

                echo "<h3>".$urow['numrows']."</h3>";
              ?>
              <p>Active Customers</p>
            </div>
            <i class="fa fa-users icon-watermark"></i>
            <a href="users.php" class="stat-card-footer">Customer List <i class="fa fa-arrow-right pull-right" style="margin-top: 3px;"></i></a>
          </div>
        </div>

        <!-- 4. Today's Sales Card -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="stat-card card-gradient-orange">
            <div class="inner">
              <?php
                // Fetch today's sales that exist in sales table
                $stmt = $conn->prepare("SELECT * FROM details 
                                        INNER JOIN sales ON sales.id=details.sales_id 
                                        LEFT JOIN products ON products.id=details.product_id 
                                        WHERE sales.sales_date = :sales_date");
                $stmt->execute(['sales_date'=>$today]);

                $today_total = 0;
                foreach($stmt as $trow){
                  $subtotal = $trow['price'] * $trow['quantity'];
                  $today_total += $subtotal;
                }

                echo "<h3>&#2547; ".number_format_short($today_total, 2)."</h3>";
              ?>
              <p>Today's Sales</p>
            </div>
            <i class="fa fa-bolt icon-watermark"></i>
            <a href="sales.php" class="stat-card-footer">Today's Transactions <i class="fa fa-arrow-right pull-right" style="margin-top: 3px;"></i></a>
          </div>
        </div>
      </div>

      <!-- Modern Sales Analytics Curved Chart Box -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box chart-box">
            <div class="box-header with-border" style="background: #ffffff; padding: 20px 24px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
              <div>
                <h3 class="box-title" style="font-weight: 700; color: #1e293b; font-size: 18px; margin: 0;">
                  <i class="fa fa-area-chart" style="color: #6366f1; margin-right: 8px;"></i> Annual Revenue Performance
                </h3>
                <small style="color: #64748b; font-size: 13px; display: block; margin-top: 4px;">Monthly revenue statistics in Bangladeshi Taka (&#2547;)</small>
              </div>
              <div class="box-tools" style="position: static;">
                <form class="form-inline" style="display: inline-block;">
                  <div class="form-group" style="margin-bottom: 0;">
                    <label style="color: #475569; font-weight: 600; margin-right: 8px; font-size: 13px;">Year:</label>
                    <select class="form-control" id="select_year" style="border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; height: 34px; padding: 4px 12px; box-shadow: none;">
                      <?php
                        for($i=2015; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "<option value='".$i."' ".$selected.">".$i."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>

            <div class="box-body" style="padding: 24px;">
              <div class="chart" style="position: relative; height: 350px;">
                <canvas id="salesChart" style="height: 350px; width: 100%;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <?php include 'includes/footer.php'; ?>

</div>

<!-- Chart Query Data -->
<?php
  $months = array();
  $sales = array();
  for( $m = 1; $m <= 12; $m++ ) {
    try{
      // Group revenue by month using valid sales records only
      $stmt = $conn->prepare("SELECT * FROM details 
                              INNER JOIN sales ON sales.id=details.sales_id 
                              LEFT JOIN products ON products.id=details.product_id 
                              WHERE MONTH(sales.sales_date)=:month AND YEAR(sales.sales_date)=:year");
      $stmt->execute(['month'=>$m, 'year'=>$year]);
      $m_total = 0;
      foreach($stmt as $srow){
        $subtotal = $srow['price'] * $srow['quantity'];
        $m_total += $subtotal;    
      }
      array_push($sales, round($m_total, 2));
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }

    $month = date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $sales = json_encode($sales);
?>

<?php $pdo->close(); ?>
<?php include 'includes/scripts.php'; ?>

<!-- Chart.js Setup: Curved Area Wave & Indigo Gradient -->
<script>
$(function(){
  var canvas = document.getElementById('salesChart');
  var ctx = canvas.getContext('2d');

  // Smooth vertical gradient for the wave background
  var gradient = ctx.createLinearGradient(0, 0, 0, 350);
  gradient.addColorStop(0, 'rgba(99, 102, 241, 0.40)');
  gradient.addColorStop(0.6, 'rgba(129, 140, 248, 0.12)');
  gradient.addColorStop(1, 'rgba(255, 255, 255, 0.0)');

  var chartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Revenue',
        fillColor           : gradient,
        strokeColor         : '#4f46e5',
        pointColor          : '#ffffff',
        pointStrokeColor    : '#4f46e5',
        pointHighlightFill  : '#4f46e5',
        pointHighlightStroke: '#ffffff',
        data                : <?php echo $sales; ?>
      }
    ]
  };

  var chartOptions = {
    bezierCurve             : true,
    bezierCurveTension      : 0.35,
    pointDot                : true,
    pointDotRadius          : 4,
    pointDotStrokeWidth     : 2,
    pointHitDetectionRadius : 15,
    datasetStroke           : true,
    datasetStrokeWidth      : 3,
    datasetFill             : true,
    scaleBeginAtZero        : true,
    scaleShowGridLines      : true,
    scaleGridLineColor      : 'rgba(241, 245, 249, 1)',
    scaleGridLineWidth      : 1,
    scaleFontFamily         : "'Segoe UI', 'Helvetica Neue', Arial, sans-serif",
    scaleFontSize           : 12,
    scaleFontColor          : '#94a3b8',
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines  : false,
    responsive              : true,
    maintainAspectRatio     : false,
    tooltipTemplate         : " <%= label %>:  ৳ <%= value.toLocaleString() %> ",
    tooltipFillColor        : 'rgba(15, 23, 42, 0.92)',
    tooltipFontFamily       : "'Segoe UI', sans-serif",
    tooltipFontSize         : 13,
    tooltipFontStyle        : "bold",
    tooltipCornerRadius     : 8,
    tooltipXPadding         : 12,
    tooltipYPadding         : 8
  };

  new Chart(ctx).Line(chartData, chartOptions);

  $('#select_year').change(function(){
    window.location.href = 'home.php?year=' + $(this).val();
  });
});
</script>
</body>
</html>