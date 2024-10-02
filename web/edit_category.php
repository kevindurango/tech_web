<?php
include 'Database.php';
include 'Category.php';

$db = new Database();
$category = new Category($db->getConnection());

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    if ($category->updateCategory($id, $category_name, $category_description)) {
        header('Location: categories.php');
        exit();
    } else {
        echo "Error updating category.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cat = $category->getCategoryById($id);
}
?>

<h2>Edit Category</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
    <label for="category_name">Category Name:</label>
    <input type="text" name="category_name" value="<?php echo htmlspecialchars($cat['category_name']); ?>" required><br>
    <label for="category_description">Description:</label>
    <textarea name="category_description" required><?php echo htmlspecialchars($cat['category_description']); ?></textarea><br>
    <input type="submit" name="submit" value="Update">
</form>
