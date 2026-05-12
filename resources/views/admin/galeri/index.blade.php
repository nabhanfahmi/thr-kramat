@extends('admin.layout.admin') {{-- Pastikan layout ini ada --}}

@section('content')
<div class="container mt-4">
    <h2>Daftar Galeri</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($galeris as $item)
                <tr>
                    <td><img src="{{ asset('storage/' . $item->gambar) }}" width="100"></td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
