<x-template.layout title="{{ $title }}">
    <x-organisms.navbar :path="$shop->path"/>
    @include('client.components.molecules.check-order.user')
    
    @if(count($orders) > 0)
        <div class="container py-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="badge bg-success">Terbayar</span>
                                    @elseif($order->status == 1)
                                        <span class="badge bg-info">Dikonfirmasi</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-primary">Diproses</span>
                                    @elseif($order->status == 3)
                                        <span class="badge bg-danger">Menunggu</span>
                                    @elseif($order->status == 4)
                                        <span class="badge bg-secondary">Pengiriman</span>
                                    @elseif($order->status == 5)
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="container py-3">
            <div class="alert alert-info">
                Kamu belum memiliki pesanan. <a href="{{ route('products') }}">Belanja sekarang!</a>
            </div>
        </div>
    @endif
    
    <x-organisms.footer :shop="$shop"/>
</x-template.layout>