<?php
include 'db_connection.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM Categories WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Category deleted successfully 🎉<br>";
        echo "<a href='category_list.php'>View Category List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
