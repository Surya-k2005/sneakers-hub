<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    unset($_SESSION['cart'][$_POST['product_id']]);
    header('Location: cart.php');
    exit;
}

$pageTitle = 'Shopping Cart';
$cartItems = getCartItems();
$cartTotal = getCartTotal();

require_once 'includes/header.php';
?>

<h1>Your Shopping Cart</h1>

<?php if (empty($cartItems)): ?>
    <p>Your cart is empty. <a href="collection.php">Browse our collection</a> to add items.</p>
<?php else: ?>
    <div class="cart-container">
        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <img src="assets/images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="item-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p class="price">₹<?php echo number_format($item['price'], 2); ?></p>
                        <p>Quantity: <?php echo $item['quantity']; ?></p>
                        <p>Total: ₹<?php echo number_format($item['total'], 2); ?></p>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="remove_item" class="btn btn-remove">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="cart-summary">
            <h2>Order Summary</h2>
            <p>Subtotal: ₹<?php echo number_format($cartTotal, 2); ?></p>
            <p>Shipping: Free</p>
            <p class="total">Total: ₹<?php echo number_format($cartTotal, 2); ?></p>
            <a href="checkout.php" class="btn btn-checkout">Proceed to Checkout</a>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>