<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$pageTitle = 'Checkout';
require_once __DIR__ . '/includes/header.php';

$cartItems = getCartItems();
$cartTotal = getCartTotal();
?>

<section class="checkout">
    <h1>Checkout</h1>
    
    <div class="checkout-container">
        <div class="order-summary">
            <h2>Your Order</h2>
            <ul class="order-items">
                <?php foreach ($cartItems as $item): ?>
                <li>
                    <img src="assets/images/<?= htmlspecialchars($item['image']) ?>" 
                         alt="<?= htmlspecialchars($item['name']) ?>">
                    <div>
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p><?= $item['quantity'] ?> × ₹<?= number_format($item['price'], 2) ?></p>
                    </div>
                    <span>₹<?= number_format($item['total'], 2) ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="order-total">
                <span>Total:</span>
                <span>₹<?= number_format($cartTotal, 2) ?></span>
            </div>
        </div>

        <form class="checkout-form" method="post" action="process_order.php">
            <h2>Shipping Information</h2>
            
            <div class="form-group">
                <label for="fullname">Full Name*</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="address">Shipping Address*</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="city">City*</label>
                    <input type="text" id="city" name="city" required>
                </div>
                
                <div class="form-group">
                    <label for="zip">ZIP Code*</label>
                    <input type="text" id="zip" name="zip" required>
                </div>
            </div>
            
            <h2>Payment Method</h2>
            <div class="payment-methods">
                <label>
                    <input type="radio" name="payment" value="credit_card" checked>
                    Credit Card
                </label>
                <label>
                    <input type="radio" name="payment" value="paypal">
                    PayPal
                </label>
                <label>
                    <input type="radio" name="payment" value="cod">
                    Cash on Delivery
                </label>
            </div>
            
            <button type="submit" class="btn-place-order">Place Order</button>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>