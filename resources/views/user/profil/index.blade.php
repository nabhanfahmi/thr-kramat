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

.profile-wrapper{

    min-height:100vh;

    padding:35px 15px;
}

/* =========================
   CONTAINER
========================= */

.profile-container{

    width:100%;

    max-width:1100px;

    margin:auto;

    background:#fff;

    border-radius:28px;

    padding:35px;

    box-shadow:
        0 15px 40px rgba(111,66,193,.08);
}

/* =========================
   TITLE
========================= */

.page-title{

    text-align:center;

    margin-bottom:35px;
}

.page-title h2{

    font-size:2rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:8px;
}

.page-title p{

    color:#777;

    font-size:.95rem;
}

/* =========================
   ALERT
========================= */

.alert{

    border:none;

    border-radius:16px;

    padding:16px 18px;

    font-weight:600;
}

.alert-success{

    background:#eafaf0;

    color:#18a957;
}

.alert-danger{

    background:#ffeaea;

    color:#dc3545;
}

/* =========================
   PROFILE TOP
========================= */

.profile-top{

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    margin-bottom:35px;
}

.profile-image{

    width:130px;

    height:130px;

    border-radius:50%;

    object-fit:cover;

    border:5px solid #fff;

    box-shadow:
        0 10px 25px rgba(111,66,193,.18);

    margin-bottom:15px;
}

.profile-name{

    font-size:1.3rem;

    font-weight:800;

    color:#2d2d2d;
}

.profile-email{

    color:#777;

    font-size:.92rem;
}

/* =========================
   CARD SECTION
========================= */

.section-card{

    background:#fff;

    border-radius:24px;

    padding:28px;

    box-shadow:
        0 8px 24px rgba(0,0,0,.05);

    margin-bottom:30px;
}

.section-title{

    font-size:1.1rem;

    font-weight:800;

    color:#6f42c1;

    margin-bottom:22px;
}

/* =========================
   FORM
========================= */

.form-label{

    font-weight:700;

    color:#555;

    margin-bottom:8px;
}

.form-control{

    border:none !important;

    background:#e5e7ff !important;

    border-radius:16px !important;

    padding:14px 16px !important;

    font-size:.95rem;

    box-shadow:none !important;

    transition:.25s;
}

.form-control:focus{

    background:#fff !important;

    box-shadow:
        0 0 0 4px rgba(111,66,193,.12) !important;
}

/* =========================
   BUTTON
========================= */

.btn{

    border:none !important;

    border-radius:16px !important;

    padding:13px 20px !important;

    font-size:.9rem !important;

    font-weight:700 !important;

    transition:.25s;
}

.btn:hover{

    transform:translateY(-2px);
}

.btn-primary{

    background:
        linear-gradient(
            135deg,
            #6f42c1,
            #9b6dff
        ) !important;
}

.btn-dark{

    background:
        linear-gradient(
            135deg,
            #2d2d2d,
            #555
        ) !important;
}

/* =========================
   DIVIDER
========================= */

.custom-divider{

    height:1px;

    background:#f1f1f1;

    margin:35px 0;
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .profile-wrapper{

        padding:20px 10px;
    }

    .profile-container{

        padding:22px 16px;

        border-radius:24px;
    }

    .page-title h2{

        font-size:1.5rem;
    }

    .section-card{

        padding:20px;
    }

    .btn{

        width:100%;
    }

    .profile-image{

        width:110px;
        height:110px;
    }
}

</style>

<div class="profile-wrapper">

    <div class="profile-container">

        {{-- TITLE --}}
        <div class="page-title">

            <h2>Profil Saya</h2>

            <p>
                Kelola informasi akun dan keamanan profil kamu.
            </p>

        </div>

        {{-- ALERT --}}
        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif

        {{-- PROFILE TOP --}}
        <div class="profile-top">

            @if(Auth::user()->foto)

                <img
                    src="{{ asset('uploads/profil/' . Auth::user()->foto) }}"
                    class="profile-image">

            @else

                <img
                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6f42c1&color=fff&size=200"
                    class="profile-image">

            @endif

            <div class="profile-name">
                {{ Auth::user()->name }}
            </div>

            <div class="profile-email">
                {{ Auth::user()->email }}
            </div>

        </div>

        {{-- FORM PROFIL --}}
        <div class="section-card">

            <div class="section-title">
                Informasi Profil
            </div>

            <form
                action="{{ route('user.profil.update') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ Auth::user()->name }}">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ Auth::user()->email }}">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Nomor HP
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ Auth::user()->no_hp }}">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Foto Profil
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control">

                    </div>

                    <!-- <div class="col-12 mb-4">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            rows="4"
                            class="form-control">{{ Auth::user()->alamat }}</textarea>

                    </div> -->

                </div>

                <button class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </form>

        </div>

        {{-- PASSWORD --}}
        <div class="section-card">

            <div class="section-title">
                Ubah Password
            </div>

            <form
                action="{{ route('user.profil.password') }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <label class="form-label">
                            Password Lama
                        </label>

                        <input
                            type="password"
                            name="password_lama"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-4">

                        <label class="form-label">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password_baru"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-4">

                        <label class="form-label">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_baru_confirmation"
                            class="form-control">

                    </div>

                </div>

                <button class="btn btn-dark">

                    Update Password

                </button>

            </form>

        </div>

    </div>

</div>

@endsection