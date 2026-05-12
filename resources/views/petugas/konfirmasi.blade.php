@extends('petugas.layout.app')

@section('content')
<style>
    /* Styling Card & Status Badge */
    .ticket-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        padding: 20px;
        margin-top: 20px;
    }
    .status-badge {
        font-weight: bold;
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
    }
    .status-selesai {
        background: #d4edda;
        color: #155724;
    }
    .status-digunakan {
        background: #fff3cd;
        color: #856404;
    }
</style>

<div class="container mt-4">
    <h2 class="fw-bold text-dark">🎟 Konfirmasi Tiket</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    @if($message)
        <div class="alert alert-danger mt-3">{{ $message }}</div>
    @elseif($tiket)
        <div class="ticket-card">
            <table class="table table-bordered mb-0 text-dark">
                <tr>
                    <th class="bg-light">Kode QR</th>
                    <td>{{ $tiket->kode_qr }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Status</th>
                    <td>
                        @if($tiket->status === 'selesai')
                            <span class="status-badge status-selesai">✅ Selesai</span>
                        @else
                            <span class="status-badge status-digunakan">⚠️ Sudah Digunakan</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="bg-light">Tanggal Pemesanan</th>
                    <td>{{ $tiket->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>

            {{-- Tombol Validasi --}}
            @if($tiket->status === 'selesai')
                <form action="{{ route('petugas.validasi', $tiket->kode_qr) }}" method="POST" class="mt-3">
                    @csrf
                    <button class="btn btn-success w-100">✅ Validasi Tiket</button>
                </form>
            @else
                <div class="alert alert-warning mt-3">⚠️ Tiket ini sudah digunakan</div>
            @endif
        </div>
    @endif
</div>
@endsection
