<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Berita Wisata' }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
/* Detail Berita */
.berita-detail {
  font-family: "Segoe UI", Roboto, Arial, sans-serif;
  color: #333;
  line-height: 1.8;
}

/* Header Baru */
.berita-header {
  background: linear-gradient(120deg, rgba(111, 66, 193, 0.95), rgba(46, 107, 224, 0.9), rgba(216, 70, 239, 0.85));
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  color: #fff;
  position: sticky;
  top: 0;
  z-index: 1000;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
  transition: all 0.4s ease;
}

/* Saat discroll lebih kompak */
.berita-header.scrolled {
  background: linear-gradient(135deg, #5a2ea6, #3954d7);
  padding: 6px 0 !important;
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
}

.berita-header .container {
  max-width: 1150px;
}

/* Tombol kembali */
.berita-header a.btn-outline-secondary {
  color: #fff;
  border-color: rgba(255, 255, 255, 0.6);
  border-radius: 12px;
  font-weight: 600;
  padding: 6px 14px;
  transition: all 0.3s ease;
}

.berita-header a.btn-outline-secondary:hover {
  background: rgba(255, 255, 255, 0.2);
  border-color: #fff;
  transform: translateX(-4px) scale(1.05);
}

/* Judul portal */
.berita-header span.fw-bold {
  font-size: 1.35rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #fff;
  font-weight: 700;
  text-shadow: 0 3px 10px rgba(0, 0, 0, 0.25);
  transition: transform 0.3s ease;
}

.berita-header span.fw-bold:hover {
  transform: scale(1.03);
}

/* Responsif */
@media (max-width: 768px) {
  .berita-header span.fw-bold {
    font-size: 1rem;
    letter-spacing: 0.5px;
  }
  .berita-header .btn {
    padding: 5px 10px;
    font-size: 0.85rem;
  }
}

/* Judul & Meta */
.berita-judul {
  font-size: 2rem;
  font-weight: 700;
  line-height: 1.3;
  margin-bottom: 10px;
  text-align: center;
  color: #222;
}
.berita-meta {
  font-size: 0.9rem;
  color: #888;
  text-align: center;
  margin-bottom: 20px;
}

/* Gambar */
.berita-gambar {
  text-align: center;
  margin-bottom: 25px;
}
.berita-gambar img {
  border-radius: 12px;
  max-height: 450px;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.berita-gambar img:hover {
  transform: scale(1.02);
}
.berita-gambar figcaption {
  font-size: 0.85rem;
  text-align: center;
  font-style: italic;
  color: #666;
}

/* Konten */
.berita-konten p {
  font-size: 1.05rem;
  line-height: 1.8;
  margin-bottom: 1.2rem;
  text-align: justify;
}
.berita-konten .lead {
  font-size: 1.2rem;
  font-weight: 400;
  color: #222;
}
.berita-quote {
  background: #f9f9f9;
  padding: 12px 18px;
  font-style: italic;
  border-left: 4px solid #2c97e8;
  border-radius: 6px;
  margin: 20px 0;
}
.berita-konten ul {
  margin: 0 0 1.2rem 1.5rem;
}
.berita-inline-image {
  position: relative;
  display: inline-block;
  margin: 25px auto;
  text-align: center;
}

.berita-inline-image img {
  max-height: 280px;
  width: 100%;
  object-fit: cover;
  border-radius: 14px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.15);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-inline-image img:hover {
  transform: scale(1.03);
  box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

.berita-inline-image small {
  display: block;
  margin-top: 8px;
  font-size: 0.85rem;
  color: #666;
  font-style: italic;
}


/* Bagikan */
.share-section {
  margin-top: 30px;
  padding: 15px;
  background: #f9f9f9;
  border-left: 4px solid #2c97e8;
  border-radius: 8px;
}
.btn-share {
  display: inline-block;
  margin: 5px 8px 0 0;
  padding: 8px 16px;
  border-radius: 30px;
  font-size: 0.9rem;
  font-weight: 600;
  text-decoration: none;
  color: #fff;
  transition: all 0.3s ease;
}
.btn-share.fb { background: #3b5998; }
.btn-share.tw { background: #1da1f2; }
.btn-share.wa { background: #25d366; }
.btn-share:hover { opacity: 0.8; }

/* Related */
.related-section h4 {
  font-weight: 700;
}
.related-section .card {
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}
.related-section .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}
.related-section img {
  height: 150px;
  object-fit: cover;
}
.related-section .overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
}
    </style>
</head>
<body>
    @yield('content')
</body>
<script>
  window.addEventListener("scroll", function () {
    const header = document.querySelector(".berita-header");
    header.classList.toggle("scrolled", window.scrollY > 50);
  });
</script>
</html>
