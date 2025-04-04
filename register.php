<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta Name = "viewport" content = "width = device - width, initial-scale = 1.0">
        <title>Registration Form</title>
        <link rel = "stylesheet"  type = "text/css" href = "style.css">
    </head>

<body>
    <div class = "register-container">
        <h2>Create an Account</h2>
        <form action = "/register" method = "POST">
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