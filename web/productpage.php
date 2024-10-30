<?php

class ProductPage
{
    private $conn;
    private $product_id;

    public function __construct($conn, $product_id)
    {
        $this->conn = $conn;
        $this->product_id = (int) $product_id;
    }

    // Fetch product details along with brand information
    public function getProductDetails()
    {
        $query = "
            SELECT p.*, b.logo_url, b.brand_name, b.description AS brand_description 
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            WHERE p.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Fetch all product images
    public function getProductImages()
    {
        $query = "SELECT * FROM images WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch major attributes, including predefined features like storage and color
    public function getProductAttributes($major_features)
    {
        $placeholders = implode("','", array_map(function ($feature) {
            return mysqli_real_escape_string($this->conn, $feature);
        }, $major_features));

        $query = "SELECT a.attribute_name, av.value 
                  FROM product_attributes pa 
                  JOIN attribute_values av ON pa.attribute_value_id = av.id 
                  JOIN attributes a ON av.attribute_id = a.id 
                  WHERE pa.product_id = ? 
                  AND a.attribute_name IN ('$placeholders')";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch tags associated with the product
    public function getProductTags()
    {
        $query = "SELECT av.value 
                  FROM product_attributes pa 
                  JOIN attribute_values av ON pa.attribute_value_id = av.id 
                  JOIN attributes a ON av.attribute_id = a.id 
                  WHERE pa.product_id = ? 
                  AND a.attribute_name = 'tags'";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return array_map(function ($row) {
            return htmlspecialchars($row['value']);
        }, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    }

    // Fetch categories associated with the product
    public function getProductCategories()
    {
        $query = "SELECT c.id, c.category_name 
                  FROM product_categories pc 
                  JOIN categories c ON pc.category_id = c.id 
                  WHERE pc.product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch similar products within the same categories
    public function getSimilarProducts()
    {
        $categories = $this->getProductCategories();
        $category_ids = array_column($categories, 'id');

        if (empty($category_ids)) {
            return [];
        }

        $category_placeholders = implode(',', $category_ids);
        $query = "
            SELECT p.id, p.name, p.price, p.original_price, MIN(i.image_path) AS image_path 
            FROM products p 
            JOIN product_categories pc ON p.id = pc.product_id 
            LEFT JOIN images i ON p.id = i.product_id 
            WHERE pc.category_id IN ($category_placeholders)
            AND p.id != ? 
            GROUP BY p.id, p.name, p.price, p.original_price
            LIMIT 3";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch the next product in sequence
    public function getNextProduct()
    {
        $query = "SELECT id FROM products WHERE id > ? ORDER BY id ASC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Fetch the previous product in sequence
    public function getPreviousProduct()
    {
        $query = "SELECT id FROM products WHERE id < ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
