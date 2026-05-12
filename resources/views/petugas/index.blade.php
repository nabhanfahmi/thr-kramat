@extends('petugas.layout.app')

@section('content')
<style>
    /* ====== Root Variables ====== */
    :root {
        --primary-gradient: linear-gradient(135deg, #4cafef, #2c97e8);
        --accent-color: #ffffff;
        --radius: 14px;
        --transition: all 0.3s ease;
    }

    /* ====== Container ====== */
    .dashboard-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 100px);
        background: #f3f8fe;
        padding: 20px;
    }

    /* ====== Card ====== */
    .menu-card {
        background: var(--primary-gradient);
        border-radius: var(--radius);
        box-shadow: 0px 10px 25px rgba(0,0,0,0.15);
        text-align: center;
        padding: 40px 30px;
        color: var(--accent-color);
        max-width: 400px;
        width: 100%;
        animation: fadeIn 0.5s ease-in-out;
    }

    .menu-card h1 {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .menu-card p {
        font-size: 1rem;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    /* ====== Scan Button ====== */
    .scan-button {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 15px 30px;
        border-radius: 50px;
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .scan-button:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    .scan-icon {
        font-size: 1.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="dashboard-container">
    <div class="menu-card">
        <h1>Selamat Datang, Petugas 🎫</h1>
        <p>Silakan pilih menu di bawah untuk melakukan tugas Anda</p>
        
        <!-- Tombol menuju scan.blade.php -->
        <a href="{{ route('petugas.scan') }}" class="scan-button">
            <span class="scan-icon">📷</span> Mulai Scan Tiket
        </a>
    </div>
</div>
@endsection
