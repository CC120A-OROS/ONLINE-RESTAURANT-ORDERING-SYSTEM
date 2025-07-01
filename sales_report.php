<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'restaurant_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$where = '';
if (!empty($start_date) && !empty($end_date)) {
    $where = "WHERE DATE(created_at) BETWEEN '$start_date' AND '$end_date'";
}

$sql_items = "
    SELECT 
        menu_name,
        SUM(menu_quantity) AS total_quantity,
        SUM(menu_price * menu_quantity) AS total_sales
    FROM orders
    $where
    GROUP BY menu_name
    ORDER BY total_sales DESC
";
$result_items = $conn->query($sql_items);

$sql_totals = "
    SELECT 
        SUM(menu_price * menu_quantity) AS total_sales,
        COUNT(*) AS total_order_rows
    FROM orders
    $where
";
$result_totals = $conn->query($sql_totals)->fetch_assoc();

$total_income = $result_totals['total_sales'] ?? 0;
$order_count = $result_totals['total_order_rows'] ?? 0;
$average_order_value = $order_count > 0 ? $total_income / $order_count : 0;

$top_selling = null;
$low_selling = null;
$items = [];

if ($result_items->num_rows > 0) {
    while ($row = $result_items->fetch_assoc()) {
        $items[] = $row;
    }
    $top_selling = $items[0];
    $low_selling = $items[count($items) - 1];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #888;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: white;
            color: black;
        }
        h2 {
            text-align: center;
            color: black;
            font-weight: bold;
        }
        .summary {
            text-align: center;
            margin: 20px auto;
            font-size: 18px;
            width: 90%;
        }
        .filter-form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="date"] {
            padding: 5px;
            margin: 0 5px;
        }
        input[type="submit"] {
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <h2>Sales Report</h2>

    <div class="filter-form">
        <form method="GET">
            From: <input type="date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
            To: <input type="date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
            <input type="submit" value="Filter">
        </form>
    </div>

    <table>
        <tr>
            <th>Menu Name</th>
            <th>Total Quantity Sold</th>
            <th>Total Sales (₱)</th>
        </tr>

        <?php if (count($items) > 0): ?>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['menu_name']) ?></td>
                    <td><?= $item['total_quantity'] ?></td>
                    <td><?= number_format($item['total_sales'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No sales data available.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="summary">
        <p><strong>Total Income:</strong> ₱<?= number_format($total_income, 2) ?></p>
        <p><strong>Number of Orders:</strong> <?= $order_count ?></p>

        <?php if ($top_selling): ?>
            <p><strong>Top Selling Items:</strong> <?= htmlspecialchars($top_selling['menu_name']) ?> (<?= $top_selling['total_quantity'] ?> sold)</p>
        <?php endif; ?>

        <?php if ($low_selling && $low_selling !== $top_selling): ?>
            <p><strong>Low Selling Item:</strong> <?= htmlspecialchars($low_selling['menu_name']) ?> (<?= $low_selling['total_quantity'] ?> sold)</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>