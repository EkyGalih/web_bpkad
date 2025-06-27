@extends('admin.index')
@section('title', 'PPID | Informasi Publik')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endsection
@section('content')
    @php
        use App\Enum\KlasifikasiEnum;
    @endphp
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Informasi Publik</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kip.create') }}" class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah
                        </a>
                        <button data-bs-toggle="modal" data-bs-target="#CacheKIP" data-bs-tooltip="tooltip"
                            data-bs-placement="top" title="Tong Sampah" class="btn btn-danger btn-md">
                            <i class="icon-base ri ri-delete-bin-3-fill icon-18px"></i>
                        </button>
                    </div>
                </div>
                @include('admin.ppid.kip.addons._cache')
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-bordered table-responsive kip">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Files</th>
                            <th>Diupload Oleh</th>
                            <th>Pada</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kip as $items)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">
                                    <div
                                        class="d-flex gap-3 border-start border-3 border-{{ KlasifikasiEnum::tryFrom($items->jenis_informasi)?->getColor() ?? 'muted' }} ps-3">
                                        <div>
                                            <a href="#"
                                                class="mb-1 text-gray-900 text-{{ KlasifikasiEnum::tryFrom($items->jenis_informasi)?->getColor() ?? 'muted' }} fw-bold">
                                                {{ strtoupper($items->jenis_informasi) }}
                                            </a>
                                            <div class="fs-7 text-muted fw-bold">{{ $items->nama_informasi }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($items->jenis_file == 'link')
                                        <a href="{{ $items->files }}" target="_blank" class="btn btn-success btn-sm"><i
                                                class="icon-base ri ri-download-2-line icon-18px me-2"></i>
                                            Download</a>
                                    @else
                                        <button data-id="{{ $items->id }}" data-nama="{{ $items->nama_informasi }}"
                                            data-view="{{ route('kip-admin.view_pdf', $items->id) }}"
                                            data-download="{{ route('kip-admin.download_pdf', $items->id) }}"
                                            type="button" class="btn btn-info btn-sm btn-open-modal" data-bs-toggle="modal"
                                            data-bs-target="#pdfModal">
                                            <i class="icon-base ri ri-eye-2-line icon-18px me-2"></i>View
                                        </button>
                                    @endif
                                </td>
                                <td>{{ GetUser($items->upload_by) }}</td>
                                <td>{{ $items->created_at == null
                                    ? 'None'
                                    : \Carbon\Carbon::parse($items->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('kip.edit', $items->id) }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</a>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('kip.destroy', $items->id) }}')"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin.ppid.kip.addons.show_pdf')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.kip').DataTable();
            $('.recycle').DataTable();
        });

        document.addEventListener('DOMContentLoaded', function() {
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
