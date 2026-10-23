<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for Sales Page -->
<style>
  .content-header h1 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
  }
  .sales-box {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    overflow: hidden;
  }
  .sales-box .box-header {
    background: #ffffff;
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
  }
  .filter-input-group {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }
  .filter-input-group .input-group-addon {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #64748b;
  }
  .filter-input-group input {
    border-color: #cbd5e1;
    font-weight: 500;
    color: #334155;
    height: 36px;
  }
  .btn-print {
    height: 36px;
    border-radius: 8px;
    font-weight: 600;
    padding: 7px 18px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25);
    transition: all 0.2s ease;
  }
  .btn-print:hover {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
  }
  /* Modern Clean Table */
  #salesTable {
    border-collapse: separate;
    border-spacing: 0;
    width: 100% !important;
  }
  #salesTable thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-top: none;
    border-bottom: 2px solid #e2e8f0;
    padding: 14px 12px;
  }
  #salesTable tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    color: #334155;
    font-size: 14px;
  }
  #salesTable tbody tr:hover {
    background-color: #f8fafc;
  }
  /* Payment Method Badges */
  .badge-method {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }
  .method-bkash {
    background: #fdf2f8;
    color: #db2777;
    border: 1px solid #fbcfe8;
  }
  .method-nagad {
    background: #fff7ed;
    color: #ea580c;
    border: 1px solid #ffedd5;
  }
  .method-visa {
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #dbeafe;
  }
  .method-cash {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }
  /* Status Badges */
  .badge-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
  }
  .status-completed {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
  }
  .status-pending {
    background: #fffbeb;
    color: #d97706;
    border: 1px solid #fde68a;
  }
  .status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
  }
  .status-completed .status-dot { background: #10b981; }
  .status-pending .status-dot { background: #f59e0b; }
  /* Action Button */
  .btn-view-details {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 12px;
    transition: all 0.2s ease;
  }
  .btn-view-details:hover {
    background: #3b82f6;
    color: #ffffff;
    border-color: #3b82f6;
    box-shadow: 0 2px 6px rgba(59, 130, 246, 0.3);
  }
  .pay-code {
    font-family: 'Consolas', 'Monaco', monospace;
    font-weight: 700;
    color: #0f172a;
    background: #f8fafc;
    padding: 3px 6px;
    border-radius: 4px;
    border: 1px solid #e2e8f0;
  }
  .amount-highlight {
    font-weight: 700;
    color: #0f172a;
    font-size: 15px;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top: 20px; padding-bottom: 15px;">
      <h1>
        <i class="fa fa-shopping-bag" style="color: #3b82f6; margin-right: 8px;"></i> Sales History
      </h1>
      <ol class="breadcrumb" style="padding-top: 8px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box sales-box">
            <div class="box-header with-border">
              <div class="pull-left">
                <h4 style="margin: 6px 0 0 0; font-weight: 700; color: #334155; font-size: 16px;">
                  All Orders & Transactions
                </h4>
              </div>
              <div class="pull-right">
                <form method="POST" class="form-inline" action="sales_print.php">
                  <div class="input-group filter-input-group" style="margin-right: 6px;">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" name="date_range" placeholder="Select date range" style="width: 210px;">
                  </div>
                  <button type="submit" class="btn btn-success btn-print" name="print">
                    <i class="fa fa-print" style="margin-right: 5px;"></i> Print / PDF
                  </button>
                </form>
              </div>
            </div>

            <div class="box-body" style="padding: 20px;">
              <table id="salesTable" class="table table-hover">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Buyer Name</th>
                  <th>Transaction#</th>
                  <th>Payment Method</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      // Fetch all sales records with user details
                      $stmt = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id ORDER BY sales_date DESC");
                      $stmt->execute();
                      foreach($stmt as $row){
                        // Calculate total amount for this sale
                        $stmt_details = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
                        $stmt_details->execute(['id'=>$row['salesid']]);
                        $total = 0;
                        foreach($stmt_details as $details){
                          $subtotal = $details['price'] * $details['quantity'];
                          $total += $subtotal;
                        }

                        // Determine modern status badge
                        $status_badge = ($row['payment_status'] == 'Pending') 
                          ? "<span class='badge-status status-pending'><span class='status-dot'></span> Pending</span>" 
                          : "<span class='badge-status status-completed'><span class='status-dot'></span> Completed</span>";

                        // Determine method style
                        $raw_method = !empty($row['payment_method']) ? strtolower($row['payment_method']) : '';
                        $method_class = 'method-cash';
                        if(strpos($raw_method, 'bkash') !== false) {
                          $method_class = 'method-bkash';
                        } elseif(strpos($raw_method, 'nagad') !== false) {
                          $method_class = 'method-nagad';
                        } elseif(strpos($raw_method, 'visa') !== false || strpos($raw_method, 'card') !== false) {
                          $method_class = 'method-visa';
                        }

                        $method_label = !empty($row['payment_method']) ? htmlspecialchars($row['payment_method']) : 'N/A';

                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td style='font-weight: 600; color: #475569;'>".date('M d, Y', strtotime($row['sales_date']))."</td>
                            <td style='font-weight: 600; color: #1e293b;'>".htmlspecialchars($row['firstname'].' '.$row['lastname'])."</td>
                            <td><span class='pay-code'>".htmlspecialchars($row['pay_id'])."</span></td>
                            <td><span class='badge-method ".$method_class."'>".$method_label."</span></td>
                            <td class='amount-highlight'>&#2547; ".number_format($total, 2)."</td>
                            <td>".$status_badge."</td>
                            <td align='center'>
                              <button type='button' class='btn btn-sm btn-view-details transact' data-id='".$row['salesid']."'>
                                <i class='fa fa-eye' style='margin-right: 4px;'></i> View
                              </button>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  <?php include 'includes/footer.php'; ?>
  <?php include '../includes/profile_modal.php'; ?>
  <?php include 'includes/modal_sales.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>

<!-- Date Picker & Table Init Scripts -->
<script>
$(function(){
  // Initialize DataTable on sales table
  if ($.fn.DataTable.isDataTable('#salesTable')) {
    $('#salesTable').DataTable();
  } else {
    $('#salesTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": []
    });
  }

  // Date range picker initialization
  $('#reservation').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    }
  });

  // Modal open on view transaction
  $(document).on('click', '.transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'transact.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
        $('#date').html(response.date);
        $('#transid').html(response.transaction);
        if($('#pay_method').length) $('#pay_method').html(response.payment_method);
        if($('#pay_status').length) $('#pay_status').html(response.payment_status);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
      }
    });
  });

  $("#transaction").on("hidden.bs.modal", function () {
    $('.prepend_items').remove();
  });
});
</script>
</body>
</html>