<?php
session_start();

$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, menu_name, menu_price, menu_quantity, menu_image, status FROM orders ORDER BY customer_name ASC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Orders</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
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

<div class="container mt-5">
    <h3 class="mb-4 text-success">My Orders</h3>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php
                switch ($_GET['message']) {
                    case 'confirmed':
                        echo "✅ Order has been <strong>confirmed</strong>!";
                        break;
                    case 'rejected':
                        echo "❌ Order has been <strong>rejected</strong>!";
                        break;
                    case 'deleted':
                        echo "🗑️ Order has been <strong>deleted</strong>!";
                        break;
                    default:
                        echo "✅ Action completed.";
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table id="orderTable" class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $status = strtolower($row['status']);
                        $btnClass = 'btn-secondary';
                        if ($status === 'new order') $btnClass = 'btn-primary';
                        elseif ($status === 'delivered') $btnClass = 'btn-success';
                        elseif ($status === 'cancelled') $btnClass = 'btn-danger';
                        elseif ($status === 'pending') $btnClass = 'btn-warning';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['menu_name']); ?></td>
                        <td>₱<?= number_format($row['menu_price'], 2); ?></td>
                        <td><?= $row['menu_quantity']; ?></td>
                        <td>
                            <?php if (!empty($row['menu_image'])): ?>
                                <img src="<?= htmlspecialchars($row['menu_image']); ?>" class="food-image" alt="Menu Image">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm <?= $btnClass ?>">
                                <?= htmlspecialchars($row['status']); ?>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="restaurant_main.php" class="btn btn-secondary mt-3">Back</a>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#orderTable').DataTable();
    });
</script>

</body>
</html>

<?php $conn->close(); ?>