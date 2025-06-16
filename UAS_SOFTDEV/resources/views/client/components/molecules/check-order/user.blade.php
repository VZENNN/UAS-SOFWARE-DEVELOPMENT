<div class="container py-3">
    <h3 class="mb-4 font-primary"><b><u>Pesanan Kamu</u></b></h3>
    
    @auth
        <p>Berikut adalah daftar pesanan yang telah kamu buat menggunakan akun {{ auth()->user()->email }}</p>
    @else
        <p>Silakan <a href="{{ route('login') }}">login</a> untuk melihat riwayat pesanan kamu.</p>
    @endauth
    
    <hr/>
</div>