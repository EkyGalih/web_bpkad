@extends('lkpd.index')
@section('title', 'Laporan Realisasi Anggaran')

@section('apbd', 'here show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-book-open fs-1 me-2"></i>LAPORAN REALISASI ANGGARAN APBD (NTB)
        </h1>
    </div>
    <div class="d-flex justify-content-end">
        <select id="tahun_anggaran" class="form-control w-100 me-2" onchange="getApbd()">
            <option value="">Pilih Tahun Anggaran</option>
            @foreach ($get_tahun as $ta)
                <option value="{{ $ta->tahun_anggaran }}" {{ $ta->tahun_anggaran == $tahun_anggaran ? 'selected' : '' }}>
                    {{ $ta->tahun_anggaran }}</option>
            @endforeach
        </select>
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <div class="card-header p-0">
                    <div class="card-title text-center">
                        <h4 class="fw-bold mb-5">LAPORAN REALISASI ANGGARAN PENDAPATAN
                            DAN BELANJA DAERAH (KONSOLIDASI)<br /><span class="d-block">{{ $tahun_anggaran }}</span><br />01
                            Januari
                            {{ $get_tahun->isEmpty() ? date('Y') : $tahun_anggaran }} Sampai {{ $get_tahun->isEmpty() ? date('d F Y') : '31 Desember ' . $tahun_anggaran }}</h4>
                    </div>
                    <input type="hidden" value="{{ $get_tahun->isEmpty() ? date('Y') : $tahun_anggaran }}" id="get_ta">
                </div>
                <div class="card-body p-0">
                    <div class="col-lg-12">
                        @include('lkpd.RealisasiAnggaran.Components.table')
                        @include('lkpd.RealisasiAnggaran.Components.edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <canvas id="RealisasiAnggaran-chart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/plugins/custom/jquery-mask/jquery-mask.js') }}"></script>
    <script>
        $(".switch").click(function() {
            $(this).toggleClass("switchOn");
        })
        $('#anggaran_terealisasi').maskMoney({
            precision: 0
        });

        $('#realisasi-table').dataTable();

        tahun_anggaran = $('#get_ta').val();

        function getApbd() {
            ta = $('#tahun_anggaran').val();
            window.location.href = window.location.origin + '/admin/lkpd/Realisasi-Anggaran/' + ta
        }

        jumlah_pendapatan1 = $('#jumlah_pendapatan1').val();
        jumlah_pendapatan2 = $('#jumlah_pendapatan2').val();
        var selisih_pendapatan = Math.abs(jumlah_pendapatan1 - jumlah_pendapatan2);

        jumlah_belanja1 = $('#jumlah_belanja1').val();
        jumlah_belanja2 = $('#jumlah_belanja2').val();
        var selisih_belanja = Math.abs(jumlah_belanja1 - jumlah_belanja2);

        jumlah_pembiayaan1 = $('#jumlah_pembiayaan1').val();
        jumlah_pembiayaan2 = $('#jumlah_pembiayaan2').val();
        var selisih_pembiayaan = Math.abs(jumlah_pembiayaan1 - jumlah_pembiayaan2);
    </script>
    @include('layouts.admin.lkpd.Script.apbd-chart')
@endsection
