@extends('admin.layout.admin')

@section('title', 'Kelola Background Hero')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Background Hero</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.hero.create') }}" class="btn btn-primary mb-3">Tambah Background</a>

    <div class="row">
        @foreach ($data as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="Background">
                    <div class="card-body text-center">
                        <a href="{{ route('admin.hero.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.hero.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus background ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
