<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Pengelola | THR Kramat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

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
            overflow:hidden;

            background:
            radial-gradient(circle at top left, rgba(127,92,255,0.35), transparent 30%),
            radial-gradient(circle at bottom right, rgba(0,229,255,0.2), transparent 30%),
            #050816;
        }

        .stars{
            position:fixed;
            inset:0;
            background-image:
            radial-gradient(2px 2px at 20px 30px, #fff, transparent),
            radial-gradient(2px 2px at 40px 70px, #00e5ff, transparent),
            radial-gradient(1px 1px at 90px 40px, #7f5cff, transparent);

            background-size:200px 200px;
            opacity:0.25;
            animation:starsMove 100s linear infinite;
        }

        @keyframes starsMove{
            from{transform:translateY(0);}
            to{transform:translateY(-200px);}
        }

        .login-card{
            width:100%;
            max-width:430px;

            background:rgba(255,255,255,0.06);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(18px);

            border-radius:30px;

            padding:45px;

            position:relative;
            z-index:2;

            box-shadow:
            0 0 30px rgba(127,92,255,0.25),
            0 0 60px rgba(0,229,255,0.08);
        }

        .logo{
            text-align:center;
            margin-bottom:25px;
        }

        .logo img{
            width:90px;
        }

        .title{
            text-align:center;
            color:white;
            margin-bottom:30px;
            font-size:2rem;
            font-weight:700;
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

        .login-btn{
            width:100%;
            height:55px;

            border:none;

            border-radius:15px;

            background:linear-gradient(135deg,#7f5cff,#00e5ff);

            color:white;

            font-weight:600;

            transition:0.4s;
        }

        .login-btn:hover{
            transform:translateY(-3px);
            box-shadow:0 0 20px rgba(127,92,255,0.5);
        }

        .text-link{
            text-align:center;
            margin-top:20px;
        }

        .text-link a{
            color:#00e5ff;
            text-decoration:none;
        }

        .back-btn{
            display:block;
            margin-top:18px;
            text-align:center;

            padding:12px;

            border-radius:15px;

            border:1px solid rgba(255,255,255,0.1);

            color:white;

            text-decoration:none;
        }

        .alert{
            padding:15px;
            border-radius:15px;
            margin-bottom:20px;
            background:#ff3d71;
            color:white;
            text-align:center;
        }

        @media(max-width:500px){

            .login-card{
                margin:20px;
                padding:35px 25px;
            }

            .title{
                font-size:1.6rem;
            }

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

<div class="stars"></div>

<div class="login-card">

    <div class="logo">
        <img src="{{ asset('img/logo/logothr.png') }}">
    </div>

    <h1 class="title">Login Pengelola</h1>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('pengelola.login') }}">
        @csrf

        <input type="email"
               class="form-control"
               name="email"
               placeholder="Masukkan Email"
               required>

        <div class="password-box">
            <input type="password"
                class="form-control"
                name="password"
                id="loginPassword"
                placeholder="Masukkan Password"
                required>

            <i class="fas fa-eye toggle-password"
            onclick="togglePassword('loginPassword', this)">
            </i>
        </div>

        <button type="submit" class="login-btn">
            Login Sekarang
        </button>
    </form>

    <div class="text-link">
        <a href="{{ route('pengelola.register') }}">
            Belum punya akun? Daftar di sini
        </a>
    </div>

    <a href="{{ url('/') }}" class="back-btn">
        ← Kembali ke Beranda
    </a>

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