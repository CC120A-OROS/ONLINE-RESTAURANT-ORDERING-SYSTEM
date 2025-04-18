<?php
if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "restaurant_db");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: orders.php?message=rejected");
exit();
?>