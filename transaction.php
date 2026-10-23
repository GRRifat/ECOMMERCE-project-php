<?php
    include 'includes/session.php';

    // Verify customer is logged in
    if(!isset($_SESSION['user'])){
        echo json_encode(['error' => 'Please login first']);
        exit();
    }

    $id = $_POST['id'];
    $user_id = $_SESSION['user'];

    $conn = $pdo->open();

    $output = array(
        'list' => '',
        'transaction' => '',
        'date' => '',
        'payment_method' => '',
        'payment_status' => '',
        'total' => ''
    );

    try {
        // Fetch sale record ensuring it belongs to the logged-in customer
        $stmt_sale = $conn->prepare("SELECT * FROM sales WHERE id = :id AND user_id = :user_id");
        $stmt_sale->execute(['id' => $id, 'user_id' => $user_id]);
        $sale = $stmt_sale->fetch();

        if($sale){
            $output['transaction'] = $sale['pay_id'];
            $output['date'] = date('M d, Y', strtotime($sale['sales_date']));
            $output['payment_method'] = !empty($sale['payment_method']) ? htmlspecialchars($sale['payment_method']) : 'N/A';
            
            // Format payment status badge
            if($sale['payment_status'] == 'Pending'){
                $output['payment_status'] = "<span class='label label-warning'>Pending</span>";
            }
            else{
                $output['payment_status'] = "<span class='label label-success'>Completed</span>";
            }

            // Fetch order item details
            $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
            $stmt->execute(['id' => $id]);

            $total = 0;
            foreach($stmt as $row){
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                $output['list'] .= "
                    <tr class='prepend_items'>
                        <td>".htmlspecialchars($row['name'])."</td>
                        <td>&#2547; ".number_format($row['price'], 2)."</td>
                        <td>".$row['quantity']."</td>
                        <td>&#2547; ".number_format($subtotal, 2)."</td>
                    </tr>
                ";
            }
            
            $output['total'] = '<b>&#2547; '.number_format($total, 2).'</b>';
        }
        else{
            $output['error'] = 'Transaction not found or access denied.';
        }
    }
    catch(PDOException $e){
        $output['error'] = $e->getMessage();
    }

    $pdo->close();
    echo json_encode($output);
?>