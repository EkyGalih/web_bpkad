@extends('client.index')

@section('title', 'Galeri Video - ')

@section('additional-css')
    <style>
        .gallery-card video {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover video {
            transform: scale(1.01);
            filter: brightness(85%);
        }

        .info-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 8px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
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

        /* Lightbox */
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
                        Galeri Video: <span class="underline-3 style-2 blue">{{ $galery->name }}</span>
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

    <!-- Video Gallery Section -->
    <section class="wrapper bg-light">
        <div class="container py-10">
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('video') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="ri ri-arrow-left-box-fill me-2"></i> Kembali
                </a>
            </div>

            @if ($videos->isEmpty())
                <div class="text-center py-6">
                    <h5 class="text-muted">Belum ada video di galeri ini.</h5>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($videos as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="position-relative gallery-card">
                                <div class="info-overlay">
                                    <span>
                                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <video src="{{ asset($item->path) }}"
                                    muted preload="metadata"
                                    controlslist="nodownload nofullscreen noremoteplayback"
                                    onmouseover="this.controls=true"
                                    onmouseout="this.controls=false"
                                    onclick="openLightbox(this.src)">
                                </video>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $videos->links() }}
                </div>
            @endif

            <!-- Lightbox -->
            <div id="lightbox" class="lightbox">
                <span class="close">&times;</span>
                <video id="lightbox-video" class="lightbox-content" controls autoplay></video>
            </div>
        </div>
    </section>
@endsection

@section('additional-js')
    <script>
        function openLightbox(src) {
            const lightbox = document.getElementById("lightbox");
            const video = document.getElementById("lightbox-video");

            lightbox.style.display = "flex";
            video.src = src;
            video.play();
        }

        document.addEventListener("DOMContentLoaded", () => {
            const lightbox = document.getElementById("lightbox");
            const video = document.getElementById("lightbox-video");
            const closeBtn = document.querySelector(".lightbox .close");

            closeBtn.addEventListener("click", () => {
                lightbox.style.display = "none";
                video.pause();
                video.src = "";
            });

            lightbox.addEventListener("click", (e) => {
                if (e.target === lightbox) {
                    lightbox.style.display = "none";
                    video.pause();
                    video.src = "";
                }
            });
        });
    </script>
@endsection
