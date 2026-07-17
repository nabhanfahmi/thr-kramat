@extends('petugas.layout.app')

@section('content')

<style>
.dashboard-box{
    max-width:700px;
    margin:auto;
}

.welcome-card{
    text-align:center;
    padding:60px 40px;
}

.welcome-card img{
    width:120px;
    margin-bottom:25px;
}

.welcome-card h1{
    font-size:2.3rem;
    font-weight:700;
    margin-bottom:15px;
}

.welcome-card p{
    color:#b7c0d4;
    margin-bottom:35px;
}

.scan-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:#08d665;
    color:white;
    padding:16px 35px;
    border-radius:15px;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
    box-shadow:0 0 25px rgba(8,214,101,.4);
}

.scan-btn:hover{
    transform:translateY(-4px);
    color:white;
}
</style>

<div class="dashboard-box">

    <div class="glass-card welcome-card">

        <img src="{{ asset('img/logo/logothr.png') }}" alt="logo-image">

        <h1>Selamat Datang Petugas</h1>

        <p>
            Silakan lakukan pemindaian tiket pengunjung
            menggunakan kamera perangkat Anda.
        </p>

        <a href="{{ route('petugas.scan') }}" class="scan-btn">
            📷 Mulai Scan Tiket
        </a>

    </div>

</div>

@endsection