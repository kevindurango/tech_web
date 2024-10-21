<?php
include 'db_connection.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM Subcategories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $subcategory = $result->fetch_assoc();

    // Check if subcategory exists
    if (!$subcategory) {
        die("Subcategory not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subcategory</title>
</head>
<body>
    <h2>Edit Subcategory</h2>
    <form action="update_subcategory.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $subcategory['id']; ?>">

        <label for="subcategory_name">Subcategory Name:</label>
        <input type="text" id="subcategory_name" name="subcategory_name" value="<?php echo htmlspecialchars($subcategory['subcategory_name']); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($subcategory['description']); ?></textarea><br><br>

        <input type="submit" value="Update Subcategory">
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
