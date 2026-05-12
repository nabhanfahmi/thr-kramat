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

    <form action="{{ route('admin.tiket.update', $tiket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_tiket" class="form-label">Nama Tiket</label>
            <input 
                type="text" 
                class="form-control" 
                name="nama_tiket" 
                id="nama_tiket" 
                value="{{ old('nama_tiket', $tiket->nama_tiket) }}" 
                required
            >
        </div>

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
                @endphp
                @foreach ($kategoriList as $value => $label)
                    <option value="{{ $value }}" 
                        {{ old('kategori', $tiket->kategori) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input 
                type="number" 
                class="form-control" 
                name="harga" 
                id="harga" 
                value="{{ old('harga', $tiket->harga) }}" 
                required 
                min="0"
            >
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input 
                type="number" 
                class="form-control" 
                name="stok" 
                id="stok" 
                value="{{ old('stok', $tiket->stok) }}" 
                required 
                min="0"
            >
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea 
                class="form-control" 
                name="deskripsi" 
                id="deskripsi" 
                rows="3" 
                required
            >{{ old('deskripsi', $tiket->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.tiket.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
