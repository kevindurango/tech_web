<?php
include '../web/db_connection.php';
include '../classes/Order.php';

try {
    $order = new Order($conn);
    $orders = $order->getAllOrders();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sales-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .sales-header h2 {
            margin: 0;
        }
        .table-container {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            vertical-align: middle;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
            font-weight: 600;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-pending {
            background-color: #f9c107;
            color: #212529;
        }
        .status-invoiced {
            background-color: #28a745;
            color: #fff;
        }
        .action-icons {
            font-size: 1.1rem;
            color: #495057;
            cursor: pointer;
        }
        .action-icons:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Header Section -->
    <div class="sales-header">
        <h2>Sales Orders</h2>
        <a href="create_order.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create
        </a>
    </div>

    <!-- Orders Table -->
    <div class="table-container">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Order Date</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Invoice Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_number']); ?></td>
                            <td><?= htmlspecialchars($order['order_date']); ?></td>
                            <td><?= htmlspecialchars($order['customer_name']); ?></td>
                            <td><?= htmlspecialchars($order['customer_email']); ?></td>
                            <td>$<?= number_format($order['total_amount'], 2); ?></td>
                            <td>
                                <span class="status-badge <?= $order['invoice_status'] === 'pending' ? 'status-pending' : 'status-invoiced'; ?>">
                                    <?= ucfirst($order['invoice_status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="view_order.php?id=<?= $order['order_number']; ?>" class="action-icons" data-bs-toggle="tooltip" data-bs-placement="top" title="View Order">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="edit_order.php?id=<?= $order['order_number']; ?>" class="action-icons ms-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Order">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="delete_order.php?id=<?= $order['order_number']; ?>" class="action-icons ms-3 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Order" onclick="return confirm('Are you sure you want to delete this order?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Enable tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
</body>
</html>
