@extends('user.layout.user')

@section('content')

<style>

    body{
        background:
            linear-gradient(
                135deg,
                #f3f0ff,
                #ffffff
            );
    }

    .dashboard-wrapper{
        min-height:100vh;

        display:flex;
        justify-content:center;
        align-items:center;

        padding:30px 15px;

        /* background:
        linear-gradient(135deg,#eef2ff,#f8fbff); */
    }

    .dashboard-container{

        width:100%;
        max-width:1000px;

        background:white;

        border-radius:28px;

        padding:35px;

        box-shadow:
        0 10px 35px rgba(0,0,0,0.08);

        animation:fadeIn 0.5s ease;
    }

    .dashboard-header{
        margin-bottom:30px;
    }

    .dashboard-title{
        font-size:2rem;
        font-weight:700;
        color:#5b21b6;
        margin-bottom:8px;
    }

    .dashboard-subtitle{
        color:#64748b;
        font-size:15px;
    }

    .section-title{
        font-size:1.3rem;
        font-weight:700;
        color:#1e293b;
        margin-bottom:20px;
    }

    .table-wrapper{
        overflow-x:auto;
        border-radius:20px;
    }

    .custom-table{
        width:100%;
        border-collapse:collapse;
        overflow:hidden;
        border-radius:20px;
    }

    .custom-table thead{
        background:
        linear-gradient(135deg,#6a11cb,#2575fc);
    }

    .custom-table thead th{
        color:white;
        font-size:14px;
        font-weight:600;
        padding:18px 15px;
        text-align:center;
        border:none;
    }

    .custom-table tbody tr{
        transition:0.3s;
        border-bottom:1px solid #eef2f7;
    }

    .custom-table tbody tr:hover{
        background:#f8faff;
    }

    .custom-table tbody td{
        padding:18px 15px;
        text-align:center;
        font-size:14px;
        color:#334155;
        font-weight:500;
    }

    .status-badge{

        display:inline-flex;
        align-items:center;
        justify-content:center;

        padding:8px 16px;

        border-radius:50px;

        font-size:13px;
        font-weight:600;
    }

    .status-success{
        background:#dcfce7;
        color:#166534;
    }

    .status-primary{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .status-warning{
        background:#fef3c7;
        color:#92400e;
    }

    .status-danger{
        background:#fee2e2;
        color:#b91c1c;
    }

    .status-secondary{
        background:#e2e8f0;
        color:#475569;
    }

    .empty-box{

        padding:40px 20px;

        border-radius:20px;

        background:#f8fafc;

        text-align:center;

        color:#64748b;
    }

    @keyframes fadeIn{

        from{
            opacity:0;
            transform:translateY(20px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }

    }

    @media(max-width:768px){

        .dashboard-container{
            padding:22px;
            border-radius:22px;
        }

        .dashboard-title{
            font-size:1.5rem;
        }

        .custom-table thead{
            display:none;
        }

        .custom-table,
        .custom-table tbody,
        .custom-table tr,
        .custom-table td{
            display:block;
            width:100%;
        }

        .custom-table tr{

            background:white;

            margin-bottom:18px;

            border-radius:18px;

            overflow:hidden;

            box-shadow:
            0 5px 18px rgba(0,0,0,0.06);

            border:none;
        }

        .custom-table td{

            text-align:right;

            padding:16px 18px;

            position:relative;

            border-bottom:1px solid #f1f5f9;
        }

        .custom-table td:last-child{
            border-bottom:none;
        }

        .custom-table td::before{

            content:attr(data-label);

            position:absolute;

            left:18px;

            font-weight:700;

            color:#6a11cb;

            text-align:left;
        }

    }

</style>

<div class="dashboard-wrapper">

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h1 class="dashboard-title">
                Dashboard Pengguna
            </h1>

            <p class="dashboard-subtitle">
                Selamat datang kembali,
                <strong>{{ Auth::user()->name }}</strong>
            </p>
        </div>

        <h3 class="section-title">
            Riwayat Pemesanan Tiket
        </h3>

        @if ($pemesanans->isEmpty())

            <div class="empty-box">
                Kamu belum pernah memesan tiket 🎟️
            </div>

        @else

            <div class="table-wrapper">

                <table class="custom-table">

                    <thead>
                        <tr>
                            <th>Nama Tiket</th>
                            <th>Jumlah</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($pemesanans as $p)

                            <tr>

                                <td data-label="Nama Tiket">
                                    {{ $p->tiket->nama_tiket }}
                                </td>

                                <td data-label="Jumlah">
                                    {{ $p->jumlah_tiket }}
                                </td>

                                <td data-label="Tanggal">
                                    {{ \Carbon\Carbon::parse($p->tanggal_kunjungan)->translatedFormat('d M Y') }}
                                </td>

                                <td data-label="Status">

                                    @switch($p->status)

                                        @case('dibayar')
                                            <span class="status-badge status-success">
                                                Dibayar
                                            </span>
                                            @break

                                        @case('selesai')
                                            <span class="status-badge status-primary">
                                                Selesai
                                            </span>
                                            @break

                                        @case('menunggu')
                                            <span class="status-badge status-warning">
                                                Menunggu
                                            </span>
                                            @break

                                        @case('gagal')
                                        @case('batal')
                                            <span class="status-badge status-danger">
                                                Gagal
                                            </span>
                                            @break

                                        @default
                                            <span class="status-badge status-secondary">
                                                {{ ucfirst($p->status) }}
                                            </span>

                                    @endswitch

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection