<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Pengelola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SB Admin 2 Lokal -->
    <link href="{{ asset('vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-4">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Login Pengelola</h1>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="pengelola" method="POST" action="{{ route('pengelola.login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>

                    <hr>
                    {{-- Rute register belum dibuat, nanti bisa ditambahkan di sini --}}
                    <div class="text-center">
                        <a class="small" href="{{ route('pengelola.register') }}">
                            Belum punya akun? Daftar di sini
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">
                            ← Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- SB Admin 2 JS -->
<script src="{{ asset('vendor/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
