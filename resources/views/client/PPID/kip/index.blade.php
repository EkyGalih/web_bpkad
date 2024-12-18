@extends('client.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="card" style="padding: 1%; margin-right: 5%; margin-left: 5%; margin-top: 1%;">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="berkala-tab" data-toggle="tab" data-target="#berkala"
                            type="button" role="tab" aria-controls="berkala" aria-selected="true">Informasi
                            Berkala</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="dikecualikan-tab" data-toggle="tab" data-target="#dikecualikan"
                            type="button" role="tab" aria-controls="dikecualikan" aria-selected="true">Informasi
                            Dikecualikan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="serta-merta-tab" data-toggle="tab" data-target="#serta-merta"
                            type="button" role="tab" aria-controls="serta-merta" aria-selected="true">Informasi
                            Serta Merta</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="setiap-saat-tab" data-toggle="tab" data-target="#setiap-saat"
                            type="button" role="tab" aria-controls="setiap-saat" aria-selected="true">Informasi
                            Setiap Saat</button>
                    </li>
                </ul>
                <ol>
                    <li><a href="{{ '/' }}">Home</a></li>
                    <li><a href="#">PPID</a></li>
                    <li>
                        <a href="{{ route('ppid-kip') }}">Klasifikasi Informasi Publik</a>
                    </li>
                </ol>
            </div>
            <div class="tab-content" id="myTabContent">
                @php
                    $KipBerkala = Helpers::_KipPPID('berkala', $query);
                    $KipSetiapSaat = Helpers::_KipPPID('setiap saat', $query);
                    $KipDikecualikan = Helpers::_KipPPID('dikecualikan', $query);
                    $KipSertaMerta = Helpers::_KipPPID('serta merta', $query);
                @endphp
                <div class="tab-pane fade show active" id="berkala" role="tabpanel" aria-labelledby="berkala-tab">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI BERKALA</strong>
                            </h2>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('ppid-kip.search_berkala') }}">
                                <div class="form-row align-items-center">
                                    <div class="col-10">
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="bx bx-search"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="search" id="search_berkala" class="form-control"
                                                placeholder="Cari Data .." value="{{ old('search') ?? $query }}">
                                        </div>
                                    </div>
                                    <div class="col-auto btn-group" style="margin-bottom: 3%;">
                                        <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered">
                            @foreach ($KipBerkala as $val => $berkala1)
                                <thead>
                                    <tr>
                                        <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                            {{ $berkala1['tahun'] }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($berkala1['kip'] as $key => $berkala2)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $berkala2['nama_informasi'] }}</td>
                                            <td>{{ Helpers::GetDate($berkala2['created_at']) . ' ' . Helpers::GetTime($berkala2['created_at']) }}
                                            </td>
                                            <td>
                                                @if ($berkala2['jenis_file'] == 'link')
                                                    <a href="{{ $berkala2['files'] }}" class="btn btn-success btn-sm"
                                                        target="_blank">
                                                        <i class="bx bx-download"></i> Download
                                                    </a>
                                                @else
                                                    <button type="button" data-toggle="modal" data-target="#pdfModal{{ $loop->iteration }}" class="btn btn-info btn-sm"
                                                        target="_blank">
                                                        <i class="bx bx-show"></i> View
                                                    </button>
                                                    <div class="modal fade" id="pdfModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="pdfModalLabel">{{ $berkala2['nama_informasi'] }}</h5>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">X</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <iframe src="{{ route('ppid-kip.view_pdf', $berkala2['id']) }}" width="100%" height="600px" frameborder="0"></iframe>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ route('ppid-kip.download_pdf', $berkala2['id']) }}" class="btn btn-success btn-sm">
                                                                        <i class="bx bx-download"></i> Download
                                                                    </a>
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade " id="dikecualikan" role="tabpanel" aria-labelledby="dikecualikan-tab">
                    <h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI DIKECUALIKAN</strong>
                    </h2>
                    <table class="table table-hover table-bordered">
                        @foreach ($KipDikecualikan as $val => $dikecualikan1)
                            <thead>
                                <th>
                                <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                    {{ $dikecualikan1['tahun'] }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dikecualikan1['kip'] as $key => $dikecualikan2)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dikecualikan2['nama_informasi'] }}</td>
                                        <td>{{ Helpers::GetDate($dikecualikan2['created_at']) . ' ' . Helpers::GetTime($dikecualikan2['created_at']) }}
                                        </td>
                                        <td>
                                            @if ($dikecualikan2['jenis_file'] == 'link')
                                                <a href="#" class="btn btn-success btn-sm">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="tab-pane fade " id="serta-merta" role="tabpanel" aria-labelledby="serta-merta-tab">
                    <h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI SERTA MERTA</strong>
                    </h2>
                    <table class="table table-hover table-bordered">
                        @foreach ($KipSertaMerta as $val => $sertamerta1)
                            <thead>
                                <th>
                                <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                    {{ $sertamerta1['tahun'] }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sertamerta1['kip'] as $key => $sertamerta2)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sertamerta2['nama_informasi'] }}</td>
                                        <td>{{ Helpers::GetDate($sertamerta2['created_at']) . ' ' . Helpers::GetTime($sertamerta2['created_at']) }}
                                        </td>
                                        <td>
                                            @if ($sertamerta2['jenis_file'] == 'link')
                                                <a href="#" class="btn btn-success btn-sm">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="tab-pane fade " id="setiap-saat" role="tabpanel" aria-labelledby="setiap-saat-tab">
                    <h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI SETIAP SAAT</strong>
                    </h2>
                    <table class="table table-hover table-bordered">
                        @foreach ($KipSetiapSaat as $val => $setiapsaat1)
                            <thead>
                                <th>
                                <th colspan="4" style="text-align: center; font-size: 25px;">Tahun
                                    {{ $setiapsaat1['tahun'] }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($setiapsaat1['kip'] as $key => $setiapsaat2)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $setiapsaat2['nama_informasi'] }}</td>
                                        <td>{{ Helpers::GetDate($setiapsaat2['created_at']) . ' ' . Helpers::GetTime($setiapsaat2['created_at']) }}
                                        </td>
                                        <td>
                                            @if ($setiapsaat2['jenis_file'] == 'link')
                                                <a href="#" class="btn btn-success btn-sm">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
@section('additional-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        // var route = "{{ route('ppid-kip.search_berkala') }}";
        // http://web_bpkad.suru.test/PPID/Klasifikasi-Informasi-Publik/info-berkala?search=tes
        // pencarian dengan tekan enter untuk jquery
        // $('#search_berkala').on('keyup', function(e) {
        //     if (e.keyCode === 13) {
        //         var query = $('#search_berkala').val();
        //         console.log(route);
        //     }
        // });

        $('#search_berkala').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection
