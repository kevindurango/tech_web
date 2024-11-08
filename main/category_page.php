<?php
// Include necessary files and initialize database connection
include '../web/db_connection.php';
include '../web/categorypage.php';

// Get category ID from the URL, defaulting to 0 if not set
$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Instantiate the CategoryPage class
$categoryPage = new CategoryPage($category_id, $conn);

// Fetch data using the CategoryPage methods
$categories = $categoryPage->getCategories();
$products = $categoryPage->getProducts();
$total_products = $categoryPage->getTotalProductCount();

// Build category tree
$categoryTree = $categoryPage->buildCategoryTree($categories);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
    <link rel="stylesheet" href="/tech_web/styles/product.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

<?php
$pageTitle = 'category_page'; 
include 'header.php'; 
?>

<section class="mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="categories-section mt-2 ps-1">
                    <h3 class="fw-bold mb-3 ps-3 text-start fs-4">Categories</h3>
                    <div class="categories-nav-wrapper">
                        <div class="categories-nav">
                        <?php

                            $categories = $categoryPage->getCategories();

                            $hasCategories = false; 

                            foreach ($categories as $cat):
                                // Set default values if data is missing
                                $categoryId = $cat['id'] ?? 0;
                                $categoryName = !empty($cat['category_name']) ? htmlspecialchars($cat['category_name']) : null; // Set to null if empty
                                $iconPath = !empty($cat['icon_path']) ? htmlspecialchars($cat['icon_path']) : '/tech_web/assets/placeholder_icon.png';

                                // Only display category if it has a valid name
                                if ($categoryName) :
                                    $hasCategories = true; // Set the flag if a valid category name is found
                            ?>
                                    <a href="category_page.php?category=<?= $categoryId ?>" class="category-item">
                                        <img src="<?= $iconPath ?>" alt="<?= $categoryName ?>" class="category-icon">
                                        <?= $categoryName ?>
                                    </a>
                                <?php endif; // End if for valid category name
                            endforeach; ?>

                            <?php if (!$hasCategories): ?>
                                <p>No categories available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mt-2 mb-2">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <h5 class="fw-normal">All products - <?= count($products) ?> items</h5>
            </div>

            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <div class="me-3 d-flex align-items-center">
                    <label for="price-list" class="me-1 mb-0">Pricelist:</label>
                    <select id="price-list" class="form-select form-select-sm ms-1">
                        <option>EUR</option>
                        <option>USD</option>
                        <option>GBP</option>
                    </select>
                </div>

                <div class="d-flex align-items-center me-3">
                    <label for="sort-by" class="me-2 mb-0">Sort by:</label>
                    <select id="sort-by" class="form-select form-select-sm w-auto">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest Arrivals</option>
                    </select>
                </div>

                <div class="view-options d-flex align-items-center">
                    <a href="#" class="me-2 text-danger">
                        <i class="bi bi-list" style="font-size: 1rem;"></i>
                    </a>
                    <a href="#" class="text-danger">
                        <i class="bi bi-grid" style="font-size: 1rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            <form method="GET" action="category_page.php" id="category-form">
    <div class="list-group border p-2" style="border-radius: 0;">
        <h5 class="fw-bold mb-4">Categories</h5>

        <!-- All Products Option -->
        <label class="list-group-item d-flex align-items-center category-label" style="cursor: pointer;">
            <input type="radio" name="category" class="form-check-input me-2 red-radio" value="0" <?= $category_id == 0 ? 'checked' : '' ?> onchange="document.getElementById('category-form').submit();">
            <span>All products</span>
            <span class="text-muted small ms-auto">(<?= $total_products ?>)</span>
        </label>

        <?php 
        // Fetch all categories that are considered parents (e.g., Smartphones, Laptops, etc.)
        $parentCategories = array_filter($categories, function($cat) {
            return !is_null($cat['parent_id']); // Get categories that have a parent
        });

        // To get unique parent categories (which are now the immediate parents)
        $uniqueParentIds = array_unique(array_column($parentCategories, 'parent_id'));
        $newParentCategories = array_filter($categories, function($cat) use ($uniqueParentIds) {
            return in_array($cat['id'], $uniqueParentIds);
        });

        foreach ($newParentCategories as $cat): 
            $categoryId = $cat['id'] ?? 0;
            $categoryName = htmlspecialchars($cat['category_name'] ?? 'Unnamed Category');
            // Get product count for the main category
            $productCount = $categoryPage->getProductCountByCategory($categoryId); 
        ?>

            <!-- Main Category Label -->
            <label class="list-group-item d-flex align-items-center category-label" style="cursor: pointer;">
                <input type="radio" name="category" class="form-check-input me-2 red-radio" value="<?= $categoryId ?>" <?= $category_id == $categoryId ? 'checked' : '' ?> onchange="document.getElementById('category-form').submit();">
                <span><?= $categoryName ?></span>
                <span class="text-muted small ms-auto">(<?= $productCount ?>)</span> <!-- Display product count -->
            </label>

            <!-- Fetch and display child categories -->
            <?php 
            // Fetch child categories for the current category
            $childCategories = array_filter($categories, function($cat) use ($categoryId) {
                return $cat['parent_id'] == $categoryId; // Get child categories
            });

            if (!empty($childCategories)): 
                foreach ($childCategories as $childCat): 
                    $childCategoryId = $childCat['id'] ?? 0;
                    $childCategoryName = htmlspecialchars($childCat['category_name'] ?? 'Unnamed Category');
                    // Get product count for the child category
                    $childProductCount = $categoryPage->getProductCountByCategory($childCategoryId); 
            ?>
                <label class="list-group-item d-flex align-items-center ms-4 category-label" style="cursor: pointer;">
                    <input type="radio" name="category" class="form-check-input me-2 red-radio" value="<?= $childCategoryId ?>" <?= $category_id == $childCategoryId ? 'checked' : '' ?> onchange="document.getElementById('category-form').submit();">
                    <span><?= $childCategoryName ?></span>
                    <span class="text-muted small ms-auto">(<?= $childProductCount ?>)</span> <!-- Display child product count -->
                </label>
            <?php 
                endforeach; 
            endif; 
        endforeach; 
        ?>
    </div>
