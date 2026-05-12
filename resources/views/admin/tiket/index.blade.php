@extends('admin.layout.admin') {{-- Layout admin --}}

@section('content')
<div class="container mt-4">
    <h2>Daftar Tiket</h2>

    {{-- Tombol Tambah --}}
    <a href="{{ route('admin.tiket.create') }}" class="btn btn-primary mb-3">Tambah Tiket</a>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Tiket --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tikets as $tiket)
                <tr>
                    <td>{{ $tiket->nama_tiket }}</td>
                    <td>{{ $tiket->kategori }}</td>
                    <td>Rp {{ number_format($tiket->harga, 0, ',', '.') }}</td>
                    <td>{{ $tiket->stok }}</td>
                    <td>{{ $tiket->deskripsi ?? '-' }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.tiket.edit', $tiket->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.tiket.destroy', $tiket->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus tiket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada tiket tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
