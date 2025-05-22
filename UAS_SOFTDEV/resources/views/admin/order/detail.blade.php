@extends('admin.layout')
@section('css')
    <style>
        .order-info > tbody > tr{
            height:35px !important;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-12">
                    <table class="order-info">
                        <tr>
                            <td><b>Status</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalUpdateStatus" style="background-color:transparent;border:none;">
                                    @if($order->status == 0)
                                        <span class="badge bg-success" >Terbayar</span>
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
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Total</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><b><u>Rp{{ $order->total }}</u></b></td>
                        </tr>
                        <tr>
                            <td><b>Nama</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Telepon</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <td><b>Alamat</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <td><b>Catatan</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $order->note }}</td>
                        </tr>
                        <tr>
                            <td><b>Ongkir</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>{{ $order->shipping_cost }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8 col-12 ">
                    <h4>Detail Pesanan</h4>
                    <div class="table-responsive">
                        <table class="table table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Judul</td>
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                    <td>Harga Ongkir</td>
                                    <td>Sub Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{!! str_replace('-', ' ', ucwords($item->title)) !!}</td>
                                        <td>Rp{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ str_replace(',', '', $order->shipping_cost) }}</td>
                                        <td>Rp{!! $item->price * $item->quantity !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="javascript:void(0)" onclick="alertconfirm('{{route('orderDelete', $order->order_code)}}')" class="btn btn-danger float-end">Hapus Pesanan</a>
        </div>
    </div>

    <!-- Modal Update Status -->
    <div class="modal fade" id="modalUpdateStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateStatusLabel">Perbarui Status Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orderUpdateStatus', $order->order_code) }}" method="post">
                        @csrf
                        <div class="input-group">
                            <select class="form-select" id="inputGroupSelect01" name="status">
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Terbayar</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Diproses</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Menunggu</option>
                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Pengiriman</option>
                                <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="input-group-text btn btn-primary" for="inputGroupSelect01">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const alertconfirm = (url) => {
        Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus pesanan ini?',
                text: "Pesanan ini akan dihapus secara permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                if (result.isConfirmed) {
                        window.location.replace(url);
                }
        })
    }
    </script>
@endsection
