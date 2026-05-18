<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>THR | KRAMAT</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- STAR BACKGROUND -->
    <div class="stars"></div>

    <!-- HEADER -->
    <header id="main-header" class="transparent">
        <nav class="navbar section-content">

            <a href="#" class="nav-logo">
                <img src="{{ asset('img/logo/logothr.png') }}" alt="Logo" class="logo-image">
            </a>

            <ul class="nav-menu">
                <button id="menu-close-button" class="fas fa-times"></button>

                <li class="nav-item"><a href="#" class="nav-link">BERANDA</a></li>
                <li class="nav-item"><a href="#galeri" class="nav-link">GALERI</a></li>
                <li class="nav-item"><a href="#daftar-tiket" class="nav-link">TIKET</a></li>
                <li class="nav-item"><a href="#aboutus" class="nav-link">TENTANG</a></li>

                @auth
                    <li class="nav-item">
                        <a href="{{ route('user.tiket.index') }}" class="nav-link special-btn">
                            BELI TIKET
                        </a>
                    </li>

                    {{-- USER MENU --}}
<li class="nav-item dropdown-user">

    <button
        class="user-menu-btn"
        id="userMenuToggle">

        @if(Auth::user()->foto)

            <img
                src="{{ asset('uploads/profil/' . Auth::user()->foto) }}"
                class="user-menu-img">

        @else

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6f42c1&color=fff"
                class="user-menu-img">

        @endif

        <span>
            {{ Auth::user()->name }}
        </span>

        <i class="fas fa-chevron-down"></i>

    </button>

    {{-- POPUP MENU --}}
    <div class="user-dropdown-menu" id="userDropdownMenu">

        {{-- PROFILE --}}
        <div class="dropdown-profile">

            @if(Auth::user()->foto)

                <img
                    src="{{ asset('uploads/profil/' . Auth::user()->foto) }}"
                    class="dropdown-profile-img">

            @else

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6f42c1&color=fff"
                    class="dropdown-profile-img">

            @endif

            <div>

                <div class="dropdown-profile-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="dropdown-profile-email">
                    {{ Auth::user()->email }}
                </div>

            </div>

        </div>

        {{-- MENU --}}
        <a href="{{ route('user.dashboard') }}" class="dropdown-link">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

        <a href="{{ route('user.profil.index') }}" class="dropdown-link">
            <i class="fas fa-user"></i>
            Profil Saya
        </a>

        <a href="{{ route('user.pemesanan.index') }}" class="dropdown-link">
            <i class="fas fa-ticket-alt"></i>
            Riwayat Tiket
        </a>

        <div class="dropdown-divider"></div>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf

            <button type="submit" class="dropdown-logout">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </button>
        </form>

    </div>

</li>
                @else
                    <li class="nav-item">
                        <a href="javascript:void(0);" onclick="alertLogin()" class="nav-link special-btn">
                            BELI TIKET
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" onclick="openSidebar()" class="nav-link">
                            MASUK
                        </a>
                    </li>
                @endauth
            </ul>

            <button id="menu-open-button" class="fas fa-bars"></button>
        </nav>
    </header>


    <!-- HERO -->
    <section class="hero-section" id="beranda1">

        <div class="hero-background">
            @forelse($heros as $bg)
                <img src="{{ asset('storage/' . $bg->gambar) }}"
                     class="bg-slide {{ $loop->first ? 'active' : '' }}"
                     alt="bg">
            @empty
                <img src="{{ asset('img/bg/bg1.jpeg') }}"
                     class="bg-slide active"
                     alt="bg">
            @endforelse
        </div>

        <div class="hero-overlay"></div>

        <div class="section-content" id="beranda2">
            <div class="hero-details">

                <span class="hero-badge">
                    DESTINASI WISATA
                </span>

                <h1 class="title">
                    THR KRAMAT BATANG
                </h1>

                <h3 class="subtitle">
                    Wisata Keluarga • Kolam Prestasi • Rekreasi Modern
                </h3>

                <p class="description">
                    Nikmati pengalaman wisata dengan suasana modern, nyaman, dan penuh hiburan bersama keluarga tercinta.
                </p>

                <div class="buttons">
                    <a href="#galeri" class="button primary-btn">
                        Jelajahi Wisata
                    </a>

                    <a href="#daftar-tiket" class="button secondary-btn">
                        Lihat Tiket
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- GALERI -->
<section id="galeri" class="galeri-section">

    <div class="section-content">

        <h2 class="section-title">
            Galeri Wisata
        </h2>

        <div class="galeri-grid">

            @forelse ($galeri as $index => $item)

                <div class="galeri-item">

                    {{-- IMAGE --}}
                    <div
                        class="image-wrapper open-gallery"
                        data-index="{{ $index }}">

                        <img
                            src="{{ asset('storage/' . $item->gambar) }}"
                            alt="galeri">

                        <div class="image-overlay">
                            🔍 Lihat Foto
                        </div>

                    </div>

                    {{-- CONTENT --}}
                    <div class="galeri-content">

                        <h5>
                            {{ $item->judul ?? 'Info Wisata' }}
                        </h5>

                        <p>
                            {!! Str::limit($item->keterangan, 90) !!}
                        </p>

                        <a
                            href="{{ route('berita.show', $item->id) }}"
                            class="btn-read">

                            Baca Selengkapnya

                        </a>

                    </div>

                </div>

            @empty

                <div class="empty-gallery">

                    <div class="empty-icon">

                        <i class="fas fa-image"></i>

                    </div>

                    <h4>
                        Galeri Belum Tersedia
                    </h4>

                    <p class="empty-text">
                        Saat ini belum ada foto wisata yang ditampilkan.
                        Silakan kembali lagi nanti untuk melihat galeri terbaru.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

