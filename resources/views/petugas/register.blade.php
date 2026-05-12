<!DOCTYPE html>
<html>
<head>
    <title>Register Petugas</title>
</head>
<body>

<h2>Register Petugas</h2>

<form action="{{ route('petugas.register.submit') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nama" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <br><br>

    <button type="submit">
        Register
    </button>
</form>

<br>

<a href="{{ route('petugas.login') }}">
    Sudah punya akun? Login
</a>

</body>
</html>