<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-image: url('Images/Background.jpg');
            background-size: cover;
        }
        .hero-text h1 {
            color: #fff;
            font-size: 36px;
            font-weight: bold;
            padding-left: 65px;
            padding-top: 20px;
        }
        .search-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .search-container input {
            width: 150px;
            margin-right: 5px;
        }
        .icons img {
            background: transparent;
            width: 30px;
            margin-left: 15px;
        }
        .icons {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 0;
            padding-bottom: 5%;
            position: absolute;
            top: 105px;
            right: 10px;
        }
        .icons a {
            font-size: 24px; 
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }
        .badge {
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .cart-icon {
    position: relative;
    display: inline-block;
    color: white;
    font-size: 24px;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -10px;
    background: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
}

        .navbar {
            width: 100%;
            position: absolute;
            top: 20px;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-size: 18px;
            margin-right: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFlash - Online Restaurant Ordering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel = "stylesheet" href = "styles.css">
</head>
<body>
    <header class="hero">
        <div class="overlay">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="#" class="navbar-brand">
                        <img src="images/logo.png" class="logo">
                    </a>
                    <div class="hero-text text-center">
                    <br>
                    <br>
                    <h1>FlashFood – Online Restaurant Ordering<br> 
                        System</h1>
                        <div class="icons">
                            <a href="#"><i class="bi bi-person"></i></a>
                            <a href="cart.php" class="cart-icon">
                                <i class="bi bi-cart"></i>
                                <?php
                                    $total_items = 0;
                                    if (!empty($_SESSION['cart'])) {
                                        foreach ($_SESSION['cart'] as $item) {
                                            $total_items += $item['quantity'];
                                        }
                                    }
                                    ?>
                                    <?php if ($total_items > 0): ?>
                                        <span class="cart-count"><?php echo $total_items; ?></span>
                                    <?php endif; ?>
                            </a>
                        </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <center>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="orders.php">My Order</a></li>
                            <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        </ul>
                    </div>
                </nav>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>