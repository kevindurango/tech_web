<?php
include 'db_connection.php'; 

if (isset($_GET['id']) && isset($_GET['attribute_id'])) {
    $id = intval($_GET['id']); 
    $attribute_id = intval($_GET['attribute_id']); 

    $stmt = $conn->prepare("DELETE FROM Attribute_Values WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Attribute value deleted successfully.";
    } else {
        echo "Error deleting attribute value: " . $stmt->error;
    }

    $stmt->close();

    header("Location: attribute_values.php?id=$attribute_id");
    exit();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
