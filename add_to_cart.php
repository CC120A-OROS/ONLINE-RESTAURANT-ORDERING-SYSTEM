<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => 1,
        'image' => $_POST['image'],
    ];

    $_SESSION['message'] = $item['name'] . " has been added to your cart!";
    $found = false;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['name'] === $item['name']) {
                $cart_item['quantity']++;
                $found = true;
                break;
            }
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    header('Location: cart.php');
    exit();
}