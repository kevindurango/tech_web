<?php
// Remove the session_start() here as it is already being called in cart.php
include '../web/db_connection.php';
require_once '../classes/cart.php';

// Get the logged-in user ID
$userId = $_SESSION['user_id'] ?? null;
$cartCount = 0;

// If the user is logged in, fetch their cart items count from the database
if ($userId) {
    $stmt = $conn->prepare("
        SELECT COUNT(*) as item_count
        FROM cart_items
        WHERE cart_id = (SELECT id FROM cart WHERE user_id = ?)
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartCount = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['item_count'] : 0;
}

// Fetch categories from the database and organize them by parent-child relationship
$sql = "SELECT * FROM categories ORDER BY parent_id, category_name";
$result = $conn->query($sql);
$categories = [];

// Organize categories by parent-child relationships
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parentId = $row['parent_id'];
        if (is_null($parentId)) {
            // Main categories
            $categories[$row['id']] = [
                'name' => $row['category_name'],
                'icon' => $row['icon_path'],
                'subcategories' => []
            ];
        } else {
            // Ensure parent category exists before adding subcategories
            if (isset($categories[$parentId])) {
                $categories[$parentId]['subcategories'][] = [
                    'id' => $row['id'],
                    'name' => $row['category_name'],
                    'icon' => $row['icon_path'],
                    'subcategories' => []
                ];
            } else {
                // Check for deeper levels of hierarchy
                foreach ($categories as &$mainCategory) {
                    foreach ($mainCategory['subcategories'] as &$subCategory) {
                        if ($subCategory['id'] == $parentId) {
                            $subCategory['subcategories'][] = [
                                'id' => $row['id'],
                                'name' => $row['category_name'],
                                'icon' => $row['icon_path'],
                            ];
                        }
                    }
                }
            }
        }
    }
}

// Recursive function to render categories and subcategories
function renderCategoryItems($categories) {
    foreach ($categories as $categoryId => $categoryData) {
        if (isset($categoryData['name'])) {
            echo '<li class="dropdown-submenu">';
            echo '<a class="dropdown-item" href="category_page.php?category=' . $categoryId . '">' . htmlspecialchars($categoryData['name']) . '</a>';

            if (!empty($categoryData['subcategories'])) {
                echo '<ul class="dropdown-menu">';
                foreach ($categoryData['subcategories'] as $subCategory) {
                    echo '<li class="dropdown-submenu">';
                    echo '<a class="dropdown-item" href="category_page.php?category=' . $subCategory['id'] . '">' . htmlspecialchars($subCategory['name']) . '</a>';
                    
                    if (!empty($subCategory['subcategories'])) {
                        echo '<ul class="dropdown-menu">';
                        foreach ($subCategory['subcategories'] as $childCategory) {
                            echo '<li><a class="dropdown-item" href="category_page.php?category=' . $childCategory['id'] . '">' . htmlspecialchars($childCategory['name']) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">  
    <link rel="stylesheet" href="/tech_web/styles/product.css">
    <style>
        /* Style for modern and minimalized dropdown menus */
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu > .dropdown-menu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-top: 0;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }
        .dropdown-item {
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #000;
        }
        .dropdown-menu {
            border: none;
            padding: 0;
        }
    </style>
</head>
<body>

<!-- First Header Section: Country Dropdown, Social Links, Logout Button, and Information Links -->
<header class="bg-dark py-1">
    <div class="container">
        <div class="row align-items-center">
            <!-- Country Dropdown and Free Shipping Notice -->
            <div class="col d-none d-md-flex align-items-center">
                <div class="dropdown me-3 ps-4 pe-5">
                    <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                        <span class="text-white">US</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="countryDropdown"></ul>
                </div>
                <span class="text-white ps-5">Free returns. Standard shipping. Orders $99</span>
            </div>

            <!-- Social Links, Information Links, and Logout Button in Top Header -->
            <div class="col d-none d-md-flex justify-content-between align-items-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">Terms</a></li>
                        <li class="nav-item"><a class="nav-link text-white small" href="#">FAQ</a></li>
                    </ul>
                </nav>
                <div class="d-none d-md-block">
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="btn btn-outline-light btn-sm ms-3">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Section -->
<section class="container bg-white border-bottom d-none d-md-block">
    <div class="row text-center align-items-center">
    
        <!-- Categories Dropdown -->
        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle fw-semibold nav-item-wrapper" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid me-1"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <?php renderCategoryItems($categories); ?>
                </ul>
            </div>
        </div>
        
        <!-- Other Navigation Links with Badges -->
        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-hot-green position-absolute">HOT</span>
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Shop</a>
        </div>
        
        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Home</a>
        </div>
        
        <!-- Popular Dropdown with Badge -->
        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-new-yellow position-absolute">NEW</span>
            <div class="dropdown">
                <a class="nav-link-red dropdown-toggle text-dark fw-semibold nav-item-wrapper" href="#" id="popularDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Popular
                </a>
                <ul class="dropdown-menu" aria-labelledby="popularDropdown">
                    <li><a class="dropdown-item" href="#">Popular Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 3</a></li>
                </ul>
            </div>
        </div>

        <!-- Collection Dropdown with Badge -->
        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-best-blue position-absolute">BEST</span>
            <div class="dropdown">
                <a class="nav-link-red dropdown-toggle text-dark fw-semibold nav-item-wrapper" href="#" id="collectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Collection
                </a>
                <ul class="dropdown-menu" aria-labelledby="collectionDropdown">
                    <li><a class="dropdown-item" href="#">Collection Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Collection Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Collection Item 3</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">All Brands</a>
        </div>
        
        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Contact Us</a>
        </div>
        
        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-black position-absolute">5% OFF</span>
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Top Deals</a>
        </div>

        <!-- Cart Icon with Count -->
        <div class="col nav-column-spacing position-relative">
            <a href="cart.php" class="nav-link-red text-dark fw-semibold nav-item-wrapper position-relative">
                <i class="bi bi-cart me-1"></i> Cart
                <?php if ($cartCount > 0): ?>
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                        <?= $cartCount ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
