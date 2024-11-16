<?php

class CategoryPage {
    private $conn;
    private $category_id;

    public function __construct($category_id, $conn) {
        $this->conn = $conn;
        $this->category_id = $category_id;
    }

    public function getCategories() {
        $sql = "SELECT c.id, 
                       COALESCE(NULLIF(c.category_name, ''), 'Unnamed Category') AS category_name, 
                       COALESCE(NULLIF(c.icon_path, ''), '/tech_web/assets/placeholder_icon.png') AS icon_path, 
                       c.parent_id,
                       (SELECT COUNT(*) FROM product_categories pc WHERE pc.category_id = c.id) AS product_count
                FROM categories c";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Error fetching categories: " . $this->conn->error);
        }

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            // Explicitly check for null or empty values and set default values
            $row['category_name'] = !empty($row['category_name']) ? $row['category_name'] : 'Unnamed Category';
            $row['icon_path'] = !empty($row['icon_path']) ? $row['icon_path'] : '/tech_web/assets/placeholder_icon.png';
            $categories[] = $row;
        }
        return $categories;
    }

    public function getProducts() {
        $sql = "SELECT p.*, b.brand_name, 
                       COALESCE(i.image_path, '/tech_web/assets/placeholder.png') AS main_image
                FROM products p
                LEFT JOIN product_categories pc ON p.id = pc.product_id
                LEFT JOIN brands b ON p.brand_id = b.id
                LEFT JOIN images i ON p.id = i.product_id AND i.image_path = p.main_image_url";

        if ($this->category_id > 0) {
            $sql .= " WHERE pc.category_id = {$this->category_id}";
        }

        $sql .= " GROUP BY p.id";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getTotalProductCount() {
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc()['total'] : 0;
    }

    public function buildCategoryTree($categories, $parentId = null) {
        $branch = [];
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = $this->buildCategoryTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }
        return $branch;
    }

    public function displayCategoryTree($categories, $selected_category_id) {
        foreach ($categories as $cat) {
            $isChecked = $cat['id'] == $this->category_id ? 'checked' : '';
            $collapseId = 'collapseCategory' . $cat['id'];

            echo '<label class="list-group-item d-flex align-items-center category-label" style="cursor: pointer;">';

            if (isset($cat['children'])) {
                echo '<a data-bs-toggle="collapse" href="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
                echo '<i class="bi bi-chevron-right me-2"></i>';
                echo '</a>';
            } else {
                echo '<span class="me-4"></span>';
            }

            // Display category name with fallback in case of missing data
            echo '<input type="radio" name="category" class="form-check-input me-2" value="' . $cat['id'] . '" ' . $isChecked . ' onclick="document.getElementById(\'category-form\').submit();">';
            echo htmlspecialchars($cat['category_name']);
            echo '<span class="text-muted small ms-auto">(' . ($cat['product_count'] ?? 0) . ')</span>';
            echo '</label>';

            if (isset($cat['children'])) {
                echo '<div class="collapse ps-4" id="' . $collapseId . '">';
                $this->displayCategoryTree($cat['children'], $selected_category_id);
                echo '</div>';
            }
        }
    }


    public function getChildCategories($parentId) {
        // Prepare the SQL query to fetch child categories
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE parent_id = ?"); // Assuming parent_id is the column used
        $stmt->bind_param("i", $parentId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch all child categories
        $childCategories = $result->fetch_all(MYSQLI_ASSOC);

        // Free result and return child categories
        $stmt->close();
        return $childCategories;
    }

    public function getProductCountByCategory($categoryId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM products INNER JOIN product_categories ON products.id = product_categories.product_id WHERE product_categories.category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count;
    }
}
