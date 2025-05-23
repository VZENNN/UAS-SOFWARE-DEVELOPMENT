@extends('admin.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
                <table class="table table-striped" id="table1">
                        <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Kode Pesanan</th>
                                        <th>Nama</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th width="20%">Aksi</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach($orders as $row)
                                <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->order_code }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>Rp. {{ $row->total }}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <span class="badge bg-success">Terbayar</span>
                                            @elseif($row->status == 1)
                                                <span class="badge bg-info">Terkonfirmasi</span>
                                            @elseif($row->status == 2)
                                                <span class="badge bg-primary">Diproses</span>
                                            @elseif($row->status == 3)
                                                <span class="badge bg-danger">Menunggu</span>
                                            @elseif($row->status == 4)
                                                <span class="badge bg-secondary">Pengiriman</span>
                                            @elseif($row->status == 5)
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                                <a href="{{ route('orderDetail', $row->order_code) }}"><span class="btn btn-sm btn-outline-primary">Detail</span></a>
                                        </td>
                                </tr>
                                @endforeach
                                <tbody>
                </table>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endsection
