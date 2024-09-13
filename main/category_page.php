<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
    <link rel="stylesheet" href="/tech_web/styles/product.css">
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
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/computer_icon.png" alt="Computers" class="category-icon">
                                Computers and Accessories
                            </a>
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/smartphone_icon.png" alt="Smartphones" class="category-icon">
                                Smartphones and Tablets
                            </a>
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/tv_icon.png" alt="TV" class="category-icon">
                                TV, Video and Audio
                            </a>
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/camera_icon.png" alt="Camera" class="category-icon">
                                Camera
                            </a>
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/headphone_icon.png" alt="Headphones" class="category-icon">
                                Headphones
                            </a>
                            <a href="#" class="category-item">
                                <img src="/tech_web/assets/wearable_electronics_icon.png" alt="Wearable" class="category-icon">
                                Wearable Electronics
                            </a>
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
                <h5 class="fw-normal">All products - 39 items</h5>
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
                <div class="list-group border rounded p-2">
                    <h5 class="fw-bold mb-4">Categories</h5>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="all-products" checked>
                        <span>All products</span>
                        <span class="text-muted small ms-auto">(39)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="computers-accessories">
                        <span>Computers and Accessories</span>
                        <span class="text-muted small ms-auto">(15)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="smartphones-tablets">
                        <span>Smartphones and Tablets</span>
                        <span class="text-muted small ms-auto">(12)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="tv-video-audio">
                        <span>TV, Video and Audio</span>
                        <span class="text-muted small ms-auto">(8)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="camera">
                        <span>Camera</span>
                        <span class="text-muted small ms-auto">(5)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="headphones">
                        <span>Headphones</span>
                        <span class="text-muted small ms-auto">(7)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="wearable-accessories">
                        <span>Wearable Accessories</span>
                        <span class="text-muted small ms-auto">(6)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <label class="list-group-item d-flex align-items-center">
                        <input type="radio" name="category" class="form-check-input me-2" value="others">
                        <span>Others</span>
                        <span class="text-muted small ms-auto">(3)</span>
                        <i class="bi bi-caret-down-fill text-muted ms-2"></i>
                    </label>
                    <button class="btn btn-dark w-100 mt-3">Reset Filter</button>
                    <div class="mt-3">
                        <img src="/tech_web/assets/headphone_sale.png" alt="Advertisement" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- Second Column: Products -->
