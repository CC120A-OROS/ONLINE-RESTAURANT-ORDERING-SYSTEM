<?php
$host = "localhost";
$dbname = "restaurant_db";
$user = "root";
$pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $email = $_POST["email"];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);

        header("Location: login.php?registered=1");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device - width, initial-scale = 1.0">
        <title>Registration Form</title>
        <link rel = "stylesheet"  type = "text/css" href = "style.css">
    </head>

<body>
    <div class = "register-container">
        <h2>Create an Account</h2>
        <form action = "" method = "POST">
            <div class = "input-group">
                <label for = "username">Username</label>
                <input type = "text" id = "username" name = "username" required> 
            </div>

            <div class = "input-group">
                <label for = "password">Password</label>
                <input type = "password" id = "password" name = "password" required>
            </div>

            <div class = "input-group">
                <label for = "email">Email</label>
                <input type = "email" id = "email" name = "email" required>
            </div>
            
            <center>
            <button type = "submit" class = "btn">Register</button>
    
            <div class = "register-link">
                <p>Have an account?
                <a href = "login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>