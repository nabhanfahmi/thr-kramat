<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- BRAND --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ route('user.dashboard') }}">

        <div class="sidebar-brand-icon">
    <img
        src="{{ asset('img/logo/logothr.png') }}"
        alt="Logo THR Kramat"
        class="sidebar-logo">
</div>

        <div class="sidebar-brand-text mx-2">
            THR USER
        </div>

    </a>

    <hr class="sidebar-divider">

    {{-- DASHBOARD --}}
    <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('user.dashboard') }}">

            <i class="fas fa-home"></i>

            <span>
                Dashboard
            </span>

        </a>

    </li>

    {{-- BELI TIKET --}}
    <li class="nav-item {{ request()->routeIs('user.tiket.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('user.tiket.index') }}">

            <i class="fas fa-ticket-alt"></i>

            <span>
                Beli Tiket
            </span>

        </a>

    </li>

    {{-- RIWAYAT --}}
    <li class="nav-item {{ request()->routeIs('user.pemesanan.index') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('user.pemesanan.index') }}">

            <i class="fas fa-history"></i>

            <span>
                Riwayat Pemesanan
            </span>

        </a>

    </li>

    {{-- PROFILE --}}
    <li class="nav-item {{ request()->routeIs('user.profil.index') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('user.profil.index') }}">

            <i class="fas fa-user-circle"></i>

            <span>
                Profil Saya
            </span>

        </a>

    </li>

    {{-- DIVIDER --}}
    <hr class="sidebar-divider">

    {{-- LOGOUT --}}
    <li class="nav-item">

        <a class="nav-link logout-btn"
           href="{{ route('user.logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            <i class="fas fa-sign-out-alt"></i>

            <span>
                Logout
            </span>

        </a>

        <form id="logout-form"
              action="{{ route('user.logout') }}"
              method="POST"
              class="d-none">

            @csrf

        </form>

    </li>

</ul>

<style>

    /* =========================================
        SIDEBAR BRAND
    ========================================= */

    .sidebar-brand{

        height:90px;

        font-size:1.2rem;

        font-weight:700;

        letter-spacing:1px;

    }

    .sidebar-brand-icon i{

        color:#00e5ff;

        font-size:24px;

        filter:drop-shadow(0 0 12px #00e5ff);

    }

    .sidebar-brand-text{

        color:white;

        text-shadow:
        0 0 12px rgba(0,229,255,0.5);

    }

    /* =========================================
        LOGO
    ========================================= */

    .sidebar-brand-icon{

        display:flex;

        align-items:center;

        justify-content:center;
    }

    .sidebar-logo{

        width:42px;

        height:42px;

        object-fit:contain;

        border-radius:10px;
    }

    /* =========================================
        MENU ITEM
    ========================================= */

    .sidebar .nav-item{

        margin:8px 12px;

    }

    .sidebar .nav-item .nav-link{

        border-radius:14px;

        padding:14px 18px;

        display:flex;
        align-items:center;

        transition:0.3s ease;

        font-weight:500;

    }

    .sidebar .nav-item .nav-link i{

        margin-right:12px;

        font-size:15px;

        min-width:18px;

    }

    /* HOVER */

    .sidebar .nav-item .nav-link:hover{

        background:
        linear-gradient(
            135deg,
            rgba(127,92,255,0.22),
            rgba(0,229,255,0.15)
        );

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

        color:white !important;

        font-weight:600;

        box-shadow:
        0 0 20px rgba(0,229,255,0.28);

    }

    .sidebar .nav-item.active .nav-link i{
        color:white;
    }

    /* =========================================
        LOGOUT BUTTON
    ========================================= */

    .logout-btn{

        background:
        linear-gradient(
            135deg,
            rgba(255,61,113,0.18),
            rgba(255,0,98,0.10)
        );

    }

    .logout-btn i{
        color:#ff4f81;
    }

    .logout-btn:hover{

        background:
        linear-gradient(
            135deg,
            #ff3d71,
            #ff0062
        ) !important;

        color:white !important;

        box-shadow:
        0 0 18px rgba(255,61,113,0.35);

    }

    .logout-btn:hover i{
        color:white;
    }

    /* =========================================
        DIVIDER
    ========================================= */

    .sidebar-divider{

        border-top:
        1px solid rgba(255,255,255,0.08);

    }

    /* =========================================
        MOBILE
    ========================================= */

    @media(max-width:768px){

        .sidebar .nav-item .nav-link{

            padding:12px 15px;

            font-size:14px;

        }

        .sidebar-brand{

            height:80px;

        }

    }

</style>