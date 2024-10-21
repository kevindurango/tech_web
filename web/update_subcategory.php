<?php
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $subcategory_name = $_POST['subcategory_name'];
    $description = $_POST['description'];

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE Subcategories SET subcategory_name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $subcategory_name, $description, $id);

    if ($stmt->execute()) {
        echo "Subcategory updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<a href="subcategories.php">Back to Subcategories</a>
