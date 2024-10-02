<?php
include 'Database.php';
include 'Category.php';

$db = new Database();
$category = new Category($db->getConnection());

$categories = $category->getCategories();
?>

<h2>Categories</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $categories->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                <td><?php echo htmlspecialchars($row['category_description']); ?></td>
                <td>
                    <a href="view_category.php?id=<?php echo $row['id']; ?>">View</a>
                    <a href="edit_category.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_category.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
