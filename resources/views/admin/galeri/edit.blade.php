@extends('admin.layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Galeri</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}" required>
        </div>

        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($galeri->gambar)
                <img src="{{ asset('storage/' . $galeri->gambar) }}" width="150">
            @else
                <p><em>Tidak ada gambar</em></p>
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            {{-- Pakai old() agar kalau validasi error, isi tidak hilang --}}
            <textarea name="keterangan" id="summernote" class="form-control" required>{!! old('keterangan', $galeri->keterangan) !!}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@push('scripts')
<!-- Summernote CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis keterangan di sini...',
            tabsize: 2,
            height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endpush
