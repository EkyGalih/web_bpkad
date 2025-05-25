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
    <section class="section-frame overflow-hidden">
        <div class="wrapper bg-info">
            <div class="container py-12 py-md-16 text-center">
                <div class="row">
                    <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                        <h1 class="display-1 mb-3 text-white">Informasi Publik</h1>
                        <p class="lead px-lg-5 px-xxl-8 mb-1 text-white">Daftar Informasi
                            {{ strtoupper(App\Enum\KlasifikasiEnum::SETIAP_SAAT->value) }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $berkala2['nama_informasi'] }}</td>
                                                    <td>{{ Helpers::GetDate($berkala2['created_at']) . ' ' . Helpers::GetTime($berkala2['created_at']) }}
                                                    </td>
                                                    <td>
                                                        @if ($berkala2['jenis_file'] == 'link')
                                                            <a href="{{ $berkala2['files'] }}"
                                                                class="btn btn-success btn-sm" target="_blank">
                                                                <i class="bx bx-download"></i> Download
                                                            </a>
                                                        @else
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#pdfModal{{ $loop->iteration }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                <i class="bx bx-show"></i> View
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
