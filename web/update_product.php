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

    $stmt = $conn->prepare("UPDATE Products SET name=?, SKU=?, short_description=?, price=?, product_description=?, feature_product=? WHERE id=?");
    $stmt->bind_param("sssdsii", $name, $sku, $short_description, $price, $product_description, $feature_product, $id);
    
    if ($stmt->execute()) {
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "assets/products/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $uploadOk = 1;

            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $stmt_update_image = $conn->prepare("UPDATE Products SET main_image_url=? WHERE id=?");
                    $stmt_update_image->bind_param("si", $_FILES['image']['name'], $id);
                    $stmt_update_image->execute();
                    $stmt_update_image->close();
                } else {
                    echo "There was an error uploading the file.";
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        $stmt_delete_attributes = $conn->prepare("DELETE FROM Product_Attributes WHERE product_id = ?");
        $stmt_delete_attributes->bind_param("i", $id);
        $stmt_delete_attributes->execute();
        $stmt_delete_attributes->close();

        if (isset($_POST['attributes']) && !empty($_POST['attributes'])) {
            $attributes = $_POST['attributes'];
            $stmt_insert_attributes = $conn->prepare("INSERT INTO Product_Attributes (product_id, attribute_value_id) VALUES (?, ?)");
            
            foreach ($attributes as $value_id) {
                $stmt_insert_attributes->bind_param("ii", $id, $value_id);
                $stmt_insert_attributes->execute();
            }
            $stmt_insert_attributes->close();
        }

        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
