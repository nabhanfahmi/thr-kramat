@extends('pengelola.layout.pengelola')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard Pengelola</h1>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemesanan</div>
                    <a href="{{ route('pengelola.pemesanan.index') }}" class="btn btn-sm btn-primary mt-2">Ekspor Data Pemesanan</a>
                </div>
            </div>
        </div>

        <!-- {{-- Tambahkan menu lain yang memang pengelola butuhkan --}}
        {{-- Contoh: Laporan --}}
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laporan</div>
                    <a href="{{ route('pengelola.laporan.index') }}" class="btn btn-sm btn-success mt-2">Lihat Laporan</a>
                </div>
            </div>
        </div> -->

    </div>
@endsection