</form>
                <div class="mt-4">
                    <img src="/tech_web/assets/headphone_sale.png" alt="Advertisement" class="img-fluid w-100" />
                </div>
            </div>

            <!-- Right Column: Products -->
            <div class="col-md-8">
                <div class="row">
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="<?= htmlspecialchars($product['main_image'] ?? '/tech_web/assets/placeholder.png') ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?>">
                                    <div class="star-reviews">
                                        <i class="bi bi-star-fill text-warning"></i> 
                                        <span>4.5</span>
                                    </div>
                                    <form action="cart.php" method="POST" class="d-inline">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button class="product-card-add-to-cart" data-product-id="<?= $product['id'] ?>">
                                            <i class="bi bi-cart"></i> Add to Cart
                                        </button>
                                    </form>
                                    <div class="product-card-icons">
                                        <i class="bi bi-eye"></i>
                                        <i class="bi bi-heart"></i>
                                        <i class="bi bi-arrow-repeat"></i>
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?></h5>
                                    <p class="card-text">
                                        <span class="text-danger"><?= number_format($product['price'] ?? 0, 2) ?> €</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php else : ?>
                        <p>No products found in this category.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
function resetFilter() {
    const form = document.getElementById('category-form');
    const allProductsRadio = form.querySelector('input[name="category"][value="0"]');
    allProductsRadio.checked = true;
    form.submit();
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.product-card-add-to-cart').click(function(event) {
        event.preventDefault(); // Prevent default button action

        const productId = $(this).data('product-id'); // Get the product ID from data attribute
        const quantity = 1; // Set quantity to 1 for this example

        // AJAX request to add product to cart
        $.ajax({
            url: 'add_to_cart.php', // URL to the PHP script
            type: 'POST',
            data: { product_id: productId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message); // Display success message
                } else {
                    alert('Error: ' + response.message); // Display error message
                }
            },
            error: function() {
                alert('An error occurred while adding the product to the cart.');
            }
        });
    });
});
</script>


</body>
</html>
