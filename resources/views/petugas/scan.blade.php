@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Scan Tiket QR Code</h3>
    <div id="reader" style="width:300px; margin:auto;"></div>
    <p id="scan-result" class="mt-3"></p>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
function onScanSuccess(decodedText, decodedResult) {
    fetch("{{ route('petugas.scan.submit') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ kode_qr: decodedText })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('scan-result').innerHTML = data.message;
    });
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection
