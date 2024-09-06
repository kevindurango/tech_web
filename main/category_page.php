<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Header with Search and Icons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
    <link rel="stylesheet" href="/tech_web/styles/product.css">
</head>
<body>
<!-- First Header Section: Country Dropdown and Social Links -->
<header class="bg-dark py-1 px-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col d-none d-md-flex align-items-center">
                <div class="dropdown me-3 ps-4 pe-5">
                    <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                        <span class="text-white">US</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="countryDropdown">
                    </ul>
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
<!-- Hamburger Menu for Smaller Screens -->
<div class="d-md-none d-flex justify-content-between align-items-center">
    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavigation" aria-controls="offcanvasNavigation">
        <i class="bi bi-list"></i>
    </button>
    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
        <i class="bi bi-cart"></i>
    </button>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavigation" aria-labelledby="offcanvasNavigationLabel">
    <div class="offcanvas-header">
        <div class="profile-container">
            <div class="profile-icon">
                <img src="/tech_web/assets/profile_icon.png" alt="Profile Icon">
            </div>
            <a href="#" class="profile-text">Login • Register</a>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>
    </div>

    <div class="offcanvas-body">
        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3"> <i class="bi bi-grid me-1"></i> Shop by Categories</a> <!-- New Link Added -->

        <div class="dropdown mb-3">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="offcanvasCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid me-1"></i> Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasCategoriesDropdown">
                <li><a class="dropdown-item" href="#">Category 1</a></li>
                <li><a class="dropdown-item" href="#">Category 2</a></li>
                <li><a class="dropdown-item" href="#">Category 3</a></li>
            </ul>
        </div>

        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3">Home</a>
        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3">Shop</a>

        <div class="dropdown mb-3">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="offcanvasPopularDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Popular
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasPopularDropdown">
                <li><a class="dropdown-item" href="#">Popular Item 1</a></li>
                <li><a class="dropdown-item" href="#">Popular Item 2</a></li>
                <li><a class="dropdown-item" href="#">Popular Item 3</a></li>
            </ul>
        </div>

        <div class="dropdown mb-3">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="offcanvasTrendingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Trending
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasTrendingDropdown">
                <li><a class="dropdown-item" href="#">Trending Item 1</a></li>
                <li><a class="dropdown-item" href="#">Trending Item 2</a></li>
                <li><a class="dropdown-item" href="#">Trending Item 3</a></li>
            </ul>
        </div>

        <div class="dropdown mb-3">
            <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="offcanvasCollectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Collection
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasCollectionDropdown">
                <li><a class="dropdown-item" href="#">Collection Item 1</a></li>
                <li><a class="dropdown-item" href="#">Collection Item 2</a></li>
                <li><a class="dropdown-item" href="#">Collection Item 3</a></li>
            </ul>
        </div>

        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3">All Brands</a>
        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3">Contact Us</a>
        <a href="#" class="nav-link text-dark fw-semibold d-block mb-3">Top Deals</a>
    </div>
</div>

<!-- Offcanvas Menu for Smaller Screens -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasMenuLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form class="d-flex mb-3">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                <i class="bi bi-search text-gray"></i>
            </button>
        </form>

        <div class="d-flex flex-column">

            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Cart</div>
                    <div class="fs-6 fw-bold">$0.00</div>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-heart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Wishlist</div>
                    <div class="fs-6 fw-bold">View Wishlist</div>
                </div>
            </div>

            <div class="d-flex align-items-center text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-person"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">Guest</div>
                    <div class="fs-6 fw-bold">My Account</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Second Header Section: Search Bar and Icons -->
<header class="bg-white py-2 border-bottom d-none d-md-block">
    <div class="container-fluid px-5">
        <div class="row align-items-center">

            <div class="col-md-6 d-flex justify-content-end">
                <form class="d-flex w-50">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                        <i class="bi bi-search text-gray"></i>
                    </button>
                </form>
            </div>

            <div class="col-md-6 d-flex justify-content-end">

            <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Cart</div>
                        <div class="fs-6 fw-bold">$0.00</div>
                    </div>
                </div>

                <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Wishlist</div>
                        <div class="fs-6 fw-bold">View Wishlist</div>
                    </div>
                </div>

                <div class="d-flex align-items-center ms-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">Guest</div>
                        <div class="fs-6 fw-bold">My Account</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Navigation Section -->
<section class="container-fluid py-3 bg-white border-bottom d-none d-md-block">
    <div class="row text-center align-items-center">
        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid me-1"></i> Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    <li><a class="dropdown-item" href="#">Category 1</a></li>
                    <li><a class="dropdown-item" href="#">Category 2</a></li>
                    <li><a class="dropdown-item" href="#">Category 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Home</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Shop</a>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="popularDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Popular
                </a>
                <ul class="dropdown-menu" aria-labelledby="popularDropdown">
                    <li><a class="dropdown-item" href="#">Popular Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Popular Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="trendingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Trending
                </a>
                <ul class="dropdown-menu" aria-labelledby="trendingDropdown">
                    <li><a class="dropdown-item" href="#">Trending Item 1</a></li>
                    <li><a class="dropdown-item" href="#">Trending Item 2</a></li>
                    <li><a class="dropdown-item" href="#">Trending Item 3</a></li>
                </ul>
            </div>
        </div>

        <div class="col nav-column-spacing">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-dark fw-semibold" href="#" id="collectionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a href="#" class="nav-link text-dark fw-semibold">All Brands</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Contact Us</a>
        </div>

        <div class="col nav-column-spacing">
            <a href="#" class="nav-link text-dark fw-semibold">Top Deals</a>
        </div>
    </div>
