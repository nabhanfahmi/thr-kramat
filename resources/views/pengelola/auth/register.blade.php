<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Pengelola | THR Kramat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px 20px;

            background:
            radial-gradient(circle at top left, rgba(127,92,255,0.35), transparent 30%),
            radial-gradient(circle at bottom right, rgba(0,229,255,0.2), transparent 30%),
            #050816;
        }

        .register-card{

            width:100%;
            max-width:480px;

            background:rgba(255,255,255,0.06);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(18px);

            border-radius:30px;

            padding:45px;

            box-shadow:
            0 0 30px rgba(127,92,255,0.25),
            0 0 60px rgba(0,229,255,0.08);

        }

        .title{
            text-align:center;
            color:white;
            margin-bottom:30px;
            font-size:2rem;
        }

        .form-control{
            width:100%;
            height:55px;

            border:none;
            outline:none;

            border-radius:15px;

            padding:0 18px;

            margin-bottom:18px;

            background:rgba(255,255,255,0.08);

            color:white;
        }

        .form-control::placeholder{
            color:#d0d9ff;
        }

        .register-btn{

            width:100%;
            height:55px;

            border:none;

            border-radius:15px;

            background:linear-gradient(135deg,#7f5cff,#00e5ff);

            color:white;

            font-weight:600;

            transition:0.4s;

        }

        .register-btn:hover{
            transform:translateY(-3px);
        }

        .text-link{
            text-align:center;
            margin-top:20px;
        }

        .text-link a{
            color:#00e5ff;
            text-decoration:none;
        }

        .alert{
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
            background:#ff3d71;
            color:white;
        }

        .password-box{
            position:relative;
            margin-bottom:18px;
        }

        .password-box .form-control{
            margin-bottom:0;
            padding-right:50px;
        }

        .toggle-password{
            position:absolute;
            right:18px;
            top:50%;
            transform:translateY(-50%);
            color:#d0d9ff;
            cursor:pointer;
            transition:0.3s;
        }

        .toggle-password:hover{
            color:#00e5ff;
        }

    </style>
</head>

<body>

<div class="register-card">

    <h1 class="title">Register Pengelola</h1>

    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('pengelola.register') }}">
        @csrf

        <input type="text"
               class="form-control"
               name="name"
               placeholder="Nama Lengkap"
               required>

        <input type="email"
               class="form-control"
               name="email"
               placeholder="Email"
               required>

        <div class="password-box">
            <input type="password"
                class="form-control"
                name="password"
                id="registerPassword"
                placeholder="Password"
                required>

            <i class="fas fa-eye toggle-password"
            onclick="togglePassword('registerPassword', this)">
            </i>
        </div>

        <div class="password-box">
            <input type="password"
                class="form-control"
                name="password_confirmation"
                id="confirmPassword"
                placeholder="Konfirmasi Password"
                required>

            <i class="fas fa-eye toggle-password"
            onclick="togglePassword('confirmPassword', this)">
            </i>
        </div>

        <button type="submit" class="register-btn">
            Daftar Sekarang
        </button>

    </form>

    <div class="text-link">
        <a href="{{ route('pengelola.login') }}">
            Sudah punya akun? Login di sini
        </a>
    </div>

</div>

<script>
    function togglePassword(inputId, icon){

        const input = document.getElementById(inputId);

        if(input.type === "password"){
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }else{
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }

    }
</script>

</body>
</html>