<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard | THR Kramat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT AWESOME -->
    <link href="{{ asset('vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- SB ADMIN -->
    <link href="{{ asset('vendor/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{

            background:
            radial-gradient(circle at top left, rgba(127,92,255,0.20), transparent 30%),
            radial-gradient(circle at bottom right, rgba(0,229,255,0.12), transparent 30%),
            #050816 !important;

            overflow-x:hidden;

        }

        /* =========================================
            SIDEBAR
        ========================================= */

        .sidebar{

            background:
            linear-gradient(
                180deg,
                rgba(15,23,42,0.95),
                rgba(10,14,35,0.98)
            ) !important;

            backdrop-filter:blur(18px);

            border-right:1px solid rgba(255,255,255,0.08);

            box-shadow:
            0 0 25px rgba(127,92,255,0.15);

        }

        .sidebar .sidebar-brand{

            height:90px;

            color:white !important;

            font-size:1.2rem;

            font-weight:700;

            letter-spacing:1px;

        }

        .sidebar .sidebar-brand i{

            color:#00e5ff;

            filter:drop-shadow(0 0 10px #00e5ff);

        }

        /* MENU */

        .sidebar .nav-item{

            margin:8px 12px;

        }

        .sidebar .nav-item .nav-link{

            color:rgba(255,255,255,0.78);

            border-radius:14px;

            padding:14px 18px;

            transition:0.3s ease;

            display:flex;
            align-items:center;

        }

        .sidebar .nav-item .nav-link i{

            margin-right:12px;

            font-size:15px;

            min-width:18px;

        }

        .sidebar .nav-item .nav-link:hover{

            background:
            linear-gradient(
                135deg,
                rgba(127,92,255,0.22),
                rgba(0,229,255,0.14)
            );

            color:white;

            transform:translateX(5px);

            box-shadow:
            0 0 18px rgba(127,92,255,0.18);

        }

        /* ACTIVE */

        .sidebar .nav-item.active .nav-link{

            background:
            linear-gradient(
                135deg,
                #7f5cff,
                #00e5ff
            );

            color:white;

            font-weight:600;

            box-shadow:
            0 0 20px rgba(0,229,255,0.35);

        }

        .sidebar hr.sidebar-divider{
            border-top:1px solid rgba(255,255,255,0.08);
        }

        /* =========================================
            TOPBAR
        ========================================= */

        .topbar{

            background:rgba(255,255,255,0.04) !important;

            backdrop-filter:blur(18px);

            border-bottom:1px solid rgba(255,255,255,0.08);

            box-shadow:none !important;

        }

        .topbar .nav-link,
        .topbar .dropdown-toggle{

            color:white !important;

        }

        .topbar .img-profile{

            border:2px solid rgba(255,255,255,0.2);

            box-shadow:
            0 0 15px rgba(0,229,255,0.2);

        }

        /* =========================================
            CONTENT
        ========================================= */

        #content-wrapper{
            background:transparent !important;
        }

        #content{
            background:transparent !important;
        }

        .container-fluid{
            padding-top:25px;
            padding-bottom:25px;
        }

        /* =========================================
            CARD GLOBAL
        ========================================= */

        .card{

            background:rgba(255,255,255,0.05);

            border:1px solid rgba(255,255,255,0.08);

            backdrop-filter:blur(16px);

            border-radius:24px;

            box-shadow:
            0 0 25px rgba(127,92,255,0.10);

            overflow:hidden;

        }

        .card-header{

            background:rgba(255,255,255,0.04);

            border-bottom:1px solid rgba(255,255,255,0.06);

            color:white;

        }

        .card-body{
            color:#d0d9ff;
        }

        /* =========================================
            BUTTON
        ========================================= */

        .btn-primary{

            background:
            linear-gradient(
                135deg,
                #7f5cff,
                #00e5ff
            ) !important;

            border:none;

            border-radius:14px;

            box-shadow:
            0 0 18px rgba(127,92,255,0.30);

        }

        .btn-primary:hover{

            transform:translateY(-2px);

            box-shadow:
            0 0 22px rgba(0,229,255,0.35);

        }

        /* =========================================
            TABLE
        ========================================= */

        .table{
            color:white;
        }

        .table thead th{

            background:rgba(255,255,255,0.05);

            border-color:rgba(255,255,255,0.06);

            color:#00e5ff;

        }

        .table td{

            border-color:rgba(255,255,255,0.05);

        }

        /* =========================================
            SCROLLBAR
        ========================================= */

        ::-webkit-scrollbar{
            width:8px;
            height:8px;
        }

        ::-webkit-scrollbar-thumb{
            background:#7f5cff;
            border-radius:20px;
        }

        /* =========================================
            MOBILE
        ========================================= */

        @media(max-width:768px){

            .sidebar{

                backdrop-filter:none;

            }

            .sidebar .nav-item .nav-link{

                padding:12px 16px;

                font-size:14px;

            }

            .topbar{

                padding-left:10px;
                padding-right:10px;

            }

            .container-fluid{
                padding-left:15px;
                padding-right:15px;
            }

        }

    </style>

</head>

<body id="page-top">

<div id="wrapper">

    {{-- SIDEBAR --}}
    @include('user.partials.sidebar')

    {{-- CONTENT WRAPPER --}}
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            {{-- TOPBAR --}}
            @include('user.partials.topbar')

            {{-- MAIN CONTENT --}}
            <div class="container-fluid">

                @yield('content')

            </div>

        </div>

    </div>

</div>

<!-- SCRIPTS -->
<script src="{{ asset('vendor/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('vendor/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('vendor/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>

</body>
</html>