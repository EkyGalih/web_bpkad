@extends('client.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('additional-css')
    <style>
        .table-responsive-scroll {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
        }

        .table-responsive-scroll thead th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 1;
        }
    </style>
@endsection
@section('content_home')
    @include('layouts.client._header', [
        'title' => 'Informasi Publik',
        'keterangan' => 'Daftar Informasi ' . strtoupper(App\Enum\KlasifikasiEnum::SERTA_MERTA->value),
    ])
    <section class="wrapper bg-active-primary">
        <div class="container py-3 py-md-3">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="card" style="padding: 1%; margin: 1% 5%;">
                    @include('client.PPID.kip.partials._header')
                    <div class="card-body">
                        <div class="table-responsive-scroll">
                            <table class="table table-hover table-bordered">
                                @if (empty($data))
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data dengan pencarian
                                            <strong>{{ $query }}</strong>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($data as $val => $items)
                                        <thead>
                                            <tr>
                                                <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                                    {{ $items['tahun'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items['kip'] as $key => $berkala2)
                                                <tr>
                                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">{{ $berkala2['nama_informasi'] }}</td>
                                                    <td>
                                                        <span class="fw-bold">
                                                            {{ \Carbon\Carbon::parse($berkala2['created_at'])->locale('id')->translatedFormat('l, d F Y') }}
                                                        </span>
                                                        <br>
                                                        <span class="text-muted">
                                                            {{ \Carbon\Carbon::parse($berkala2['created_at'])->locale('id')->translatedFormat('h:i A') }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if ($berkala2['jenis_file'] == 'link')
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-success btn-sm btn-download-link"
                                                                data-id="{{ $berkala2['id'] }}"
                                                                data-url="{{ route('ppid-kip.click', $berkala2['id']) }}"
                                                                data-file="{{ $berkala2['files'] }}"
                                                                data-bs-tooltip="tooltip" data-bs-placement="left"
                                                                title="Download File">
                                                                <img src="{{ asset('client/assets/img/icons/solid/cloud-download.svg') }}"
                                                                    class="svg-inject icon-svg icon-svg-sm solid-mono text-info"
                                                                    alt="Search Icon" style="width: 18px; height: 18px;">
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-info btn-sm btn-open-modal"
                                                                data-bs-tooltip="tooltip" data-bs-placement="left"
                                                                data-id="{{ $berkala2['id'] }}"
                                                                data-nama="{{ $berkala2['nama_informasi'] }}"
                                                                data-url="{{ route('ppid-kip.click', $berkala2['id']) }}"
                                                                data-view="{{ route('ppid-kip.view_pdf', $berkala2['id']) }}"
                                                                data-download="{{ route('ppid-kip.download_pdf', $berkala2['id']) }}"
                                                                data-bs-toggle="modal" data-bs-target="#pdfModal"
                                                                title="Lihat Dokumen">
                                                                <img src="{{ asset('client/assets/img/icons/solid/dot.svg') }}"
                                                                    class="svg-inject icon-svg icon-svg-sm solid-mono text-info"
                                                                    alt="Search Icon" style="width: 18px; height: 18px;">
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                            @include('client.PPID.kip.partials._modal_view')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search Form
            const searchInput = document.getElementById('searchInput');
            const clearBtn = document.getElementById('clearSearch');
            const form = document.getElementById('searchForm');

            function toggleClearBtn() {
                clearBtn.style.display = searchInput?.value.trim() ? 'inline' : 'none';
            }

            if (searchInput && clearBtn && form) {
                searchInput.addEventListener('input', toggleClearBtn);
                clearBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    toggleClearBtn();
                    form.submit();
                });
                toggleClearBtn();
            }

            // Tombol download langsung (link)
            document.querySelectorAll('.btn-download-link').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const clickUrl = this.dataset.url;
                    const fileUrl = this.dataset.file;

                    fetch(clickUrl)
                        .then(res => res.ok ? res.json() : Promise.reject(res))
                        .then(() => window.open(fileUrl, '_blank'))
                        .catch(err => {
                            console.error('Gagal menambahkan klik:', err);
                            window.open(fileUrl, '_blank');
                        });
                });
            });

            // Tombol open modal
            document.querySelectorAll('.btn-open-modal').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const clickUrl = this.dataset.url;
                    const viewUrl = this.dataset.view;
                    const downloadUrl = this.dataset.download;
                    const namaInformasi = this.dataset.nama;

                    // Tambah klik
                    fetch(clickUrl).catch(err => console.warn('Click gagal:', err));

                    // Set iframe dan link download
                    const iframe = document.getElementById('pdfFrame');
                    const downloadBtn = document.getElementById('pdfDownloadBtn');
                    const modalTitle = document.getElementById('pdfModalLabel');

                    if (iframe && downloadBtn && modalTitle) {
                        iframe.src = viewUrl;
                        downloadBtn.href = downloadUrl;
                        modalTitle.innerText = namaInformasi;
                    }
                });
            });

            // Fix aksesibilitas: setelah modal ditutup, hapus fokus
            const pdfModal = document.getElementById('pdfModal');
            if (pdfModal) {
                pdfModal.addEventListener('hidden.bs.modal', function() {
                    document.activeElement.blur(); // hilangkan fokus dari modal
                    document.getElementById('pdfFrame').src = ""; // kosongkan iframe
                });
            }
        });
    </script>
@endsection
