<center><?php
session_start();
?>

<?php
$cart_items = $_SESSION['cart'] ?? [];
$total = 0;
?>
<div class="container mt-5 bg-light p-4 rounded">
    <h3>Your cart (<?php echo count($cart_items); ?> item<?php echo count($cart_items) != 1 ? 's' : ''; ?>)</h3>

    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <?php foreach ($cart_items as $index => $item): ?>
            <?php 
                $subtotal = $item['price'] * $item['quantity'];
                $original_price = $item['original_price'] ?? ($item['price'] + 15);
                $saved_amount = ($original_price - $item['price']) * $item['quantity'];
                $total += $subtotal;
            ?>
            <div class="d-flex mb-3 p-2 bg-white shadow-sm rounded">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 100px;" onerror="this.src='images/default.jpg';">
                <div class="flex-grow-1">
                    <h5>
                        <a href="#" class="text-decoration-none"><?php echo $item['name']; ?></a>
                    </h5>
                    <p class="mb-1 text-muted" style="font-size: 14px;">
                    </p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="text-danger fw-bold">₱<?php echo $item['price']; ?>.00</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action="update_cart.php" method="post" class="d-flex">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                            <div class="px-3"><?php echo $item['quantity']; ?></div>
                            <button type="submit" name="increase" class="btn btn-outline-secondary btn-sm">+</button>
                        </form>
                        <div class="ms-4">
                            <a href="remove_item.php?index=<?php echo $index; ?>" class="text-danger small">Remove item</a>
                        </div>
                    </div>
                    <p class="mt-2 mb-0"><strong>Subtotal:</strong> ₱<?php echo $subtotal; ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="text-end mt-4">
            <h5><strong>Total: ₱<?php echo $total; ?></strong></h5>
            <div class="d-flex justify-content-end gap-2">
                <a href="menu.php" class="btn btn-outline-dark">Back</a>
                <a href="checkout.php" class="btn btn-danger">Go to checkout</a>
            </div>
        </div>
    <?php endif; ?>
</div>