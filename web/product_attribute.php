<?php
class ProductAttribute
{
    private $conn;
    private $tableName = "attributes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllAttributes()
    {
        $query = "
            SELECT a.id as attribute_id, a.attribute_name, av.id as value_id, av.value
            FROM " . $this->tableName . " a
            LEFT JOIN attribute_values av ON a.id = av.attribute_id
            ORDER BY a.attribute_name, av.value";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addAttribute($attributeName, $attributeValues)
    {
        $query = "INSERT INTO attributes (attribute_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $attributeName);
    
        if ($stmt->execute()) {
            $attributeId = $stmt->insert_id;
            $valuesArray = explode(',', $attributeValues);

            foreach ($valuesArray as $value) {
                $value = trim($value);
                if (!empty($value)) {
                    $valueQuery = "INSERT INTO attribute_values (attribute_id, value) VALUES (?, ?)";
                    $valueStmt = $this->conn->prepare($valueQuery);
                    $valueStmt->bind_param('is', $attributeId, $value);
                    $valueStmt->execute();
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public function deleteAttribute($attributeId)
    {
        $deleteValuesQuery = "DELETE FROM attribute_values WHERE attribute_id = ?";
        $stmt = $this->conn->prepare($deleteValuesQuery);
        $stmt->bind_param('i', $attributeId);
        $stmt->execute();

        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $attributeId);
        return $stmt->execute();
    }

    public function getAttributeById($attributeId)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $attributeId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateAttribute($attributeId, $attributeName)
    {
        $query = "UPDATE " . $this->tableName . " SET attribute_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $attributeName, $attributeId);
        return $stmt->execute();
    }
}
