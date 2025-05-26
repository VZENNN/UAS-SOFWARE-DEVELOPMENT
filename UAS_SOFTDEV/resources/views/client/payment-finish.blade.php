@extends('client.layout.template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Payment Completed</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fa fa-check-circle text-success" style="font-size: 64px;"></i>
                    </div>
                    
                    <h5 class="mb-3">Thank you for your order!</h5>
                    <p>Order Code: <strong>{{ $order->order_code }}</strong></p>
                    <p>We have received your payment and are processing your order.</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('clientCheckOrderStatus', ['order_code' => $order->order_code]) }}" class="btn btn-primary">Check Order Status</a>
                        <a href="{{ route('clientHome') }}" class="btn btn-outline-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 