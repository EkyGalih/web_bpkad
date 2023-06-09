@extends('client.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="card" style="padding: 3%; margin-right: 5%; margin-left: 5%;">
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
                    <li><a href="PPID">PPID</a></li>
                    <li>Klasifikasi Informasi Publik</li>
                </ol>
            </div>
            <div class="tab-content" id="myTabContent">
                @php
                    $KipBerkala = Helpers::_KipPPID('berkala');
                    $KipSetiapSaat = Helpers::_KipPPID('setiap saat');
                    $KipDikecualikan = Helpers::_KipPPID('dikecualikan');
                    $KipSertaMerta = Helpers::_KipPPID('serta merta');
                @endphp
                <div class="tab-pane fade show active" id="berkala" role="tabpanel" aria-labelledby="berkala-tab">
                    <h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI BERKALA</strong></h2>
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
                                                    <a href="{{ $berkala2['files'] }}" class="btn btn-info btn-sm"
                                                        target="_blank">
                                                        <i class="bx bx-show"></i> Lihat
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
        var route = "{{ route('ppid-kip.search') }}";

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
