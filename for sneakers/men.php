<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    addToCart($_POST['product_id']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$products = getProducts('men');
$pageTitle = "Men's Sneakers";

require_once 'includes/header.php';
?>

<h1>Men's Sneakers</h1>
<div class="products-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="assets/images/<?= $product['image'] ?>">
            <h3><?= $product['name'] ?></h3>
            <p class="price">₹<?= number_format($product['price'], 2) ?></p>
            <form method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>