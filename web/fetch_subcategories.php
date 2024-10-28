<?php
include 'db_connection.php';

// Get the parent_id from the query parameters
$parent_id = isset($_GET['parent_id']) ? intval($_GET['parent_id']) : 0;

// Fetch subcategories (Product Types) based on the parent category
if ($parent_id) {
    $subcategories_result = $conn->query("SELECT * FROM Categories WHERE parent_id = $parent_id");

    if ($subcategories_result->num_rows > 0) {
        echo '<table class="category-level">';
        while ($subcategory = $subcategories_result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $subcategory['id'] . '</td>';
            echo '<td><span class="expand-btn" data-id="' . $subcategory['id'] . '">&#9654;</span> ' . htmlspecialchars($subcategory['category_name']) . '</td>';
            echo '<td>' . htmlspecialchars($subcategory['description']) . '</td>';
            echo '<td>
                    <a href="edit_category.php?id=' . $subcategory['id'] . '">Edit</a> |
                    <a href="delete_category.php?id=' . $subcategory['id'] . '" onclick="return confirm(\'Are you sure you want to delete this category?\');">Delete</a> |
                    <a href="category_values.php?category_id=' . $subcategory['id'] . '">View Products</a>
                  </td>';
            echo '</tr>';

            // Placeholder for deeper subcategories (Product Variations)
            echo '<tr class="subcategories" id="subcategories-' . $subcategory['id'] . '">';
            echo '<td colspan="4"></td>'; // This is where deeper subcategories will be loaded
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No subcategories (Product Types) found.</p>'; 
    }
}

$conn->close();
?>
