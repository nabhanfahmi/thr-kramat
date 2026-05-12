<nav class="navbar navbar-expand-lg custom-topbar shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Kiri: Tombol Beranda -->
        <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm d-flex align-items-center">
            <i class="fas fa-home mr-2"></i> Beranda
        </a>

        <!-- Kanan: Tombol Logout -->
        <form method="POST" action="{{ route('pengelola.logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm d-flex align-items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>

    </div>
</nav>