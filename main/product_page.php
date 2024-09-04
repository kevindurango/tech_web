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
<!-- Offcanvas Menu For Nav Links -->

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
            <!-- My Cart -->
            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Cart</div>
                    <div class="fs-6 fw-bold">$0.00</div>
                </div>
            </div>
            <!-- My Wishlist -->
            <div class="d-flex align-items-center mb-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-heart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Wishlist</div>
                    <div class="fs-6 fw-bold">View Wishlist</div>
                </div>
            </div>
            <!-- Guest Account -->
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
            <!-- Search Form Column -->
            <div class="col-md-6 d-flex justify-content-end">
                <form class="d-flex w-50">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                        <i class="bi bi-search text-gray"></i>
                    </button>
                </form>
            </div>
            <!-- Icons and Texts Column -->
            <div class="col-md-6 d-flex justify-content-end">
                <!-- My Cart -->
                <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Cart</div>
                        <div class="fs-6 fw-bold">$0.00</div>
                    </div>
                </div>
                <!-- My Wishlist -->
                <div class="d-flex align-items-center mx-4 text-dark">
                    <div class="icon-circle me-2">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="text-start">
                        <div class="fs-7 fw-light">My Wishlist</div>
                        <div class="fs-6 fw-bold">View Wishlist</div>
                    </div>
                </div>
                <!-- Guest Account -->
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
<!-- Product Image Carousel Section -->
<section class="product-section mt-4">
    <div class="container">
        <div class="row">
            <!-- Product Image Carousel -->
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/tech_web/assets/iphone13.png" class="d-block w-100" alt="Product Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/tech_web/assets/iphone13-2.png" class="d-block w-100" alt="Product Image 2">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <!-- Thumbnails -->
                <div class="d-flex justify-content-center mt-2">
                    <img src="/tech_web/assets/iphone13.png" class="img-thumbnail mx-1" alt="Thumbnail 1" data-bs-target="#productCarousel" data-bs-slide-to="0">
                    <img src="/tech_web/assets/iphone13-2.png" class="img-thumbnail mx-1" alt="Thumbnail 2" data-bs-target="#productCarousel" data-bs-slide-to="1">
                </div>
            </div>
            <!-- Product Details -->
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="fw-semibold">Shop</span>
                    <span class="mx-2">/</span>
                    <span class="fw-semibold">Apple iPhone 13</span>
                    <i class="bi bi-box ms-2"></i>
                </div>

                <h3 class="mb-2">Apple iPhone 13</h3>

                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-star-fill text-warning me-2"></i>
                    <span>4.5 (200 reviews)</span>
                </div>

                <p class="mb-3">The iPhone 13 features a stunning display, advanced camera system, and powerful A15 Bionic chip. It offers a sleek design, improved battery life, and a range of exciting colors.</p>

                <div class="mb-3">
                    <span class="text-danger fw-bold fs-5 me-2">Original Price: $999</span>
                    <span class="text-muted text-decoration-line-through fs-5 me-2">$899</span>
                    <span class="text-success fw-semibold">(8% off)</span>
                </div>
                <!-- Storage Options -->
                <hr class="my-4">
                <div class="mb-3">
                    <h5>Storage</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-storage">8 GB + 128 GB</button>
                        <button class="btn btn-storage">16 GB + 256 GB</button>
                    </div>
                </div>
                <!-- Color Options -->
                <div class="mb-3">
                    <h5>Color</h5>
                    <div class="d-flex gap-2">
                        <div class="color-option bg-danger"></div>
                        <div class="color-option bg-purple"></div>
                        <div class="color-option bg-dark"></div>
                    </div>
                </div>
                <!-- Notifications and Save for Later -->
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-envelope-fill text-danger me-2"></i>
                    <span>Get notified when back in stock</span>
                </div>
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-clock me-1"></i> Save for later
                </button>
            </div>
        </div>
    </div>
</section>
 <!-- Footer Section -->
<footer class="bg-dark text-white py-5 footer separator-line">
    <div class="container">
        <div class="row">

        <div class="col-md-3 mb-4">
    <div class="d-flex justify-content-between flex-wrap">

        <a href="#" class="text-dark icon-circle bg-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-facebook" style="color: #3b5998;"></i>
        </a>

        <a href="#" class="text-dark icon-circle bg-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-twitter" style="color: #1da1f2;"></i>
        </a>

        <a href="#" class="text-dark icon-circle bg-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-linkedin" style="color: #0077b5;"></i>
        </a>

        <a href="#" class="text-dark icon-circle bg-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-instagram" style="color: #e1306c;"></i>
        </a>

        <a href="#" class="text-dark icon-circle bg-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
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
