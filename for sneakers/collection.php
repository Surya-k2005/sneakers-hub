<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    addToCart($_POST['product_id']); // Uses function from functions.php
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Refresh page
    exit;
}

$products = getProducts(); // Gets ALL products
$pageTitle = 'All Collection';

require_once 'includes/header.php';
?>

<h1>Our Sneakers Collection</h1>

<div class="products-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="assets/images/<?= htmlspecialchars($product['image']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p class="price">₹<?= number_format($product['price'], 2) ?></p>
            <form method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>