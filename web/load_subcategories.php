<?php
include 'db_connection.php';

if (isset($_POST['categoryIds'])) {
    $categoryIds = $_POST['categoryIds'];
    $subcategories = array();

    // Log received category IDs for debugging
    error_log(print_r($categoryIds, true));

    if (!empty($categoryIds)) {
        // Prepare a placeholder string for the IN clause
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id, subcategory_name FROM subcategories WHERE category_id IN ($placeholders)");
        
        // Dynamically bind parameters
        $stmt->bind_param(str_repeat('i', count($categoryIds)), ...$categoryIds);
        
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $subcategories[] = array('id' => $row['id'], 'name' => htmlspecialchars($row['subcategory_name']));
        }
        $stmt->close();
    }

    // Log the subcategories found
    error_log(print_r($subcategories, true));

    if (empty($subcategories)) {
        echo json_encode(array('error' => 'No subcategories found for the selected categories.'));
    } else {
        echo json_encode($subcategories);
    }
} else {
    echo json_encode(array('error' => 'No category IDs received.'));
}

$conn->close();
?>