<!-- =========================
     POPUP GALLERY
========================= -->

<div class="gallery-popup" id="galleryPopup">

    {{-- CLOSE --}}
    <button class="close-gallery" id="closeGallery">
        ✕
    </button>

    {{-- PREV --}}
    <button class="nav-gallery prev-gallery" id="prevGallery">
        ❮
    </button>

    {{-- IMAGE --}}
    <div class="gallery-popup-content">

        <img
            id="popupImage"
            src=""
            alt="popup">

    </div>

    {{-- NEXT --}}
    <button class="nav-gallery next-gallery" id="nextGallery">
        ❯
    </button>

</div>


    <!-- TIKET -->
<section id="daftar-tiket" class="daftar-tiket-section">

    <div class="section-content">

        <div class="section-heading">

            <h2 class="section-title">
                Daftar Tiket
            </h2>

        </div>

        @if($tikets->count() > 0)

        <div class="ticket-cards">

                @foreach($tikets as $tiket)

                    <div class="ticket-card">

                        <div class="ticket-image">
                            @if($tiket->gambar_tiket)
                                <img src="{{ asset($tiket->gambar_tiket) }}" alt="ticket">
                            @else
                                <img src="{{ asset('img/default-ticket.jpg') }}" alt="ticket">
                            @endif
                        </div>

                        <div class="ticket-content">
                            <small>{{ $tiket->kategori }}</small>

                            <h3>{{ $tiket->nama_tiket }}</h3>

                            <p>
                                @if($tiket->harga)
                                    Rp {{ number_format($tiket->harga, 0, ',', '.') }}
                                @else
                                    Hubungi admin
                                @endif
                            </p>

                            @auth
                                <a href="{{ route('user.tiket.index') }}" class="ticket-btn">
                                    Dapatkan Tiket
                                </a>
                            @else
                                <a href="javascript:void(0)" onclick="belumLogin()" class="ticket-btn">
                                    Dapatkan Tiket
                                </a>
                            @endauth
                        </div>
                    </div>

                @endforeach
            </div>

        @else

        {{-- EMPTY --}}
        <div class="empty-ticket">

            <div class="empty-icon">

                <i class="fas fa-ticket-alt"></i>

            </div>

            <h4>
                Tiket Belum Tersedia
            </h4>

            <p class="empty-text">
                Saat ini belum ada tiket wisata yang tersedia.
                Silakan cek kembali beberapa saat lagi.
            </p>

        </div>

        @endif

    </div>

