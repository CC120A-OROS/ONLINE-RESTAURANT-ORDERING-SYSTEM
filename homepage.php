<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-image: url('Images/Homepage.webp');
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            h1 {
                margin: 30px 0 10px 0;
                font-weight: 700;
                line-height: 50px;
                text-transform: uppercase;
                color: #fff;
                font-size: 45px;
            }

            h2 {
                color:#fff;
                margin-bottom: 50px;
                font-size:24px;
                line-height: 26px;
                margin-bottom: 30px;
            }

            .button {
                text-transform: uppercase;
                font-weight: bold;
                font-size: 16px;
                letter-spacing: 1px;
                display: inline-block;
                padding: 8px 20px;
                border-radius: 2px;
                transition: 0.5s;
                margin: 10px;
            }

            .register {
                background: #eb9a03;
                border: 2px solid #eb9a03;
                color:#000;
                font-weight: bold;
            }

            .register:hover {
                background: none;
                border: 2px solid #fff;
                color:#fff;
                text-decoration: none;
            }

            .login {
                border: 2px solid #fff;
                color:#fff;
            }

            .login:hover {
                background: #eb9a03;
                border: 2px solid #eb9a03;
                text-decoration: none;
            }
 
        </style>
    </head>

<body>
    <center>
    <div class = "index-container">
        <h1>Welcome To FlashFood Restaurant</h1>
        <pre><h2>Delight In Every Bite</h2></pre>
        
        <div class = "button">
        <a href = "register.php" class = "register">Register</a> 
        <a href = "login.php" class = "login">Login</a>
        </div>
    </div>
</body>
</html>