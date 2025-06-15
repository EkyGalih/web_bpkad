@extends('admin.index')
@section('title', 'FAQ | Laporan Masyarakat')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">FAQ - Laporan Masyarakat</h4>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover faq-laporan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Laporan</th>
                            <th>Pelapor</th>
                            <th>Tanggal</th>
                            <th>Jawaban</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $lap)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-wrap">
                                    <div class="d-flex gap-3 border-start border-3 border-info ps-3">
                                        <div>
                                            <a href="#" data-bs-tooltip="tooltip" data-bs-toggle="modal"
                                                data-bs-target="#ShowLaporan{{ $loop->iteration }}" data-bs-placement="top"
                                                title="Lihat Laporan" class="mb-1 text-gray-900 text-info fw-bold">
                                                {{ strtoupper($lap->judul_laporan) }}
                                            </a>
                                            <div class="fs-7 text-muted fw-bold">{{ $lap->kode_laporan }} -
                                                <span class="fs-7 text-muted fw-bold text-primary">
                                                    Kategori {{ $lap->kategori_laporan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" data-bs-tooltip="tooltip" data-bs-toggle="modal"
                                        data-bs-target="#ShowPelapor{{ $loop->iteration }}" data-bs-placement="top"
                                        title="Lihat Pelapor" class="text-decoration-none text-gray-900">
                                        <i class="icon-base ri ri-user-3-line icon-18px me-2"></i>
                                        {{ $lap->nama_pelapor }}
                                    </a>
                                </td>
                                <td>{{ $lap->tgl_laporan == null ? 'None' : get_date($lap->tgl_laporan) }}
                                </td>
                                <td>{{ $lap->jawaban_dari }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-tooltip="tooltip"
                                                data-bs-toggle="modal" data-bs-target="#ShowBerkas{{ $loop->iteration }}"
                                                data-bs-placement="top" title="Lihat Berkas"><i class="icon-base ri ri-file-3-line icon-18px me-2"></i>
                                                Lihat Bukti</button>
                                            <button data-bs-toggle="modal" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Lihat Jawaban" data-bs-target="#Jawab{{ $loop->iteration }}"
                                                class="dropdown-item" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Jadikan Agenda Kaban">
                                                <i class="icon-base ri ri-question-answer-line icon-18px me-2"></i> Tanggapi Laporan
                                            </button>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('laporan-admin.destroy', $lap->id) }}')"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                    @include('admin/faq/laporan/addons/_pelapor')
                                    @include('admin/faq/laporan/addons/_detail')
                                    @include('admin/faq/laporan/addons/_bukti')
                                    @include('admin/faq/laporan/addons/_jawab')
                                </td>
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
            $('.faq-laporan').DataTable();
        });

        var loadBerkas = function(event) {
            var berkas = document.getElementById('berkas');
            berkas.src = URL.createObjectURL(event.target.files[0]);
            berkas.onload = function() {
                URL.revokeObjectURL(berkas.src);
            }
        };
    </script>
@endsection
