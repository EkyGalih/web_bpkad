@extends('admin.index')
@section('title', 'Galery Foto')
@section('styles')
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

        /* Info (tanggal dan tombol) */
        .gallery-item .info {
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

        /* Lightbox container */
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

        /* Gambar yang ditampilkan di tengah */
        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            object-fit: contain;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        }

        /* Tombol close */
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
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h4 class="mb-0">Galery Foto</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('galery-foto.index') }}" class="btn btn-outline-secondary">
                    <i class="icon-base ri ri-arrow-left-box-fill me-2"></i> Kembali
                </a>
                <a href="{{ route('galery-foto.create', $foto->id) }}" class="btn btn-outline-success">
                    <i class="icon-base ri ri-upload-2-fill me-2"></i> Upload
                </a>
            </div>
        </div>
        <p class="mb-6">
            {{ $foto->name }}
        </p>
        <!-- Role cards -->
        <div class="row g-6">
            <div class="gallery">
                @foreach ($fotos as $item)
                    <div class="gallery-item">
                        <img src="{{ asset($item->path) }}" alt="{{ $item->galery->name }}" />
                        <div class="info">
                            <span class="date">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d M Y') }}
                            </span>
                            <button class="delete-btn" onclick="deleteData('{{ route('galery-foto.destroy', $item->id) }}')" data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Foto">
                                <i class="icon-base ri ri-delete-bin-fill"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Tambahkan gambar sesuai kebutuhan -->
                @endforeach
                <!-- Modal Zoom -->
            </div>
            {{ $fotos->links() }}
            <div id="lightbox" class="lightbox">
                <span class="close">&times;</span>
                <img class="lightbox-content" id="lightbox-img">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lightbox = document.getElementById("lightbox");
            const lightboxImg = document.getElementById("lightbox-img");
            const closeBtn = document.querySelector(".lightbox .close");

            document.querySelectorAll(".gallery-item img").forEach(img => {
                img.addEventListener("click", () => {
                    lightbox.style.display = "flex"; // pakai flex, bukan block
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
