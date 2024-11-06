<?php
include 'db_connection.php'; // Include your database connection

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

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

// Fetch all attributes and their values
$stmt_all_attributes = $conn->query("
    SELECT a.id AS attribute_id, a.attribute_name, av.id AS value_id, av.value 
    FROM attributes a 
    LEFT JOIN attribute_values av ON a.id = av.attribute_id
    ORDER BY a.id, av.id
");

$attributes_with_values = [];
while ($row = $stmt_all_attributes->fetch_assoc()) {
    $attributes_with_values[$row['attribute_id']]['name'] = $row['attribute_name'];
    if ($row['value_id']) {
        $attributes_with_values[$row['attribute_id']]['values'][] = [
            'id' => $row['value_id'],
            'value' => $row['value']
        ];
    }
}

$success = isset($_GET['update']) && $_GET['update'] == 'success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <h2>Edit Product</h2>

    <?php if ($success): ?>
        <p style="color: green;">Product updated successfully!</p>
        <p><a href="product_list.php">Go back to Product List</a></p>
    <?php endif; ?>

    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <fieldset>
            <legend>Product Information</legend>

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required placeholder="Enter product name"><br><br>

            <label for="sku">SKU:</label>
            <input type="text" id="sku" name="sku" value="<?php echo htmlspecialchars($product['SKU']); ?>" required placeholder="Enter SKU"><br><br>

            <label for="short_description">Short Description:</label>
            <textarea id="short_description" name="short_description" required placeholder="Enter short description"><?php echo htmlspecialchars($product['short_description']); ?></textarea><br><br>

            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description" required placeholder="Enter product description"><?php echo htmlspecialchars($product['product_description']); ?></textarea><br><br>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required placeholder="Enter price"><br><br>

            <label for="feature_product">Feature Product:</label>
            <input type="checkbox" id="feature_product" name="feature_product" <?php echo ($product['feature_product'] ? 'checked' : ''); ?> title="Check to feature this product"><br><br>
            <p><a href="image_management.php?id=<?php echo $product_id; ?>">Manage Images for this Product</a></p> <!-- Link to image management -->

        </fieldset>

        <fieldset>
            <legend>Product Categories and Brands</legend>

            <label for="brand">Select Brand:</label>
            <select id="brand" name="brand_id" required>
                <option value="">Select a Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['id']; ?>" <?php echo ($brand['id'] == $product['brand_id'] ? 'selected' : ''); ?>>
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="product_variation">Select Product Variation:</label>
            <select id="product_variation" name="product_variation_id" required>
                <option value="">Select a Product Variation</option>
                <?php
                // Fetch product variations (lowest-level categories)
                $variations_result = $conn->query("SELECT id, category_name FROM categories WHERE parent_id IS NOT NULL");
                while ($variation = $variations_result->fetch_assoc()) {
                    $selected = in_array($variation['id'], $current_categories) ? 'selected' : '';
                    echo "<option value='" . $variation['id'] . "' $selected>" . htmlspecialchars($variation['category_name']) . "</option>";
                }
                ?>
            </select><br><br>
        </fieldset>

        <fieldset>
            <legend>Product Attributes</legend>

            <label for="attributes">Select Attributes:</label>
            <select id="attributes" name="attributes[]" multiple required>
                <?php foreach ($attributes_with_values as $attribute_id => $attribute): ?>
                    <optgroup label="<?php echo htmlspecialchars($attribute['name']); ?>">
                        <?php foreach ($attribute['values'] as $value): ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo (in_array($value['id'], $current_attributes) ? 'selected' : ''); ?>>
                                <?php echo htmlspecialchars($value['value']); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select><br><br>
        </fieldset>

        <button type="submit">Update Product</button>
    </form>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for better UI
            $('select').select2({
                allowClear: true
            });
        });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
