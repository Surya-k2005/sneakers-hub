<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['order'])) {
    header('Location: index.php');
    exit;
}

$pageTitle = 'Order Cancelled';
require_once __DIR__ . '/includes/header.php';
?>

<section class="order-cancelled">
    <div class="cancellation-box">
        <div class="cancel-icon">✕</div>
        <h1>Order Cancelled</h1>
        <p class="order-number">Order ID: <strong><?= htmlspecialchars($_SESSION['order']['order_id']) ?></strong></p>
        
        <p>Your order has been successfully cancelled.</p>
        <p>If this was a mistake, please contact our support team immediately.</p>
        
        <div class="action-buttons">
            <a href="index.php" class="btn-continue">Continue Shopping</a>
            <a href="contact.php" class="btn-contact">Contact Support</a>
        </div>
    </div>
</section>

<?php 
// Clear the order from session
unset($_SESSION['order']);
require_once __DIR__ . '/includes/footer.php'; 
?>