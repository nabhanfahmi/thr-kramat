<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <hr class="sidebar-divider">

    <!-- Galeri -->
    <li class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.galeri.index') }}">
            <i class="fas fa-images"></i>
            <span>Galeri</span>
        </a>
    </li>

    <!-- Tiket -->
    <li class="nav-item {{ request()->routeIs('admin.tiket.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tiket.index') }}">
            <i class="fas fa-ticket-alt"></i>
            <span>Tiket</span>
        </a>
    </li>

    <!-- Background Hero -->
    <li class="nav-item {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.hero.index') }}">
            <i class="fas fa-image"></i>
            <span>Background Hero</span>
        </a>
    </li>

    <!-- Data Pemesanan -->
    <li class="nav-item {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pemesanan.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Data Pemesanan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

</ul>
