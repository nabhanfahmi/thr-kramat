@extends('admin.layout.admin')

@section('content')
<div class="container mt-4">
    <h2>{{ isset($tiket) ? 'Edit Tiket' : 'Tambah Tiket' }}</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ isset($tiket) ? route('admin.tiket.update', $tiket->id) : route('admin.tiket.store') }}" 
        method="POST"
    >
        @csrf
        @if (isset($tiket))
            @method('PUT')
        @endif

        {{-- Nama Tiket --}}
        <div class="mb-3">
            <label for="nama_tiket" class="form-label">Nama Tiket</label>
            <input 
                type="text" 
                name="nama_tiket" 
                id="nama_tiket" 
                class="form-control" 
                value="{{ old('nama_tiket', $tiket->nama_tiket ?? '') }}" 
                required
            >
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-control" name="kategori" id="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                @php
                    $kategoriList = [
                        'Tiket Reguler' => 'Reguler',
                        'Tiket VIP' => 'VIP',
                        'Tiket Anak-anak' => 'Anak-anak',
                        'Tiket Paket Keluarga' => 'Paket Keluarga'
                    ];
                    $selectedKategori = old('kategori', $tiket->kategori ?? '');
                @endphp
                @foreach ($kategoriList as $value => $label)
                    <option value="{{ $value }}" {{ $selectedKategori == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input 
                type="number" 
                class="form-control" 
                name="harga" 
                id="harga" 
                value="{{ old('harga', $tiket->harga ?? '') }}" 
                required 
                min="0"
            >
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Tiket</label>
            <input 
                type="number" 
                name="stok" 
                id="stok" 
                class="form-control" 
                required 
                min="0" 
                value="{{ old('stok', $tiket->stok ?? '') }}"
            >
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea 
                class="form-control" 
                name="deskripsi" 
                id="deskripsi" 
                rows="3" 
                required
            >{{ old('deskripsi', $tiket->deskripsi ?? '') }}</textarea>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.tiket.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
