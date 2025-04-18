<?php
session_start();

$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$delivery_method = $_POST['delivery_method'] ?? '';
$address = $_POST['address'] ?? '';
$cart_items = $_SESSION['cart'] ?? [];

if ($delivery_method === "Delivery" && empty($address)) {
    echo "Address required for delivery.";
    exit();
}

$first_item = $cart_items[0] ?? [];
$menu_name = $first_item['name'] ?? '';
$menu_price = $first_item['price'] ?? 0.00;
$menu_quantity = $first_item['quantity'] ?? 1;
$menu_image = $first_item['image'] ?? '';

$stmt = $conn->prepare("
    INSERT INTO orders (customer_name, phone, address, menu_name, menu_price, menu_quantity, menu_image, delivery_method) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("sssssdss", $name, $phone, $address, $menu_name, $menu_price, $menu_quantity, $menu_image, $delivery_method);

if (!$stmt->execute()) {
    die("Error saving order: " . $stmt->error);
}

$stmt->close();

unset($_SESSION['cart']);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Thank you, <?php echo htmlspecialchars($name); ?>!</h4>
        <p>Your order has been placed successfully.</p>
        <a href="menu.php" class="btn btn-primary">Back to Menu</a>
    </div>
</div>
</body>
</html>