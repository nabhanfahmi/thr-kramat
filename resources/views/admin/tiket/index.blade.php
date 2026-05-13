@extends('admin.layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Daftar Tiket</h2>

    <a href="{{ route('admin.tiket.create') }}" class="btn btn-primary mb-3">
        Tambah Tiket
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Gambar</th>
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

                    {{-- Gambar Tiket --}}
                    <td>
                        @if($tiket->gambar_tiket)
                            <img src="{{ asset($tiket->gambar_tiket) }}"
                                 width="70"
                                 height="70"
                                 class="rounded"
                                 style="object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td>{{ $tiket->nama_tiket }}</td>
                    <td>{{ $tiket->kategori }}</td>

                    <td>
                        Rp {{ number_format($tiket->harga, 0, ',', '.') }}
                    </td>

                    <td>{{ $tiket->stok }}</td>

                    <td>
                        {{ \Illuminate\Support\Str::limit($tiket->deskripsi, 50) ?? '-' }}
                    </td>

                    <td>
                        <a href="{{ route('admin.tiket.edit', $tiket->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.tiket.destroy', $tiket->id) }}"
                              method="POST"
                              style="display:inline-block;"
                              onsubmit="return confirm('Yakin ingin menghapus tiket ini?')">

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
                    <td colspan="7" class="text-center">
                        Belum ada tiket tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection