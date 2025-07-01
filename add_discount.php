<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'restaurant_db';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_discount'])) {
    $meal_id = (int)$_POST['meal_id'];
    $discount = floatval($_POST['discount']);

    $sql = "UPDATE meals SET discount = $discount WHERE id = $meal_id";
    if ($conn->query($sql)) {
        $message = "<div class='alert alert-success'>Discount Applied Successfully!
        <br>
        <br><a href='admin_dashboard.php' class='back'>Back</a>
        </div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to apply discount.</div>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_discount'])) {
    $meal_id = (int)$_POST['meal_id_remove'];

    $sql = "UPDATE meals SET discount = 0 WHERE id = $meal_id";
    if ($conn->query($sql)) {
        $message = "<div class='alert alert-success'>Discount Removed Successfully!
        <br>
        <br><a href='admin_dashboard.php' class='back'>Back</a>
        </div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to remove discount.</div>";
    }
}

$meals = [];
$result = $conn->query("SELECT id, name FROM meals");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meals[] = $row;
    }
}
?>

<style>
    .alert-success {
        padding: 10px;
        color: #155724;
        margin: 10px 0;
        border-radius: 5px;
    }

    .alert-danger {
        padding: 10px;
        color: #721c24;
        margin: 10px 0;
        border-radius: 5px;
    }

    .back {
        padding: 10px 20px; 
        border: none; 
        background: skyblue; 
        border-radius: 5px; 
        text-decoration: none; 
        color: black;"
    }

    form {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 400px;
        margin-bottom: 40px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        padding: 8px;
        width: 100%;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    .custom-btn-blue {
        background-color: skyblue;
        color: black;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .custom-btn-blue:hover {
        background-color: #87cefa;
    }

    .custom-btn-red {
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .custom-btn-red:hover {
        background-color: #f08080;
    }
</style>

<?= $message ?>

<?php if ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
    <h3>Add Discount</h3>
    <form method="POST" action="add_discount.php">
        <div class="mb-3">
            <label for="meal_id" class="form-label">Select Menu</label>
            <select name="meal_id" class="form-select" required>
                <?php foreach ($meals as $meal): ?>
                    <option value="<?= $meal['id'] ?>"><?= htmlspecialchars($meal['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" name="discount" min="0" max="100" class="form-control" required>
        </div>
        <div style="text-align: center;">
            <button type="submit" name="apply_discount" class="custom-btn-blue">Apply Discount</button>
        </div>
    </form>

    <h3>Remove Discount</h3>
    <form method="POST" action="add_discount.php">
        <div class="mb-3">
            <label for="meal_id_remove" class="form-label">Select Menu</label>
            <select name="meal_id_remove" class="form-select" required>
                <?php foreach ($meals as $meal): ?>
                    <option value="<?= $meal['id'] ?>"><?= htmlspecialchars($meal['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="text-align: center;">
            <button type="submit" name="remove_discount" class="custom-btn-red">Remove Discount</button>
        </div>
    </form>
<?php endif; ?>