<?php
session_start();

$host = "localhost";
$dbname = "restaurant_db";
$user = "root";
$pass = "";

$message = "";

if (isset($_GET["registered"])) {
    $message = "Account created successfully! Please login.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password === $user["password"]) {
            $_SESSION["username"] = $user["username"];
            header("Location: restaurant_main.php"); 
            exit;
        } else {
            $message = "Invalid username or password.";
        }
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
        <title>Login Page</title>
        <link rel = "stylesheet"  type = "text/css" href = "style.css">
    </head>

<body>
    <div class = "login-container">
        <h2>Login</h2>
        <form action = "" method = "POST">
            <div class = "input-group">
                <label for = "username">Username</label>
                <input type = "text" id = "username" name = "username" required> 
            </div>

            <div class = "input-group">
                <label for = "password">Password</label>
                <input type = "password" id = "password" name = "password" required>
            </div>
            
            <center>
            <button type = "submit" class = "btn">Login</button>
    
            <div class = "register-link">
                <p>Don't have an account?
                <a href = "register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>