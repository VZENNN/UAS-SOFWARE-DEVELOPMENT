@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<div class="container py-4">
    <form action="{{ route('clientCheckoutSave') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror bg-transparent" placeholder="Mike" value="{{ old('name') }}" required>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror bg-transparent" placeholder="08122387xxxx" value="{{ old('phone') }}" required>
            @error('phone')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror bg-transparent" placeholder="3425 Stone Street" value="{{ old('address') }}" required>
            @error('address')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="note">Catatan</label>
            <textarea name="note" id="note" cols="30" class="form-control @error('note') is-invalid @enderror bg-transparent" placeholder="Kalau bisa warna hitam  . . .">{{ old('note') }}</textarea>
            @error('note')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="province">Provinsi</label>
            <select name="province" id="province" class="form-control bg-transparent" required>
                <option value="">-- Pilih Provinsi --</option>
            </select>
        </div>

        <div class="form-group">
            <label for="city">Kota</label>
            <select name="city" id="city" class="form-control bg-transparent" required>
                <option value="">-- Pilih Kota --</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="courier">Tipe Pengiriman</label>
            <select name="courier" id="courier" class="form-control bg-transparent" required>
                <option value="">-- Pilih Kurir --</option>
                <option value="jne">JNE</option>
            </select>
        </div>   
        <div class="form-group">
            <label for="service">Tipe Ongkir</label>
            <select name="service" id="service" class="form-control bg-transparent" required>
                <option value="">-- Pilih Layanan Ongkir --</option>
            </select>
        </div>

        <div class="form-group mt-4">
            <label for="discount_code">Kode Diskon</label>
            <div class="input-group">
                <input type="text" name="discount_code" id="discount_code" class="form-control bg-transparent" placeholder="Masukkan kode diskon">
                <button type="button" id="apply-discount" class="btn btn-secondary">Terapkan</button>
            </div>
            <small id="discount-message" class="form-text"></small>
        </div>

        <div class="mt-4">
            <h5 class="mb-2 font-bold">Rincian Harga</h5>
            <table class="table table-bordered w-100">
                <tbody>
                    <tr>
                        <td>Harga Barang</td>
                        <td id="harga_barang">Rp0</td>
                    </tr>
                    <tr>
                        <td>Harga Ongkir</td>
                        <td id="harga_ongkir">Rp0</td>
                    </tr>
                    <tr id="discount-row" style="display: none;">
                        <td>Diskon</td>
                        <td id="harga_diskon" class="text-danger">-Rp0</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total Harga</td>
                        <td id="total_price">Rp0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button id="pay-button" type="button" class="btn btn-primary float-end">Bayar Sekarang</button>
    </form>
