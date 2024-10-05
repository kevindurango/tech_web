<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">  
    <link rel="stylesheet" href="/tech_web/styles/product.css">
</head>
<body>

<?php
$pageTitle = 'product_page'; 
include 'header.php'; 

$conn = new mysqli('localhost', 'root', '', 'tech_ecommerce');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = 1; 
$productQuery = $conn->prepare("SELECT * FROM products WHERE id = ?");
$productQuery->bind_param("i", $product_id);
$productQuery->execute();
$productResult = $productQuery->get_result();
$product = $productResult->fetch_assoc();

// Fetch product images
$imageQuery = $conn->prepare("SELECT * FROM images WHERE product_id = ?");
$imageQuery->bind_param("i", $product_id);
$imageQuery->execute();
$imageResult = $imageQuery->get_result();
$images = [];
while ($row = $imageResult->fetch_assoc()) {
    $images[] = $row['image_path'];
}

$similarProductsQuery = $conn->query("SELECT * FROM products ORDER BY RAND() LIMIT 3");
$similarProducts = [];
while ($row = $similarProductsQuery->fetch_assoc()) {
    $similarProducts[] = $row;
}
?>

<!-- Product Image Carousel Section -->
<section class="product-section mt-4">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="<?= $image ?>" class="d-block w-100" alt="Product Image <?= $index + 1 ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev carousel-control-prev-circle" href="#productCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-control-next-circle" href="#productCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <?php foreach ($images as $index => $image): ?>
                    <img src="<?= $image ?>" class="img-thumbnail mx-1" alt="Thumbnail <?= $index + 1 ?>" data-bs-target="#productCarousel" data-bs-slide-to="<?= $index ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Product details -->
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="mx-2">/</span>
                    <span class="text-danger fw-semibold">Shop</span>
                    <span class="mx-2">/</span>
                    <span class="fw-semibold"><?= htmlspecialchars($product['name']) ?></span>
                    <div class="d-flex align-items-center ms-auto">
                        <span style="color: red; font-size: 1rem;">&lt;</span>
                        <i class="bi bi-grid text-danger mx-2" style="font-size: 1rem;"></i>
                        <span style="color: red; font-size: 1rem;">&gt;</span>
                    </div>
                </div>

                <h3 class="mb-2"><?= htmlspecialchars($product['name']) ?></h3>

                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <i class="bi bi-star-half text-warning me-2"></i>
                    <span>4.5 (200 reviews)</span>
                </div>

                <p class="mb-3"><?= htmlspecialchars($product['short_description']) ?></p>

                <div class="mb-3">
                    <span class="text-danger fw-bold fs-5 me-2">Original Price: $<?= htmlspecialchars($product['price']) ?></span>
                    <span class="text-muted text-decoration-line-through fs-5 me-2">$899</span>
                    <span class="text-success fw-semibold" style="color: orange;">(8% off)</span>
                </div>

                <hr class="my-4">
                <div class="mb-3">
                    <h5>Storage</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-storage">8 GB + 128 GB</button>
                        <button class="btn btn-storage">16 GB + 256 GB</button>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>Color</h5>
                    <div class="d-flex gap-2">
                        <div class="color-option bg-danger"></div>
                        <div class="color-option bg-purple"></div>
                        <div class="color-option bg-dark"></div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3 text-start w-100">
                    <i class="bi bi-envelope-fill text-danger me-2"></i>
                    <span class="text-danger">Get notified when back in stock</span>
                </div>

                <button class="save-for-later-button">
                    <i class="bi bi-clock me-1"></i> Save for later
                </button>

                <hr class="my-4">

                <div class="product-info mt-2">
                    <div class="container">
                        <div class="row align-items-start">
                            <div class="col-4 col-md-2 text-center pe-3">
                                <img src="/tech_web/assets/apple-logo.png" alt="Apple Logo" class="apple-logo">
                            </div>
                            <div class="col-8 col-md-10 ps-4">
                                <p class="mb-1 mt-2"><strong>Apple</strong></p>
                                <p class="fw-normal">This is a genuine product of Brand. The product comes with a standard brand warranty of 1 year.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-gift" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Special Offer:</span> Get mi smart speaker on purchase of selected devices. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-bank" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Bank Offer:</span> Extra 5% off on credit cards. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-person-badge" style="color: #e00; margin-right: 0.5rem;"></i>
                        <span>
                            <span style="color: #ff4d4d;">Membership:</span> Get prime membership for extra discount. 
                            <a href="#" style="color: #e00; text-decoration: none;">Details ></a>
                        </span>
                    </div>
                </div>

                <hr class="my-4">
                <div class="mb-4">
                    <p class="mb-1"><strong>SKU:</strong> <?= htmlspecialchars($product['SKU']) ?></p>
                    <p class="mb-1"><strong>Tags:</strong> Gadget, Exclusive, Storage, Best, Device, Electric.</
                    <p class="mb-1"><strong>Tags:</strong> Gadget, Exclusive, Storage, Best, Device, Electric.</p>
                    <p class="mb-1"><strong>Product Description:</strong></p>
                    <p><?= htmlspecialchars($product['product_description']) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Products Section -->
<section class="similar-products mt-5">
    <div class="container">
        <h3>Similar Products</h3>
        <div class="row">
            <?php foreach ($similarProducts as $similarProduct): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= $similarProduct['main_image_url'] ?>" class="card-img-top" alt="<?= htmlspecialchars($similarProduct['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($similarProduct['name']) ?></h5>
                        <p class="card-text">Price: $<?= htmlspecialchars($similarProduct['price']) ?></p>
                        <a href="product.php?id=<?= $similarProduct['id'] ?>" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
$imageQuery->close();
$productQuery->close();
$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
