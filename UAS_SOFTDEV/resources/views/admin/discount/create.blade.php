@extends('admin.layout')
@section('css')
<style>
    .form-select{
        text-align:left !important;
    }
    .dropdown-menu{
        border: 1px solid #dce7f1;
    }
</style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body row">
            <div class="col-md-8 col-12">
                <form action="{{ route('admin.discount.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="code">Kode Diskon</label>
                        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" 
                            placeholder="SALE50" value="{{ old('code') }}" required>
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Jumlah Diskon (%)</label>
                        <input type="number" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror" 
                            placeholder="10" value="{{ old('discount') }}" required min="1" max="100">
                        @error('discount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="qty">Kuota Penggunaan</label>
                        <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" 
                            placeholder="10" value="{{ old('qty') }}" required min="0">
                        @error('qty')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection