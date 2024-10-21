<?php
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = intval($_POST['category_id']);
    $subcategory_name = $_POST['subcategory_name'];
    $description = $_POST['description'];

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO Subcategories (subcategory_name, description, category_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $subcategory_name, $description, $category_id);

    if ($stmt->execute()) {
        echo "Subcategory added successfully!";
        // Redirect back to subcategories page
        header("Location: subcategories.php?category_id=" . $category_id);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