</div>
@push('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Text area auto-resize functionality
        autosize();
        function autosize(){
            var text = $('#note');

            text.each(function(){
                $(this).attr('rows',1);
                resize($(this));
                this.style.overflow = 'hidden';
                this.style.backgroundColor = 'transparent';
            });

            text.on('input', function(){
                resize($(this));
            });

            function resize ($text) {
                $text.css('height', 'auto');
                $text.css('height', $text[0].scrollHeight+'px');
            }
        }
    </script>

    <script>
        // Discount variables
        let appliedDiscountCode = '';
        let appliedDiscountPercent = 0;
        let discountAmount = 0;

        // Payment button handling
        document.getElementById('pay-button').addEventListener('click', function (e) {
            e.preventDefault();

            const selectedService = $('#service').val();
            const ongkirText = document.getElementById('harga_ongkir').textContent;

            const formData = {
                name: document.getElementById('name').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                note: document.getElementById('note').value,
                province: $('#province').val(),
                city: $('#city').val(),
                courier: $('#courier').val(),
                service: selectedService,
                shipping_cost: ongkirText,
                discount_code: appliedDiscountCode
            };
        
            fetch("{{ route('clientCheckoutSave') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                if (data.token) {
                    window.snap.pay(data.token, {
                        onSuccess: function(result){
                            window.location.href = '/success/' + data.order_code;
                        },
                        onPending: function(result){
                            alert("Menunggu pembayaran.");
                        },
                        onError: function(result){
                            alert("Terjadi kesalahan.");
                        },
                        onClose: function(){
                            alert("Kamu menutup popup tanpa menyelesaikan pembayaran");
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran.");
                }
            });
        });
    </script>

    <script>
        // Province and city select initialization
        $(document).ready(function() {
            $('#province').select2({
                placeholder: '-- Pilih Provinsi --'
            });
            $('#city').select2({
                placeholder: '-- Pilih Kota --'
            });

            fetch('/provinces')
                .then(res => res.json())
                .then(data => {
                    data.forEach(province => {
                        $('#province').append(new Option(province.name, province.id));
                    });
                });

            $('#province').on('change', function() {
                const provinceId = $(this).val();
                $('#city').empty().append(new Option('-- Pilih Kota --', ''));
                if (provinceId) {
                    fetch(`/cities/${provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(city => {
                                $('#city').append(new Option(city.name, city.id));
                            });
                        });
                }
            });
            
            // Initialize discount button handler
            $('#apply-discount').on('click', applyDiscount);
        });
    </script>

    <script>
        // Shipping services handling
        function loadOngkirService() {
            const cityId = $('#city').val();
            const courier = $('#courier').val();

            if (cityId && courier) {
                fetch(`/ongkir/services?destination=${cityId}&courier=${courier}`)
                    .then(res => res.json())
                    .then(data => {
                        $('#service').empty().append(new Option('-- Pilih Layanan Ongkir --', ''));
                        data.forEach(service => {
                            const label = `${service.service} - ${service.description} - Rp${service.cost[0].value.toLocaleString()}`;
                            $('#service').append(new Option(label, service.service));
                            $('#service').data(`price-${service.service}`, service.cost[0].value);
                        });
                    });
            }
        }

        $('#courier, #city').on('change', loadOngkirService);

        $('#service').on('change', function() {
            const selectedService = $(this).val();
            const price = $(this).data(`price-${selectedService}`);
            const formattedPrice = price ? `Rp${price.toLocaleString()}` : 'Rp0';
        
            $('#ongkir_price').val(formattedPrice);
            document.getElementById('harga_ongkir').textContent = formattedPrice;
        
            updateTotalHarga();
        });
    </script>

    <script>
        // Price calculations
        const hargaBarang = {{ session('cart_total') }}; 
        
        document.getElementById('harga_barang').textContent = 'Rp' + hargaBarang.toLocaleString();
        updateTotalHarga();
        
        function parseRupiah(rupiahString) {
            return parseInt(rupiahString.replace(/[^\d]/g, '')) || 0;
        }
        
        function updateTotalHarga() {
            const ongkirText = document.getElementById('harga_ongkir').textContent;
            const ongkir = parseRupiah(ongkirText);
            const subtotal = hargaBarang + ongkir;
            
            // Apply discount if exists
            if (appliedDiscountPercent > 0) {
                // Calculate discount amount based on subtotal
                discountAmount = Math.round(subtotal * (appliedDiscountPercent / 100));
                
                // Show discount row
                document.getElementById('discount-row').style.display = '';
                document.getElementById('harga_diskon').textContent = '-Rp' + discountAmount.toLocaleString();
                
                const total = subtotal - discountAmount;
                document.getElementById('total_price').textContent = 'Rp' + total.toLocaleString();
            } else {
                // No discount
                document.getElementById('discount-row').style.display = 'none';
                document.getElementById('total_price').textContent = 'Rp' + subtotal.toLocaleString();
            }
        }
        
        // Discount handling
        function applyDiscount() {
            const code = document.getElementById('discount_code').value;
            if (!code) {
                document.getElementById('discount-message').textContent = 'Masukkan kode diskon terlebih dahulu';
                document.getElementById('discount-message').className = 'form-text text-danger';
                return;
            }
            
            fetch('/verify-discount', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.valid) {
                    // Store discount info
                    appliedDiscountCode = code;
                    appliedDiscountPercent = data.discount_percent;
                    
                    // Update UI
                    document.getElementById('discount-message').textContent = 'Diskon berhasil diterapkan: ' + data.discount_percent + '%';
                    document.getElementById('discount-message').className = 'form-text text-success';
                    
                    // Update price calculations
                    updateTotalHarga();
                } else {
                    // Reset discount
                    resetDiscount();
                    
                    // Show error message
                    document.getElementById('discount-message').textContent = 'Kode diskon tidak valid atau sudah habis';
                    document.getElementById('discount-message').className = 'form-text text-danger';
                }
            })
            .catch(err => {
                console.error('Error:', err);
                document.getElementById('discount-message').textContent = 'Terjadi kesalahan saat memverifikasi kode';
                document.getElementById('discount-message').className = 'form-text text-danger';
            });
        }
        
        function resetDiscount() {
            appliedDiscountCode = '';
            appliedDiscountPercent = 0;
            discountAmount = 0;
            document.getElementById('discount-row').style.display = 'none';
            updateTotalHarga();
        }
    </script>
@endpush