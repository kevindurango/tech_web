<?php

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $short_description = $_POST['short_description'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $featured = isset($_POST['featured']) ? 1 : 0;
    $category_id = $_POST['category_id'];  

    $stmt_product = $conn->prepare("INSERT INTO products (name, SKU, short_description, price, featured, description, category_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt_product->bind_param("sssdiss", $name, $sku, $short_description, $price, $featured, $description, $category_id);
    
    if ($stmt_product->execute()) {
        $product_id = $stmt_product->insert_id; 

        $image_url = '';
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_url = $target_file;

                $stmt_image = $conn->prepare("INSERT INTO images (product_id, image_url) VALUES (?, ?)");
                $stmt_image->bind_param("is", $product_id, $image_url);
                $stmt_image->execute();
                $stmt_image->close();
            } else {
                echo "Error uploading the image.";
            }
        }

        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt_product->error;
    }

    $stmt_product->close();
    $conn->close();
}

?>

<form action="create_product.php" method="post" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br>

    <label for="sku">SKU:</label>
    <input type="text" name="sku" required><br>

    <label for="short_description">Short Description:</label>
    <textarea name="short_description" required></textarea><br>

    <label for="price">Price:</label>
    <input type="text" name="price" required><br>

    <label for="category">Category:</label>
    <select name="category_id">
        <?php
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        while ($category = $result->fetch_assoc()) {
            echo "<option value='" . $category['id'] . "'>" . htmlspecialchars($category['category_name']) . "</option>";
        }
        ?>
    </select><br>

    <label for="featured">Feature Product:</label>
    <input type="checkbox" name="featured"><br>

    <label for="image">Product Image:</label>
    <input type="file" name="image" accept="image/*"><br>

    <label for="description">Product Description (HTML allowed):</label>
    <textarea name="description"></textarea><br>

    <input type="submit" value="Add Product">
</form>
