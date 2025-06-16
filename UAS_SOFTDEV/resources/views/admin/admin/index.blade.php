@extends('admin.layout')
@section('button')
    <a href="{{ route('admin.create') }}" class="btn btn-outline-primary">Tambah Admin</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="alertconfirm('{{route('admin.destroy', $admin->id)}}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
const alertconfirm = (url) => {
        Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus admin ini?',
                text: "Data admin ini akan dihapus secara permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
                }).then((result) => {
                if (result.isConfirmed) {
                        window.location.replace(url);
                }
        })
    }
</script>
@endsection