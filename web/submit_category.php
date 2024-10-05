<?php
include 'db_connection.php'; 

$category_name = $_POST['category_name'];
$description = $_POST['description'];

$stmt = $conn->prepare("INSERT INTO Categories (category_name, description) VALUES (?, ?)");
$stmt->bind_param("ss", $category_name, $description);

if ($stmt->execute()) {
    echo "Category added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
