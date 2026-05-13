@extends('user.layout.user')

@section('content')
<style>
    body {
        background-color: #f8f9fc;
    }

    .ticket-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: linear-gradient(to bottom right, #ffffff, #f1f0fc);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .ticket-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .ticket-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
        background: #eee;
    }

    .ticket-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .ticket-card:hover .ticket-image img {
        transform: scale(1.05);
    }

    .ticket-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ticket-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #512da8;
        margin-bottom: 0.5rem;
    }

    .ticket-category {
        font-size: 0.9rem;
        color: #6c757d;
        font-style: italic;
        margin-bottom: 0.75rem;
    }

    .ticket-desc {
        font-size: 0.95rem;
        color: #343a40;
        margin-bottom: 0.75rem;
    }

    .ticket-price {
        font-size: 1rem;
        font-weight: 600;
        color: #000;
        margin-bottom: 1rem;
    }

    .btn-ticket {
        background: linear-gradient(135deg, #6f42c1, #8e60d3);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px;
        font-weight: 600;
        transition: 0.3s ease;
        margin-top: auto;
    }

    .btn-ticket:hover {
        background: linear-gradient(135deg, #5a339e, #7e4fc1);
        transform: scale(1.03);
        color: white;
    }

    h2.text-primary {
        color: #6f42c1 !important;
    }

    @media (max-width: 768px) {
        .ticket-title {
            font-size: 1.1rem;
        }
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-uppercase fw-bold text-primary">
        Daftar Tiket
    </h2>

    <div class="row">
        @forelse($tikets as $tiket)
            <div class="col-md-4 mb-4">
                <div class="card ticket-card">

                    {{-- Gambar Tiket (SUDAH DIPERBAIKI) --}}
                    <div class="ticket-image">
                        @if($tiket->gambar_tiket)
                            <img src="{{ asset($tiket->gambar_tiket) }}" alt="{{ $tiket->nama_tiket }}">
                        @else
                            <img src="{{ asset('img/default-ticket.jpg') }}" alt="Default Ticket">
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="ticket-body">
                        <h5 class="ticket-title">{{ $tiket->nama_tiket }}</h5>

                        <p class="ticket-category">
                            Kategori: {{ $tiket->kategori ?? 'Umum' }}
                        </p>

                        <p class="ticket-desc">
                            {{ \Illuminate\Support\Str::limit($tiket->deskripsi, 100, '...') }}
                        </p>

                        <p class="ticket-price">
                            Harga: Rp {{ number_format($tiket->harga, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('user.pesan.form', $tiket->id) }}"
                           class="btn btn-ticket">
                            Beli Tiket
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-center">Tidak ada tiket tersedia.</p>
        @endforelse
    </div>
</div>
@endsection