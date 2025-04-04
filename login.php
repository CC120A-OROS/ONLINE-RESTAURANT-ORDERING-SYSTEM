<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta Name = "viewport" content = "width = device - width, initial-scale = 1.0">
        <title>Login Page</title>
        <link rel = "stylesheet"  type = "text/css" href = "style.css">
    </head>

<body>
    <div class = "login-container">
        <h2>Login</h2>
        <form action = "/login" method = "POST">
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