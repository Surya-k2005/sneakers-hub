<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$orderId = 'SNK' . strtoupper(uniqid());

$_SESSION['order'] = [
    'order_id' => $orderId,
    'customer' => htmlspecialchars($_POST['fullname']),
    'email' => htmlspecialchars($_POST['email']),
    'address' => htmlspecialchars($_POST['address']),
    'city' => htmlspecialchars($_POST['city']),
    'zip' => htmlspecialchars($_POST['zip']),
    'payment_method' => htmlspecialchars($_POST['payment']),
    'items' => getCartItems(),
    'total' => getCartTotal(),
    'date' => date('Y-m-d H:i:s')
];

$_SESSION['cart'] = [];

$pageTitle = 'Order Confirmation';
require_once __DIR__ . '/includes/header.php';
?>

<section class="order-confirmation">
    <div class="confirmation-box">
        <div class="success-icon">✓</div>
        <h1>Order Placed Successfully!</h1>
        <p class="order-number">Your Order ID: <strong><?= $orderId ?></strong></p>
        
        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="summary-row">
                <span>Date:</span>
                <span><?= date('F j, Y') ?></span>
            </div>
            <div class="summary-row">
                <span>Payment Method:</span>
                <span>
                    <?= match($_SESSION['order']['payment_method']) {
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                        'cod' => 'Cash on Delivery',
                        default => 'Unknown'
                    } ?>
                </span>
            </div>
            <div class="summary-row total">
                <span>Total Amount:</span>
                <span>₹<?= number_format($_SESSION['order']['total'], 2) ?></span>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="index.php" class="btn-continue">Continue Shopping</a>
            <form method="post" action="cancel_order.php" class="cancel-form">
                <input type="hidden" name="order_id" value="<?= $orderId ?>">
                <button type="submit" class="btn-cancel">Cancel Order</button>
            </form>
        </div>
        
        <p class="support-text">
            Need help? Contact our <a href="contact.php">customer support</a>.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>