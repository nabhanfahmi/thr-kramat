<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Pengelola</title>
    <link href="{{ asset('vendor/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card shadow-lg my-5">
                <div class="card-body p-4">

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Register Pengelola</h1>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pengelola.register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" class="form-control form-control-user" name="name" placeholder="Nama Lengkap" required>
                        </div>

                        <div class="form-group mb-3">
                            <input type="email" class="form-control form-control-user" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a class="small" href="{{ route('pengelola.login') }}">Sudah punya akun? Login di sini</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
