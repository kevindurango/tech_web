<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    // Modify the query to include the brand
    $stmt = $conn->prepare("SELECT p.id, p.name, p.SKU, p.short_description, p.price, p.product_description, p.feature_product, p.main_image_url, b.brand_name 
                             FROM Products p 
                             LEFT JOIN Brands b ON p.brand_id = b.id
                             WHERE p.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    // Fetch product attributes
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

    // Fetch product categories
    $stmt_categories = $conn->prepare("SELECT c.category_name 
                                        FROM Product_Categories pc 
                                        JOIN Categories c ON pc.category_id = c.id 
                                        WHERE pc.product_id = ?");
    $stmt_categories->bind_param("i", $id);
    $stmt_categories->execute();
    $result_categories = $stmt_categories->get_result();

    $categories = [];
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row['category_name'];
    }

    // Define the image path based on your folder structure
    $image_path = "/tech_web/uploads/" . $id . "/" . basename($product['main_image_url']);

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
        <!-- Use the dynamically generated image path -->
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 150px; max-height: 150px;">
        <p><strong>SKU:</strong> <?php echo htmlspecialchars($product['SKU']); ?></p>
        <p><strong>Short Description:</strong> <?php echo htmlspecialchars($product['short_description']); ?></p>
        <p><strong>Price:</strong> €<?php echo number_format($product['price'], 2); ?></p>
        <p><strong>Product Description:</strong><br><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
        <p><strong>Featured Product:</strong> <?php echo $product['feature_product'] ? 'Yes' : 'No'; ?></p>
        
        <!-- Display the brand -->
        <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand_name']); ?></p>
        
        <p><strong>Category:</strong> <?php echo htmlspecialchars(implode(', ', $categories)); ?></p> <!-- Display the categories -->

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
$stmt_categories->close();
$conn->close();
?>