<div class="col-md-8">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class="card">
            <div class="card-img-container">
              <img src="/tech_web/assets/products/apple-imac-pro.png" class="card-img-top" alt="Product 1">
              <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>4.2</span> 
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
              <h5 class="card-title">Apple iMac</h5>
              <p class="card-text">
                <span class="text-danger">$334</span>
                <span class="text-muted text-decoration-line-through">$364</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class="card">
            <div class="card-img-container">
              <img src="/tech_web/assets/products/apple-iphone-13.png" class="card-img-top" alt="Apple iPhone 13">
              <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>4.5</span>
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
              <h5 class="card-title">Apple iPhone 13</h5>
              <p class="card-text">
                <span class="text-danger">368.00 €</span>
                <span class="text-muted text-decoration-line-through">400.00 €</span>
                <span class="text-success text-orange">(8% OFF)</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
          <div class="card">
            <div class="card-img-container">
              <img src="/tech_web/assets/products/wireless-controller.png" class="card-img-top" alt="Wireless Controller">
              <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>4.7</span>
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
              <h5 class="card-title">Wireless Controller</h5>
              <p class="card-text">
                <span class="text-danger">189.05 €</span>
                <span class="text-muted text-decoration-line-through">199.00 €</span>
                <span class="text-success text-orange">(5% OFF)</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
            <img src="/tech_web/assets/products/apple-iphone-case.png" class="card-img-top" alt="Apple iPhone Case">
            <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>3.0</span>
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
            <h5 class="card-title">Apple iPhone Case</h5>
            <p class="card-text">
                <span class="text-danger">73.60 €</span>
                <span class="text-muted text-decoration-line-through">80.00 €</span>
                <span class="text-success text-orange">(8% OFF)</span>
            </p>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
            <img src="/tech_web/assets/products/hp-pavilion-laptop.png" class="card-img-top" alt="HP Pavilion Laptop">
            <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>3.0</span>
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
            <h5 class="card-title">HP Pavilion Laptop</h5>
            <p class="card-text">
                <span class="text-danger">700.00 €</span>
            </p>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
            <img src="/tech_web/assets/products/homepod-mini.png" class="card-img-top" alt="HomePod Mini">
            <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>3.0</span>
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
            <h5 class="card-title">HomePod Mini</h5>
            <p class="card-text">
                <span class="text-danger">95.00 €</span>
            </p>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="card">
                <div class="card-img-container">
                    <img src="/tech_web/assets/products/apple-core-i5-desktop.png" class="card-img-top" alt="Apple Core i5 Desktop">
                    <div class="star-reviews">
                        <i class="bi bi-star-fill text-warning"></i> <span>2.5</span>
                    </div>
                    <button class="product-card-add-to-cart product-card-out-of-stock " disabled>
                        <i class="bi bi-cart"></i> Out of Stock
                    </button>
                    <div class="product-card-icons">
                        <i class="bi bi-eye"></i>
                        <i class="bi bi-heart"></i>
                        <i class="bi bi-arrow-repeat"></i>
                        <i class="bi bi-clipboard"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Apple Core i5 Desktop</h5>
                    <p class="card-text">
                        <span class="text-danger">600.00 €</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
            <img src="/tech_web/assets/products/microsoft-surface-pro-core-i5.png" class="card-img-top" alt="Microsoft Surface Pro Core i5">
            <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
            </div>
            <div class="badge badge-danger">New Arrival</div>
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
            <h5 class="card-title">Microsoft Surface Pro Core i5</h5>
            <p class="card-text">
                <span class="text-danger">432.00 €</span>
            </p>
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
            <img src="/tech_web/assets/products/apple-macbook-pro-core-i5.png" class="card-img-top" alt="Apple MacBook Pro Core i5">
            <div class="star-reviews">
                <i class="bi bi-star-fill text-warning"></i> <span>2.5</span>
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
            <h5 class="card-title">Apple MacBook Pro Core i5</h5>
            <p class="card-text">
                <span class="text-danger">467.00 €</span>
            </p>
            </div>
        </div>
        </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/asus-core-i5-10th-gen-laptop.png" class="card-img-top" alt="ASUS Core i5 10th Gen Laptop">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.5</span>
                </div>
                <div class="badge badge-primary">Trending</div>
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
                <h5 class="card-title">Asus Core i5 10th Gen</h5>
                <p class="card-text">
                    <span class="text-danger">367.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/sony-core-i5-8th-gen-desktop.png" class="card-img-top" alt="Sony Core i5 8th Gen Desktop">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
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
                <h5 class="card-title">Sony Core i5 8th Gen Desktop</h5>
                <p class="card-text">
                    <span class="text-danger">359.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/samsung-galaxy-s10.png" class="card-img-top" alt="Samsung Galaxy S10">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
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
                <h5 class="card-title">Samsung Galaxy S10</h5>
                <p class="card-text">
                    <span class="text-danger">322.00 €</span>
                    <span class="text-muted text-decoration-line-through">350.00 €</span>
                    <span class="text-success text-orange">(8% OFF)</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/apple-iphone-11.png" class="card-img-top" alt="Apple iPhone 11">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>2.5</span>
                </div>
                <div class="badge badge-exclusive">Exclusive</div>
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
                <h5 class="card-title">Apple iPhone 11</h5>
                <p class="card-text">
                    <span class="text-danger">367.08 €</span>
                    <span class="text-muted text-decoration-line-through">399.00 €</span>
                    <span class="text-success text-orange">(8% OFF)</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/samsung-galaxy-a16.png" class="card-img-top" alt="Samsung Galaxy A16">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
                <h5 class="card-title">Samsung Galaxy A16</h5>
                <p class="card-text">
                    <span class="text-danger">312.80 €</span>
                    <span class="text-muted text-decoration-line-through">340.00 €</span>
                    <span class="text-success text-orange">(8% OFF)</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/apple-ipad-7th-gen.png" class="card-img-top" alt="Apple iPad (7th Gen)">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.5</span>
                </div>
                <div class="badge badge-danger">New Arrival</div>
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
                <h5 class="card-title">Apple iPad (7th Gen)</h5>
                <p class="card-text">
                    <span class="text-danger">334.88 €</span>
                    <span class="text-muted text-decoration-line-through">364.00 €</span>
                    <span class="text-success text-orange">(8% OFF)</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/tab-m8-3rd-gen.png" class="card-img-top" alt="Tab M8 3rd Gen">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
                </div>
                <div class="sale-badge">Sale</div>
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
                <h5 class="card-title">Tab M8 3rd Gen</h5>
                <p class="card-text">
                    <span class="text-danger">294.40 €</span>
                    <span class="text-muted text-decoration-line-through">320.00 €</span>
                    <span class="text-success text-orange">(8% OFF)</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/sony-bravia-hd-led-tv.png" class="card-img-top" alt="Sony Bravia HD LED TV">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
                <h5 class="card-title">Sony Bravia HD LED TV</h5>
                <p class="card-text">
                    <span class="text-danger">378.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/samsung-ultra-hd-led-tv.png" class="card-img-top" alt="Samsung Ultra HD LED TV">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
                <h5 class="card-title">Samsung Ultra HD LED TV</h5>
                <p class="card-text">
                    <span class="text-danger">400.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/samsung-ultra-hd-led-tv.png" class="card-img-top" alt="Sony Ultra 4K LED TV">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
                </div>
                <div class="badge badge-danger">New Arrival</div>
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
                <h5 class="card-title">Sony Ultra 4K LED TV</h5>
                <p class="card-text">
                    <span class="text-danger">390.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/sony-sa-d40-80-w-speaker-system.png" class="card-img-top" alt="Sony SA-D40 80 W Speaker System">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
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
                <h5 class="card-title">Sony SA-D40 80 W</h5>
                <p class="card-text">
                    <span class="text-danger">230.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/120-w-home-theater-system.png" class="card-img-top" alt="120 W Home Theater System">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
                <h5 class="card-title">120 W Home Theater</h5>
                <p class="card-text">
                    <span class="text-danger">248.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/sony-cybershot-dsc-h300-camera.png" class="card-img-top" alt="Sony CyberShot DSC-H300 Camera">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>2.5</span>
                </div>
                <div class="badge badge-primary">Trending</div>
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
                <h5 class="card-title">Sony CyberShot DSC-H300</h5>
                <p class="card-text">
                    <span class="text-danger">200.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/canon-ixus-190-camera.png" class="card-img-top" alt="Canon IXUS 190 Camera">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
                <h5 class="card-title">Canon IXUS 190</h5>
                <p class="card-text">
                    <span class="text-danger">205.00 €</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
            <div class="card-img-container">
                <img src="/tech_web/assets/products/apple-airpods.png" class="card-img-top" alt="Apple AirPods">
                <div class="star-reviews">
                    <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
                </div>
                <div class="badge badge-exclusive">Exclusive</div>
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
                <h5 class="card-title">Apple AirPods</h5>
                <p class="card-text">
                    <span class="text-danger">230.00 €</span>
                </p>
            </div>
        </div>
    </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/sennheiser-hd-headset.jpg" class="card-img-top" alt="Sennheiser HD Headset">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
            <h5 class="card-title">Sennheiser HD Headset</h5>
            <p class="card-text">
              <span class="text-danger">167.00 €</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/apple-watch-series-5.jpg" class="card-img-top" alt="Apple Watch Series 5">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>3.0</span>
            </div>
            <div class="sale-badge">Sale</div>
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
            <h5 class="card-title">Apple Watch Series 5</h5>
            <p class="card-text">
              <span class="text-danger">417.10 €</span>
              <span class="text-muted">430.00 € (3% OFF)</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/galaxy-fit-e-smart-band.jpg" class="card-img-top" alt="Galaxy Fit e Smart Band">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
            <h5 class="card-title">Galaxy Fit e Smart Band</h5>
            <p class="card-text">
              <span class="text-danger">140.65 €</span>
              <span class="text-muted">145.00 € (3% OFF)</span>
            </p>
            <div class="color-options">
                <div class="color-dot yellow"></div>
                <div class="color-dot green"></div>
                <div class="color-dot blue"></div>
            </div>
          </div>
        </div>
      </div>
    

    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/screen-guards.jpg" class="card-img-top" alt="Screen Guards">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>2.5</span>
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
            <h5 class="card-title">Screen Guards</h5>
            <p class="card-text">
              <span class="text-danger">7.36 €</span>
              <span class="text-muted">8.00 € (8% OFF)</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/sony-ht-s40r-600-w-soundbar.png" class="card-img-top" alt="SONY HT-S40R 600 W Soundbar">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
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
            <h5 class="card-title">SONY HT-S40R 600 W Soundbar</h5>
            <p class="card-text">
              <span class="text-danger">250.00 €</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/sennheiser-bluetooth-speakers.png" class="card-img-top" alt="Sennheiser Bluetooth Speakers">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>4.0</span>
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
            <h5 class="card-title">Sennheiser Bluetooth Speakers</h5>
            <p class="card-text">
              <span class="text-danger">176.00 €</span>
            </p>
            <div class="color-options">
                <div class="color-dot white"></div>
                <div class="color-dot yellow"></div>
                <div class="color-dot black"></div>
            </div>
          </div>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/canon-compact-cameras.png" class="card-img-top" alt="Canon Compact Cameras">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>2.0</span>
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
            <h5 class="card-title">Canon Compact Cameras</h5>
            <p class="card-text">
              <span class="text-danger">205.00 €</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/sony-sel200600g-lens.png" class="card-img-top" alt="SONY SEL200600G Lens">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>4.5</span>
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
            <h5 class="card-title">SONY SEL200600G Lens</h5>
            <p class="card-text">
              <span class="text-danger">678.00 €</span>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="card">
          <div class="card-img-container">
            <img src="/tech_web/assets/products/sennheiser-bluetooth-headsets.png" class="card-img-top" alt="Sennheiser Bluetooth Headsets">
            <div class="star-reviews">
              <i class="bi bi-star-fill text-warning"></i> <span>3.5</span>
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
            <h5 class="card-title">Sennheiser Bluetooth Headsets</h5>
            <p class="card-text">
              <span class="text-danger">98.00 €</span>
            </p>
          </div>
        </div>
      </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>


<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
