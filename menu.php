<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'restaurant_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $item_name = $_POST['name'];
    $item_price = $_POST['price'];
    $item_image = $_POST['image']; 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['name'] == $item_name) {
            $cart_item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => 1,
            'image' => $item_image 
        ];
    }

    $_SESSION['message'] = "$item_name added to cart!";
    header("Location: menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop - Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f8f8;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            z-index: 999;
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }

        .back {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .back:hover {
            background-color: #333;
        }

        h1 {
            color: #333;
            margin-top: 60px;
        }

        .shop-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 30px;
            margin: 20px;
            padding: 0 20px;
        }

        .meal-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .meal-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .meal-card h3 {
            margin: 10px 0;
            color: #333;
        }

        .meal-card p {
            font-size: 18px;
            color: #d32f2f;
            font-weight: bold;
        }

        .button-group {
            margin-top: 10px;
        }

        .cart-button {
            padding: 8px 12px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

        .cart-button:hover {
            background-color: #388e3c;
        }

        .image-wrapper {
    position: relative;
    width: 100%;
}

.ribbon {
    position: absolute;
    top: 15px;
    right: -35px;
    width: 120px;
    background: red;
    color: white;
    text-align: center;
    font-weight: bold;
    transform: rotate(45deg);
    z-index: 10;
    font-size: 14px;
    padding: 5px 0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    letter-spacing: 1px;
}

    </style>
</head>

<body>

<button class="back" onclick="window.location.href='restaurant_main.php'">←</button>

<?php
if (isset($_SESSION['message'])) {
    echo "<div class='alert'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);
}
?>

<h1>Our Menu</h1>

<div class="shop-container">
<?php
$sql = "SELECT * FROM meals";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($meal = $result->fetch_assoc()) {
        ?>
        <div class="meal-card">
            <form method="post" action="menu.php">

                <?php
                $price = $meal['price'];
                $discount = isset($meal['discount']) ? $meal['discount'] : 0;
                $discounted_price = $price;

                if ($discount > 0) {
                    $discounted_price = $price - ($price * ($discount / 100));
                }
                ?>

                <div class="image-wrapper">
                    <img src="<?= htmlspecialchars($meal['image']) ?>" alt="<?= htmlspecialchars($meal['name']) ?>">
                    <?php if ($discount > 0): ?>
                        <div class="ribbon"><?= $discount ?>% OFF</div>
                    <?php endif; ?>
                </div>

                <?php
                if ($discount > 0) {
                    echo "<p><span style='color:red; text-decoration:line-through;'>₱" . number_format($price, 2) . "</span> ";
                    echo "<span style='color:green;'>₱" . number_format($discounted_price, 2) . " (-$discount%)</span></p>";
                } else {
                    echo "<p>₱" . number_format($price, 2) . "</p>";
                }
                ?>

                <!-- Hidden fields for cart -->
                <input type="hidden" name="name" value="<?= htmlspecialchars($meal['name']) ?>">
                <input type="hidden" name="price" value="<?= $discounted_price ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($meal['image']) ?>">

                <h3><?= htmlspecialchars($meal['name']) ?></h3>

                <div class="button-group">
                    <button class="cart-button" type="submit" name="add_to_cart">Add to Cart</button>
                </div>
            </form>
        </div>
        <?php
    }
} else {
    echo "<p>No meals available.</p>";
}
$conn->close();
?>
</div>

</body>
</html>