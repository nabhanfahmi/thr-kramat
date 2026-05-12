<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">User</div>
    </a>

    <hr class="sidebar-divider">

    <!-- Beli Tiket -->
    <li class="nav-item {{ request()->routeIs('user.tiket.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.tiket.index') }}">
            <i class="fas fa-ticket-alt"></i>
            <span>Beli Tiket</span>
        </a>
    </li>
    <!-- End Beli Tiket -->

    <!-- Riwayat Pemesanan -->
    <li class="nav-item {{ request()->routeIs('user.pemesanan.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.pemesanan.index') }}">
            <i class="fas fa-history"></i>
            <span>Riwayat Pemesanan</span>
        </a>
    </li>
    <!-- End Riwayat Pemesanan -->

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
    <!-- End Logout -->

</ul>
