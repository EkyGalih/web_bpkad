@extends('client.index')
@section('title', 'OLYMPIC |')
@section('additional-css')

@endsection
@section('content_home')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-300"
        data-image-src="{{ asset($settings->header_image) }}">
        <div class="container pt-17 pb-19 pt-md-18 pb-md-17 text-center">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                    <h1 class="display-1 mb-3 text-white">Olympic</h1>
                    <p class="lead px-lg-5 px-xxl-8 mb-1 text-white"></p>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-10">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="col-lg-12">
                    <div class="blog single">
                        <div class="card">
                            <div class="card-header" style="background-color: #0a1b39;">
                                <div class="d-flex align-items-center justify-content-center text-center">
                                    <h1 class="fw-bold text-warning mb-0 me-2">{{ $champions->nama_bidang }}</h1>
                                    <img class="blink mx-2 me-2" src="https://storage.ntbprov.go.id/bpkad/uploads/defaults/champion.png" alt="Champion" height="80px" width="70px" style="margin-top: -6px;">
                                    <h1 class="fw-bold text-warning mb-0">{{ $olympics[0]->tahun }}</h1>
                                </div>
                            </div>
                            <div class="card-body">
                                @php
                                    // Buat rankingMap berdasarkan urutan emas, perak, perunggu (tahun aktif)
                                    $sortedOlympics = $olympics
                                        ->sortByDesc(fn($o) => [$o->emas, $o->perak, $o->perunggu])
                                        ->values();
                                    $rankingMap = collect();
                                    foreach ($sortedOlympics as $index => $item) {
                                        $rankingMap[$item->id] = $index + 1;
                                    }
                                @endphp
                                <table class="table styled-table">
                                    <thead>
                                        <tr>
                                            <td>Rank</td>
                                            <td>Bidang</td>
                                            <td class="text-center">Emas</td>
                                            <td class="text-center">Perak</td>
                                            <td class="text-center">Perunggu</td>
                                            <td style="text-align: center;">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($olympics as $olympic)
                                            @php
                                                $ranking = $rankingMap[$olympic->id] ?? null;
                                                $rowClass = match ($ranking) {
                                                    1 => 'table-warning', // Juara 1
                                                    2 => 'table-secondary', // Juara 2
                                                    3 => 'table-danger', // Juara 3
                                                    default => '',
                                                };
                                            @endphp
                                            <tr class="{{ $rowClass }}">
                                                <td>
                                                    @if ($ranking <= 3)
                                                        <img src="https://storage.ntbprov.go.id/bpkad/uploads/defaults/{{ $ranking }}.png"
                                                            alt="Rank {{ $ranking }}" width="35px" height="50px">
                                                    @else
                                                        {{ $ranking }}
                                                    @endif
                                                </td>
                                                <td class="fw-bold">{{ strtoupper($olympic->nama_bidang) }}</td>
                                                <td style="text-align: center; font-weight: bold;">
                                                    {{ $olympic->emas }}</td>
                                                <td style="text-align: center; font-weight: bold;">
                                                    {{ $olympic->perak }}</td>
                                                <td style="text-align: center; font-weight: bold;">
                                                    {{ $olympic->perunggu }}</td>
                                                <td style="text-align: center;">{{ $olympic->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('additional-js')

@endsection
