<?php
session_start();

$conn = new mysqli("localhost", "root", "", "restaurant_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, customer_name, phone, address, menu_name, menu_price, menu_quantity, menu_image, delivery_method, status FROM orders ORDER BY customer_name ASC";
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
<body>

<div class="container mt-5">
    <h3 class="mb-4 text-black">All Orders</h3>

    <table id="orderTable" class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Menu Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Delivery Method</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $status = strtolower($row['status']);
                        $textClass = 'text-secondary';
                        if ($status === 'new order') $textClass = 'text-primary';
                        elseif ($status === 'delivered') $textClass = 'text-success';
                        elseif ($status === 'cancelled') $textClass = 'text-danger';
                        elseif ($status === 'pending') $textClass = 'text-warning';
                    ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['customer_name']); ?></td>
                        <td><?= htmlspecialchars($row['phone']); ?></td>
                        <td><?= htmlspecialchars($row['address']); ?></td>
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
                        <td><?= htmlspecialchars($row['delivery_method']); ?></td>
                        <td>
                            <span class="fw-semibold <?= $textClass ?>">
                                <?= htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="confirm_orders.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm" title="Confirm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="reject_orders.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm" title="Reject">
                                    <i class="fas fa-times"></i>
                                </a>
                                <a href="delete_orders.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this order?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
      <a href="admin_dashboard.php" class="btn btn-custom-back mt-3">Back</a>
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