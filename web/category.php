<?php
class Category
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    // Method to fetch main categories
    public function fetchMainCategories()
    {
        $query = "SELECT * FROM categories WHERE parent_id IS NULL";
        return $this->conn->query($query);
    }

    // Method to fetch product types based on main category
    public function fetchProductTypes($parentId)
    {
        $query = "SELECT * FROM categories WHERE parent_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $parentId);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Method to fetch subcategories based on category ID
    public function fetchSubcategories($parentId)
    {
        $query = "SELECT * FROM categories WHERE parent_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $parentId);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Method to close the database connection
    public function closeConnection()
    {
        $this->conn->close();
    }

    public function fetchProductsInCategory($categoryId) {
        $query = "SELECT p.id, p.name AS product_name, p.price, p.product_description AS description 
                  FROM products p
                  JOIN product_categories pc ON p.id = pc.product_id
                  WHERE pc.category_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Fetch all products as an associative array
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        $stmt->close();
        return $products;
    }

    public function deleteCategory($id) {
        if (!is_int($id) || $id <= 0) {
            return "Invalid category ID.";
        }

        $stmt = $this->conn->prepare("DELETE FROM Categories WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Category deleted successfully 🎉";
        } else {
            return "Error: " . $stmt->error;
        }
    }

      // Method to fetch a category by ID
    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT id, category_name, description, parent_id FROM Categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close();

        return $category;
    }

    // Method to update a category
    public function updateCategory($id, $category_name, $description, $parent_id) {
        if (!is_int($id) || $id <= 0) {
            return "Invalid category ID.";
        }

        $stmt = $this->conn->prepare("UPDATE Categories SET category_name = ?, description = ?, parent_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $category_name, $description, $parent_id, $id);

        if ($stmt->execute()) {
            $stmt->close();
            return "Category updated successfully 🎉";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    // Method to add a new category
    public function addCategory($category_name, $description, $parent_id = 0) {
        $stmt = $this->conn->prepare("INSERT INTO Categories (category_name, description, parent_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $category_name, $description, $parent_id);

        if ($stmt->execute()) {
            $stmt->close();
            return "Category added successfully! 🎉";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function fetchAllCategories() {
        $categories = [];
        $stmt = $this->conn->prepare("SELECT id, category_name, parent_id FROM Categories");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        $stmt->close();
        return $categories;
    }

    // Method to display categories in a hierarchical format
    public function displayCategories($categories, $parent_id = 0, $level = 0) {
        $output = '';
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parent_id) {
                // Indentation for subcategories
                $output .= "<option value=\"{$category['id']}\">" . str_repeat('&nbsp;', $level * 4) . htmlspecialchars($category['category_name']) . "</option>";
                // Recursive call to display subcategories
                $output .= $this->displayCategories($categories, $category['id'], $level + 1);
            }
        }
        return $output;
    }
    
}
?>
