<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$pageTitle = 'Contact Us';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $success = true;
}

require_once 'includes/header.php';
?>

<h1>Contact Us</h1>

<?php if (isset($success) && $success): ?>
    <div class="alert success">
        <p>Thank you for your message! We'll get back to you soon.</p>
    </div>
<?php endif; ?>

<form action="contact.php" method="post" class="contact-form">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>
    </div>
    
    <button type="submit" class="btn">Send Message</button>
</form>

<?php require_once 'includes/footer.php'; ?>