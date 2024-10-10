<?php
include 'db_connection.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Default to 1 if not set

// Fetch product details
$product_query = "SELECT p.id, p.name, p.SKU, p.short_description, p.price, p.product_description, p.feature_product, p.main_image_url, p.brand_id 
                  FROM products p WHERE p.id = ?";
$product_stmt = $conn->prepare($product_query);
$product_stmt->bind_param("i", $product_id);
$product_stmt->execute();
$product_result = $product_stmt->get_result();
$product = $product_result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch current product attributes
$stmt_attributes = $conn->prepare("SELECT attribute_value_id FROM product_attributes WHERE product_id = ?");
$stmt_attributes->bind_param("i", $product_id);
$stmt_attributes->execute();
$result_attributes = $stmt_attributes->get_result();

$current_attributes = [];
while ($row = $result_attributes->fetch_assoc()) {
    $current_attributes[] = $row['attribute_value_id'];
}

// Fetch current product categories
$stmt_categories = $conn->prepare("SELECT category_id FROM product_categories WHERE product_id = ?");
$stmt_categories->bind_param("i", $product_id);
$stmt_categories->execute();
$result_categories = $stmt_categories->get_result();

$current_categories = [];
while ($row = $result_categories->fetch_assoc()) {
    $current_categories[] = $row['category_id'];
}

// Fetch all brands
$stmt_all_brands = $conn->query("SELECT id, brand_name FROM brands");
$brands = $stmt_all_brands->fetch_all(MYSQLI_ASSOC);

// Check if the update was successful (for displaying the success message)
$success = isset($_GET['update']) && $_GET['update'] == 'success';
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

    <!-- Display success message if the product was updated successfully -->
    <?php if ($success): ?>
        <p style="color: green;">Product updated successfully!</p>
        <p><a href="product_list.php">Go back to Product List</a></p>
    <?php endif; ?>

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

        <!-- Brand selection -->
        <label for="brand">Select Brand:</label>
        <select id="brand" name="brand_id" required>
            <option value="">Select a Brand</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?php echo $brand['id']; ?>" <?php echo ($brand['id'] == $product['brand_id'] ? 'selected' : ''); ?>>
                    <?php echo htmlspecialchars($brand['brand_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <!-- Link to image management -->
        <label for="image_management">Manage Product Images:</label>
        <a href="image_management.php?id=<?php echo $product['id']; ?>">Manage Images</a><br><br>

        <!-- Attributes selection -->
        <label for="attributes">Select Attributes:</label>
        <select id="attributes" name="attributes[]" multiple>
            <?php
            $attr_result = $conn->query("SELECT id, attribute_name FROM attributes");
            while ($attr_row = $attr_result->fetch_assoc()) {
                echo "<optgroup label='" . htmlspecialchars($attr_row['attribute_name']) . "'>";
                $value_result = $conn->query("SELECT id, value FROM attribute_values WHERE attribute_id = " . $attr_row['id']);
                while ($value_row = $value_result->fetch_assoc()) {
                    $selected = in_array($value_row['id'], $current_attributes) ? 'selected' : '';
                    echo "<option value='" . $value_row['id'] . "' $selected>" . htmlspecialchars($value_row['value']) . "</option>";
                }
                echo "</optgroup>";
            }
            ?>
        </select><br><br>

        <!-- Category selection -->
        <label for="categories">Select Categories:</label>
        <select id="categories" name="categories[]" multiple>
            <?php
            $category_result = $conn->query("SELECT id, category_name FROM categories");
            while ($category_row = $category_result->fetch_assoc()) {
                $selected = in_array($category_row['id'], $current_categories) ? 'selected' : '';
                echo "<option value='" . $category_row['id'] . "' $selected>" . htmlspecialchars($category_row['category_name']) . "</option>";
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
            
            $('#categories').select2({
                placeholder: 'Select Categories',
                allowClear: true
            });

            $('#brand').select2({
                placeholder: 'Select a Brand',
                allowClear: true
            });
        });
    </script>
</body>
</html>

<?php
$product_stmt->close();
$stmt_attributes->close();
$stmt_categories->close();
$conn->close();
?>
