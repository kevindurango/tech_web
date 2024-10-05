<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $stmt = $conn->prepare("SELECT p.id, p.name, p.SKU, p.short_description, p.price, p.product_description, p.feature_product, p.main_image_url 
                             FROM Products p WHERE p.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    $stmt_attributes = $conn->prepare("SELECT av.value, a.attribute_name 
                                        FROM Product_Attributes pa 
                                        JOIN Attribute_Values av ON pa.attribute_value_id = av.id 
                                        JOIN Attributes a ON av.attribute_id = a.id 
                                        WHERE pa.product_id = ?");
    $stmt_attributes->bind_param("i", $id);
    $stmt_attributes->execute();
    $result_attributes = $stmt_attributes->get_result();

    $attributes = [];
    while ($row = $result_attributes->fetch_assoc()) {
        $attributes[$row['attribute_name']][] = $row['value'];
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>
<body>
    <div class="product-details">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <img src="<?php echo '/tech_web/assets/products/' . htmlspecialchars($product['main_image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 150px; max-height: 150px;">
        <p><strong>SKU:</strong> <?php echo htmlspecialchars($product['SKU']); ?></p>
        <p><strong>Short Description:</strong> <?php echo htmlspecialchars($product['short_description']); ?></p>
        <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
        <p><strong>Product Description:</strong><br><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
        <p><strong>Featured Product:</strong> <?php echo $product['feature_product'] ? 'Yes' : 'No'; ?></p>
        
        <p><strong>Attributes:</strong></p>
        <ul>
            <?php
            foreach ($attributes as $attribute_name => $values) {
                echo "<li><strong>" . htmlspecialchars($attribute_name) . ":</strong> " . htmlspecialchars(implode(', ', $values)) . "</li>";
            }
            ?>
        </ul>

        <a href="product_list.php">Back to Product List</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$stmt_attributes->close();
$conn->close();
?>
