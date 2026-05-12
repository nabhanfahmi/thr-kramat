@extends('user.layout.user')

@section('content')
<div class="container mt-5">
    <h3>Silakan Selesaikan Pembayaran</h3>
    <p>Total: <strong>Rp{{ number_format($pemesanans->total_harga, 0, ',', '.') }}</strong></p>
    @if (!$snapToken)
        <div class="alert alert-danger">
            Token pembayaran tidak tersedia. Silakan coba lagi nanti atau hubungi admin.
        </div>
    @else
        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    @endif
</div>

{{-- Snap.js Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_Key') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('user.pemesanan.index') }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran.");
                window.location.href = "{{ route('user.pemesanan.index') }}";
            },
            onError: function(result){
                alert("Pembayaran gagal.");
                console.error(result);
            },
            onClose: function(){
                alert("Kamu menutup popup tanpa menyelesaikan pembayaran");
            }
        });
    });
</script>
@endsection
