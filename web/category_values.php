<?php
include 'db_connection.php'; 

if (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) {
    $category_id = intval($_GET['category_id']); 

    // Debugging output
    echo "Category ID: " . $category_id; // Check the category ID
    
    $product_query = "SELECT p.id, p.name AS product_name, p.price, p.product_description AS description 
                      FROM products p
                      JOIN product_categories pc ON p.id = pc.product_id
                      WHERE pc.category_id = ?";
    
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging output
    echo "Number of products found: " . $result->num_rows; // Check how many products were found
} else {
    echo "Invalid category ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in Category</title>
</head>
<body>
    <h2>Products in Category</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4">No products found in this category.</td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="category_list.php">Back to Categories</a>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
