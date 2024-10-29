<?php
class Product
{
    private $id;
    private $name;
    private $sku;
    private $short_description;
    private $price;
    private $product_description;
    private $feature_product;
    private $brand_id;
    private $attributes;
    private $image_path;

    // Constructor
    public function __construct($name, $sku, $short_description, $price, $product_description, $feature_product, $brand_id, $attributes = [], $image_path = null)
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->short_description = $short_description;
        $this->price = $price;
        $this->product_description = $product_description;
        $this->feature_product = $feature_product;
        $this->brand_id = $brand_id;
        $this->attributes = $attributes;
        $this->image_path = $image_path;
    }

    // Method to submit a new product
    public function submitProduct($conn, $categories)
    {
        // Prepare SQL statement to insert product details
        $stmt = $conn->prepare("INSERT INTO products (name, SKU, short_description, price, product_description, feature_product, brand_id, main_image_url) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdssss", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $this->image_path);

        if ($stmt->execute()) {
            // Get the ID of the newly created product
            $product_id = $stmt->insert_id;

            // Insert categories associated with the product
            foreach ($categories as $category_id) {
                $stmt_category = $conn->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
                $stmt_category->bind_param("ii", $product_id, $category_id);
                $stmt_category->execute();
                $stmt_category->close();
            }

            // Insert attributes associated with the product
            if (!empty($this->attributes)) {
                foreach ($this->attributes as $attribute_value_id) {
                    $stmt_attribute = $conn->prepare("INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)");
                    $stmt_attribute->bind_param("ii", $product_id, $attribute_value_id);
                    $stmt_attribute->execute();
                    $stmt_attribute->close();
                }
            }

            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    // Method to update product details
    public function updateProduct($product_id, $conn)
    {
        $update_product_query = "UPDATE products SET name = ?, SKU = ?, short_description = ?, price = ?, 
            product_description = ?, feature_product = ?, brand_id = ? WHERE id = ?";
        $stmt = $conn->prepare($update_product_query);
        $stmt->bind_param("sssdssii", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $product_id);

        if (!$stmt->execute()) {
            echo "Error updating product: " . $stmt->error;
            return false;
        }
        $stmt->close();
        return true;
    }

    // Method to update product categories
    public function updateProductCategories($product_id, $product_variation_id, $conn)
    {
        // Fetch the category path for the selected product variation
        $category_path = [];
        $current_category_id = $product_variation_id;

        while ($current_category_id) {
            $category_query = $conn->prepare("SELECT id, parent_id FROM categories WHERE id = ?");
            $category_query->bind_param("i", $current_category_id);
            $category_query->execute();
            $category_result = $category_query->get_result();
            $category = $category_result->fetch_assoc();

            if ($category) {
                $category_path[] = $category['id'];
                $current_category_id = $category['parent_id'];
            } else {
                break;
            }
        }

        // Clear existing categories for the product
        $conn->query("DELETE FROM product_categories WHERE product_id = $product_id");

        // Insert the new categories for the product based on the category path
        foreach (array_reverse($category_path) as $category_id) {
            $insert_category_query = "INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)";
            $insert_category_stmt = $conn->prepare($insert_category_query);
            $insert_category_stmt->bind_param("ii", $product_id, $category_id);
            $insert_category_stmt->execute();
            $insert_category_stmt->close();
        }
    }

    // Method to update product attributes
    public function updateProductAttributes($product_id, $conn)
    {
        // Clear existing attributes for the product
        $conn->query("DELETE FROM product_attributes WHERE product_id = $product_id");

        // Insert the new attributes for the product based on the corrected input structure
        if (!empty($this->attributes)) {
            foreach ($this->attributes as $value_id) { // Directly iterate over each selected attribute value ID
                $insert_attribute_query = "INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)";
                $insert_attribute_stmt = $conn->prepare($insert_attribute_query);
                $insert_attribute_stmt->bind_param("ii", $product_id, $value_id);

                // Check if the insert operation was successful
                if (!$insert_attribute_stmt->execute()) {
                    echo "Error inserting attribute: " . $insert_attribute_stmt->error;
                }
                $insert_attribute_stmt->close();
            }
        }
    }

    // Method to handle image upload
    public static function uploadImage($image)
    {
        $upload_dir = 'uploads/';
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_path = $upload_dir . basename($image_name);

        // Create upload directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move uploaded image to the upload directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            return $image_path;
        } else {
            echo "Failed to upload image.";
            return false;
        }
    }

    // Method to delete a product
    public function deleteProduct($product_id, $conn)
    {
        // First, clear associations
        $conn->query("DELETE FROM product_categories WHERE product_id = $product_id");
        $conn->query("DELETE FROM product_attributes WHERE product_id = $product_id");

        // Then, delete the product itself
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            return true; // Product deleted successfully
        } else {
            echo "Error deleting product: " . $stmt->error;
            return false;
        }
    }

    // Method to get all products
    public static function getAllProducts($conn)
    {
        $sql = "SELECT id, name, SKU, short_description, price, product_description, feature_product, main_image_url FROM products";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }
}
?>
