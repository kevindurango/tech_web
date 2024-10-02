<?php
include 'Database.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $category_sql = "SELECT category_name FROM categories WHERE id = ?";
    $stmt = $conn->prepare($category_sql);
    $stmt->bind_param('i', $category_id);
    $stmt->execute();
    $category_result = $stmt->get_result();
    $category = $category_result->fetch_assoc();

    if ($category) {
        echo "<h2>Products in Category: " . htmlspecialchars($category['category_name']) . "</h2>";

        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $category_id);
        $stmt->execute();
        $products = $stmt->get_result();

        if ($products->num_rows > 0) {
            echo '<table border="1">';
            echo '
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
            ';

            while ($product = $products->fetch_assoc()) {
                echo '
                    <tr>
                        <td>' . $product['id'] . '</td>
                        <td>' . htmlspecialchars($product['name']) . '</td>
                        <td>$' . number_format($product['price'], 2) . '</td>
                    </tr>
                ';
            }

            echo '</tbody></table>';
        } else {
            echo 'No products found in this category.';
        }
    } else {
        echo 'Category not found.';
    }
} else {
    echo 'No category ID provided.';
}

$conn->close();
?>
