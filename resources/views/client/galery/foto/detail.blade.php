@extends('client.index')

@section('title', 'Galeri Foto - ' . $settings->title)

@section('additional-css')
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.02);
            filter: brightness(80%);
        }

        .info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 8px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .delete-btn {
            background: #ff4d4d;
            border: none;
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .delete-btn:hover {
            background: #e60000;
        }

        .lightbox {
            display: none;
            position: fixed;
            z-index: 1050;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.85);
            justify-content: center;
            align-items: center;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            object-fit: contain;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        }

        .lightbox .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1051;
        }
    </style>
@endsection

@section('content_home')
    <!-- Hero Section -->
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-300"
        data-image-src="{{ asset($settings->header_image) }}">
        <div class="container pt-17 pb-19 pt-md-18 pb-md-17 text-center">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                    <h1 class="display-1 text-white fs-60 mb-4 px-md-15 px-lg-0">
                        Galeri Foto : <span class="underline-3 style-2 blue">{{ $galery->name }}</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="overflow-hidden">
            <div class="divider text-light mx-n2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 60">
                    <path fill="currentColor" d="M0,0V60H1440V0A5771,5771,0,0,1,0,0Z" />
                </svg>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="wrapper bg-light">
        <div class="container py-10">
            <div class="d-flex justify-content-end align-items-center mb-1">
                <div class="d-flex gap-2">
                    <a href="{{ route('foto') }}" class="btn btn-outline-secondary btn-sm">
                        Kembali
                    </a>
                </div>
            </div>
            @if ($fotos->isEmpty())
                <div class="text-center py-6">
                    <span class="text-muted fs-5">Belum ada foto di galeri ini.</span>
                </div>
            @else
                <div class="gallery">
                    @foreach ($fotos as $item)
                        <div class="gallery-item">
                            <img src="{{ asset($item->path) }}" alt="{{ $item->galery->name }}">
                            <div class="info">
                                <span class="date">
                                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d M Y') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    {{ $fotos->links() }}
                </div>
            @endif

            <!-- Lightbox Viewer -->
            <div id="lightbox" class="lightbox">
                <span class="close">&times;</span>
                <img class="lightbox-content" id="lightbox-img">
            </div>
        </div>
    </section>
@endsection

@section('additional-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lightbox = document.getElementById("lightbox");
            const lightboxImg = document.getElementById("lightbox-img");
            const closeBtn = document.querySelector(".lightbox .close");

            document.querySelectorAll(".gallery-item img").forEach(img => {
                img.addEventListener("click", () => {
                    lightbox.style.display = "flex";
                    lightboxImg.src = img.src;
                });
            });

            closeBtn.addEventListener("click", () => {
                lightbox.style.display = "none";
            });

            lightbox.addEventListener("click", (e) => {
                if (e.target === lightbox) {
                    lightbox.style.display = "none";
                }
            });
        });
    </script>
@endsection
