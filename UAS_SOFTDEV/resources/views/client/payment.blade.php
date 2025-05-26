@extends('client.layout.template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Payment</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Order Code: {{ $order->order_code }}</h5>
                        <h6>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h6>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Customer Details</h6>
                            <p class="mb-1">Name: {{ $order->name }}</p>
                            <p class="mb-1">Phone: {{ $order->phone }}</p>
                            <p class="mb-1">Address: {{ $order->address }}</p>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button class="btn btn-primary" id="pay-button">Pay Now</button>
                        <a href="{{ route('payment.cancel', $order->order_code) }}" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snap_token }}', {
            onSuccess: function(result) {
                window.location.href = '{{ route("payment.finish", $order->order_code) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route("payment.finish", $order->order_code) }}';
            },
            onError: function(result) {
                alert("Payment failed. Please try again.");
                console.log(result);
            },
            onClose: function() {
                alert('You closed the payment window without completing the payment.');
            }
        });
    };
</script>
@endsection 