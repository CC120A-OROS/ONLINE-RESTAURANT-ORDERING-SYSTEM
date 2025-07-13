<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meal_id = intval($_POST['meal_id']);
    $quantity = intval($_POST['quantity']);
    $action = $_POST['action'];

    $sql = "SELECT stock FROM meals WHERE id = $meal_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $meal = $result->fetch_assoc();
        $current_stock = $meal['stock'];

        if ($action == 'in') {
            $new_stock = $current_stock + $quantity;
        } elseif ($action == 'out') {
            if ($quantity > $current_stock) {
                echo "<script>alert('Error: Cannot remove more stock than available!'); window.location.href='stock_in_out.php';</script>";
                exit;
            }
            $new_stock = $current_stock - $quantity;
        } else {
            echo "<script>alert('Invalid action.'); window.location.href='stock_in_out.php';</script>";
            exit;
        }

        $update = "UPDATE meals SET stock = $new_stock WHERE id = $meal_id";
        if ($conn->query($update) === TRUE) {
            $log = "INSERT INTO stock_logs (meal_id, quantity, action) VALUES ($meal_id, $quantity, '$action')";
            $conn->query($log);

            echo "<script>alert('Stock updated successfully!'); window.location.href='stock_in_out.php';</script>";
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    } else {
        echo "Meal not found.";
    }
}

$meals = $conn->query("SELECT * FROM meals");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock In/Out Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .btn-skyblue {
            background-color: skyblue;
            color: black;
            border: none;
        }

        .btn-skyblue:hover {
            background-color: lightblue;
            color: white;
        }

        .btn-custom-back {
            background-color: skyblue; 
            color: #000 !important;   
            border: none;
        }

        .btn-custom-back:hover {
            background-color: lightblue;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-black">Manage Menu Stock</h2>

    <div class="table-responsive">
        <table id="stockTable" class="table table-bordered table-striped align-middle">
            <thead class="table-white">
                <tr>
                    <th>Menu Name</th>
                    <th>Price</th>
                    <th>Current Stock</th>
                    <th>Stock In</th>
                    <th>Stock Out</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($meals && $meals->num_rows > 0): ?>
                    <?php while ($meal = $meals->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($meal['name']); ?></td>
                            <td>₱<?= number_format($meal['price'], 2); ?></td>
                            <td><?= $meal['stock']; ?></td>
                            <td>
                                <form action="stock_in_out.php" method="POST" class="d-flex align-items-center gap-2">
                                    <input type="hidden" name="meal_id" value="<?= $meal['id']; ?>">
                                    <input type="hidden" name="action" value="in">
                                    <input type="number" name="quantity" min="1" required class="form-control form-control-sm" placeholder="Qty" style="width: 80px;">
                                    <button type="submit" class="btn btn-skyblue btn-sm">Stock In</button>
                                </form>
                            </td>
                            <td>
                                <form action="stock_in_out.php" method="POST" class="d-flex align-items-center gap-2">
                                    <input type="hidden" name="meal_id" value="<?= $meal['id']; ?>">
                                    <input type="hidden" name="action" value="out">
                                    <input type="number" name="quantity" min="1" required class="form-control form-control-sm" placeholder="Qty" style="width: 80px;">
                                    <button type="submit" class="btn btn-danger btn-sm">Stock Out</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No meals found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="admin_dashboard.php" class="btn btn-custom-back mt-3">Back</a>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#stockTable').DataTable();
    });
</script>

</body>
</html>

<?php
$conn->close();
?>