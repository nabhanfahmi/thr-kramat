<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom fonts & styles -->
    <link href="{{ asset('vendor/sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* Sidebar style */
        .sidebar {
            background: linear-gradient(180deg, #6a11cb 0%, #2575fc 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease-in-out;
        }

        /* Brand */
        .sidebar .sidebar-brand {
            padding: 1.5rem 1rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        /* Icon and text spacing */
        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Nav item default */
        .sidebar .nav-item .nav-link {
            color: #ffffffcc;
            transition: all 0.3s;
            padding: 12px 20px;
            border-left: 4px solid transparent;
        }

        /* Hover effect */
        .sidebar .nav-item .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #00ffe7;
            transform: translateX(4px);
        }

        /* Active menu */
        .sidebar .nav-item.active .nav-link {
            background-color: rgba(0, 0, 0, 0.15);
            border-left: 4px solid #00ffc6;
            color: #ffffff;
            font-weight: 600;
        }

        /* Divider */
        .sidebar hr.sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Logout style */
        .sidebar .nav-item .nav-link i.fa-sign-out-alt {
            color: #ff6b6b;
        }

        .sidebar .nav-item .nav-link:hover i.fa-sign-out-alt {
            color: #ff9a9a;
        }

        /* user dashboard style */
            /* === Container Styling === */
        /* === Heading === */
        .dashboard-container h2 {
            color: #5b2c6f;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .dashboard-container p {
            font-size: 16px;
            color: #555;
        }

        /* === Section Title === */
        .dashboard-container h4 {
            margin-top: 40px;
            font-weight: 600;
            color: #2c3e50;
        }

        /* === Table Styling === */
        .dashboard-container .table {
            margin-top: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .dashboard-container .table thead th {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            font-weight: 600;
            border: none;
        }

        .dashboard-container .table tbody td {
            text-align: center;
            vertical-align: middle;
            color: #333;
            font-weight: 500;
            padding: 15px 10px;
        }

        /* === Badges === */
        .badge {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: capitalize;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .badge.bg-success {
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: #fff;
        }

        .badge.bg-warning {
            background: linear-gradient(to right, #f7971e, #ffd200);
            color: #333;
        }

        .badge.bg-danger {
            background: linear-gradient(to right, #e53935, #e35d5b);
            color: #fff;
        }

        .badge.bg-secondary {
            background-color: #95a5a6;
            color: #fff;
        }

        /* === Animation === */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        /* Wrapper agar div pas tengah layar */
        .dashboard-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            padding: 30px 15px;
        }

        /* Dashboard box */
        .dashboard-container {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            animation: fadeIn 0.6s ease-in-out;
        }

        h2 {
            color: #512da8;
            font-weight: 700;
        }

        /* Tambahkan animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive behavior (opsional) */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 25px 20px;
            }
        }
        /* Custom Topbar */
        .custom-topbar {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 10px 25px;
            border-bottom: 3px solid #ffffff33;
        }

        .custom-topbar .btn {
            border-radius: 30px;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
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
            color: #fff;
            border-color: #fff;
        }

        /* Responsive spacing */
        @media (max-width: 768px) {
            .custom-topbar .btn {
                font-size: 13px;
                padding: 5px 12px;
            }
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                @include('user.partials.topbar')

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
</body>
</html>