</section>


    <!-- ABOUT -->
    <section id="aboutus" class="about-section">

        <div class="section-content about-container">

            <div class="about-image-wrapper">
                <img src="{{ asset('img/logo/logothr.jpg') }}" alt="about" class="about-image">
            </div>

            <div class="about-details">
                <h2 class="section-title">About Us</h2>

                <p class="text">
                    THR Kramat merupakan destinasi wisata keluarga populer di Kabupaten Batang dengan konsep rekreasi modern, nyaman, dan ramah keluarga.
                </p>

                <div class="social-link-list">
                    <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
        </div>
    </section>


    <!-- SIDEBAR -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <div id="sidebarForm" class="sidebar-form">
        <div class="sidebar-content">

            <h4>Selamat Datang</h4>

            <a href="{{ route('admin.login') }}" class="sidebar-btn dark-btn">
                Login Admin
            </a>

            <a href="{{ route('pengelola.login') }}" class="sidebar-btn">
                Login Pengelola
            </a>

            <a href="{{ route('petugas.login') }}" class="sidebar-btn">
                Login Petugas
            </a>

            <a href="{{ route('user.login') }}" class="sidebar-btn">
                Login User
            </a>

            <button onclick="closeSidebar()" class="close-sidebar-btn">
                Tutup
            </button>
        </div>
    </div>


    <!-- FOOTER -->
    <footer class="site-footer">
        <p>
            © 2025 THR Kramat Batang | Developed by Nabhan Fahmi
        </p>
    </footer>


    <!-- SCRIPT -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let slides = document.querySelectorAll(".bg-slide");
            let currentSlide = 0;

            function showNextSlide() {
                slides[currentSlide].classList.remove("active");
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add("active");
            }

            setInterval(showNextSlide, 5000);

            const header = document.getElementById("main-header");

            function updateHeaderTransparency() {
                if (window.scrollY === 0) {
                    header.classList.add("transparent");
                    header.classList.remove("solid");
                } else {
                    header.classList.add("solid");
                    header.classList.remove("transparent");
                }
            }

            updateHeaderTransparency();
            window.addEventListener("scroll", updateHeaderTransparency);
        });

        const openBtn = document.getElementById('menu-open-button');
        const closeBtn = document.getElementById('menu-close-button');
        const body = document.body;

        openBtn.addEventListener('click', () => {
            body.classList.add('show-mobile-menu');
        });

        closeBtn.addEventListener('click', () => {
            body.classList.remove('show-mobile-menu');
        });

        function openSidebar() {
            document.getElementById('sidebarForm').classList.add('active');
            document.getElementById('sidebarOverlay').classList.add('active');
        }

        function closeSidebar() {
            document.getElementById('sidebarForm').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }

        function alertLogin() {
            Swal.fire({
                icon: 'warning',
                title: 'Login Diperlukan!',
                text: 'Silakan login terlebih dahulu untuk membeli tiket.',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#7f5cff'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        }
    </script>

    <script>
        function belumLogin() {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                html: `
                    <b>Anda belum login 😅</b><br>
                    Ayo login dulu wkwk 🚀
                `,
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#7f5cff',
                background: '#0b1227',
                color: '#ffffff',
                backdrop: `
                    rgba(0,0,0,0.7)
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        }
    </script>

    <script>

const popup = document.getElementById('galleryPopup');

const popupImage = document.getElementById('popupImage');

const galleryItems = document.querySelectorAll('.open-gallery');

const closeGallery = document.getElementById('closeGallery');

const prevGallery = document.getElementById('prevGallery');

const nextGallery = document.getElementById('nextGallery');

let currentIndex = 0;

/* =========================
   GET IMAGES
========================= */

const images = [

    @foreach($galeri as $item)

        "{{ asset('storage/' . $item->gambar) }}",

    @endforeach

];

/* =========================
   OPEN
========================= */

galleryItems.forEach(item => {

    item.addEventListener('click', function(){

        currentIndex = parseInt(this.dataset.index);

        showImage();

        popup.classList.add('active');

        document.body.style.overflow = 'hidden';

    });

});

/* =========================
   SHOW IMAGE
========================= */

function showImage(){

    popupImage.src = images[currentIndex];
}

/* =========================
   NEXT
========================= */

nextGallery.addEventListener('click', function(){

    currentIndex++;

    if(currentIndex >= images.length){
        currentIndex = 0;
    }

    showImage();

});

/* =========================
   PREV
========================= */

prevGallery.addEventListener('click', function(){

    currentIndex--;

    if(currentIndex < 0){
        currentIndex = images.length - 1;
    }

    showImage();

});

/* =========================
   CLOSE
========================= */

closeGallery.addEventListener('click', closePopup);

popup.addEventListener('click', function(e){

    if(e.target === popup){
        closePopup();
    }

});

function closePopup(){

    popup.classList.remove('active');

    document.body.style.overflow = 'auto';
}

/* =========================
   KEYBOARD
========================= */

document.addEventListener('keydown', function(e){

    if(!popup.classList.contains('active')) return;

    if(e.key === 'ArrowRight'){
        nextGallery.click();
    }

    if(e.key === 'ArrowLeft'){
        prevGallery.click();
    }

    if(e.key === 'Escape'){
        closePopup();
    }

});

/* =========================
   SWIPE MOBILE
========================= */

let startX = 0;

popup.addEventListener('touchstart', e => {

    startX = e.touches[0].clientX;

});

popup.addEventListener('touchend', e => {

    let endX = e.changedTouches[0].clientX;

    if(startX - endX > 50){

        nextGallery.click();
    }

    if(endX - startX > 50){

        prevGallery.click();
    }

});

</script>

<script>

const userMenuToggle =
document.getElementById('userMenuToggle');

const userDropdownMenu =
document.getElementById('userDropdownMenu');

userMenuToggle.addEventListener('click', function () {

    userDropdownMenu.classList.toggle('active');

});

document.addEventListener('click', function (e) {

    if (
        !userMenuToggle.contains(e.target)
        &&
        !userDropdownMenu.contains(e.target)
    ) {

        userDropdownMenu.classList.remove('active');
    }

});

</script>

</body>
</html>
