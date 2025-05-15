<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PAPIH COMP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .banner {
            background: url('https://via.placeholder.com/1200x400') no-repeat center center;
            background-size: cover;
            height: 400px;
            position: relative;
            margin-bottom: 30px;
        }
        .banner-text {
            position: absolute;
            bottom: 30px;
            left: 30px;
            color: white;
            background-color: rgba(0,0,0,0.6);
            padding: 20px;
            border-radius: 10px;
        }
        .product-card {
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">MyShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Banner -->
<div class="banner">
    <div class="banner-text">
        <h1>Indrapura Komputer</h1>
        <p>Your one-stop shop for everything!</p>
    </div>
</div>

<!-- Product List -->
<div class="container">
    <h2 class="mb-4">Featured Products</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @for ($i = 0; $i < 6; $i++)
        <div class="col">
            <div class="card h-100 product-card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product {{ $i }}">
                <div class="card-body">
                    <h5 class="card-title">Product {{ $i + 1 }}</h5>
                    <p class="card-text">Short description for product {{ $i + 1 }}.</p>
                    <p class="text-primary fw-bold">$19.99</p>
                    <a href="#" class="btn btn-success w-100">Add to Cart</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; {{ date('Y') }} MyShop. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
