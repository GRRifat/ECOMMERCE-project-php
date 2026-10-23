<?php include 'includes/session.php'; ?>
<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['error'] = 'Please login first';
        header('location: login.php');
        exit();
    }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
    <div class="content-wrapper">
        <div class="container">

            <section class="content">
                <div class="row">
                    <!-- Left Side: Order Summary -->
                    <div class="col-sm-6">
                        <div class="box box-solid" style="border-radius: 6px; border: 1px solid #d2d6de;">
                            <div class="box-header with-border" style="background: #f9f9f9;">
                                <h4 class="box-title" style="font-weight: bold;"><i class="fa fa-shopping-bag"></i> Order Summary</h4>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $conn = $pdo->open();
                                            $stmt = $conn->prepare("SELECT *, cart.quantity AS cart_qty, products.name AS prodname FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
                                            $stmt->execute(['user_id'=>$user['id']]);
                                            $grand_total = 0;
                                            foreach($stmt as $item){
                                                $subtotal = $item['price'] * $item['cart_qty'];
                                                $grand_total += $subtotal;
                                                echo "
                                                    <tr>
                                                        <td>".$item['prodname']."</td>
                                                        <td>".$item['cart_qty']."</td>
                                                        <td class='text-right'>&#2547; ".number_format($subtotal, 2)."</td>
                                                    </tr>
                                                ";
                                            }
                                            $pdo->close();
                                        ?>
                                        <tr class="active" style="font-size: 16px;">
                                            <th colspan="2">Total Amount</th>
                                            <th class="text-right" style="color: #c0392b;">&#2547; <?php echo number_format($grand_total, 2); ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="cart_view.php" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Edit Cart</a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Payment Method Form -->
                    <div class="col-sm-6">
                        <div class="box box-solid" style="border-radius: 6px; border: 1px solid #d2d6de;">
                            <div class="box-header with-border" style="background: #f9f9f9;">
                                <h4 class="box-title" style="font-weight: bold;"><i class="fa fa-credit-card"></i> Select Payment Method</h4>
                            </div>
                            <div class="box-body" style="padding: 20px;">
                                <form action="process_payment.php" method="POST" id="checkout_form">
                                    
                                    <!-- Payment Options -->
                                    <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-xs-6" style="margin-bottom: 10px;">
                                            <label style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; width: 100%; cursor: pointer; text-align: center; display: block;">
                                                <input type="radio" name="payment_method" value="bKash" checked onclick="togglePaymentMethod('bkash')">
                                                <span style="font-weight: bold; color: #d12053; display: block; margin-top: 5px;">bKash</span>
                                            </label>
                                        </div>
                                        <div class="col-xs-6" style="margin-bottom: 10px;">
                                            <label style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; width: 100%; cursor: pointer; text-align: center; display: block;">
                                                <input type="radio" name="payment_method" value="Nagad" onclick="togglePaymentMethod('nagad')">
                                                <span style="font-weight: bold; color: #f7941d; display: block; margin-top: 5px;">Nagad</span>
                                            </label>
                                        </div>
                                        <div class="col-xs-6" style="margin-bottom: 10px;">
                                            <label style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; width: 100%; cursor: pointer; text-align: center; display: block;">
                                                <input type="radio" name="payment_method" value="Visa Card" onclick="togglePaymentMethod('visa')">
                                                <span style="font-weight: bold; color: #1a1f71; display: block; margin-top: 5px;">Visa Card</span>
                                            </label>
                                        </div>
                                        <div class="col-xs-6" style="margin-bottom: 10px;">
                                            <label style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; width: 100%; cursor: pointer; text-align: center; display: block;">
                                                <input type="radio" name="payment_method" value="Cash" onclick="togglePaymentMethod('cash')">
                                                <span style="font-weight: bold; color: #2e7d32; display: block; margin-top: 5px;">Cash</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- 1. bKash / Nagad Box (With Number and OK -> OTP Step) -->
                                    <div id="mfs_container" style="display: block; margin-bottom: 15px; background: #fafafa; padding: 15px; border-radius: 5px; border: 1px solid #eee;">
                                        <!-- Step 1: Number Input & OK Button -->
                                        <div id="mfs_step1">
                                            <label id="mfs_title">bKash Account Number:</label>
                                            <div class="input-group">
                                                <input type="text" name="mfs_number" id="mfs_input" class="form-control" placeholder="017XXXXXXXX" maxlength="11">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary btn-flat" id="btn_send_otp" onclick="sendOtpStep()">OK</button>
                                                </span>
                                            </div>
                                            <small class="text-muted" id="mfs_note" style="display: block; margin-top: 5px;">Enter your 11-digit mobile number and click OK.</small>
                                        </div>

                                        <!-- Step 2: OTP Input (Initially Hidden) -->
                                        <div id="mfs_step2" style="display: none; margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd;">
                                            <div class="alert alert-info" style="padding: 8px 12px; margin-bottom: 10px; font-size: 13px;">
                                                <i class="fa fa-info-circle"></i> Demo Verification Code has been sent to your number!
                                            </div>
                                            <div class="form-group" style="margin-bottom: 5px;">
                                                <label>Enter Verification Code (OTP):</label>
                                                <input type="text" name="mfs_otp" id="mfs_otp" class="form-control" placeholder="Enter 4-6 digit OTP (e.g. 123456)" maxlength="6">
                                            </div>
                                            <small class="text-success"><i class="fa fa-check"></i> Number verified. Now enter any demo OTP and place order.</small>
                                        </div>
                                    </div>

                                    <!-- 2. Visa Card Fields -->
                                    <div id="card_container" style="display: none; margin-bottom: 15px; background: #fbfbfb; padding: 15px; border-radius: 5px; border: 1px solid #eee;">
                                        <div class="form-group">
                                            <label>Card Number:</label>
                                            <input type="text" name="card_number" id="card_number" class="form-control" placeholder="4111 2222 3333 4444" maxlength="19">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <div class="form-group" style="margin-bottom: 0;">
                                                    <label>Year / Expiry (MM/YY):</label>
                                                    <input type="text" name="card_expiry" id="card_expiry" class="form-control" placeholder="MM/YY" maxlength="5">
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="form-group" style="margin-bottom: 0;">
                                                    <label>CVV:</label>
                                                    <input type="password" name="card_cvv" id="card_cvv" class="form-control" placeholder="123" maxlength="4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Cash on Delivery Notice -->
                                    <div id="cash_container" style="display: none; margin-bottom: 15px;">
                                        <div class="alert alert-warning" style="margin-bottom: 0;">
                                            <i class="fa fa-info-circle"></i> Delivery pawar por cash payment korben. Status <b>Pending</b> thakbe.
                                        </div>
                                    </div>

                                    <button type="submit" name="checkout_btn" id="submit_order_btn" class="btn btn-success btn-lg btn-block btn-flat">
                                        <i class="fa fa-check"></i> Place Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
         
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var currentMethod = 'bkash';
var isOtpSent = false;

function togglePaymentMethod(type){
    currentMethod = type;
    isOtpSent = false;

    var mfsBox = document.getElementById('mfs_container');
    var cardBox = document.getElementById('card_container');
    var cashBox = document.getElementById('cash_container');
    var mfsTitle = document.getElementById('mfs_title');
    var mfsInput = document.getElementById('mfs_input');
    var mfsStep2 = document.getElementById('mfs_step2');

    // Reset OTP Step 2
    mfsStep2.style.display = 'none';
    document.getElementById('mfs_otp').value = '';

    mfsBox.style.display = 'none';
    cardBox.style.display = 'none';
    cashBox.style.display = 'none';

    if(type === 'bkash'){
        mfsBox.style.display = 'block';
        mfsTitle.innerText = 'bKash Account Number:';
        mfsInput.placeholder = '017XXXXXXXX';
    } 
    else if(type === 'nagad'){
        mfsBox.style.display = 'block';
        mfsTitle.innerText = 'Nagad Account Number:';
        mfsInput.placeholder = '01XXXXXXXXX';
    } 
    else if(type === 'visa'){
        cardBox.style.display = 'block';
    } 
    else if(type === 'cash'){
        cashBox.style.display = 'block';
    }
}

// "OK" button-e chap dile OTP box dekhabe
function sendOtpStep(){
    var number = document.getElementById('mfs_input').value.trim();
    if(number.length < 11){
        alert('Please enter a valid 11-digit mobile number first!');
        document.getElementById('mfs_input').focus();
        return;
    }

    // OTP box open kora
    document.getElementById('mfs_step2').style.display = 'block';
    document.getElementById('mfs_otp').focus();
    isOtpSent = true;
}

// Form submit validation
document.getElementById('checkout_form').addEventListener('submit', function(e){
    if(currentMethod === 'bkash' || currentMethod === 'nagad'){
        var number = document.getElementById('mfs_input').value.trim();
        var otp = document.getElementById('mfs_otp').value.trim();

        if(!isOtpSent || otp === ''){
            e.preventDefault();
            alert('Please enter your mobile number, click OK, and provide the OTP code!');
            if(!isOtpSent){
                document.getElementById('mfs_input').focus();
            } else {
                document.getElementById('mfs_otp').focus();
            }
        }
    }
    else if(currentMethod === 'visa'){
        var cardNo = document.getElementById('card_number').value.trim();
        var expiry = document.getElementById('card_expiry').value.trim();
        var cvv = document.getElementById('card_cvv').value.trim();

        if(cardNo === '' || expiry === '' || cvv === ''){
            e.preventDefault();
            alert('Please fill up all Visa Card details (Card Number, Expiry, CVV)!');
        }
    }
});
</script>
</body>
</html>