<center>
<?php
session_start();
?>

<?php
$cart_items = $_SESSION['cart'] ?? [];
$total = 0;
?>

<style>
.cart-button {
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none !important;
    padding: 10px 10;
    margin: 10px;
    transition: background-color 0.3s, color 0.3s;
}

.cart-button.back {
    background-color: skyblue;
    color: #000;
}

.cart-button.back:hover {
    background-color: lightblue;
    color: #000;
}

.cart-button.checkout {
    background-color: skyblue;
    color: #000;
}

.cart-button.checkout:hover {
    background-color: lightblue;
    color: #000;
}
</style>

    <h2 class="mb-4 text-center">Your Cart (<?php echo count($cart_items); ?> Item<?php echo count($cart_items) != 1 ? 's' : ''; ?>)</h2>

    <?php if (empty($cart_items)): ?>
        <h4 class="text-center">Your cart is empty.</h4>
    <?php else: ?>
        <?php foreach ($cart_items as $index => $item): ?>
            <?php 
                $subtotal = $item['price'] * $item['quantity'];
                $original_price = $item['original_price'] ?? ($item['price'] + 15);
                $saved_amount = ($original_price - $item['price']) * $item['quantity'];
                $total += $subtotal;
            ?>
            <div class="mb-3 p-3 border rounded bg-white text-start">
                <div class="text-center mb-2">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 150px; height: auto;" onerror="this.src='images/default.jpg';">
                </div>
                <h3 class="text-center"><?php echo $item['name']; ?></h3>
                <p class="text-center text-danger fw-bold">₱<?php echo $item['price']; ?></p>
                
                <form action="update_cart.php" method="post" class="d-flex justify-content-center align-items-center mb-2">
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                    <div class="d-flex align-items-center border rounded overflow-hidden" style="width: 120px;">
                        <button type="submit" name="decrease" class="btn btn-outline-secondary btn-sm rounded-0" style="width: 40px;">-</button>
                        <div class="text-center fw-bold" style="width: 40px;"><?php echo $item['quantity']; ?></div>
                        <button type="submit" name="increase" class="btn btn-outline-secondary btn-sm rounded-0" style="width: 40px;">+</button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>

        <div class="text-end">
            <p><strong>Subtotal:</strong> ₱<?php echo $total; ?></p>
            <p><strong>Total:</strong> ₱<?php echo $total; ?></p>
        </div>

        <div class="d-flex justify-content-between mt-4 gap-3">
            <a href="menu.php" class="cart-button back w-50 text-center">Back</a>
            <a href="checkout.php" class="cart-button checkout w-50 text-center">Go to Checkout</a>
        </div>
    <?php endif; ?>
</div>