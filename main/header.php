<?php
// Include database connection
include '../web/db_connection.php';

// Fetch categories from the database and organize them by parent-child relationship
$sql = "SELECT * FROM categories ORDER BY category_name";
$result = $conn->query($sql);
$categories = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parentId = $row['parent_id'];
        
        if (is_null($parentId)) {
            // Main category (no parent)
            $categories[$row['id']] = [
                'name' => $row['category_name'],
                'icon' => $row['icon_path'],
                'subcategories' => []
            ];
        } else {
            // Subcategory (has a parent)
            $categories[$parentId]['subcategories'][] = [
                'id' => $row['id'],
                'name' => $row['category_name']
            ];
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
        /* Style for nested dropdown menus */
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
        }
    </style>
</head>
<body>

<!-- First Header Section: Country Dropdown and Social Links -->
<header class="bg-dark py-1">
    <div class="container">
        <div class="row align-items-center">
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
            </div>
            <div class="col d-md-none text-center">
                <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
                <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</header>

<!-- Navigation Section -->
<section class="container bg-white border-bottom d-none d-md-block">
    <div class="row text-center align-items-center">
        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle fw-semibold nav-item-wrapper" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid me-1"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <!-- Dynamically generated categories and subcategories -->
                    <?php foreach ($categories as $categoryId => $category): ?>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="category_page.php?category=<?= $categoryId ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </a>
                            <?php if (!empty($category['subcategories'])): ?>
                                <ul class="dropdown-menu">
                                    <?php foreach ($category['subcategories'] as $subcategory): ?>
                                        <li>
                                            <a class="dropdown-item" href="category_page.php?category=<?= $subcategory['id'] ?>">
                                                <?= htmlspecialchars($subcategory['name']) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Additional navigation links -->
        <div class="col nav-column-spacing position-relative">
            <span class="badge bg-hot-green position-absolute">HOT</span>
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Shop</a>
        </div>
        <div class="col nav-column-spacing">
            <a href="#" class="nav-link-red text-dark fw-semibold nav-item-wrapper">Home</a>
        </div>
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
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JavaScript for Nested Dropdowns -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dropdown-submenu > .dropdown-toggle').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            let nextEl = element.nextElementSibling;
            if (nextEl && nextEl.classList.contains('dropdown-menu')) {
                nextEl.classList.toggle('show');

                // Close the dropdown menu if clicked outside
                document.addEventListener('click', function(e) {
                    if (!element.contains(e.target)) {
                        nextEl.classList.remove('show');
                    }
                });
            }
        });
    });
});
</script>

</body>
</html>