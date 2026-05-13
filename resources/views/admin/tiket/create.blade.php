@extends('admin.layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Tambah Tiket</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tiket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Tiket --}}
        <div class="mb-3">
            <label class="form-label">Nama Tiket</label>
            <input type="text" name="nama_tiket" class="form-control"
                value="{{ old('nama_tiket') }}" required>
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
                    <option value="{{ $value }}" {{ old('kategori') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                value="{{ old('harga') }}" min="0" required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label">Stok Tiket</label>
            <input type="number" name="stok" class="form-control"
                value="{{ old('stok') }}" min="0" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Gambar --}}
        <div class="mb-3">
            <label class="form-label">Gambar Tiket</label>
            <input type="file" name="gambar_tiket" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.tiket.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection