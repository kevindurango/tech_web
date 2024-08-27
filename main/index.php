<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Header with Search and Icons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/tech_web/styles/styles.css">
</head>
<body>
<!-- First Header Section: Country Dropdown and Social Links -->
<header class="bg-dark py-1 px-4">
    <div class="container-fluid d-flex align-items-center">
        <!-- Dropdown and Offer Text -->
        <div class="d-flex align-items-center flex-grow-1">
            <div class="dropdown me-3 ps-4 pe-5">
                <button class="btn btn-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="countryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                    <span class="text-white">US</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="countryDropdown">
                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/us.svg');"></div>
                        <span>US - United States</span>
                    </a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/ca.svg');"></div>
                        <span>CA - Canada</span>
                    </a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/gb.svg');"></div>
                        <span>UK - United Kingdom</span>
                    </a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/au.svg');"></div>
                        <span>AU - Australia</span>
                    </a></li>
                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="country-logo rounded-circle bg-gray" style="background-image: url('https://flagcdn.com/in.svg');"></div>
                        <span>IN - India</span>
                    </a></li>
                </ul>
            </div>
            <span class="text-white ps-5">Free returns. Standard shipping. Orders $99</span>
        </div>
        <!-- Navigation Links -->
        <nav>
            <ul class="nav pe-4">
                <li class="nav-item"><a class="nav-link text-white small" href="#">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link text-white small" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white small" href="#">Terms</a></li>
                <li class="nav-item"><a class="nav-link text-white small" href="#">FAQ</a></li>
            </ul>
        </nav>
        <!-- Social Media Icons -->
        <div class="ps-4 pe-4">
            <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-github"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-youtube"></i></a>
            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</header>
<!-- Second Header Section: Search Bar and Icons -->
<header class="bg-white py-2 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Search Form -->
        <form class="d-flex w-25">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-light d-flex align-items-center border-0" type="submit">
                <i class="bi bi-search text-gray"></i>
            </button>
        </form>
        <!-- Icons and Texts -->
        <div class="d-flex">
            <!-- My Cart -->
            <div class="d-flex align-items-center me-3 text-dark">
                <div class="icon-circle me-2">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="text-start">
                    <div class="fs-7 fw-light">My Cart</div>
                    <div class="fs-6 fw-bold">$0.00</div>
                </div>
            </div>
            <!-- My Wishlist -->
            <div class="d-flex align-items-center me-3 text-dark">
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
</header>
<!-- Product Introduction Section -->
<section class="container-fluid bg-image py-5">
    <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start mb-4 mb-md-0 ps-5">
            <h2 class="display-4 fw-bold text-gradient mb-3">Google Pixel 8</h2>
            <p class="lead text-dark">Experience the future with the Google Pixel 8, featuring a vibrant 6.2-inch OLED display, cutting-edge Tensor G3 chip, and a powerful 50MP camera system. Designed with a sleek, modern aesthetic and built to last with all-day battery life and 5G connectivity, the Pixel 8 delivers exceptional performance and seamless integration with Google Assistant. Embrace a new era of technology with a device that combines style, power, and intelligent features for an unparalleled smartphone experience.</p>
        </div>
        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <img src="/tech_web/assets/pixel-8.png" alt="Google Pixel 8" class="img-fluid rounded custom-image">
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
