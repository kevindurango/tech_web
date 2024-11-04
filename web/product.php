<?php
class Product
{
    private $db;
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

    // Constructor with optional product ID
    public function __construct($db, $id = null)
    {
        $this->db = $db; 
        if ($id) {
            $this->getProductById($id); 
        }
    }

    // Fetch a single product by ID
    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if ($product) {
            $this->id = $product['id'];
            $this->name = $product['name'];
            $this->sku = $product['SKU'];
            $this->short_description = $product['short_description'];
            $this->price = $product['price'];
            $this->product_description = $product['product_description'];
            $this->feature_product = $product['feature_product'];
            $this->brand_id = $product['brand_id'];
            $this->image_path = $product['main_image_url'];
            // Populate attributes if needed
            $this->attributes = $this->getProductAttributes($id);
        }
    }

    // Fetch product attributes
    private function getProductAttributes($product_id)
    {
        $query = "SELECT attribute_value_id FROM product_attributes WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Returns an array of attribute value IDs
    }

    // Method to submit a new product
    public function submitProduct($categories)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, SKU, short_description, price, product_description, feature_product, brand_id, main_image_url) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdssss", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $this->image_path);

        if ($stmt->execute()) {
            $product_id = $stmt->insert_id; // Get the ID of the newly created product

            // Insert categories associated with the product
            foreach ($categories as $category_id) {
                $stmt_category = $this->db->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
                $stmt_category->bind_param("ii", $product_id, $category_id);
                $stmt_category->execute();
                $stmt_category->close();
            }

            // Insert attributes associated with the product
            if (!empty($this->attributes)) {
                foreach ($this->attributes as $attribute_value_id) {
                    $stmt_attribute = $this->db->prepare("INSERT INTO product_attributes (product_id, attribute_value_id) VALUES (?, ?)");
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
    public function updateProduct($product_id)
    {
        $update_product_query = "UPDATE products SET name = ?, SKU = ?, short_description = ?, price = ?, 
                                product_description = ?, feature_product = ?, brand_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($update_product_query);
        $stmt->bind_param("sssdssii", $this->name, $this->sku, $this->short_description, $this->price, $this->product_description, $this->feature_product, $this->brand_id, $product_id);

        if (!$stmt->execute()) {
            echo "Error updating product: " . $stmt->error;
            return false;
        }
        $stmt->close();
        return true;
    }

    // Method to delete a product
    public function deleteProduct($product_id)
    {
        // First, clear associations
        $this->db->query("DELETE FROM product_categories WHERE product_id = $product_id");
        $this->db->query("DELETE FROM product_attributes WHERE product_id = $product_id");

        // Then, delete the product itself
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            return true; // Product deleted successfully
        } else {
            echo "Error deleting product: " . $stmt->error;
            return false;
        }
    }

    // Method to get all products
    public static function getAllProducts($db)
    {
        $sql = "SELECT id, name, SKU, short_description, price, product_description, feature_product, main_image_url FROM products";
        $result = $db->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
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
}
?>
