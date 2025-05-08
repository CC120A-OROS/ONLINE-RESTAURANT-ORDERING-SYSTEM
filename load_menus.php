<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "restaurant_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM meals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Menu Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        img.food-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-primary">All menu data</h2>
    <table id="menuTable" class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>Menu</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= number_format($row['price'], 2); ?></td>
                <td>
                    <img src="<?= htmlspecialchars($row['image']); ?>" class="food-image" alt="Meal Image">
                </td>
                <td>
                    <a href="edit_menu.php?id=<?= $row['id']; ?>" class="text-warning me-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="delete_menu.php?id=<?= $row['id']; ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#menuTable').DataTable();
    });
</script>
</body>
</html>

<?php $conn->close(); ?>