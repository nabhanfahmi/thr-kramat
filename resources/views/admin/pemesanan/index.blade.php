@extends('admin.layout.admin')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4cafef, #2c97e8);
        --danger-gradient: linear-gradient(135deg, #ff6a6a, #ff4d4d);
        --radius: 14px;
        --transition: all 0.3s ease;
    }

    /* Card */
    .card-custom {
        background: #fff;
        border-radius: var(--radius);
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        transition: var(--transition);
    }
    .card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    /* Section Title */
    .section-title {
        font-weight: 700;
        font-size: 26px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Form */
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: var(--transition);
    }
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(40,167,69,0.15);
    }

    /* Table Responsive */
    .table-wrapper {
        overflow-x: auto;
    }
    table {
        min-width: 800px;
        border-radius: 10px;
        overflow: hidden;
    }
    table th,
    table td {
        text-align: center;
    }
    thead {
        background: var(--primary-gradient);
        color: white;
    }
    tbody tr:hover {
        background-color: #f6fdf8 !important;
    }

    /* Badge */
    .badge-status {
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 500;
    }

    /* Stat Card */
    .stat-card {
        background: var(--primary-gradient);
        color: white;
        border-radius: var(--radius);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .stat-card .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-card .icon-box i {
        font-size: 28px;
    }
    .stat-card .value {
        font-size: 30px;
        font-weight: 700;
    }
    .stat-card .label {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Toast Wrapper */
.toast-custom {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1055;
    min-width: 300px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideIn 0.4s ease-out;
    display: flex;
    flex-direction: column;
}
.toast-custom .toast-header {
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    color: white;
}
.toast-custom .toast-body {
    padding: 12px 14px;
    font-size: 15px;
    background: white;
    color: #333;
}

/* Variasi warna */
.toast-warning .toast-header {
    background: linear-gradient(135deg, #ff6a6a, #ff4d4d);
}
.toast-error .toast-header {
    background: linear-gradient(135deg, #ff6a6a, #ff4d4d);
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}


</style>

@if(session('error'))
    <div class="alert alert-danger mb-3">
        {{ session('error') }}
    </div>
@endif

{{-- Export Form --}}
<div class="card-custom mb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="fw-semibold m-0">📤 Export Data Pemesanan</h5>
        <button class="btn btn-sm btn-outline-secondary" type="button" 
                data-bs-toggle="collapse" data-bs-target="#exportCollapse" 
                aria-expanded="false" aria-controls="exportCollapse">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="exportCollapse" class="collapse">
        <form id="formExport" action="{{ route('admin.pemesanan.export') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>

            <div class="col-md-3">
                <label for="jenis" class="form-label">Jenis Laporan</label>
                <select name="jenis" id="jenis" class="form-select">
                    <option value="harian" {{ request('jenis') == 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="bulanan" {{ request('jenis') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ request('jenis') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="status_export" class="form-label">Status Pemesanan</label>
                <select name="status" id="status_export" class="form-select">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="tiket terpakai" {{ request('status') == 'tiket terpakai' ? 'selected' : '' }}>Tiket Terpakai</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="format" class="form-label">Format Export</label>
                <select name="format" id="format" class="form-select">
                    <option value="pdf" {{ request('format') == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="excel" {{ request('format') == 'excel' ? 'selected' : '' }}>Excel</option>
                </select>
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fa fa-download"></i>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Filter Form --}}
<div class="card-custom mb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="fw-semibold m-0">🔍 Filter Status</h5>
        <button class="btn btn-sm btn-outline-secondary" type="button" 
                data-bs-toggle="collapse" data-bs-target="#filterCollapse" 
                aria-expanded="false" aria-controls="filterCollapse">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="filterCollapse" class="collapse">
        <form action="{{ route('admin.pemesanan.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
            <label for="status_filter" class="fw-semibold mb-0">Filter Status:</label>
            <select name="status" id="status_filter" class="form-select w-auto">
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="tiket terpakai" {{ request('status') == 'tiket terpakai' ? 'selected' : '' }}>Tiket Terpakai</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
            <button type="submit" class="btn btn-primary">Terapkan</button>
        </form>
    </div>
</div>

{{-- Stat Card --}}
<div class="stat-card mt-4 shadow-lg">
    <div class="icon-box">
        <i class="bi bi-people-fill"></i>
    </div>
    <div>
        <div class="label">Total Pengunjung</div>
        <div class="value" id="totalPengunjung">0</div>
    </div>
</div>

{{-- Table --}}
<div class="card-custom mt-4 table-wrapper">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Tiket</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($pemesanans as $pemesanan)
            <tr>
                <td>{{ $pemesanan->id }}</td>

                <td>
                    {{ $pemesanan->user->name ?? '-' }}
                </td>

                <td>
                    {{ $pemesanan->tiket->nama_tiket ?? '-' }}
                </td>

                <td>{{ $pemesanan->jumlah_tiket }}</td>

                <td>
                    Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                </td>

                <td>
                    @php
                        $statusColors = [
                            'menunggu' => 'bg-warning text-white',
                            'dibayar'  => 'bg-success text-white',
                            'selesai'  => 'bg-primary text-white',
                            'tiket terpakai' => 'bg-dark text-white',
                            'batal'    => 'bg-danger',
                        ];
                    @endphp

                    <span class="badge-status badge {{ $statusColors[$pemesanan->status] ?? 'bg-secondary' }}">
                        {{ ucfirst($pemesanan->status) }}
                    </span>
                </td>

                <td>
                    {{ $pemesanan->created_at->format('d-m-Y H:i') }}
                </td>

                <td>
                    <a href="{{ route('admin.pemesanan.show', $pemesanan->id) }}"
                    class="btn btn-info btn-sm">
                        Detail
                    </a>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="8" class="text-center">
                    Data pemesanan tidak ditemukan.
                </td>
            </tr>
        @endforelse
    </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $pemesanans->links() }}
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Bootstrap JS harus sebelum script custom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    // Animasi angka
    const target = {{ $totalPengunjung }};
    const counter = document.getElementById("totalPengunjung");
    let count = 0;
    const speed = Math.max(1, Math.ceil(target / 50));

    const interval = setInterval(() => {
        count += speed;
        if(count >= target){
            count = target;
            clearInterval(interval);
        }
        counter.innerText = count.toLocaleString();
    }, 30);

    // Toggle icon collapse
    document.querySelectorAll("[data-bs-toggle='collapse']").forEach(btn => {
        const targetEl = document.querySelector(btn.dataset.bsTarget);

        // Set icon awal sesuai keadaan
        if (targetEl.classList.contains('show')) {
            btn.querySelector('i').classList.replace('bi-chevron-down', 'bi-chevron-up');
        } else {
            btn.querySelector('i').classList.replace('bi-chevron-up', 'bi-chevron-down');
        }

        targetEl.addEventListener('show.bs.collapse', () => {
            btn.querySelector('i').classList.replace('bi-chevron-down', 'bi-chevron-up');
        });
        targetEl.addEventListener('hide.bs.collapse', () => {
            btn.querySelector('i').classList.replace('bi-chevron-up', 'bi-chevron-down');
        });
    });

    // Validasi form export
    document.getElementById("formExport").addEventListener("submit", function (e) {
        const tanggal = document.getElementById("tanggal").value.trim();
        const hasData = document.querySelector("table tbody tr td") && 
                        !document.querySelector("table tbody tr td").textContent.includes("tidak ditemukan");

        function showToast(type, message) {
    const toast = document.getElementById("customToast");
    const toastMsg = document.getElementById("customToastMessage");
    const toastTitle = document.getElementById("toastTitle");

    // Reset class
    toast.className = "toast-custom";

    if (type === "warning") {
        toast.classList.add("toast-warning");
        toastTitle.textContent = "Peringatan";
    } else if (type === "error") {
        toast.classList.add("toast-error");
        toastTitle.textContent = "Kesalahan";
    }

    toastMsg.textContent = message;
    toast.classList.remove("d-none");

    setTimeout(() => {
        toast.classList.add("d-none");
    }, 3500);
}


if (!tanggal) {
    e.preventDefault();
    showToast("warning", "Silakan pilih tanggal terlebih dahulu!");
    return;
}
if (!hasData) {
    e.preventDefault();
    showToast("error", "Tidak ada data pemesanan yang sesuai dengan tanggal yang dipilih.");
    return;
}



    });
});
</script>

<div id="customToast" class="toast-custom d-none">
    <div class="toast-header">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span id="toastTitle">Peringatan</span>
    </div>
    <div class="toast-body" id="customToastMessage"></div>
</div>



@endsection
