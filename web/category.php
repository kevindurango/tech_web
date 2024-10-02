<?php
class Category {
    private $conn;
    private $table = "categories";

    public $category_name;
    public $category_description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCategories() {
        $sql = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateCategory($id, $category_name, $category_description) {
        $sql = "UPDATE " . $this->table . " SET category_name = ?, category_description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $category_name, $category_description, $id);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function addCategory() {
        $sql = "INSERT INTO " . $this->table . " (category_name, category_description) VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $this->category_name, $this->category_description);

        return $stmt->execute();
    }
}
?>
