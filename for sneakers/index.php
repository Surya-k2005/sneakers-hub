<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
$featuredProducts = getProducts('men');

$pageTitle = 'Home';
$featuredProducts = getProducts('men');

require_once 'includes/header.php';
?>

<section class="hero">
    <h2>Step Up Your Sneaker Game</h2>
    <p>Discover the latest and greatest sneakers from top brands</p>
    <a href="collection.php" class="btn">Shop Now</a>
</section>

<section class="featured-products">
    <h2>Featured Sneakers</h2>
    <div class="products-grid">
        <?php foreach ($featuredProducts as $product): ?>
            <div class="product-card">
                <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                <form action="collection.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>