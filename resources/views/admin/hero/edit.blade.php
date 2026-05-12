@extends('admin.layout.admin')

@section('title', 'Edit Background Hero')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Background Hero</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Gambar Saat Ini</label><br>
            <img src="{{ asset('storage/' . $hero->gambar) }}" alt="Background" style="width: 100%; max-width: 400px;">
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar Baru (Opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
