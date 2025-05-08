<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - FlashFood Restaurant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 1rem;
            border-right: 1px solid #ddd;
        }
        .sidebar h4 {
            margin-bottom: 1rem;
        }
        .sidebar a {
            display: block;
            padding: 0.5rem 0;
            color: #000;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
            border-radius: 5px;
        }
        .main-content {
            flex-grow: 1;
            padding: 2rem;
        }
        .submenu {
            display: none;
            margin-left: 15px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('a[href="#"]').click(function(event){
                event.preventDefault();
                $(this).next('.submenu').toggle();
            });

            $('a[href="users.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('load_users.php');
            });

            $('#load-orders').click(function(event){
                event.preventDefault();
                $('#main-content').load('load_orders.php');
            });

            $('.load-content[href="load_menus.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('load_menus.php');
            });

            $('.load-content[href="add_new_menu.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('add_new_menu.php');
            });

            $('.load-content[href="add_discount.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('add_discount.php');
            });

            $('.load-content[href="sales_report.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('sales_report.php');
            });

            $('.load-content[href="stock_in_out.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('stock_in_out.php');
            });

            $('.load-content[href="inventory_report.php"]').click(function(event){
                event.preventDefault();
                $('#main-content').load('inventory_report.php');
            });
        });
    </script>
</head>
<body>

<div class="sidebar">
    <center><img src="images/logo.png">
    <a href="admin_dashboard.php">🏠 Home</a>
    <a href="users.php">👤 Users</a>
    <div class="dropdown">
        <a href="#">🍽️ Menus</a>
        <div class="submenu">
            <a href="load_menus.php" class="load-content"> All Menus</a>
            <a href="add_new_menu.php" class="load-content">Add New Menu</a>
            <a href="add_discount.php" class="load-content">Add Discount</a>
            <a href="stock_in_out.php" class="load-content">Stock Management</a>
        </div>
    </div>
    <a href="orders.php" id="load-orders">🛒 Orders</a>
    <div class="dropdown">
    <a href="#">📊 Reports</a>
    <div class="submenu">
        <a href="sales_report.php" class="load-content">Sales Report</a>
        <a href="inventory_report.php" class="load-content">Inventory Report</a>
    </div>
</div>
    <a href="admin_logout.php" class="text-danger">🚪 Logout</a>
</div></center>

<div class="main-content" id="main-content">
    <h2>Admin Dashboard</h2>
    <p>Welcome back, <?php echo $_SESSION['admin_username']; ?>!</p>
</div>
</body>
</html>