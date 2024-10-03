<?php
include 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$valueId = isset($_GET['id']) ? $_GET['id'] : null;

if ($valueId) {

    $query = "SELECT * FROM attribute_values WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $valueId);
    $stmt->execute();
    $valueResult = $stmt->get_result();
    $attributeValue = $valueResult->fetch_assoc();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newValue = $_POST['attribute_value'];


        $updateQuery = "UPDATE attribute_values SET value = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('si', $newValue, $valueId);
        
        if ($updateStmt->execute()) {
            header("Location: attribute_list.php?msg=Value updated successfully");
            exit();
        } else {
            echo "Error updating value.";
        }
    }
} else {
    echo "Invalid value ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Attribute Value</title>
</head>
<body>
    <h1>Edit Attribute Value</h1>
    <form action="edit_attribute_value.php?id=<?php echo $valueId; ?>" method="post">
        <label for="attribute_value">Attribute Value:</label>
        <input type="text" name="attribute_value" value="<?php echo htmlspecialchars($attributeValue['value']); ?>" required><br>

        <input type="submit" value="Update Value">
    </form>
    <a href="attribute_list.php">Back to Attribute List</a>
</body>
</html>
