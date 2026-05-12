@extends('user.layout.user')

@section('content')

<div class="container mt-5">

    <div class="card shadow border-0 rounded-4 p-4">

        <h2 class="mb-4 text-center text-primary">
            Konfirmasi Pembayaran
        </h2>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Detail Pemesanan --}}
        <table class="table table-bordered">

            <tr>
                <th width="35%">Kode Transaksi</th>
                <td>{{ $pemesanans->kode_transaksi }}</td>
            </tr>

            <tr>
                <th>Nama Tiket</th>
                <td>{{ $pemesanans->tiket->nama_tiket ?? '-' }}</td>
            </tr>

            <tr>
                <th>Jumlah Tiket</th>
                <td>{{ $pemesanans->jumlah_tiket }}</td>
            </tr>

            <tr>
                <th>Tanggal Kunjungan</th>
                <td>
                    {{ \Carbon\Carbon::parse($pemesanans->tanggal_kunjungan)->translatedFormat('d F Y') }}
                </td>
            </tr>

            <tr>
                <th>Total Harga</th>
                <td>
                    <strong class="text-success">
                        Rp{{ number_format($pemesanans->total_harga, 0, ',', '.') }}
                    </strong>
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($pemesanans->status == 'menunggu')
                        <span class="badge bg-warning text-dark">
                            Menunggu Pembayaran
                        </span>

                    @elseif($pemesanans->status == 'dibayar')
                        <span class="badge bg-success">
                            Sudah Dibayar
                        </span>

                    @elseif($pemesanans->status == 'batal')
                        <span class="badge bg-danger">
                            Dibatalkan
                        </span>

                    @else
                        <span class="badge bg-secondary">
                            {{ ucfirst($pemesanans->status) }}
                        </span>
                    @endif
                </td>
            </tr>

        </table>

        {{-- Tombol Bayar --}}
        @if($pemesanans->status == 'menunggu')

            <div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">

                <button id="pay-button" class="btn btn-primary btn-lg px-4">
                    Bayar Sekarang
                </button>

                <a href="{{ route('user.pemesanan.index') }}"
                class="btn btn-warning btn-lg px-4">
                    Nanti
                </a>

            </div>

        @else

            <div class="alert alert-info text-center mt-3">
                Pembayaran sudah diproses.
            </div>

        @endif

    </div>

</div>

{{-- Midtrans Snap --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>

<script type="text/javascript">

    const payButton = document.getElementById('pay-button');

    if (payButton) {

        payButton.addEventListener('click', function () {

            snap.pay('{{ $snapToken }}', {

                onSuccess: function(result) {

                    alert("Pembayaran berhasil!");

                    console.log(result);

                    window.location.href =
                        "{{ route('user.pemesanan.index') }}";
                },

                onPending: function(result) {

                    alert("Menunggu pembayaran!");

                    console.log(result);

                    window.location.href =
                        "{{ route('user.pemesanan.index') }}";
                },

                onError: function(result) {

                    alert("Pembayaran gagal!");

                    console.log(result);
                },

                onClose: function() {

                    alert('Pembayaran belum diselesaikan.');

                    window.location.href =
                        "{{ route('user.pemesanan.index') }}";
                }
            });

        });

    }

</script>

@endsection