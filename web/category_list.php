<?php

include 'db_connect.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($category = $result->fetch_assoc()) {
        echo '
            <tr>
                <td>' . $category['id'] . '</td>
                <td>' . htmlspecialchars($category['category_name']) . '</td>
                <td>' . htmlspecialchars($category['category_description']) . '</td>
            </tr>
        ';
    }

    echo '
        </tbody>
    </table>';
} else {
    echo 'No categories found.';
}

$conn->close();
?>
