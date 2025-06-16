@extends('admin.layout')
@section('button')
    <a href="{{ route('faqCreate') }}" class="btn btn-outline-primary">Buat</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->question }}</td>
                                <td>{{ Str::limit($item->answer, 100) }}</td>
                                <td>
                                    <a href="{{ route('faqEdit', $item->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="alertconfirm('{{route('faqDelete', $item->id)}}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
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
                title: 'Apakah Anda yakin ingin menghapus FAQ ini?',
                text: "FAQ ini akan dihapus secara permanen",
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