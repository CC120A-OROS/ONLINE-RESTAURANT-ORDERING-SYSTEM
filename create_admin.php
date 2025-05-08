<?php
$conn = new mysqli("localhost", "root", "", "restaurant_db");

$username = 'admin';
$password = 'admin123'; 

$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin user created.";
?>