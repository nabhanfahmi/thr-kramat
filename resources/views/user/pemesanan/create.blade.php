@extends('user.layout.user')

@section('content')

<style>

/* =========================
   BODY
========================= */

body{
    background:
        linear-gradient(
            135deg,
            #f3f0ff,
            #ffffff
        );
}

/* =========================
   WRAPPER
========================= */

.booking-wrapper{

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:30px 15px;
}

/* =========================
   CARD
========================= */

.booking-card{

    width:100%;

    max-width:650px;

    background:#fff;

    border-radius:28px;

    padding:35px;

    box-shadow:
        0 15px 40px rgba(111,66,193,.10);

    position:relative;

    overflow:hidden;
}

.booking-card::before{

    content:"";

    position:absolute;

    top:-80px;
    right:-80px;

    width:220px;
    height:220px;

    background:
        linear-gradient(
            135deg,
            rgba(111,66,193,.15),
            rgba(155,109,255,.08)
        );

    border-radius:50%;
}

/* =========================
   TITLE
========================= */

.booking-title{

    text-align:center;

    margin-bottom:30px;

    position:relative;

    z-index:2;
}

.booking-title h3{

    font-size:2rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:8px;
}

.booking-title p{

    color:#777;

    font-size:.95rem;
}

/* =========================
   FORM
========================= */

.form-group{

    margin-bottom:22px;

    position:relative;

    z-index:2;
}

.form-label{

    display:block;

    margin-bottom:8px;

    font-weight:700;

    color:#5b35a0;

    font-size:.95rem;
}

.form-control{

    width:100%;

    border:none;

    background:#f7f5ff;

    border-radius:16px;

    padding:15px 18px;

    font-size:.95rem;

    color:#333;

    transition:.25s;

    box-shadow:
        inset 0 0 0 1px #ece8ff;
}

.form-control:focus{

    background:#fff;

    box-shadow:
        0 0 0 4px rgba(111,66,193,.12);

    outline:none;
}

/* =========================
   BUTTONS
========================= */

.button-group{

    display:flex;

    gap:14px;

    margin-top:30px;

    position:relative;

    z-index:2;
}

.btn-submit{

    flex:1;

    border:none;

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        );

    color:#fff;

    padding:14px;

    border-radius:16px;

    font-weight:700;

    font-size:.95rem;

    transition:.25s;

    text-decoration:none;
}

.btn-submit:hover{

    transform:translateY(-2px);

    box-shadow:
        0 10px 20px rgba(111,66,193,.20);

    color:#fff;
}

.btn-cancel{

    flex:1;

    background:#f3f3f3;

    color:#444;

    padding:14px;

    border-radius:16px;

    font-weight:700;

    font-size:.95rem;

    text-align:center;

    text-decoration:none;

    transition:.25s;
}

.btn-cancel:hover{

    background:#e8e8e8;

    transform:translateY(-2px);

    color:#222;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .booking-card{

        padding:25px 20px;

        border-radius:22px;
    }

    .booking-title h3{
        font-size:1.6rem;
    }

    .button-group{

        flex-direction:column;
    }

    .btn-submit,
    .btn-cancel{
        width:100%;
    }
}

</style>

<div class="booking-wrapper">

    <div class="booking-card">

        {{-- TITLE --}}
        <div class="booking-title">

            <h3>
                Pesan Tiket
            </h3>

            <p>
                {{ $tiket->nama_wisata }}
            </p>

        </div>

        {{-- FORM --}}
        <form action="{{ route('user.pesan.store', $tiket->id) }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="jumlah_tiket" class="form-label">
                    Jumlah Tiket
                </label>

                <input
                    type="number"
                    name="jumlah_tiket"
                    id="jumlah_tiket"
                    min="1"
                    class="form-control"
                    placeholder="Masukkan jumlah tiket"
                    required>

            </div>

            <div class="form-group">

                <label for="tanggal_kunjungan" class="form-label">
                    Tanggal Kunjungan
                </label>

                <input
                    type="date"
                    name="tanggal_kunjungan"
                    id="tanggal_kunjungan"
                    class="form-control"
                    required>

            </div>

            <div class="button-group">

                <button type="submit" class="btn-submit">
                    Pesan Sekarang
                </button>

                <a
                    href="{{ route('user.tiket.index') }}"
                    class="btn-cancel">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection