<?php
include 'db_connection.php'; 

// Retrieve filter parameters
$parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : null;
$product_type_id = isset($_GET['product_type_id']) ? $_GET['product_type_id'] : null;

// Prepare the SQL query
$query = "SELECT * FROM Categories WHERE 1=1"; // Start with a base query

// Filter by Product Line (parent category)
if ($parent_id === '') {
    // If parent_id is an empty string, fetch only main categories (parent_id IS NULL)
    $query .= " AND parent_id IS NULL";
} elseif ($parent_id !== null) {
    // Otherwise, fetch categories with the specified parent_id
    $query .= " AND parent_id = " . intval($parent_id);
}

// Filter by Product Type if specified
if ($product_type_id !== null && $product_type_id !== '') {
    $query .= " AND id = " . intval($product_type_id); // Assuming product_type_id is used to filter categories
}

// Execute the query
$result = $conn->query($query);

// Check if categories are found
if ($result->num_rows > 0) {
    echo '<tr>
            <th>ID</th>
            <th>Name (Product Type)</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>';

    while ($category = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $category['id'] . '</td>';
        echo '<td><span class="expand-btn" data-id="' . $category['id'] . '">&#9654;</span> ' . htmlspecialchars($category['category_name']) . '</td>';
        echo '<td>' . htmlspecialchars($category['description']) . '</td>';
        echo '<td>
                <a href="edit_category.php?id=' . $category['id'] . '">Edit</a> |
                <a href="delete_category.php?id=' . $category['id'] . '" onclick="return confirm(\'Are you sure you want to delete this category?\');">Delete</a> |
                <a href="category_values.php?category_id=' . $category['id'] . '">View Products</a>
              </td>';
        echo '</tr>';

        // Placeholder for subcategories
        echo '<tr class="subcategories" id="subcategories-' . $category['id'] . '">';
        echo '<td colspan="4"></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No categories found.</td></tr>';
}

// Close the connection
$conn->close();
?>
