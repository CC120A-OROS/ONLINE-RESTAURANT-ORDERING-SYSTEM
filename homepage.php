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
            color: #fff;
            font-size: 24px;
            line-height: 26px;
            margin-bottom: 80px;
        }

        .register,
        .login {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            letter-spacing: 1px;
            padding: 14px 30px;
            border-radius: 5px;
            transition: 0.3s ease;
            margin: 10px;
            background: skyblue;
            border: none;
            color: #000;
            text-decoration: none;
            display: inline-block;
        }

        .register:hover,
        .login:hover {
            background: lightblue;
            color: #000;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <center>
        <div class="index-container">
            <h1>Welcome To FlashFood Restaurant</h1>
            <h2>Delight In Every Bite</h2>
            <div>
                <a href="register.php" class="register">Register</a> 
                <a href="login.php" class="login">Login</a>
            </div>
        </div>
    </center>
</body>
</html>