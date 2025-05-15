<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PAPIH COMP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        .navbar {
            background-color: #198754; /* Hijau Bootstrap */
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .banner {
        background-color: #2b6777; /* warna senada logo */
        color: #fff;
        height: auto;
        padding: 30px;
        margin-bottom: 30px;
        }
        .banner-text {
        display: flex;
        align-items: center;
        gap: 20px;
        }
        .banner-text img {
        height: 70px;
        background-color: #fff;
        padding: 8px;
        border-radius: 10px;
         }
        .product-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .product-card .card-body {
            background-color: #fff;
        }
        .product-card .btn {
            background-color: #198754;
            border: none;
        }
        .product-card .btn:hover {
            background-color: #157347;
        }
        footer {
            background-color: #343a40; /* Abu-abu gelap */
            color: #fff;
        }
    </style>
</head>
<body>

<!-- Banner -->
<div class="banner">
    <div class="container banner-text">
        <img src="{{ asset('images/PAPIH COMP.png') }}" alt="Logo Indrapura Komputer">
        <div>
            <h1 class="fw-bold mb-1">INDRAPURA KOMPUTER</h1>
            <p class="mb-0">Solusi terbaik untuk kebutuhan komputer Anda!</p>
        </div>
    </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Indrapura Komputer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Tambahkan tautan navigasi di sini jika diperlukan -->
    </div>
</nav>

<!-- Daftar Produk -->
<div class="container">
    <h2 class="mb-4 text-center fw-bold">Produk Unggulan</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @for ($i = 0; $i < 6; $i++)
        <div class="col">
            <div class="card h-100 product-card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Produk {{ $i + 1 }}">
                <div class="card-body">
                    <h5 class="card-title">Produk {{ $i + 1 }}</h5>
                    <p class="card-text">Deskripsi singkat untuk produk {{ $i + 1 }}.</p>
                    <p class="text-success fw-bold">$19.99</p>
                    <a href="#" class="btn btn-success w-100">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 mt-5">
    &copy; {{ date('Y') }} PAPIH COMP. All rights reserved.
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
