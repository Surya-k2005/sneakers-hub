<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getProducts($category = null) {
    global $pdo;
    
    $sql = "SELECT * FROM products";
    if ($category) {
        $sql .= " WHERE category = :category";
    }
    
    $stmt = $pdo->prepare($sql);
    if ($category) {
        $stmt->bindParam(':category', $category);
    }
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addToCart($productId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}
function getCartItems() {
    global $pdo;
    
    if (empty($_SESSION['cart'])) {
        return [];
    }
    
    $productIds = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($productIds);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $cartItems = [];
    foreach ($products as $product) {
        $cartItems[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $_SESSION['cart'][$product['id']],
            'total' => $product['price'] * $_SESSION['cart'][$product['id']]
        ];
    }
    
    return $cartItems;
}

// Get cart total
function getCartTotal() {
    $cartItems = getCartItems();
    $total = 0;
    
    foreach ($cartItems as $item) {
        $total += $item['total'];
    }
    
    return $total;
}
?>