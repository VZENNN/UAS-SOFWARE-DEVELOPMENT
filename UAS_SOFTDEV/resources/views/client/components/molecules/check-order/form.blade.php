<div class="container py-3">
    <h3 class="mb-4 font-primary"><b><u>Cek Pesanan</u></b></h3>
    <form action="{{ route('clientCheckOrderStatus') }}" method="post">
      @csrf
      <div class="input-group mb-3">
        <input type="text" name="order_code" class="form-control bg-transparent" placeholder="Masukkan kode pesanan Anda b5K-xxxxx" aria-label="Username penerima" aria-describedby="button-addon2" required>
        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cek</button>
      </div>
    </form>
    <hr/>
</div>
