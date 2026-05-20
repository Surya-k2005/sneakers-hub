<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    addToCart($_POST['product_id']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$pageTitle = 'Women\'s Sneakers';
$womenProducts = getProducts('women');

require_once 'includes/header.php';
?>

<h1>Women's Sneakers</h1>

<div class="products-grid">
    <?php foreach ($womenProducts as $product): ?>
        <div class="product-card">
            <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p class="price">₹<?= number_format($product['price'], 2) ?></p>
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>