<?php

class productattribute 
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function addAttribute($attribute_name)
    {
        $stmt = $this->conn->prepare("INSERT INTO Attributes (attribute_name) VALUES (?)");
        $stmt->bind_param("s", $attribute_name);

        if ($stmt->execute()) {
            return "New attribute created successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function deleteAttributeValue($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Attribute_Values WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            return "Attribute value deleted successfully.";
        } else {
            return "Error deleting attribute value: " . $stmt->error;
        }
    }

    public function addAttributeValue($attribute_id, $value)
    {
        $stmt = $this->conn->prepare("INSERT INTO Attribute_Values (attribute_id, value) VALUES (?, ?)");
        $stmt->bind_param("is", $attribute_id, $value);
    
        if ($stmt->execute()) {
            return "New value added successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function editAttributeValue($id, $attribute_id, $value)
    {
        $stmt = $this->conn->prepare("UPDATE Attribute_Values SET attribute_id = ?, value = ? WHERE id = ?");
        $stmt->bind_param("isi", $attribute_id, $value, $id);
    
        if ($stmt->execute()) {
            return "Attribute value updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }

    public function getAttributeValues($attribute_id)
    {
        $stmt = $this->conn->prepare("SELECT id, value FROM Attribute_Values WHERE attribute_id = ?");
        $stmt->bind_param("i", $attribute_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAttributeById($id)
    {
        $stmt = $this->conn->prepare("SELECT attribute_name FROM Attributes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAttributeValueById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Attribute_Values WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc(); 
    }

    public function updateAttribute($id, $attribute_name)
    {
        $stmt = $this->conn->prepare("UPDATE Attributes SET attribute_name = ? WHERE id = ?");
        $stmt->bind_param("si", $attribute_name, $id);

        if ($stmt->execute()) {
            return "Attribute updated successfully!";
        } else {
            return "Error updating attribute: " . $stmt->error;
        }
    }

    public function deleteAttribute($id)
    {
        $this->conn->begin_transaction();
    
        try {
            // Delete related records from Product_Attributes
            $stmt_product_attributes = $this->conn->prepare("DELETE pa FROM Product_Attributes pa 
                INNER JOIN Attribute_Values av ON pa.attribute_value_id = av.id
                WHERE av.attribute_id = ?");
            $stmt_product_attributes->bind_param("i", $id);
            $stmt_product_attributes->execute();
            $stmt_product_attributes->close();

            // Delete records from Attribute_Values
            $stmt_attribute_values = $this->conn->prepare("DELETE FROM Attribute_Values WHERE attribute_id = ?");
            $stmt_attribute_values->bind_param("i", $id);
            $stmt_attribute_values->execute();
            $stmt_attribute_values->close();

            // Finally, delete from Attributes table
            $stmt_attributes = $this->conn->prepare("DELETE FROM Attributes WHERE id = ?");
            $stmt_attributes->bind_param("i", $id);
            $stmt_attributes->execute();
            $stmt_attributes->close();

            $this->conn->commit();
            return "Attribute and related values deleted successfully.";
        } catch (Exception $e) {
            $this->conn->rollback();
            return "Error deleting attribute: " . $e->getMessage();
        }
    }
}

?>