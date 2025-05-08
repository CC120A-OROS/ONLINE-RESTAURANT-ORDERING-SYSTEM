<?php
$conn = new mysqli("localhost", "root", "", "restaurant_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully'); window.location.href='load_users.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user'); window.location.href='load_users.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='load_users.php';</script>";
}

$conn->close();
?>