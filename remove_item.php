<?php
session_start();

if (!isset($_SESSION['cart']) || !isset($_GET['index'])) {
    header('Location: cart.php');
    exit();
}

$index = $_GET['index'];

if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
}

header('Location: cart.php');
exit();
