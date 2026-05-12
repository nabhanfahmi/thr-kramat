@extends('user.layout.user')

@section('content')
<style>
    body {
        background-color: #f8f9fc;
    }

    .container {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        max-width: 600px;
        margin: 0 auto;
    }

    h3 {
        text-align: center;
        font-weight: bold;
        color: #6f42c1;
        margin-bottom: 30px;
        font-size: 1.8rem;
    }

    .form-label {
        font-weight: 600;
        color: #4a4a4a;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #6f42c1, #8e60d3);
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 1rem;
        width: 100%;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a339e, #7c4bc0);
        transform: scale(1.02);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            margin: 15px;
        }

        h3 {
            font-size: 1.5rem;
        }

        .btn-primary {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 480px) {
        .form-control {
            font-size: 0.9rem;
            padding: 10px;
        }

        .btn-primary {
            font-size: 0.9rem;
            padding: 12px;
        }

        h3 {
            font-size: 1.3rem;
        }
    }
    .btn-outline-secondary {
    border-radius: 12px;
    padding: 14px;
    font-weight: bold;
    font-size: 1rem;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-outline-secondary:hover {
    background: #e9ecef;
    transform: scale(1.02);
}

</style>

<div class="container mt-5">
    <h3>Pesan Tiket: {{ $tiket->nama_wisata }}</h3>

    <form action="{{ route('user.pesan.store', $tiket->id) }}" method="POST">
        @csrf

        <!-- <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No. HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div> -->

        <div class="mb-3">
            <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" min="1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" required>
        </div>

        <div class="d-flex gap-3 mt-4">
    <button type="submit" class="btn btn-primary flex-fill">Pesan Tiket</button>
    <a href="{{ route('user.tiket.index') }}" class="btn btn-outline-secondary flex-fill">Batal</a>
</div>

    </form>
</div>
@endsection
