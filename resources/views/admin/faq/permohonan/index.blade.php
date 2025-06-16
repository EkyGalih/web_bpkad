@extends('admin.index')
@section('title', 'Menu')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <style>
        .image_upload>input {
            display: none;
        }

        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background-color: rgba(0, 0, 0, 0.3);
            /* Lebih ringan dan ramping */
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(3px);
            animation: fadeIn 0.2s ease-in-out;
        }

        .lightbox-inner {
            background: #000;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.7);
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
        }

        .lightbox-inner img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
        }

        .close-lightbox {
            position: absolute;
            top: -15px;
            right: -15px;
            background: #fff;
            color: #000;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">FAQ - Permohonan Masyarakat</h4>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover faq-permohonan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permohonan</th>
                            <th>Pemohon</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $item)
                            @php
                                $tes = get_date($item->created_at);
                            @endphp
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-wrap">
                                    <div class="d-flex gap-3 border-start border-3 border-info ps-3">
                                        <div>
                                            <a href="#" data-bs-tooltip="tooltip" data-bs-toggle="modal"
                                                data-bs-target="#ShowPermohonan{{ $loop->iteration }}"
                                                data-bs-placement="top" title="Lihat Permohonan"
                                                class="mb-1 text-gray-900 text-info fw-bold">
                                                {{ $item->kode_pemohon }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" data-bs-tooltip="tooltip" data-bs-toggle="modal"
                                        data-bs-target="#ShowPemohon{{ $loop->iteration }}" data-bs-placement="top"
                                        title="Lihat Pemhon" class="text-decoration-none text-gray-900">
                                        <i class="icon-base ri ri-user-3-line icon-18px me-2"></i>
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>
                                    @if ($item->status == 'proses')
                                        <a href="{{ route('permohonan-admin.status', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="icon-base ri ri-time-fill me-2"></i>
                                            Proses</a>
                                    @else
                                        <a href="#" class="btn btn-success btn-sm"><i
                                                class="icon-base ri ri-check-double-fill me-2"></i>
                                            selesai</a>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-md"
                                        onclick="deleteData('{{ route('permohonan-admin.destroy', $item->id) }}')"
                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Permohonan">
                                        <i class="icon-base ri ri-delete-bin-4-fill"></i>
                                    </button>
                                </td>
                                @include('admin/faq/permohonan/addons/_detail')
                                @include('admin.faq.permohonan.addons._pemohon')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.faq-permohonan').DataTable();
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

        document.querySelectorAll('.thumbnail-img').forEach(img => {
            img.addEventListener('click', function() {
                const lightbox = document.getElementById('lightbox');
                const lightboxImg = document.getElementById('lightbox-img');
                lightboxImg.src = this.src;
                lightbox.style.display = 'flex';
            });
        });

        function closeLightbox(event = null) {
            if (event) event.stopPropagation();
            document.getElementById('lightbox').style.display = 'none';
            document.getElementById('lightbox-img').src = '';
        }
    </script>
@endsection
