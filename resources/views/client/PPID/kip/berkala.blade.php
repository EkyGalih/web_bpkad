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
        'keterangan' => 'Daftar Informasi ' . strtoupper(App\Enum\KlasifikasiEnum::BERKALA->value),
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
                                    @foreach ($data as $val => $berkala)
                                        <thead>
                                            <tr>
                                                <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                                    {{ $berkala['tahun'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($berkala['kip'] as $key => $berkala2)
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
                                                            <a href="{{ $berkala2['files'] }}"
                                                                class="btn btn-success btn-sm" target="_blank"
                                                                data-bs-tooltip="tooltip" data-bs-placement="left"
                                                                title="Download File">
                                                                <img src="{{ asset('client/assets/img/icons/solid/cloud-download.svg') }}"
                                                                    class="svg-inject icon-svg icon-svg-sm solid-mono text-info"
                                                                    alt="Search Icon" style="width: 18px; height: 18px;">
                                                            </a>
                                                        @else
                                                            <button type="button" data-toggle="modal"
                                                                data-bs-tooltip="tooltip" data-bs-placement="left"
                                                                title="Lihat Dokumen"
                                                                data-target="#pdfModal{{ $loop->iteration }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                <img src="{{ asset('client/assets/img/icons/solid/dot.svg') }}"
                                                                    class="svg-inject icon-svg icon-svg-sm solid-mono text-info"
                                                                    alt="Search Icon" style="width: 18px; height: 18px;">
                                                            </button>
                                                            <div class="modal fade" id="pdfModal{{ $loop->iteration }}"
                                                                tabindex="-1" aria-labelledby="pdfModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="pdfModalLabel">
                                                                                {{ $berkala2['nama_informasi'] }}</h5>
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <iframe
                                                                                src="{{ route('ppid-kip.view_pdf', $berkala2['id']) }}"
                                                                                width="100%" height="600px"
                                                                                frameborder="0"></iframe>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a href="{{ route('ppid-kip.download_pdf', $berkala2['id']) }}"
                                                                                class="btn btn-success btn-sm">
                                                                                <i class="bx bx-download"></i> Download
                                                                            </a>
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional-js')
    <script>
        const searchInput = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearSearch');
        const form = document.getElementById('searchForm');

        function toggleClearBtn() {
            clearBtn.style.display = searchInput.value.trim() ? 'inline' : 'none';
        }

        searchInput.addEventListener('input', toggleClearBtn);

        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            toggleClearBtn();
            form.submit();
        });

        toggleClearBtn();
    </script>
@endsection
