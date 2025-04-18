<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'restaurant_db';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$menu = "";
$price = "";
$image_path = "";
$added = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu = mysqli_real_escape_string($conn, $_POST['menu']);
    $price = floatval($_POST['price']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = "images/";
        $image_path = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $sql = "INSERT INTO meals (name, price, image) VALUES ('$menu', $price, '$image_path')";
            if ($conn->query($sql) === TRUE) {
                $added = true;
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Image is required.";
    }
}
$conn->close();
?>
<?php if ($added): ?>
    <div style="text-align:center; padding: 30px;">
        <img src="<?php echo $image_path; ?>" alt="Uploaded Image" style="width:150px; height:150px; object-fit:cover; border:1px solid #ccc;">
        <h3 style="margin-top: 20px;"><?php echo htmlspecialchars($menu); ?></h3>
        <p>₱<?php echo number_format($price, 2); ?></p>
        <p style="color: green;"><strong><?php echo htmlspecialchars($menu); ?> Added Successfully</strong></p>
        <a href="admin_dashboard.php"style="padding: 10px 20px;">Back</a>
    </div>
<?php else: ?>
    <div>
        <h2>Add New Menu</h2>
        <form method="POST" action="add_new_menu.php" enctype="multipart/form-data">
            <label for="menu">Menu Name</label>
            <input type="text" name="menu" required>

            <label for="price">Price</label>
            <input type="number" name="price" step="0.01" required>

            <label for="image">Image</label>
            <input type="file" name="image" accept="image/*" required>

            <br>
            <button type="submit">Add</button>
        </form>
    </div>
<?php endif; ?>
<style>
    form {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 500px;
    }
    input[type="text"], input[type="number"], input[type="file"] {
        padding: 8px;
        width: 100%;
        margin-bottom: 15px;
    }
    button {
        padding: 10px 20px;
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
</style>