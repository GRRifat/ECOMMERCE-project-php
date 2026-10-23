<?php
    include 'includes/session.php';

    // Verify user is authenticated as admin
    if(!isset($_SESSION['admin'])){
        header('location: ../index.php');
        exit();
    }

    if(isset($_POST['print'])){
        $date_range = trim($_POST['date_range']);

        if(!empty($date_range) && strpos($date_range, ' - ') !== false){
            $ex = explode(' - ', $date_range);
            $from = date('Y-m-d', strtotime(trim($ex[0])));
            $to = date('Y-m-d', strtotime(trim($ex[1])));
        } else {
            // Default: Show all sales up to today if date range is empty
            $from = '2000-01-01';
            $to = date('Y-m-d');
        }

        $from_title = date('M d, Y', strtotime($from));
        $to_title = date('M d, Y', strtotime($to));

        $conn = $pdo->open();

        // Fetch sales within date range (including day end)
        $stmt_sales = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id WHERE sales_date >= :from_date AND sales_date <= :to_date ORDER BY sales_date DESC");
        $stmt_sales->execute(['from_date'=>$from, 'to_date'=>$to]);

        $rows = '';
        $total = 0;
        $order_count = 0;
        $completed_count = 0;
        $pending_count = 0;

        foreach($stmt_sales as $row){
            $order_count++;
            
            // Calculate total for each sale record
            $stmt_details = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
            $stmt_details->execute(['id'=>$row['salesid']]);
            $amount = 0;
            foreach($stmt_details as $details){
                $amount += ($details['price'] * $details['quantity']);
            }
            $total += $amount;

            $method = !empty($row['payment_method']) ? htmlspecialchars($row['payment_method']) : 'N/A';
            $raw_method = strtolower($method);
            
            // Payment method badge styling
            $method_class = 'badge-other';
            if(strpos($raw_method, 'bkash') !== false) {
                $method_class = 'badge-bkash';
            } elseif(strpos($raw_method, 'nagad') !== false) {
                $method_class = 'badge-nagad';
            } elseif(strpos($raw_method, 'visa') !== false || strpos($raw_method, 'card') !== false) {
                $method_class = 'badge-visa';
            } elseif(strpos($raw_method, 'cash') !== false) {
                $method_class = 'badge-cash';
            }

            if($row['payment_status'] == 'Pending'){
                $pending_count++;
                $status = '<span class="status-pill status-pending">Pending</span>';
            } else {
                $completed_count++;
                $status = '<span class="status-pill status-completed">Completed</span>';
            }

            $rows .= '
                <tr>
                    <td class="text-center">'.date('M d, Y', strtotime($row['sales_date'])).'</td>
                    <td><strong>'.htmlspecialchars($row['firstname'].' '.$row['lastname']).'</strong></td>
                    <td><span class="mono-code">'.htmlspecialchars($row['pay_id']).'</span></td>
                    <td class="text-center"><span class="method-tag '.$method_class.'">'.$method.'</span></td>
                    <td class="text-center">'.$status.'</td>
                    <td class="text-right amount-col">&#2547; '.number_format($amount, 2).'</td>
                </tr>
            ';
        }
        $pdo->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Statement (<?php echo $from_title . ' - ' . $to_title; ?>)</title>
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        body {
            background-color: #f1f5f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #1e293b;
            padding: 30px 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .page-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            padding: 40px;
        }

        /* Top Action Bar */
        .action-bar {
            max-width: 900px;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-action-back {
            background: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-action-back:hover {
            background: #f8fafc;
            color: #0f172a;
        }
        .btn-action-print {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: none;
            padding: 9px 22px;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-action-print:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
            color: #ffffff;
        }

        /* Header Document Section */
        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 25px;
        }
        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .brand-subtitle {
            font-size: 13px;
            color: #64748b;
            margin: 0;
            font-weight: 500;
        }
        .statement-meta {
            text-align: right;
        }
        .statement-meta h3 {
            margin: 0 0 6px 0;
            font-size: 18px;
            font-weight: 700;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .statement-meta p {
            margin: 2px 0;
            font-size: 12px;
            color: #64748b;
        }
        .statement-meta strong {
            color: #1e293b;
        }

        /* Summary Stat Cards */
        .stats-summary-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }
        .stat-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
        }
        .stat-item .stat-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .stat-item .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .stat-item.highlight {
            background: #eff6ff;
            border-color: #bfdbfe;
        }
        .stat-item.highlight .stat-value {
            color: #1d4ed8;
        }

        /* Custom Table Design */
        .statement-table {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        .statement-table thead th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 2px solid #cbd5e1;
            padding: 10px 12px;
        }
        .statement-table tbody td {
            padding: 11px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            color: #334155;
        }
        .statement-table tbody tr:nth-child(even) {
            background-color: #fafbfc;
        }
        .mono-code {
            font-family: "Consolas", "Courier New", monospace;
            font-size: 12px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            color: #0f172a;
            font-weight: 600;
        }
        .amount-col {
            font-weight: 700;
            color: #0f172a;
            font-size: 13px;
        }

        /* Payment Method Pill */
        .method-tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }
        .badge-bkash { background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; }
        .badge-nagad { background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5; }
        .badge-visa  { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
        .badge-cash  { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }
        .badge-other { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

        /* Status Pill */
        .status-pill {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
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

        /* Total Row */
        .grand-total-row td {
            background: #f8fafc !important;
            border-top: 2px solid #cbd5e1 !important;
            border-bottom: 2px solid #cbd5e1 !important;
            padding: 12px 14px;
            font-size: 14px;
        }
        .grand-total-amount {
            font-size: 16px;
            font-weight: 800;
            color: #1d4ed8;
        }

        /* Statement Footer */
        .doc-footer {
            margin-top: 35px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #94a3b8;
            font-size: 11px;
        }

        /* Print Media Styles */
        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .page-container {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
                max-width: 100%;
            }
            .statement-table tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- Top Action Bar (Hidden in Print Mode) -->
    <div class="action-bar no-print">
        <a href="sales.php" class="btn-action-back">
            <i class="fa fa-arrow-left"></i> Back to Sales
        </a>
        <button onclick="window.print()" class="btn-action-print">
            <i class="fa fa-print"></i> Download as PDF / Print
        </button>
    </div>

    <!-- Printable Statement Paper Container -->
    <div class="page-container">

        <!-- Header -->
        <div class="doc-header">
            <div>
                <h1 class="brand-title">
                    <i class="fa fa-shopping-bag" style="color: #2563eb;"></i> ECOMMERCE STORE
                </h1>
                <p class="brand-subtitle">Official Statement of Sales & Transactions</p>
            </div>
            <div class="statement-meta">
                <h3>Sales Statement</h3>
                <p>Date Range: <strong><?php echo $from_title . ' — ' . $to_title; ?></strong></p>
                <p>Generated: <strong><?php echo date('M d, Y h:i A'); ?></strong></p>
            </div>
        </div>

        <!-- Executive Summary Cards -->
        <div class="stats-summary-row">
            <div class="stat-item">
                <div class="stat-label">Total Orders</div>
                <div class="stat-value"><?php echo $order_count; ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Completed</div>
                <div class="stat-value" style="color: #059669;"><?php echo $completed_count; ?></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Pending</div>
                <div class="stat-value" style="color: #d97706;"><?php echo $pending_count; ?></div>
            </div>
            <div class="stat-item highlight">
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value grand-total-amount">&#2547; <?php echo number_format($total, 2); ?></div>
            </div>
        </div>

        <!-- Table of Orders -->
        <table class="statement-table">
            <thead>
                <tr>
                    <th width="14%" class="text-center">Date</th>
                    <th width="23%">Buyer Name</th>
                    <th width="23%">Transaction#</th>
                    <th width="14%" class="text-center">Method</th>
                    <th width="12%" class="text-center">Status</th>
                    <th width="14%" class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!empty($rows)){
                        echo $rows;
                    } else {
                        echo '<tr><td colspan="6" align="center" style="padding: 30px; color: #94a3b8; font-style: italic;">No sales records found within this date range.</td></tr>';
                    }
                ?>
                <tr class="grand-total-row">
                    <td colspan="5" align="right"><strong>Grand Total Amount:</strong></td>
                    <td align="right" class="grand-total-amount">&#2547; <?php echo number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Document Footer -->
        <div class="doc-footer">
            <span>Report generated from Admin Control Center</span>
            <span>All values stated in Bangladeshi Taka (BDT &#2547;)</span>
        </div>

    </div>

    <script>
        // Open print dialog automatically on document load
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
<?php
    } else {
        $_SESSION['error'] = 'Need date range to provide sales print';
        header('location: sales.php');
        exit();
    }
?>