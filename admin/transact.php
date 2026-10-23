<?php
    include 'includes/session.php';

    $id = $_POST['id'];

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
        // Fetch sale record with customer details
        $stmt_sale = $conn->prepare("SELECT sales.*, users.firstname, users.lastname FROM sales LEFT JOIN users ON users.id=sales.user_id WHERE sales.id = :id");
        $stmt_sale->execute(['id' => $id]);
        $sale = $stmt_sale->fetch();

        if ($sale) {
            $output['transaction'] = '<span style="font-family: monospace; font-weight: 700; background: #f1f5f9; padding: 2px 8px; border-radius: 4px; border: 1px solid #e2e8f0; color: #0f172a;">' . htmlspecialchars($sale['pay_id']) . '</span>';
            $output['date'] = '<i class="fa fa-calendar-o text-muted" style="margin-right: 5px;"></i>' . date('M d, Y', strtotime($sale['sales_date']));
            
            // Styled Payment Method Badge
            $method = !empty($sale['payment_method']) ? htmlspecialchars($sale['payment_method']) : 'N/A';
            $raw_method = strtolower($method);
            
            if(strpos($raw_method, 'bkash') !== false) {
                $output['payment_method'] = "<span style='background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-transform: uppercase;'>bKash</span>";
            } elseif(strpos($raw_method, 'nagad') !== false) {
                $output['payment_method'] = "<span style='background: #fff7ed; color: #ea580c; border: 1px solid #ffedd5; padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-transform: uppercase;'>Nagad</span>";
            } elseif(strpos($raw_method, 'visa') !== false || strpos($raw_method, 'card') !== false) {
                $output['payment_method'] = "<span style='background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-transform: uppercase;'>Visa / Card</span>";
            } else {
                $output['payment_method'] = "<span style='background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 11px; text-transform: uppercase;'>Cash</span>";
            }

            // Styled Payment Status Pill
            if ($sale['payment_status'] == 'Pending') {
                $output['payment_status'] = "<span style='background: #fffbeb; color: #d97706; border: 1px solid #fde68a; padding: 3px 12px; border-radius: 20px; font-weight: 700; font-size: 11px;'>● Pending</span>";
            } else {
                $output['payment_status'] = "<span style='background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; padding: 3px 12px; border-radius: 20px; font-weight: 700; font-size: 11px;'>● Completed</span>";
            }
        }

        // Fetch purchased items with photo
        $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
        $stmt->execute(['id' => $id]);

        $total = 0;
        foreach ($stmt as $row) {
            $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/noimage.jpg';
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            
            $output['list'] .= "
                <tr class='prepend_items' style='vertical-align: middle;'>
                    <td style='padding: 12px 10px;'>
                        <div style='display: flex; align-items: center; gap: 12px;'>
                            <img src='" . $image . "' style='width: 42px; height: 42px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);'>
                            <span style='font-weight: 600; color: #1e293b; font-size: 13.5px;'>" . htmlspecialchars($row['name']) . "</span>
                        </div>
                    </td>
                    <td style='padding: 12px 10px; vertical-align: middle; color: #475569;'>&#2547; " . number_format($row['price'], 2) . "</td>
                    <td align='center' style='padding: 12px 10px; vertical-align: middle;'>
                        <span style='background: #f1f5f9; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; color: #334155; border: 1px solid #e2e8f0;'>" . $row['quantity'] . "</span>
                    </td>
                    <td align='right' style='padding: 12px 10px; vertical-align: middle; font-weight: 700; color: #0f172a;'>&#2547; " . number_format($subtotal, 2) . "</td>
                </tr>
            ";
        }

        $output['total'] = '<span style="color: #2563eb; font-size: 18px; font-weight: 800;">&#2547; ' . number_format($total, 2) . '</span>';
    } 
    catch (PDOException $e) {
        $output['error'] = $e->getMessage();
    }

    $pdo->close();
    echo json_encode($output);
?>