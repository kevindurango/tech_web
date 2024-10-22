<?php
include 'db_connection.php';

if (isset($_POST['category_id'])) {
    $category_id = (int)$_POST['category_id'];
    $subcategory_result = $conn->prepare("SELECT id, subcategory_name FROM subcategories WHERE category_id = ?");
    $subcategory_result->bind_param("i", $category_id);
    $subcategory_result->execute();
    $result = $subcategory_result->get_result();

    $subcategories = [];
    while ($row = $result->fetch_assoc()) {
        $subcategories[] = [
            'id' => $row['id'],
            'name' => htmlspecialchars($row['subcategory_name'])
        ];
    }

    echo json_encode($subcategories); 
    $subcategory_result->close();
}

$conn->close();
?>