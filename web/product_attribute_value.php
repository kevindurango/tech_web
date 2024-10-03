<?php
class ProductAttributeValue
{
    private $conn;
    private $tableName = "attribute_values";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function deleteAttributeValue($valueId)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $valueId);
        return $stmt->execute();
    }

    public function getValuesByAttributeId($attributeId)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE attribute_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $attributeId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addValue($attributeId, $value)
    {
        $query = "INSERT INTO " . $this->tableName . " (attribute_id, value) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $attributeId, $value);
        return $stmt->execute();
    }

    public function updateValue($valueId, $value)
    {
        $query = "UPDATE " . $this->tableName . " SET value = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $value, $valueId);
        return $stmt->execute();
    }

    public function deleteValue($valueId)
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $valueId);
        return $stmt->execute();
    }
}
