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

if (empty($cart_items)) {
    echo "Your cart is empty.";
    exit();
}

$stmt = $conn->prepare("
    INSERT INTO orders (customer_name, phone, address, menu_name, menu_price, menu_quantity, menu_image, delivery_method) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

foreach ($cart_items as $item) {
    $menu_name = $item['name'];
    $menu_price = $item['price'];
    $menu_quantity = $item['quantity'];
    $menu_image = $item['image'];

    $stmt->bind_param("sssssdss", $name, $phone, $address, $menu_name, $menu_price, $menu_quantity, $menu_image, $delivery_method);
    if (!$stmt->execute()) {
        die("Error saving order: " . $stmt->error);
    }

    $escaped_name = $conn->real_escape_string($menu_name);
    $deduct_sql = "UPDATE meals SET stock = stock - $menu_quantity WHERE name = '$escaped_name' AND stock >= $menu_quantity";
    $conn->query($deduct_sql);
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
    <style>
        .btn-skyblue {
            background-color: skyblue;
            color: #000;
            border: none;
        }
        .btn-skyblue:hover {
            background-color: lightblue;
            color: #000;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Thank you, <?php echo htmlspecialchars($name); ?>!</h4>
        <p>Your order has been placed successfully.</p>
        <a href="menu.php" class="btn btn-skyblue">Back to Menu</a>
    </div>
</div>
</body>
</html>