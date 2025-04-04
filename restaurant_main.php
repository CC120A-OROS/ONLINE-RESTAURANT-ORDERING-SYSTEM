<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-image: url('Images/Background.jpg');
            background-size: cover;
        }
        .hero-text h1 {
            color: #fff;
            font-size: 36px;
            font-weight: bold;
            padding-left: 65px;
            padding-top: 20px;
        }
        .search-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .search-container input {
            width: 150px;
            margin-right: 5px;
        }
        .icons img {
            background: transparent;
            width: 30px;
            margin-left: 15px;
        }
        .icons {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 0;
            padding-bottom: 5%;
            position: absolute;
            top: 105px;
            right: 10px;
        }
        .icons a {
            font-size: 24px; /* Adjust icon size */
            color: white; /* Change color if needed */
            margin-left: 15px;
            text-decoration: none;
        }
        .badge {
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .navbar {
            width: 100%;
            position: absolute;
            top: 20px;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-size: 18px;
            margin-right: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodFlash - Online Restaurant Ordering</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel = "stylesheet" href = "styles.css">
</head>
<body>
    <header class="hero">
        <div class="overlay">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="#" class="navbar-brand">
                        <img src="logo.png" class="logo">
                    </a>
                    <div class="hero-text text-center">
                    <br>
                    <br>
                    <h1>FlashFood – Online Restaurant Ordering<br> 
                        System</h1>
                        <div class="icons">
                            <a href="#"><i class="bi bi-person"></i></a>
                            <a href="#"><i class="bi bi-cart"></i><span class="badge"></span></a>
                        </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Checkout</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                        </ul>
                        <div class="search-container">
                            <input type="text" id="searchBox" placeholder="Search" class="form-control">
                            <button class="btn btn-danger" onclick="searchMeal()">🔍</button>
                        </div>

                        <div id="searchResult" style="text-align: center; margin-top: 20px;"></div>

                        <script>
                            function searchMeal() {
                                let searchQuery = document.getElementById("searchBox").value.toLowerCase();
                                let resultDiv = document.getElementById("searchResult");

                                resultDiv.innerHTML = "";

                                if (searchQuery === "adobong sitaw") {
                                    resultDiv.innerHTML = `
                                        <div style="text-align: center; margin-top: 30px;">
                                            <h3>Adobong Sitaw</h3>
                                            <img src="Images/adobong-sitaw.jpg" alt="Adobong Sitaw" style="width:300px; border-radius:10px;">
                                        </div>
                                    `;
                                } else {
                                    resultDiv.innerHTML = "<p style='color:red; font-weight: bold;'>No results found.</p>";
                                }
                            }
                        </script>
                    </div>
                </nav>
                </div>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
