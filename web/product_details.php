<?php
include 'db_connection.php';

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Default to 1 if not set

// Fetch product details
$product_query = "SELECT p.id, p.name, p.SKU, p.short_description, p.price, p.product_description, p.feature_product, p.main_image_url, p.brand_id, b.brand_name 
                  FROM products p 
                  LEFT JOIN brands b ON p.brand_id = b.id 
                  WHERE p.id = ?";
$stmt = $conn->prepare($product_query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch category path
$category_path = [];
$product_variation_id = null;

// Retrieve product variation ID directly
$variation_query = "SELECT category_id FROM product_categories WHERE product_id = ? ORDER BY category_id DESC LIMIT 1";
$variation_stmt = $conn->prepare($variation_query);
$variation_stmt->bind_param("i", $product_id);
$variation_stmt->execute();
$variation_result = $variation_stmt->get_result();

if ($variation_row = $variation_result->fetch_assoc()) {
    $product_variation_id = $variation_row['category_id'];
}

if ($product_variation_id) {
    $current_category_id = $product_variation_id;
    while ($current_category_id) {
        $category_query = $conn->prepare("SELECT id, category_name, parent_id FROM categories WHERE id = ?");
        $category_query->bind_param("i", $current_category_id);
        $category_query->execute();
        $category_result = $category_query->get_result();
        $category = $category_result->fetch_assoc();
        
        if ($category) {
            $category_path[] = $category['category_name'];
            $current_category_id = $category['parent_id'];
        } else {
            break;
        }
    }
    $category_path = array_reverse($category_path);
    $full_category_path = implode("/", $category_path);
} else {
    $full_category_path = 'N/A';
}

// Fetch related images
$image_query = "SELECT image_path FROM images WHERE product_id = ?";
$image_stmt = $conn->prepare($image_query);
$image_stmt->bind_param("i", $product_id);
$image_stmt->execute();
$image_result = $image_stmt->get_result();
$images = [];
while ($img_row = $image_result->fetch_assoc()) {
    $images[] = $img_row['image_path'];
}

// Fetch product attributes (including tags)
$attributes_query = "
    SELECT a.attribute_name, av.value 
    FROM product_attributes pa 
    LEFT JOIN attribute_values av ON pa.attribute_value_id = av.id 
    LEFT JOIN attributes a ON av.attribute_id = a.id 
    WHERE pa.product_id = ?";
$attributes_stmt = $conn->prepare($attributes_query);
$attributes_stmt->bind_param("i", $product_id);
$attributes_stmt->execute();
$attributes_result = $attributes_stmt->get_result();
$attributes = [];
while ($attr_row = $attributes_result->fetch_assoc()) {
    $attributes[] = $attr_row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>
<body>
    <h2>Product Details</h2>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
    <p><strong>SKU:</strong> <?php echo htmlspecialchars($product['SKU']); ?></p>
    <p><strong>Short Description:</strong> <?php echo htmlspecialchars($product['short_description']); ?></p>
    <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
    <p><strong>Full Description:</strong> <?php echo htmlspecialchars($product['product_description']); ?></p>
    <p><strong>Featured Product:</strong> <?php echo $product['feature_product'] ? 'Yes' : 'No'; ?></p>
    <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand_name']); ?></p>
    <p><strong>Category Path:</strong> <?php echo $full_category_path ? htmlspecialchars($full_category_path) : 'N/A'; ?></p>

    <!-- Display attributes (including tags) -->
    <h3>Product Attributes</h3>
    <?php if (!empty($attributes)): ?>
        <ul>
            <?php foreach ($attributes as $attribute): ?>
                <li><strong><?php echo htmlspecialchars($attribute['attribute_name']); ?>:</strong> <?php echo htmlspecialchars($attribute['value']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No attributes available for this product.</p>
    <?php endif; ?>

    <!-- Display images -->
    <h3>Product Images</h3>
    <?php if (!empty($images)): ?>
        <?php foreach ($images as $image_path): ?>
            <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Product Image" style="max-width:200px; height:auto;">
        <?php endforeach; ?>
    <?php else: ?>
        <p>No images available for this product.</p>
    <?php endif; ?>

    <p><a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit Product</a></p>
</body>
</html>