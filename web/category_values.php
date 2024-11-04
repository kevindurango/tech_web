<?php
include 'db_connection.php'; 
include 'category.php'; // Include the category class

// Initialize the category class
$category = new category($conn); // Use lowercase class name

// Check if category_id is set and is a valid integer
if (isset($_GET['category_id']) && intval($_GET['category_id']) > 0) {
    $category_id = intval($_GET['category_id']); 

    // Fetch products in the specified category
    $products = $category->fetchProductsInCategory($category_id);

    // Debugging output
    echo "Category ID: " . htmlspecialchars($category_id); // Check the category ID
    echo "Number of products found: " . count($products); // Check how many products were found
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
        <?php if (!empty($products)) { ?>
            <?php foreach ($products as $row) { ?>
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
    $conn->close();
    ?>
</body>
</html>
