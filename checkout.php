<?php
session_start();

$cart_items = $_SESSION['cart'] ?? [];
$total = 0;

if (empty($cart_items)) {
    echo "<div class='container mt-5'><h4>Your cart is empty.</h4><a href='menu.php'>Back to Menu</a></div>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
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
<div class="container mt-5 bg-light p-4 rounded">
    <h3>Checkout</h3>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Price (₱)</th>
                <th>Quantity</th>
                <th>Subtotal (₱)</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $item): ?>
            <?php 
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?>.00</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $subtotal; ?>.00</td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                <td><strong>₱<?php echo $total; ?>.00</strong></td>
            </tr>
        </tbody>
    </table>

    <form action="checkout_process.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="delivery_method" class="form-label">Choose Delivery Method</label>
            <select name="delivery_method" id="delivery_method" class="form-select" required onchange="toggleAddressField()">
                <option value="">-- Select --</option>
                <option value="Delivery">Delivery</option>
                <option value="Pick-up">Pick-up</option>
            </select>
        </div>

        <div class="mb-3" id="addressField" style="display: none;">
            <label for="address" class="form-label">Delivery Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-skyblue">Confirm Order</button>
        <a href="cart.php" class="btn btn-skyblue">Back to Cart</a>
    </form>
</div>

<script>
    function toggleAddressField() {
        const deliveryMethod = document.getElementById('delivery_method').value;
        const addressField = document.getElementById('addressField');
        addressField.style.display = deliveryMethod === 'Delivery' ? 'block' : 'none';
    }
</script>
</body>
</html>