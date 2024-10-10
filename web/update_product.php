<?php
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $short_description = $_POST['short_description'];
    $price = floatval($_POST['price']);
    $product_description = $_POST['product_description'];
    $feature_product = isset($_POST['feature_product']) ? 1 : 0;
    $brand_id = isset($_POST['brand_id']) ? intval($_POST['brand_id']) : null; // Get the brand ID

    // Update product details
    $stmt = $conn->prepare("UPDATE products SET name=?, SKU=?, short_description=?, price=?, product_description=?, feature_product=?, brand_id=? WHERE id=?");
    $stmt->bind_param("sssdsiii", $name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $id);
    
    if ($stmt->execute()) {
        // Handle image upload if a new image is provided
        if (!empty($_FILES['image']['name'])) {
            // Set up the target directory using the new path structure
            $target_dir = "C:/xampp/htdocs/tech_web/uploads/" . $id . "/";
            
            // Create the directory if it doesn't exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            // Set the target file path
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                // Move the file to the target directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Build the relative path to store in the database
                    $image_path = "/tech_web/uploads/" . $id . "/" . basename($_FILES['image']['name']);
                    
                    // Update the product's main image in the database
                    $stmt_update_image = $conn->prepare("UPDATE products SET main_image_url=? WHERE id=?");
                    $stmt_update_image->bind_param("si", $image_path, $id);
                    $stmt_update_image->execute();
                    $stmt_update_image->close();
                } else {
                    // Error moving uploaded file
                    header("Location: edit_product.php?id=$id&update=error&message=upload_failed");
                    exit();
                }
            } else {
                // Invalid image file
                header("Location: edit_product.php?id=$id&update=error&message=invalid_image");
                exit();
            }
        }

        // Delete old product attributes
        $stmt_delete_attributes = $conn->prepare("DELETE FROM product_attributes WHERE product_id = ?");
        $stmt_delete_attributes->bind_param("i", $id);
        $stmt_delete_attributes->execute();
        $stmt_delete_attributes->close();

        // Insert new product attributes
        if (isset($_POST['attributes']) && !empty($_POST['attributes'])) {
            $attributes = $_POST['attributes'];
            $stmt_insert_attributes = $conn->prepare("INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)");
            foreach ($attributes as $value_id) {
                $stmt_insert_attributes->bind_param("ii", $id, $value_id);
                $stmt_insert_attributes->execute();
            }
            $stmt_insert_attributes->close();
        }

        // Delete old product categories
        $stmt_delete_categories = $conn->prepare("DELETE FROM product_categories WHERE product_id = ?");
        $stmt_delete_categories->bind_param("i", $id);
        $stmt_delete_categories->execute();
        $stmt_delete_categories->close();

        // Insert new product categories
        if (isset($_POST['categories']) && !empty($_POST['categories'])) {
            $categories = $_POST['categories'];
            $stmt_insert_categories = $conn->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
            foreach ($categories as $category_id) {
                $stmt_insert_categories->bind_param("ii", $id, $category_id);
                $stmt_insert_categories->execute();
            }
            $stmt_insert_categories->close();
        }

        // Redirect with success message
        header("Location: edit_product.php?id=$id&update=success");
        exit();
    } else {
        // Redirect with error message
        header("Location: edit_product.php?id=$id&update=error&message=update_failed");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
