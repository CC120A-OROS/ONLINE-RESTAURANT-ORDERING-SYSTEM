<?php
session_start();

if (!isset($_SESSION['cart']) || !isset($_POST['index'])) {
    header('Location: cart.php');
    exit();
}

$index = $_POST['index'];

if (isset($_SESSION['cart'][$index])) {
    if (isset($_POST['increase'])) {
        $_SESSION['cart'][$index]['quantity'] += 1;
    } elseif (isset($_POST['decrease'])) {
        if ($_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); 
        }
    }
}

header('Location: cart.php');
exit();