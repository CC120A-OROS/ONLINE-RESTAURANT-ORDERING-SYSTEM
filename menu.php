<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f8f8;
        }
        .back {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .back:hover {
            background-color: #333;
        }

        h1 {
            color: #333;
            margin-top: 20px;
        }

        .shop-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); 
            gap: 50px;
            justify-content: center;
            margin: 20px;
        }

        .meal-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 100%; 
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .meal-card img {
            width: 100%; 
            height: 250px; 
            object-fit: cover;
            border-radius: 10px;
        }


        .meal-card h3 {
            margin: 10px 0;
            color: #333;
        }

        .meal-card p {
            font-size: 18px;
            color: #d32f2f;
            font-weight: bold;
        }

        .meal-card p s {
            color: gray;
            font-size: 14px;
        }

        button {
            background-color: #ff5733;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #e64a19;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Menu</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

    <button class="back" onclick="goBack()">←</button>      
<br>
<br>
<br>
    <h1>Our Menu</h1>

    <div class="shop-container">
        <div class="meal-card">
            <img src="images/kaldereta.jpg">
            <h3>Kaldereta</h3>
            <p>₱75.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="meal-card">
            <img src="images/Adobong baboy.jpg">
            <h3>Adobong Baboy</h3>
            <p>₱80.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="meal-card">
            <img src="images/adobong manok.jpg">
            <h3>Adobong Manok</h3>
            <p>₱60.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="meal-card">
            <img src="images/sisig.webp">
            <h3>Pork Sisig</h3>
            <p>₱100.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="meal-card">
            <img src="images/adobong sitaw.avif">
            <h3>Adobong Sitaw</h3>
            <p>₱50.00</p>
            <button>Add to Cart</button>
        </div>

        <div class="meal-card">
            <img src="images/kare kare.jpg">
            <h3>Kare Kare</h3>
            <p>₱70.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/bicol express.jpg">
            <h3>Bicol Express</h3>
            <p>₱80.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/binungor.jpg">
            <h3>Binungor</h3>
            <p>₱50.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/bulalo.webp">
            <h3>Bulalo</h3>
            <p>₱100.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/dinakdakan.jpg">
            <h3>Dinakdakan</h3>
            <p>₱80.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/dinuguan.webp">
            <h3>Dinuguan</h3>
            <p>₱75.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/letchon belly.avif">
            <h3>Letchon Belly</h3>
            <p>₱150.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/lomi.jpg">
            <h3>Lomi</h3>
            <p>₱60.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/pancit.webp">
            <h3>Pancit</h3>
            <p>₱80.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/sinigang na bangus.jpg">
            <h3>Sinigang na Bangus</h3>
            <p>₱80.00</p>
            <button>Add to Cart</button>
        </div>

         <div class="meal-card">
            <img src="images/garlic butter shrimp.webp">
            <h3>Garlic Butter Shrimp</h3>
            <p>₱100.00</p>
            <button>Add to Cart</button>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = "restaurant_main.php"; 
        }
    </script>

</body>
</html>

