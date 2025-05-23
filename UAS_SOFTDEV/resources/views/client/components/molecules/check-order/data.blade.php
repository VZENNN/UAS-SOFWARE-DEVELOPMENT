@push('css')
    <style>
        .order-info > tbody > tr{
          height:35px !important;
        }
    </style>
@endpush
<div class="container py-3">
    <div class="card bg-transparent border">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3 col-12">
                    <table class="order-info">
                        <tr>
                            <td><b>Status</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td><b>Kode Pesanan</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><b><u>Rp. {{ $order->order_code }}</u></b></td>
                        </tr>
                        <tr>
                            <td><b>Total</b></td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><b><u>Rp. {{ $order->total }}</u></b></td>
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
                    </table>
                </div>
                <div class="col-md-9 col-12">
                    <h4>Detail Pesanan</h4>
                    <div class="table-responsive d-md-block d-sm-blovk d-none">
                        <table class="table table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Judul</td>
                                <td>Harga</td>
                                <td>Jumlah</td>
                                <td>Sub Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{!! str_replace('-', ' ', ucwords($item->title)) !!}</td>
                                <td>Rp. {{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp. {!! $item->price * $item->quantity !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="d-lg-none d-sm-none d-block">
                        @foreach($orderDetail  as $row)
                            <div class="card mt-2 bg-transparent" style="width: 100%;box-shadow: rgb(0 0 0 / 10%) 0px 10px 15px -3px, rgb(0 0 0 / 5%) 0px 4px 6px -2px;">
                                <div class="card-body" style="padding: .8rem;">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="font-bold font-primary">{!! str_replace('-', ' ', ucwords($row->title)) !!}</h6>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Harga</label>
                                            <p class="font-bold">Rp. {{ $row->price }}</p>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Sub Total</label>
                                            <p class="font-bold">Rp. {!! $row->price * $row->quantity !!}</p>
                                        </div>
                                        <div class="col-12">
                                            <label for="">Jumlah</label>
                                            <p class="font-bold">X {{ $row->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-transparent mt-3 border">
      <div class="card-body">
        <div class="row">
          <div class="col-4">
            <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary font-secondary"><span class="d-flex align-items-center gap-2"><i class="bi bi-arrow-left"></i> Beranda </span></a>
          </div>
          <div class="col-8">
            <a href="/" class="btn btn-sm float-end btn-primary font-secondary"><span class="d-flex align-items-center gap-2"><i class="bi bi-telephone"></i> &nbsp;Konfirmasi Pesanan</span></a>
          </div>
        </div>
      </div>
    </div>
</div>
