<?php
$connection = new mysqli("localhost", "root", "", "restaurant_db");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT name, price, discount, stock FROM meals";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-black">Inventory Report</h2>

    <table id="inventoryTable" class="table table-bordered table-striped">
        <thead class="table-white">
            <tr>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Discount (%)</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                    $stock = $row['stock'];
                    if ($stock <= 0) {
                        $status = '<span class="badge bg-danger">Out of Stock</span>';
                    } elseif ($stock <= 5) {
                        $status = '<span class="badge bg-warning text-dark">Low Stock</span>';
                    } else {
                        $status = '<span class="badge bg-success">In Stock</span>';
                    }
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td>₱<?= number_format($row['price'], 2); ?></td>
                    <td><?= $row['discount']; ?>%</td>
                    <td><?= $row['stock']; ?></td>
                    <td><?= $status; ?></td>
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
    $(document).ready(function () {
        $('#inventoryTable').DataTable();
    });
</script>

</body>
</html>

<?php
$connection->close();
?>