@extends('petugas.layout.app')

@section('content')

<style>

.scan-wrapper{
    max-width:650px;
    margin:auto;
}

.scan-card{
    padding:35px;
}

.scan-title{
    text-align:center;
    margin-bottom:25px;
}

.scan-title h2{
    font-weight:700;
}

.scan-title p{
    color:#b9c0d3;
}

.start-btn{
    width:100%;
    border:none;
    background:#08d665;
    color:white;
    padding:15px;
    border-radius:14px;
    font-weight:600;
    margin-bottom:20px;
    box-shadow:0 0 25px rgba(8,214,101,.35);
}

.start-btn:hover{
    background:#06c15b;
}

#reader{
    overflow:hidden;
    border-radius:18px;
    border:2px solid rgba(255,255,255,.08);
}

#scan-result{
    margin-top:20px;
}

.result-success{
    background:#0fd46c20;
    border:1px solid #0fd46c;
    color:#0fd46c;
    padding:15px;
    border-radius:12px;
}

.result-error{
    background:#ff4d4d20;
    border:1px solid #ff4d4d;
    color:#ff7070;
    padding:15px;
    border-radius:12px;
}
</style>

<div class="scan-wrapper">

    <div class="glass-card scan-card">

        <div class="scan-title">
            <h2>📷 Scan Tiket QR</h2>
            <p>Arahkan kamera ke QR Code tiket</p>
        </div>

        <button class="start-btn" onclick="startScanner()">
            Mulai Scan Kamera
        </button>

        <div id="reader"></div>

        <div id="scan-result"></div>

    </div>

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

        scanner.start(
            devices[0].id,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        );

    })
    .catch(() => {
        alert("Izin kamera ditolak");
    });
}

function onScanSuccess(decodedText) {

    if(sudahScan) return;

    sudahScan = true;
    scanner.stop();

    let kodeQr = decodedText.split('/').pop();

    fetch("{{ route('petugas.scan.submit') }}",{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body:JSON.stringify({
            kode_qr:kodeQr
        })
    })
    .then(res=>res.json())
    .then(data=>{

        document.getElementById('scan-result').innerHTML=
        `<div class="result-success">${data.message}</div>`;

        sudahScan = false;
    });
}
</script>

@endsection