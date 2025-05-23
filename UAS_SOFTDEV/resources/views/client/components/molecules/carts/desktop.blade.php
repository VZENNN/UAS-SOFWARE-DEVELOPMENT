<table id="cart" class="table table-hover table-striped">
    <thead>
        <tr>
            <th style="width:50%">Produk</th>
            <th style="width:10%">Harga</th>
            <th style="width:25">Kuantitas</th>
            <th style="width:15%">Subtotal</th>
            @if(!request()->routeIs('clientCheckout'))
                <th style="width:5%">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @php $total = 0 @endphp
    @if(session('cart'))
        @foreach((array) session('cart') as $id => $details)
            @php $total += $details['price'] * $details['quantity'] @endphp
            <tr class="item-cart">
                <td>
                    {!! str_replace('-', ' ', ucwords($details['title'])) !!}
                </td>
                <td>
                    Rp{{$details['price']}}
                </td>
                <td>
                    @if(request()->routeIs('clientCheckout'))
                       x{{ $details['quantity'] }}
                    @else
                        <div id="input_div">
                            <input type="button" value="-" onclick="minus($(this))" class="btn btn-outline-primary">
                            <input type="text" value="{{ $details['quantity'] }}" id="count" data-id="{{ $id }}" data-price="{{$details['price']}}" class="count btn btn-outline-primary font-secondary" disabled>
                            <input type="button" value="+" onclick="plus($(this))" data-stock="{{ $details['product_stock'] }}" data-quantity="{{ $details['quantity'] }}" class="btn btn-outline-primary">
                        </div>
                    @endif
                </td>
                <td>Rp<span class="product-subtotal" data-subtotal="{{ $details['price'] * $details['quantity'] }}">{{ $details['price'] * $details['quantity']}}</span></td>
                @if(!request()->routeIs('clientCheckout'))
                    <td class="actions">
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}" onclick="deleteItem({{ $id }}, $(this), 'desktop')"><i class="bi bi-trash"></i></button>
                    </td>
                @endif
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
        <tr>
            <td>
            @if(!request()->routeIs('clientCheckout'))
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-arrow-left"></i> Lanjutkan Belanja
                    </span>
                </a>
            @endif
            </td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs">
                <strong>Total : Rp<span class="cart-total">{{ $total }}</span></strong>
            </td>
            @if(!request()->routeIs('clientCheckout'))
                <td>
                    <a href="#" id="btn-checkout" class="btn btn-primary">Checkout</a>
                </td>
            @endif
        </tr>
    </tfoot>
</table>
@push('js')
    <script>
        document.getElementById("btn-checkout").addEventListener("click", function (e) {
            e.preventDefault();
            const total = document.querySelector('.cart-total').innerText.replace(/\D/g, '');
        
            fetch("/store-total", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ total: total })
            }).then(response => {
                if(response.ok) {
                    window.location.href = "/checkout";
                }
            });
        });
    </script>
@endpush