<?php
include 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = $conn->query($categoriesQuery);

$attributesQuery = "SELECT * FROM attributes";
$attributesResult = $conn->query($attributesQuery);

$product = null;
$productId = null;

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $productQuery = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $productResult = $stmt->get_result();
    $product = $productResult->fetch_assoc();

    $imageQuery = "SELECT image_url FROM images WHERE product_id = ?";
    $imageStmt = $conn->prepare($imageQuery);
    $imageStmt->bind_param('i', $productId);
    $imageStmt->execute();
    $imageResult = $imageStmt->get_result();
    $image = $imageResult->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $description = $_POST['description'];
    $shortDescription = $_POST['short_description'];
    $price = $_POST['price'];
    $featured = isset($_POST['featured']) ? 1 : 0;
    $categoryId = $_POST['category_id'];
    $imageUrl = $_POST['image_url'];

    $updateProductQuery = "UPDATE products SET name = ?, sku = ?, description = ?, short_description = ?, price = ?, featured = ?, category_id = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateProductQuery);
    $updateStmt->bind_param('ssssssii', $name, $sku, $description, $shortDescription, $price, $featured, $categoryId, $productId);

    if ($updateStmt->execute()) {
        $updateImageQuery = "UPDATE images SET image_url = ? WHERE product_id = ?";
        $imageStmt = $conn->prepare($updateImageQuery);
        $imageStmt->bind_param('si', $imageUrl, $productId);
        $imageStmt->execute();

        $clearAttributesQuery = "DELETE FROM product_attributes WHERE product_id = ?";
        $clearStmt = $conn->prepare($clearAttributesQuery);
        $clearStmt->bind_param('i', $productId);
        $clearStmt->execute();

        foreach ($_POST['attribute_values'] as $attributeId => $valueIds) {
            if (!empty($valueIds)) {
                foreach ($valueIds as $valueId) {
                    if (!empty($valueId)) {
                        $insertAttributesQuery = "INSERT INTO product_attributes (product_id, attribute_id, value_id) VALUES (?, ?, ?)";
                        $insertStmt = $conn->prepare($insertAttributesQuery);
                        $insertStmt->bind_param('iii', $productId, $attributeId, $valueId);
                        $insertStmt->execute();
                    }
                }
            }
        }

        header("Location: edit_product.php?id=$productId&msg=Product updated successfully");
        exit();
    } else {
        echo "Error updating product.";
    }
}
?>

<form action="edit_product.php?id=<?php echo $productId; ?>" method="post">
    <label for="name">Product Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>

    <label for="sku">SKU:</label>
    <input type="text" name="sku" value="<?php echo htmlspecialchars($product['sku']); ?>" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br>

    <label for="short_description">Short Description:</label>
    <textarea name="short_description" required><?php echo htmlspecialchars($product['short_description']); ?></textarea><br>

    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>

    <label for="featured">Featured:</label>
    <input type="checkbox" name="featured" <?php echo $product['featured'] ? 'checked' : ''; ?>><br>

    <label for="image_url">Image URL:</label>
    <input type="text" name="image_url" value="<?php echo htmlspecialchars($image['image_url']); ?>"><br>

    <label for="category_id">Category:</label>
    <select name="category_id" required>
        <option value="">Select a category</option>
        <?php while ($category = $categoriesResult->fetch_assoc()): ?>
            <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category['category_name']); ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <h2>Select Attributes</h2>
    <?php while ($attribute = $attributesResult->fetch_assoc()): ?>
        <label><strong><?php echo htmlspecialchars($attribute['attribute_name']); ?></strong></label><br>
        <?php
        $valueQuery = "SELECT * FROM attribute_values WHERE attribute_id = ?";
        $valueStmt = $conn->prepare($valueQuery);
        $valueStmt->bind_param('i', $attribute['id']);
        $valueStmt->execute();
        $valueResult = $valueStmt->get_result();

        while ($value = $valueResult->fetch_assoc()): ?>
            <input type="checkbox" name="attribute_values[<?php echo $attribute['id']; ?>][]" value="<?php echo $value['id']; ?>" <?php
                $checkQuery = "SELECT * FROM product_attributes WHERE product_id = ? AND attribute_id = ? AND value_id = ?";
                $checkStmt = $conn->prepare($checkQuery);
                $checkStmt->bind_param('iii', $productId, $attribute['id'], $value['id']);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();
                echo ($checkResult->num_rows > 0) ? 'checked' : '';
            ?>>
            <?php echo htmlspecialchars($value['value']); ?><br>
        <?php endwhile; ?>
    <?php endwhile; ?>

    <input type="submit" value="Update Product">
</form>
<a href="product_list.php">Back to Product List</a>
