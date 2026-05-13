<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>THR | KRAMAT</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- ===== HEADER ===== -->
    <header id="main-header" class="transparent">
        <nav class="navbar section-content">
            <a href="#" class="nav-logo">
                <img src="{{ asset('img/logo/logothr.png') }}" alt="Logo THR Kramat" class="logo-image" />
            </a>

            <ul class="nav-menu">
                <button id="menu-close-button" class="fas fa-times"></button>
                <li class="nav-item"><a href="#beranda2" class="nav-link">BERANDA</a></li>
                <li class="nav-item"><a href="#galeri" class="nav-link">GALERI WISATA</a></li>
                <li class="nav-item"><a href="#daftar-tiket" class="nav-link">DAFTAR TIKET</a></li>
                <li class="nav-item">
                    @auth
                        <a href="{{ route('user.tiket.index') }}" class="nav-link">BELI TIKET</a>
                    @else
                        <a href="javascript:void(0);" onclick="alertLogin()" class="nav-link">BELI TIKET</a>
                    @endauth
                </li>
                <li class="nav-item"><a href="#aboutus" class="nav-link">TENTANG</a></li>
                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a href="#" onclick="openSidebar()" class="nav-link">MASUK/DAFTAR</a></li>
                @endauth
            </ul>

            <button id="menu-open-button" class="fas fa-bars"></button>
        </nav>
    </header>

    <!-- ===== MAIN CONTENT ===== -->
    <main>
        <!-- Hero Section -->
        <section class="hero-section scroll-reveal" id="beranda1">
            <div class="hero-background">
                @forelse($heros as $bg)
                    <img src="{{ asset('storage/' . $bg->gambar) }}" class="bg-slide {{ $loop->first ? 'active' : '' }}" alt="BG {{ $loop->iteration }}">
                @empty
                    <img src="{{ asset('img/default-bg.jpg') }}" class="bg-slide active" alt="Default BG">
                @endforelse
            </div>

            <div class="section-content" id="beranda2">
                <div class="hero-details">
                    <h2 class="title">Selamat Datang</h2>
                    <h3 class="subtitle">Di Destinasi Wisata dan Kolam Renang Prestasi THR Kramat Batang</h3>
                    <p class="description">
                        "Nikmati saja hari liburmu, memikirkan hari esok yang belum terjadi secara berlebihan hanya akan membuatmu lupa mensyukuri hari liburmu."
                    </p>
                    <div class="buttons">
                        <a href="#" class="button lihat-selengkapnya">Lihat Selengkapnya</a>
                        <a href="#" class="button contact-us" id="contact-us">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Galeri Section -->
        <section id="galeri" class="galeri-section scroll-reveal" style="width:100%;">
            <div class="section-content" style="max-width:100%;">
                <h2 class="section-title">Galeri Wisata & Berita</h2>
                <div class="galeri-grid">
                    @forelse ($galeri as $item)
                        <div class="galeri-wrapper">
                            <div class="galeri-item">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="galeri" class="img-fluid rounded mb-2" style="object-fit: cover; max-height: 300px; width: 100%;">
                                <h5 class="fw-bold mt-2">{{ $item->judul ?? 'Info Wisata' }}</h5>
                                <p>{!! Str::limit($item->keterangan, 80) !!}</p>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('berita.show', $item->id) }}" class="btn btn-sm btn-outline-primary btn-read">Baca Selengkapnya</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada gambar galeri.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <div class="lightbox" id="lightbox">
            <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
            <button class="lightbox-nav left" onclick="prevImage()">&#10094;</button>
            <img id="lightbox-img" src="" alt="Preview">
            <button class="lightbox-nav right" onclick="nextImage()">&#10095;</button>
        </div>

        <!-- Tiket Section -->
        <section id="daftar-tiket" class="daftar-tiket-section scroll-reveal">
            <div class="section-content">
                <h2 class="section-title">Daftar Tiket</h2>
                @if($tikets->isEmpty())
                    <p class="text-center">Belum ada tiket tersedia.</p>
                @else
                    <div class="ticket-cards">
                        @foreach($tikets as $tiket)
                            <div class="ticket-card">

                                {{-- Gambar Tiket --}}
                                <div class="ticket-image">
                                    @if($tiket->gambar_tiket)
                                        <img src="{{ asset($tiket->gambar_tiket) }}" alt="{{ $tiket->nama_tiket }}">
                                    @else
                                        <img src="{{ asset('img/default-ticket.jpg') }}" alt="Default Ticket">
                                    @endif
                                </div>

                                {{-- Nama Tiket --}}
                                <h3>{{ $tiket->nama_tiket }}</h3>

                                {{-- Kategori (opsional biar keren) --}}
                                <small class="text-muted">{{ $tiket->kategori }}</small>

                                {{-- Harga --}}
                                <p>
                                    @if($tiket->harga)
                                        Rp {{ number_format($tiket->harga, 0, ',', '.') }}
                                    @else
                                        Hubungi admin untuk detail harga
                                    @endif
                                </p>

                                {{-- Tombol --}}
                                <a href="#" class="button">
                                    {{ $tiket->harga ? 'Dapatkan Tiket' : 'Hubungi Kami' }}
                                </a>

                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="tiket-info-wrapper">
                    <p class="text">Pesan tiket dengan cepat dan mudah secara online. Nikmati wisata tanpa antre!</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="aboutus" class="about-section">
            <div class="section-content">
                <div class="about-image-wrapper">
                    <img src="{{ asset('img/logo/logothr.jpg') }}" alt="About" class="about-image" />
                </div>
                <div class="about-details">
                    <h2 class="section-title">About Us</h2>
                    <p class="text">
                        THR Kramat adalah salah satu destinasi wisata keluarga yang populer di Kabupaten Batang, Jawa Tengah.
                        Tempat ini menawarkan berbagai fasilitas kolam renang untuk anak-anak maupun dewasa, menjadikannya
                        pilihan favorit masyarakat sekitar untuk berlibur dan berolahraga air.
                        Dibangun untuk memenuhi kebutuhan hiburan masyarakat lokal, THR Kramat memiliki nuansa rekreasi yang
                        ramah keluarga, dengan lingkungan yang tertata dan fasilitas yang terus diperbarui.
                        Lokasinya yang strategis di pusat kota Batang memudahkan akses dari berbagai penjuru kabupaten.
                    </p>
                    <div class="social-link-list">
                        <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ===== SIDEBAR LOGIN/REGISTER ===== -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
    <div id="sidebarForm" class="sidebar-form">
        <div class="p-4 text-center">
            <h4 class="mb-4">Selamat Datang di Website Tiket Wisata Online</h4>
            <div class="d-grid gap-3 col-12">
                <a href="{{ route('admin.login') }}" class="btn btn-dark btn-lg">Login Admin</a>
                <a href="{{ route('pengelola.login') }}" class="btn btn-primary btn-lg">Login Pengelola</a>
                <a href="{{ route('petugas.login') }}" class="btn btn-primary btn-lg">Login Petugas</a>
                <a href="{{ route('user.login') }}" class="btn btn-primary btn-lg">Login User</a>
            </div>
            <button type="button" class="btn btn-secondary mt-4" onclick="closeSidebar()">Tutup</button>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer text-center">
        <p>&copy; 2025 THR Kramat Batang | Developed by Nabhan Fahmi</p>
    </footer>

    <!-- ===== SCRIPTS ===== -->
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
    </script>

    <!-- Lightbox Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const galleryImages = document.querySelectorAll('.galeri-item img');
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const closeBtn = document.querySelector('.lightbox-close');
            let currentIndex = 0;
            const imageList = Array.from(galleryImages);

            function showImage(index) {
                if (index >= 0 && index < imageList.length) {
                    currentIndex = index;
                    lightboxImg.src = imageList[currentIndex].src;
                    lightbox.style.display = 'flex';
                }
            }

            imageList.forEach((img, index) => {
                img.addEventListener('click', () => showImage(index));
            });

            function nextImage() {
                currentIndex = (currentIndex + 1) % imageList.length;
                showImage(currentIndex);
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + imageList.length) % imageList.length;
                showImage(currentIndex);
            }

            function closeLightbox() {
                lightbox.style.display = 'none';
                lightboxImg.src = '';
            }

            lightbox.addEventListener('click', function (e) {
                if (e.target === lightbox || e.target === closeBtn) closeLightbox();
            });

            document.addEventListener('keydown', function (e) {
                if (lightbox.style.display === 'flex') {
                    if (e.key === 'ArrowRight') nextImage();
                    if (e.key === 'ArrowLeft') prevImage();
                    if (e.key === 'Escape') closeLightbox();
                }
            });

            window.nextImage = nextImage;
            window.prevImage = prevImage;
            window.closeLightbox = closeLightbox;
        });
    </script>

    <!-- Sidebar -->
    <script>
        function openSidebar() {
            document.getElementById('sidebarForm').classList.add('active');
            document.getElementById('sidebarOverlay').classList.add('active');
        }

        function closeSidebar() {
            document.getElementById('sidebarForm').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
        }
    </script>

    <!-- SweetAlert Login Alert -->
    <script>
        function alertLogin() {
            Swal.fire({
                icon: 'warning',
                title: 'Login Diperlukan!',
                text: 'Silakan login terlebih dahulu untuk membeli tiket.',
                confirmButtonText: 'Login Sekarang',
                confirmButtonColor: '#6f42c1',
                showCloseButton: true,
                background: '#f8f9fa',
                customClass: {
                    title: 'fs-4',
                    popup: 'rounded-4 shadow'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        }
    </script>

    <!-- Scroll Smooth ke Tiket -->
    <script>
        function scrollToTiketSection() {
            const tiketSection = document.getElementById("daftar-tiket");
            if (tiketSection) {
                tiketSection.scrollIntoView({ behavior: "smooth" });

                const notif = document.createElement("div");
                notif.className = "custom-alert";
                notif.textContent = "Ke Menu Beli Tiket Untuk Mendapatkan Tiket! Silakan pilih tiket yang ingin dibeli.";
                document.body.appendChild(notif);

                setTimeout(() => { notif.remove(); }, 3000);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const beliButtons = document.querySelectorAll(".button:not(.contact-us)");
            beliButtons.forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    scrollToTiketSection();
                });
            });
        });
    </script>
</body>
</html>
