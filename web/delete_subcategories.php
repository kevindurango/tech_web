<?php
include 'db_connection.php'; // Include your database connection

// Check if the subcategory ID is passed in the URL
if (isset($_GET['id'])) {
    $subcategory_id = intval($_GET['id']); // Get and sanitize the subcategory ID

    // Prepare a SQL query to delete the subcategory
    $stmt = $conn->prepare("DELETE FROM Subcategories WHERE id = ?");
    
    if ($stmt === false) {
        // Debugging: Check for errors in preparing the statement
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $subcategory_id); // Bind the subcategory ID to the query

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Subcategory deleted successfully!";
    } else {
        echo "Error deleting subcategory: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
} else {
    echo "Invalid request. No subcategory ID specified.";
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Subcategory</title>
</head>
<body>
    <a href="subcategories.php">Go back to Subcategory List</a> <!-- Link to go back to the subcategory list -->
</body>
</html>