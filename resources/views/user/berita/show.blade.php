@extends('berita.layouts.berita')

@section('content')
<div class="berita-header shadow-sm">
  <div class="container header-inner">
    <a href="{{ route('home') }}#galeri" class="btn btn-outline-secondary back-btn">
      ⬅️
    </a>
    <span class="fw-bold site-title">Portal Berita Wisata</span>
    <div class="header-right"></div> <!-- kosong dulu, buat balance -->
  </div>
</div>


<div class="container my-5 berita-detail">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Judul -->
            <h1 class="berita-judul mb-3">{{ $item->judul }}</h1>

            <!-- Info tambahan -->
            <p class="berita-meta text-muted">
                Dipublikasikan pada {{ $item->created_at->format('d M Y') }}
            </p>

            <!-- Gambar utama + caption -->
            <figure class="berita-gambar mb-4">
                <img src="{{ asset('storage/' . $item->gambar) }}" 
                     alt="{{ $item->judul }}" 
                     class="img-fluid rounded shadow-lg">
                <figcaption class="text-muted mt-2 small">
                    Dokumentasi: {{ $item->judul }}
                </figcaption>
            </figure>

            <!-- Konten (CKEditor) -->
            <div class="berita-konten mt-4">
                {!! $item->berita ?? $item->keterangan !!}
            </div>

            <!-- Highlight Tips / Kutipan -->
            <blockquote class="berita-quote my-4 p-3 border-start border-4 rounded">
                ✨ Nikmati pengalaman wisata lebih menyenangkan dengan memesan tiket secara online.
            </blockquote>

            <!-- Bagikan -->
            <div class="share-section mt-5">
                <h5 class="mb-3">Bagikan Artikel Ini:</h5>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="btn-share fb">Facebook</a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($item->judul) }}" target="_blank" class="btn-share tw">Twitter</a>
                <a href="https://wa.me/?text={{ urlencode($item->judul . ' ' . Request::url()) }}" target="_blank" class="btn-share wa">WhatsApp</a>
            </div>

            <!-- Berita Terkait -->
            @if(isset($related) && $related->count() > 0)
            <div class="related-section mt-5">
                <h4 class="mb-3">Berita Terkait</h4>
                <div class="row">
                    @foreach($related as $rel)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $rel->gambar) }}" 
                                         class="card-img-top" 
                                         alt="{{ $rel->judul }}">
                                    <div class="overlay"></div>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($rel->judul, 50) }}</h6>
                                    <a href="{{ route('berita.show', $rel->id) }}" class="stretched-link">Baca</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
