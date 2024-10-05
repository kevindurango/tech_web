<?php
include 'db_connection.php'; // Include the database connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    $stmt = $conn->prepare("SELECT p.id, p.name, p.SKU, p.short_description, p.price, p.product_description, p.feature_product, p.main_image_url 
                             FROM Products p WHERE p.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    // Fetch current product attributes
    $stmt_attributes = $conn->prepare("SELECT attribute_value_id FROM Product_Attributes WHERE product_id = ?");
    $stmt_attributes->bind_param("i", $id);
    $stmt_attributes->execute();
    $result_attributes = $stmt_attributes->get_result();

    $current_attributes = [];
    while ($row = $result_attributes->fetch_assoc()) {
        $current_attributes[] = $row['attribute_value_id'];
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
    <title>Edit Product</title>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>

        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku" value="<?php echo htmlspecialchars($product['SKU']); ?>" required><br><br>

        <label for="short_description">Short Description:</label>
        <textarea id="short_description" name="short_description" required><?php echo htmlspecialchars($product['short_description']); ?></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description"><?php echo htmlspecialchars($product['product_description']); ?></textarea><br><br>

        <label for="feature_product">Feature Product:</label>
        <input type="checkbox" id="feature_product" name="feature_product" <?php echo ($product['feature_product'] ? 'checked' : ''); ?>><br><br>

        <label for="image">Current Image:</label>
        <div>
            <?php if (!empty($product['main_image_url'])) : ?>
                <img src="<?php echo '/tech_web/assets/products/' . basename($product['main_image_url']); ?>" alt="Product Image" style="max-width: 150px;"><br>
                <p>Current Image: <a href="<?php echo '/tech_web/assets/products/' . basename($product['main_image_url']); ?>" target="_blank">View Image</a></p>
            <?php else : ?>
                <p>No image available.</p>
            <?php endif; ?>
        </div>

        <label for="image">Upload New Image (optional):</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <label for="attributes">Select Attributes:</label>
        <select id="attributes" name="attributes[]" multiple>
            <?php
            $attr_result = $conn->query("SELECT id, attribute_name FROM Attributes");
            while ($attr_row = $attr_result->fetch_assoc()) {
                $value_result = $conn->query("SELECT id, value FROM Attribute_Values WHERE attribute_id = " . $attr_row['id']);
                echo "<optgroup label='" . htmlspecialchars($attr_row['attribute_name']) . "'>";
                while ($value_row = $value_result->fetch_assoc()) {
                    $selected = in_array($value_row['id'], $current_attributes) ? 'selected' : '';
                    echo "<option value='" . $value_row['id'] . "' $selected>" . htmlspecialchars($value_row['value']) . "</option>";
                }
                echo "</optgroup>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Update Product">
    </form>

    <script>
        $(document).ready(function() {
            $('#attributes').select2({
                placeholder: 'Select Attributes',
                allowClear: true
            });
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$stmt_attributes->close();
$conn->close();
?>
