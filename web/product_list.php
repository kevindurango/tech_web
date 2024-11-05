<?php
include 'db_connection.php'; 
include '../classes/product.php';
// Retrieve all products using the new method
$products = Product::getAllProducts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Short Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td>
                            <a href="http://localhost/tech_web/main/product_page.php?id=<?php echo $product['id']; ?>">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($product['SKU']); ?></td>
                        <td><?php echo htmlspecialchars($product['short_description']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <?php if (!empty($product['main_image_url'])): ?>
                                <img src="<?php echo '/tech_web/uploads/' . $product['id'] . '/' . basename($product['main_image_url']); ?>" alt="Product Image">
                            <?php else: ?>
                                No image available.
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">View Details</a>
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <a href="product_form.php">Add New Product</a>
</body>
</html>

<?php
$conn->close();
?>
