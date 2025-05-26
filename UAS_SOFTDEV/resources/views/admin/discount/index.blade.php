@extends('admin.layout')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection
@section('button')
<a href="{{ route('admin.discount.create') }}" class="btn btn-outline-primary">Tambah Diskon</a>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Diskon (%)</th>
                    <th>Kuota</th>
                    <th>Tanggal Dibuat</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($discounts as $discount)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $discount->code }}</td>
                    <td>{{ $discount->discount }}%</td>
                    <td>{{ $discount->qty }}</td>
                    <td>{{ $discount->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.discount.edit', $discount->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
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