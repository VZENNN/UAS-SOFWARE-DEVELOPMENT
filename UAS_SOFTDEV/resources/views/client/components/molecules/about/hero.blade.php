@push('css')
    <style>
        .about-text h4{
          font-weight: 300;
          width: 80%;
          margin: 0 auto;
        }

        .img-about-us img{
          width: 100%;
        }

        @media screen and (max-width:576px){
            .about-text h4{
                font-weight: 300;
                width: 100%;
                margin: 0 auto;
                font-size: 16px;
            }
        }
    </style>
@endpush

<div class="py-md-5 py-2">
    <div class="container about-text">
    <h1 class="font-primary text-center mt-5">Tentang Kami</h1>
    <h4 class="font-secondary text-center">Selamat datang di Toko Computer, pusat kebutuhan teknologi terpercaya Anda!
Kami menyediakan berbagai produk komputer, laptop, komponen hardware, dan aksesoris IT dengan kualitas terbaik dan harga bersaing.
Dengan dukungan tim profesional, kami siap membantu Anda menemukan solusi teknologi terbaik untuk kebutuhan personal, gaming, bisnis, hingga perakitan PC custom. Produk kami mencakup:

Laptop dan PC berbagai merek (Asus, Acer, HP, Lenovo, MSI, dll.)

Komponen PC: prosesor, VGA, motherboard, RAM, SSD, HDD, PSU, casing

Aksesoris: keyboard, mouse, headset, webcam, printer, router, dan lainnya

Layanan servis & upgrade komputer/laptop

TechZone Computer berkomitmen memberikan pelayanan cepat, ramah, dan jaminan garansi resmi untuk setiap produk.
Nikmati juga layanan belanja online yang aman dan pengiriman ke seluruh Indonesia.</h4>
    </div>

    <div class="img-about-us mt-4">
    <img src="{{ asset('assets/images/laptop.jpg    ') }}" alt="" class="img-fluid">
    </div>
</div>
