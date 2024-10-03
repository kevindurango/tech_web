<?php
include 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    $productQuery = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $productResult = $stmt->get_result();
    $product = $productResult->fetch_assoc();

    if (!$product) {
        echo "Product not found.";
        exit();
    }

    $imageQuery = "SELECT image_url FROM images WHERE product_id = ?";
    $imageStmt = $conn->prepare($imageQuery);
    $imageStmt->bind_param('i', $productId);
    $imageStmt->execute();
    $imageResult = $imageStmt->get_result();
    $image = $imageResult->fetch_assoc();

    $attributesQuery = "
        SELECT pa.id as product_attribute_id, a.attribute_name, av.value
        FROM product_attributes pa
        JOIN attributes a ON pa.attribute_id = a.id
        JOIN attribute_values av ON pa.value_id = av.id
        WHERE pa.product_id = ?
    ";
    $attributesStmt = $conn->prepare($attributesQuery);
    $attributesStmt->bind_param('i', $productId);
    $attributesStmt->execute();
    $attributesResult = $attributesStmt->get_result();
} else {
    echo "Invalid product ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>

    <!-- Display Product Image -->
    <?php if (!empty($image['image_url'])): ?>
        <img src="/tech_web/assets/products/<?php echo htmlspecialchars($image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 300px;">
    <?php else: ?>
        <p>No image available for this product.</p>
    <?php endif; ?>

    <p><strong>SKU:</strong> <?php echo htmlspecialchars($product['sku']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
    <p><strong>Featured:</strong> <?php echo $product['featured'] ? 'Yes' : 'No'; ?></p>

    <h2>Attributes</h2>
    <?php if ($attributesResult->num_rows > 0): ?>
        <ul>
            <?php while ($attribute = $attributesResult->fetch_assoc()): ?>
                <li><strong><?php echo htmlspecialchars($attribute['attribute_name']); ?>:</strong> <?php echo htmlspecialchars($attribute['value']); ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No attributes found for this product.</p>
    <?php endif; ?>
    
    <a href="product_list.php">Back to Product List</a>
</body>
</html>
