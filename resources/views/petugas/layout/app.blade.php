<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Petugas Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            min-height:100vh;
            background:
                radial-gradient(circle at top left,#251d5c 0%,#090b1f 45%,#040713 100%);
            color:white;
            font-family:'Poppins',sans-serif;
            overflow-x:hidden;
        }

        /* bintang */
        body::before{
            content:"";
            position:fixed;
            inset:0;
            background-image:
                radial-gradient(white 1px, transparent 1px);
            background-size:50px 50px;
            opacity:.15;
            pointer-events:none;
        }

        .navbar-custom{
            background:rgba(12,16,40,.85);
            backdrop-filter:blur(15px);
            border-bottom:1px solid rgba(255,255,255,.08);
        }

        .brand-logo{
            font-size:22px;
            font-weight:700;
            color:#fff;
            text-decoration:none;
        }

        .logout-btn{
            border:none;
            padding:10px 18px;
            border-radius:12px;
            background:#ff4d4d;
            color:white;
            transition:.3s;
        }

        .logout-btn:hover{
            transform:translateY(-2px);
            background:#ff2e2e;
        }

        .content-wrapper{
            min-height:calc(100vh - 80px);
            padding:40px 20px;
        }

        .glass-card{
            background:rgba(14,18,45,.85);
            backdrop-filter:blur(15px);
            border-radius:24px;
            border:1px solid rgba(255,255,255,.06);
            box-shadow:
                0 0 30px rgba(0,255,128,.12),
                0 0 80px rgba(0,255,128,.08);
        }
    </style>

    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <a class="brand-logo" href="{{ route('petugas.dashboard') }}">
            THR KRAMAT
        </a>

        <form action="{{ route('petugas.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>

    </div>
</nav>

<div class="content-wrapper">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>