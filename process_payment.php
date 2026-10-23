<?php
include 'includes/session.php';
$conn = $pdo->open();

// Redirect to login page if user is not authenticated
if(!isset($_SESSION['user'])){
    $_SESSION['error'] = 'Please login first';
    header('location: login.php');
    exit();
}

if(isset($_POST['checkout_btn'])){
    $user_id = $_SESSION['user'];
    $payment_method = $_POST['payment_method'];
    $sales_date = date('Y-m-d');

    // Determine payment status and transaction ID based on selected method
    if($payment_method == 'Cash'){
        $pay_id = 'CASH-' . strtoupper(bin2hex(random_bytes(4)));
        $payment_status = 'Pending';
    }
    else{
        $prefix = strtoupper(substr($payment_method, 0, 3));
        $pay_id = $prefix . '-' . strtoupper(bin2hex(random_bytes(4)));
        $payment_status = 'Completed';
    }

    try{
        // 1. Insert order record into sales table
        $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, payment_method, payment_status) VALUES (:user_id, :pay_id, :sales_date, :payment_method, :payment_status)");
        $stmt->execute([
            'user_id' => $user_id,
            'pay_id' => $pay_id,
            'sales_date' => $sales_date,
            'payment_method' => $payment_method,
            'payment_status' => $payment_status
        ]);
        $sales_id = $conn->lastInsertId();

        // 2. Fetch cart items and insert each item into details table
        $stmt = $conn->prepare("SELECT *, cart.id AS cartid, products.id AS prodid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
        $stmt->execute(['user_id'=>$user_id]);

        $total_amount = 0;
        $order_items = [];

        foreach($stmt as $row){
            $subtotal = $row['price'] * $row['quantity'];
            $total_amount += $subtotal;
            $order_items[] = $row;

            $stmt_details = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
            $stmt_details->execute([
                'sales_id' => $sales_id,
                'product_id' => $row['prodid'],
                'quantity' => $row['quantity']
            ]);
        }

        // 3. Clear user shopping cart after successful checkout
        $stmt_delete = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
        $stmt_delete->execute(['user_id'=>$user_id]);

        // 4. Render payment receipt / invoice slip
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Payment Receipt - Order #<?php echo $sales_id; ?></title>
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
            <style>
                body {
                    background: #f4f6f9;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    padding: 30px 15px;
                }
                .receipt-container {
                    max-width: 600px;
                    margin: auto;
                    background: #ffffff;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                    padding: 30px;
                    border: 1px solid #eaeaea;
                }
                .receipt-header {
                    text-align: center;
                    padding-bottom: 20px;
                    border-bottom: 2px dashed #eee;
                }
                .receipt-header .icon-success {
                    font-size: 55px;
                    color: #27ae60;
                }
                .receipt-header .icon-pending {
                    font-size: 55px;
                    color: #f39c12;
                }
                .receipt-table {
                    margin-top: 25px;
                    margin-bottom: 20px;
                }
                .receipt-table th {
                    color: #555;
                    font-weight: 600;
                }
                .items-table {
                    margin-top: 15px;
                }
                .btn-print {
                    background: #34495e;
                    color: #fff;
                }
                .btn-print:hover {
                    background: #2c3e50;
                    color: #fff;
                }
            </style>
        </head>
        <body>

        <div class="receipt-container">
            <div class="receipt-header">
                <?php if($payment_status == 'Completed'): ?>
                    <i class="fa fa-check-circle icon-success"></i>
                    <h2 style="margin: 10px 0 5px 0; font-weight: bold; color: #2c3e50;">Payment Successful!</h2>
                    <p class="text-muted">Thank you! Your payment has been received successfully.</p>
                <?php else: ?>
                    <i class="fa fa-clock-o icon-pending"></i>
                    <h2 style="margin: 10px 0 5px 0; font-weight: bold; color: #2c3e50;">Order Placed!</h2>
                    <p class="text-muted">Your Cash on Delivery order has been placed. Payment is pending.</p>
                <?php endif; ?>
            </div>

            <!-- Order & Payment Details -->
            <table class="table table-bordered receipt-table">
                <tr>
                    <th width="40%">Order ID</th>
                    <td class="text-right"><strong>#<?php echo $sales_id; ?></strong></td>
                </tr>
                <tr>
                    <th>Transaction / Pay ID</th>
                    <td class="text-right"><span style="font-family: monospace; font-size: 14px; font-weight: bold;"><?php echo $pay_id; ?></span></td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td class="text-right"><span class="label label-primary"><?php echo htmlspecialchars($payment_method); ?></span></td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td class="text-right">
                        <?php if($payment_status == 'Pending'): ?>
                            <span class="label label-warning">Pending</span>
                        <?php else: ?>
                            <span class="label label-success">Completed</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td class="text-right"><?php echo date('M d, Y', strtotime($sales_date)); ?></td>
                </tr>
            </table>

            <!-- Purchased Items Breakdown -->
            <h4 style="font-weight: bold; margin-top: 20px;"><i class="fa fa-list"></i> Order Items</h4>
            <table class="table table-striped items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td class="text-center"><?php echo $item['quantity']; ?></td>
                            <td class="text-right">&#2547; <?php echo number_format($item['price'], 2); ?></td>
                            <td class="text-right">&#2547; <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="active" style="font-size: 16px;">
                        <th colspan="3" class="text-right">Total Amount:</th>
                        <th class="text-right" style="color: #c0392b;">&#2547; <?php echo number_format($total_amount, 2); ?></th>
                    </tr>
                </tbody>
            </table>

            <div class="text-center" style="margin-top: 30px;">
                <button onclick="window.print()" class="btn btn-print btn-flat"><i class="fa fa-print"></i> Print Receipt</button>
                <a href="index.php" class="btn btn-success btn-flat" style="margin-left: 10px;"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
            </div>
        </div>

        </body>
        </html>
        <?php
        $pdo->close();
        exit();

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
        $pdo->close();
        header('location: checkout.php');
        exit();
    }
}
else{
    $pdo->close();
    header('location: cart_view.php');
    exit();
}
?>