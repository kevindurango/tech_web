<?php
class Product {
    private $conn;
    private $table = "products";

    public $id;
    public $name;
    public $sku;
    public $short_description;
    public $price;
    public $featured;
    public $image_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM " . $this->table;
        return $this->conn->query($sql);
    }

    public function getProductById($id) {
        $sql = "SELECT p.*, i.image_url FROM " . $this->table . " p
                LEFT JOIN images i ON p.id = i.product_id
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function addProduct() {
        $sql = "INSERT INTO " . $this->table . " (name, sku, short_description, price, featured, image_url) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $this->name, $this->sku, $this->short_description, $this->price, $this->featured, $this->image_url);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $sku, $short_description, $price, $featured) {
        $sql = "UPDATE products SET name=?, sku=?, short_description=?, price=?, featured=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdii", $name, $sku, $short_description, $price, $featured, $id);
        return $stmt->execute();
    }

    public function updateImage($product_id, $image_url) {
        $sql = "UPDATE images SET image_url = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $image_url, $product_id);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>
