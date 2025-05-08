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
        <br><a href='admin_dashboard.php' class='btn btn-sm btn-secondary mt-2'>Back</a>
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
        background-color: #d4edda;
        padding: 10px;
        border: 1px solid #c3e6cb;
        color: #155724;
        margin: 10px 0;
        border-radius: 5px;
    }
    .alert-danger {
        background-color: #f8d7da;
        padding: 10px;
        border: 1px solid #f5c6cb;
        color: #721c24;
        margin: 10px 0;
        border-radius: 5px;
    }
    form {
        margin-bottom: 40px;
        max-width: 400px;
    }
</style>

<?= $message ?>

<?php if ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
    <h3>Add Discount</h3>
    <form method="POST" action="add_discount.php">
        <div class="mb-3">
            <label for="meal_id" class="form-label">Select Menu:</label>
            <select name="meal_id" class="form-select" required>
                <?php foreach ($meals as $meal): ?>
                    <option value="<?= $meal['id'] ?>"><?= htmlspecialchars($meal['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%):</label>
            <input type="number" name="discount" min="0" max="100" class="form-control" required>
        </div>
        <button type="submit" name="apply_discount" class="btn btn-primary">Apply Discount</button>
    </form>

    <h3>Remove Discount</h3>
    <form method="POST" action="add_discount.php">
        <div class="mb-3">
            <label for="meal_id_remove" class="form-label">Select Menu:</label>
            <select name="meal_id_remove" class="form-select" required>
                <?php foreach ($meals as $meal): ?>
                    <option value="<?= $meal['id'] ?>"><?= htmlspecialchars($meal['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="remove_discount" class="btn btn-danger">Remove Discount</button>
    </form>
<?php endif; ?>