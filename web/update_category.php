<?php
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE Categories SET category_name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $category_name, $description, $id);

    if ($stmt->execute()) {
        echo "Category updated successfully 🎉";
    } else {
        echo "Error updating category: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
