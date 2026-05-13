@extends('admin.layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Tiket</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tiket.update', $tiket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label">Nama Tiket</label>
            <input type="text" name="nama_tiket" class="form-control"
                value="{{ old('nama_tiket', $tiket->nama_tiket) }}" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @php
                    $kategoriList = [
                        'Tiket Reguler' => 'Reguler',
                        'Tiket VIP' => 'VIP',
                        'Tiket Anak-anak' => 'Anak-anak',
                        'Tiket Paket Keluarga' => 'Paket Keluarga'
                    ];
                @endphp
                @foreach ($kategoriList as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('kategori', $tiket->kategori) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                value="{{ old('harga', $tiket->harga) }}" min="0" required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                value="{{ old('stok', $tiket->stok) }}" min="0" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $tiket->deskripsi) }}</textarea>
        </div>

        {{-- Gambar Lama --}}
        @if ($tiket->gambar_tiket)
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label><br>
                <img src="{{ asset($tiket->gambar_tiket) }}" width="150" class="img-thumbnail">
            </div>
        @endif

        {{-- Upload Gambar Baru --}}
        <div class="mb-3">
            <label class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="gambar_tiket" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.tiket.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection