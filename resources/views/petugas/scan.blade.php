@extends('petugas.layout.app')

@section('content')

<style>
.scanner-container {
    max-width: 420px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    text-align: center;
}

#reader {
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
}

button {
    padding: 10px 20px;
    border: none;
    background: #2c97e8;
    color: white;
    border-radius: 10px;
    margin-bottom: 15px;
}
</style>

<div class="scanner-container">

    <h3>Scan Tiket QR</h3>

    <button onclick="startScanner()">
        📷 Mulai Scan Kamera
    </button>

    <div id="reader"></div>
    <div id="scan-result"></div>

</div>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>

let scanner;
let sudahScan = false;

function startScanner() {

    if (!scanner) {
        scanner = new Html5Qrcode("reader");
    }

    Html5Qrcode.getCameras()
    .then(devices => {

        if (!devices.length) {
            alert("Kamera tidak ditemukan");
            return;
        }

        let cameraId = devices[0].id;

        scanner.start(
            cameraId,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        ).catch(err => {
            console.log(err);
            alert("Tidak bisa membuka kamera. Cek izin browser.");
        });

    })
    .catch(err => {
        console.log(err);
        alert("Izin kamera ditolak");
    });
}

function onScanSuccess(decodedText) {

    if (sudahScan) return;
    sudahScan = true;

    scanner.stop();

    let kodeQr = decodedText.split('/').pop();

    fetch("{{ route('petugas.scan.submit') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: JSON.stringify({ kode_qr: kodeQr })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("scan-result").innerHTML = data.message;
        sudahScan = false;
    });

}

</script>

@endsection