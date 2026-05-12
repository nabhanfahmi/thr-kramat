<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sistem Tiket Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container text-center py-5">
        <h1 class="mb-4">Selamat Datang di Website Tiket Wisata Online</h1>

        <div class="d-grid gap-3 col-6 mx-auto">
            <a href="{{ route('admin.login') }}" class="btn btn-dark btn-lg">Login Admin</a>
            <a href="{{ route('pengelola.login') }}" class="btn btn-primary btn-lg">Login Pengelola</a>
            <a href="{{ route('user.login') }}" class="btn btn-primary btn-lg">Login User</a>
        </div>
    </div>

</body>
</html>

<!-- loginnya sudah pakai sidebar di welcome!!!!!!!!!!!! -->