</section>

<section class="mt-3">
    <div class="container-fluid">
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
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">

            <div class="col-md-6">
                <h5 class="fw-normal">All products - 39 items</h5>
            </div>

            <!-- Pricelist, Sort by, and View -->
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <!-- Pricelist Dropdown -->
                <div class="me-3 d-flex align-items-center">
                    <label for="price-list" class="me-1 mb-0">Pricelist:</label>
                    <select id="price-list" class="form-select form-select-sm ms-1">
                        <option>EUR</option>
                        <option>USD</option>
                        <option>GBP</option>
                    </select>
                </div>
                <!-- Sort by Dropdown -->
                <div class="d-flex align-items-center me-3">
                    <label for="sort-by" class="me-2 mb-0">Sort by:</label>
                    <select id="sort-by" class="form-select form-select-sm w-auto">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest Arrivals</option>
                    </select>
                </div>
                <!-- List and Grid View Icons -->
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

<section class="mt-2 mb-2">
    <div class="container-fluid">
        <div class="row">
            <!-- First Column: Category Filter -->
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
                <section class="similar-products mt-2 mb-3">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Product Card -->
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/product-ipad-7thgen.png" class="card-img-top" alt="Product 1">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Tablet</h6>
                                        <h5 class="card-title">Apple iPad 7th Gen</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$334</span>
                                            <span class="text-muted text-decoration-line-through">$364</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/apple-iphone-11.png" class="card-img-top" alt="Product 2">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Apple iPhone 11</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$349</span>
                                            <span class="text-muted text-decoration-line-through">$449</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/tech_web/assets/galaxy-a16.png" class="card-img-top" alt="Product 3">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">Smartphone</h6>
                                        <h5 class="card-title">Samsung Galaxy A16</h5>
                                        <p class="card-text">
                                            <span class="text-danger">$299</span>
                                            <span class="text-muted text-decoration-line-through">$399</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section -->
<section class="bg-dark text-white py-5 separator-line">
    <div class="container">
        <div class="row align-items-left">

            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-normal">Subscribe to our weekly newsletter</h2>
            </div>

            <div class="col-md-6">
                <form class="d-flex">
                    <input type="email" class="form-control me-2" placeholder="your email...." aria-label="Email">
                    <button class="btn btn-danger" type="submit">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section -->
<footer class="bg-dark text-white py-5 footer separator-line">
    <div class="container">
        <div class="row">

<div class="col-md-3 mb-4">
    <div class="social-links row row-cols-3 row-cols-sm-2 row-cols-md-1 g-3 mt-1">
        <a href="#" class="icon-circle">
            <i class="bi bi-facebook" style="color: #3b5998;"></i>
        </a>
        <a href="#" class="icon-circle">
            <i class="bi bi-twitter" style="color: #1da1f2;"></i>
        </a>
        <a href="#" class="icon-circle">
            <i class="bi bi-linkedin" style="color: #0077b5;"></i>
        </a>
        <a href="#" class="icon-circle">
            <i class="bi bi-instagram" style="color: #e1306c;"></i>
        </a>
        <a href="#" class="icon-circle">
            <i class="bi bi-youtube" style="color: #ff0000;"></i>
        </a>
    </div>
</div>
   <!-- Column 2: Categories -->
   <div class="col-md-2 mb-4">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Athletic Apparel</a></li>
                    <li><a href="#" class="text-white">Sneakers & Athletic</a></li>
                    <li><a href="#" class="text-white">Sunglasses & Eyewear</a></li>
                    <li><a href="#" class="text-white">Jeans</a></li>
                    <li><a href="#" class="text-white">T-Shirts</a></li>
                    <li><a href="#" class="text-white">Swimwear</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h5>Account Info</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Your Account</a></li>
                    <li><a href="#" class="text-white">Refunds & Replacements</a></li>
                    <li><a href="#" class="text-white">Order tracking</a></li>
                    <li><a href="#" class="text-white">Delivery info</a></li>
                    <li><a href="#" class="text-white">Taxes & Fees</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-4">
                <h5>Useful Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Blog</a></li>
                    <li><a href="#" class="text-white">Community</a></li>
                    <li><a href="#" class="text-white">Forums</a></li>
                    <li><a href="#" class="text-white">Pricing and Plans</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5>About Us</h5>
                <p class="text-white-50">
                    We are a team of passionate people whose goal is to improve everyone's life through disruptive products. We build great products to solve your business problems.
                    Our products are designed for small to medium sized companies willing to optimize their performance.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Small Footer Section -->
<footer class="bg-dark text-white py-3">
    <div class="container">
        <div class="row align-items-center">

        <div class="col-12 col-md-6 mb-2 mb-md-0 d-flex align-items-center justify-content-center justify-content-md-start">
                <i class="bi bi-copyright" style="font-size: 1rem; color: #fff;"></i>
                <span class="ms-2" style="font-size: 1rem;">MyCompany</span>
            </div>

            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
                <div class="dropdown ps-4 pe-5">
                    <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="country-logo rounded-circle" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                        <span class="text-white ms-2">US</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="countryDropdown">

                </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</body>
</html>
