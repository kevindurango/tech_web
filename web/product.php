<?php
class Product
{
    private $conn;
    private $tableName = "products";

    public $name;
    public $sku;
    public $short_description;
    public $price;
    public $featured;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addProduct()
    {
        $query = "INSERT INTO " . $this->tableName . " (name, sku, short_description, price, featured) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssssi', $this->name, $this->sku, $this->short_description, $this->price, $this->featured);

        if ($stmt->execute()) {
            $productId = $stmt->insert_id;
            return $productId;
        } else {
            return false;
        }
    }

    public function addImage($productId, $imageUrl)
    {
        $query = "INSERT INTO images (product_id, image_url) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $productId, $imageUrl);
        return $stmt->execute();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM " . $this->tableName;
        return $this->conn->query($sql);
    }

    public function getProductById($id) {
        $sql = "SELECT p.*, i.image_url FROM " . $this->tableName . " p
                LEFT JOIN images i ON p.id = i.product_id
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function updateProduct($id, $name, $sku, $short_description, $price, $featured, $category_id) {
        $sql = "UPDATE products SET name = ?, sku = ?, short_description = ?, price = ?, featured = ?, category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdsiii", $name, $sku, $short_description, $price, $featured, $category_id, $id);
        return $stmt->execute();
    }

    public function updateImage($product_id, $image_url) {
        $sql = "UPDATE images SET image_url = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $image_url, $product_id);
        return $stmt->execute();
    }

    public function deleteProduct($productId)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $productId);
        return $stmt->execute();
    }
}
?>
