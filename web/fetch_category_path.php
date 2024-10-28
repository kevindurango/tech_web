<?php
include 'db_connection.php';

if (isset($_GET['product_variation_id'])) {
    $category_id = (int)$_GET['product_variation_id'];
    $category_path = [];

    // Retrieve all parent categories up the hierarchy
    while ($category_id) {
        $stmt = $conn->prepare("SELECT id, category_name, parent_id FROM categories WHERE id = ?");
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();

        if ($category) {
            $category_path[] = [
                'id' => $category['id'],
                'name' => $category['category_name'],
                'parent_id' => $category['parent_id']
            ];
            $category_id = $category['parent_id'];
        } else {
            break;
        }
    }

    // Return path in top-to-bottom order
    echo json_encode(array_reverse($category_path));
}
?>
