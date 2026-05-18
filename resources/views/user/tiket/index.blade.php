@extends('user.layout.user')

@section('content')

<style>

    body{
        background:
        linear-gradient(135deg,#eef2ff,#f8fbff);
    }

    .ticket-page{
        padding:35px 10px;
    }

    .ticket-heading{
        text-align:center;
        margin-bottom:40px;
    }

    .ticket-heading h2{
        font-size:2.2rem;
        font-weight:800;

        background:linear-gradient(135deg,#6a11cb,#2575fc);
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;

        margin-bottom:10px;
    }

    .ticket-heading p{
        color:#64748b;
        font-size:15px;
    }

    .ticket-card{

        border:none;
        border-radius:28px;

        overflow:hidden;

        background:white;

        height:100%;

        transition:0.35s ease;

        box-shadow:
        0 10px 30px rgba(0,0,0,0.07);

        position:relative;
    }

    .ticket-card:hover{
        transform:translateY(-8px);

        box-shadow:
        0 18px 40px rgba(0,0,0,0.12);
    }

    .ticket-image{
        width:100%;
        height:230px;
        overflow:hidden;
        position:relative;
    }

    .ticket-image img{
        width:100%;
        height:100%;
        object-fit:cover;

        transition:0.5s ease;
    }

    .ticket-card:hover .ticket-image img{
        transform:scale(1.08);
    }

    .ticket-overlay{

        position:absolute;
        inset:0;

        background:
        linear-gradient(to top,
        rgba(0,0,0,0.5),
        transparent 60%);
    }

    .ticket-body{
        padding:22px;
        display:flex;
        flex-direction:column;
        height:calc(100% - 230px);
    }

    .ticket-category{

        display:inline-block;

        width:max-content;

        padding:6px 14px;

        border-radius:50px;

        font-size:12px;
        font-weight:600;

        background:#ede9fe;
        color:#6d28d9;

        margin-bottom:15px;
    }

    .ticket-title{
        font-size:1.4rem;
        font-weight:700;
        color:#1e293b;
        margin-bottom:12px;
    }

    .ticket-desc{
        color:#64748b;
        font-size:14px;
        line-height:1.7;
        margin-bottom:18px;
    }

    .ticket-footer{
        margin-top:auto;
    }

    .ticket-price{
        font-size:1.25rem;
        font-weight:800;
        color:#111827;
        margin-bottom:18px;
    }

    .btn-ticket{

        width:100%;
        height:52px;

        border:none;
        border-radius:16px;

        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;

        text-decoration:none;

        background:
        linear-gradient(135deg,#6a11cb,#2575fc);

        color:white;

        font-weight:700;

        transition:0.3s ease;
    }

    .btn-ticket:hover{

        transform:translateY(-2px);

        color:white;

        text-decoration:none;

        box-shadow:
        0 10px 25px rgba(106,17,203,0.35);
    }

    .empty-ticket{

        background:white;

        padding:60px 30px;

        border-radius:25px;

        text-align:center;

        box-shadow:
        0 10px 30px rgba(0,0,0,0.06);
    }

    .empty-ticket i{
        font-size:60px;
        color:#94a3b8;
        margin-bottom:20px;
    }

    .empty-ticket h4{
        color:#334155;
        margin-bottom:10px;
    }

    .empty-ticket p{
        color:#64748b;
    }

    @media(max-width:768px){

        .ticket-page{
            padding:25px 5px;
        }

        .ticket-heading h2{
            font-size:1.7rem;
        }

        .ticket-image{
            height:210px;
        }

        .ticket-body{
            padding:18px;
        }

        .ticket-title{
            font-size:1.2rem;
        }

    }

</style>

<div class="container-fluid ticket-page">

    <!-- <div class="ticket-heading">
        <h2>Daftar Tiket Wisata</h2>
        <p>
            Pilih tiket terbaik dan nikmati pengalaman wisata seru 🎡
        </p>
    </div> -->

    <div class="row">

        @forelse($tikets as $tiket)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="ticket-card">

                    <div class="ticket-image">

                        @if($tiket->gambar_tiket)

                            <img src="{{ asset($tiket->gambar_tiket) }}"
                                 alt="{{ $tiket->nama_tiket }}">

                        @else

                            <img src="{{ asset('img/default-ticket.jpg') }}"
                                 alt="Default Ticket">

                        @endif

                        <div class="ticket-overlay"></div>

                    </div>

                    <div class="ticket-body">

                        <span class="ticket-category">
                            {{ $tiket->kategori ?? 'Tiket Umum' }}
                        </span>

                        <h3 class="ticket-title">
                            {{ $tiket->nama_tiket }}
                        </h3>

                        <p class="ticket-desc">
                            {{ \Illuminate\Support\Str::limit($tiket->deskripsi, 100, '...') }}
                        </p>

                        <div class="ticket-footer">

                            <div class="ticket-price">
                                Rp {{ number_format($tiket->harga,0,',','.') }}
                            </div>

                            <a href="{{ route('user.pesan.form', $tiket->id) }}"
                               class="btn-ticket">

                                <i class="fas fa-ticket-alt"></i>
                                Beli Tiket

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="empty-ticket">

                    <i class="fas fa-ticket-alt"></i>

                    <h4>Tiket Belum Tersedia</h4>

                    <p>
                        Saat ini belum ada tiket wisata yang tersedia.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection