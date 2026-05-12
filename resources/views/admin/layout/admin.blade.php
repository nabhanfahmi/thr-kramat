<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom fonts & styles -->
    <link href="{{ asset('vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* Sidebar Admin - Gradient & Glow Style */
    .sidebar {
        background: linear-gradient(to bottom right, #2c3e50, #4ca1af);
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }

    .sidebar .sidebar-brand {
        padding: 1.5rem 1rem;
        font-size: 1.25rem;
        font-weight: bold;
        color: #ffffff;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .sidebar .sidebar-brand-icon i {
        font-size: 1.6rem;
        color: #ffd700;
    }

    /* Nav items */
    .sidebar .nav-item .nav-link {
        color: #ffffffcc;
        transition: all 0.3s ease;
        padding: 12px 20px;
        border-left: 4px solid transparent;
        font-weight: 500;
    }

    .sidebar .nav-item .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 4px solid #00ffc6;
        transform: translateX(4px);
    }

    .sidebar .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        border-left: 4px solid #29ffc6;
        box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.1);
    }

    /* Divider line */
    .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin: 0.75rem 1rem;
    }

    /* Icon spacing and color */
    .sidebar .nav-link i {
        margin-right: 10px;
        color: #ffffffb3;
        transition: color 0.3s;
    }

    .sidebar .nav-link:hover i,
    .sidebar .nav-item.active .nav-link i {
        color: #ffffff;
    }

    /* Responsive: optional */
    @media (max-width: 768px) {
        .sidebar {
            font-size: 14px;
        }
    }
    /* Topbar Admin Style */
    .custom-topbar {
        background: linear-gradient(to right, #2c3e50, #4ca1af); /* serasi dengan sidebar */
        color: white;
        padding: 12px 30px;
        border-bottom: 3px solid #ffffff2e;
        z-index: 999;
    }

    .custom-topbar .btn {
        border-radius: 30px;
        padding: 7px 18px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease-in-out;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .custom-topbar .btn i {
        margin-right: 6px;
    }

    .custom-topbar .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.6);
        color: white;
    }

    .custom-topbar .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: #fff;
        color: #fff;
        transform: scale(1.02);
    }

    /* Responsive Fix */
    @media (max-width: 768px) {
        .custom-topbar {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }

        .custom-topbar .btn {
            font-size: 13px;
            width: 100%;
        }
    }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                @include('admin.partials.topbar')

                <!-- Main Content -->
                <div class="container-fluid pt-4">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
