@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-body row">
            <div class="col-md-8 col-12">
                <form action="{{ route('faqStore') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="question">Pertanyaan</label>
                        <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror" placeholder="Masukkan pertanyaan" value="{{old('question')}}" required autofocus>
                        @error('question')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="answer">Jawaban</label>
                        <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @enderror" rows="5" placeholder="Masukkan jawaban" required>{{old('answer')}}</textarea>
                        @error('answer')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection