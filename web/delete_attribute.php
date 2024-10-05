<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $conn->begin_transaction();

    try {

        // Delete related records from Product_Attributes
        $stmt_product_attributes = $conn->prepare("
            DELETE pa FROM Product_Attributes pa 
            INNER JOIN Attribute_Values av ON pa.attribute_value_id = av.id
            WHERE av.attribute_id = ?");
        $stmt_product_attributes->bind_param("i", $id);
        $stmt_product_attributes->execute();
        $stmt_product_attributes->close();

        // Delete records from Attribute_Values
        $stmt_attribute_values = $conn->prepare("DELETE FROM Attribute_Values WHERE attribute_id = ?");
        $stmt_attribute_values->bind_param("i", $id);
        $stmt_attribute_values->execute();
        $stmt_attribute_values->close();

        // Finally, delete from Attributes table
        $stmt_attributes = $conn->prepare("DELETE FROM Attributes WHERE id = ?");
        $stmt_attributes->bind_param("i", $id);
        $stmt_attributes->execute();
        $stmt_attributes->close();

        $conn->commit();
        
        // Redirect with success message
        header("Location: attribute_list.php?message=Attribute+and+related+values+deleted+successfully");
    } catch (Exception $e) {

        // Rollback if something goes wrong
        $conn->rollback();
        echo "Error deleting attribute: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
