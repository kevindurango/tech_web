<?php
include 'db_connection.php'; 

// Retrieve POST data
$name = $_POST['name'];
$sku = $_POST['sku'];
$short_description = $_POST['short_description'];
$price = $_POST['price'];
$product_description = $_POST['product_description'];
$feature_product = isset($_POST['feature_product']) ? 1 : 0;
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];
$subcategories = isset($_POST['subcategories']) ? $_POST['subcategories'] : []; // Added subcategories
$attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];

// Handle image upload
$image = $_FILES['image'];
$image_name = $image['name'];
$image_tmp = $image['tmp_name'];

$upload_dir = 'uploads/';
$image_path = $upload_dir . basename($image_name);

// Create upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Move uploaded image to the upload directory
if (move_uploaded_file($image_tmp, $image_path)) {
    // Prepare SQL statement to insert product details
    $stmt = $conn->prepare("INSERT INTO Products (name, SKU, short_description, price, product_description, feature_product, main_image_url) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsss", $name, $sku, $short_description, $price, $product_description, $feature_product, $image_path);

    if ($stmt->execute()) {
        // Get the ID of the newly created product
        $product_id = $stmt->insert_id;

        // Insert categories associated with the product
        foreach ($categories as $category_id) {
            $stmt_category = $conn->prepare("INSERT INTO Product_Categories (product_id, category_id) VALUES (?, ?)");
            $stmt_category->bind_param("ii", $product_id, $category_id);
            $stmt_category->execute();
            $stmt_category->close();
        }

        // Insert subcategories associated with the product
        foreach ($subcategories as $subcategory_id) {
            $stmt_subcategory = $conn->prepare("INSERT INTO Product_Subcategories (product_id, subcategory_id) VALUES (?, ?)");
            $stmt_subcategory->bind_param("ii", $product_id, $subcategory_id);
            $stmt_subcategory->execute();
            $stmt_subcategory->close();
        }

        // Insert attributes associated with the product
        if (!empty($attributes)) {
            foreach ($attributes as $attribute_value_id) {
                $stmt_attribute = $conn->prepare("INSERT INTO Product_Attributes (product_id, attribute_value_id) VALUES (?, ?)");
                $stmt_attribute->bind_param("ii", $product_id, $attribute_value_id);
                $stmt_attribute->execute();
                $stmt_attribute->close();
            }
        }

        // Success message
        echo "New product created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Failed to upload image.";
}

// Close the database connection
$conn->close();
?>