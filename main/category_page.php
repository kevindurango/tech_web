<?php
include '../web/db_connection.php';

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

// Fetch categories with product count in a single query
$sql = "SELECT c.*, 
               (SELECT COUNT(*) FROM product_categories pc WHERE pc.category_id = c.id) AS product_count
        FROM categories c";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);

// Fetch products based on the selected category
$sql = "SELECT p.*, pc.category_id, c.category_name, b.brand_name, i.image_path AS main_image
        FROM products p 
        LEFT JOIN product_categories pc ON p.id = pc.product_id
        LEFT JOIN categories c ON pc.category_id = c.id
        LEFT JOIN brands b ON p.brand_id = b.id
        LEFT JOIN images i ON p.id = i.product_id AND i.image_path = p.main_image_url";

if ($category_id > 0) {
    $sql .= " WHERE pc.category_id = $category_id";
}

$sql .= " GROUP BY p.id";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);

$sql_count = "SELECT COUNT(*) as total FROM products";
$result_count = $conn->query($sql_count);
$total_products = $result_count->fetch_assoc()['total'];

$conn->close();
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
                            <?php foreach ($categories as $cat): ?>
                                <a href="category_page.php?category=<?= $cat['id'] ?>" class="category-item">
                                    <img src="<?= $cat['icon_path'] ?>" alt="" style="width: 15px;"> <?= htmlspecialchars($cat['category_name']) ?>
                                </a>
                            <?php endforeach; ?>
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
                        
                        <label class="list-group-item d-flex align-items-center category-label" style="cursor: pointer;">
                            <input type="radio" name="category" class="form-check-input me-2" value="0" <?= $category_id == 0 ? 'checked' : '' ?> onclick="document.getElementById('category-form').submit();">
                            <span>All products</span>
                            <span class="text-muted small ms-auto">(<?= $total_products ?>)</span>
                        </label>

                        <?php foreach ($categories as $cat): ?>
                            <label class="list-group-item d-flex align-items-center category-label" style="cursor: pointer;">
                                <input type="radio" name="category" class="form-check-input me-2" value="<?= $cat['id'] ?>" <?= $category_id == $cat['id'] ? 'checked' : '' ?> onclick="document.getElementById('category-form').submit();">
                                <span><?= htmlspecialchars($cat['category_name']) ?></span> 
                                <span class="text-muted small ms-auto">(<?= $cat['product_count'] ?>)</span>
                            </label>
                        <?php endforeach; ?>

                        <button type="submit" name="reset" value="1" class="btn btn-dark w-100 mt-3 border-0" onclick="window.location.href='category_page.php'">Reset Filter</button>
                    </div>
                </form>

                <div class="mt-4">
                    <img src="/tech_web/assets/headphone_sale.png" alt="Advertisement" class="img-fluid w-100" />
                </div>
            </div>

            <!-- Right Column: Products -->
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <div class="card">
                                <div class="card-img-container">
                                    <img src="<?= $product['main_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                                    <div class="star-reviews">
                                        <i class="bi bi-star-fill text-warning"></i> 
                                        <span>4.5</span>
                                    </div>
                                    <button class="product-card-add-to-cart">
                                        <i class="bi bi-cart"></i> Add to Cart
                                    </button>
                                    <div class="product-card-icons">
                                        <i class="bi bi-eye"></i>
                                        <i class="bi bi-heart"></i>
                                        <i class="bi bi-arrow-repeat"></i>
                                        <i class="bi bi-clipboard"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text">
                                        <span class="text-danger"><?= number_format($product['price'], 2) ?> €</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
