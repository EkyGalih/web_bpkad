@extends('lkpd.index')
@section('title', 'APBD')

@section('apbd', 'here show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="fas fa-journal-whills me-2"></i> APBD PROVINSI NUSA TENGGARA BARAT (NTB)
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0 w-50">
        <select id="tahun_anggaran" class="form-control w-50 me-2" onchange="getApbd()">
            <option value="">Pilih Tahun Anggaran</option>
            @foreach ($get_tahun as $ta)
                <option value="{{ $ta->tahun_anggaran }}" {{ $tahun_anggaran == $ta->tahun_anggaran ? 'selected' : '' }}>
                    {{ $ta->tahun_anggaran }}
                </option>
            @endforeach
        </select>
        <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalImport">
            <i class="ki-outline ki-file-up fs-2"></i> Import APBD
        </button>
        <div type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <i class="ki-outline ki-plus-circle fs-2"></i> Tambah Item
        </div>
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-line-tabs mb-8 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#one-years">DATA PERTAHUN
                            ({{ $tahun_anggaran }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#five-years">DATA 5 TAHUN TERAKHIR</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="one-years" role="tabpanel">
                        @include('lkpd.Apbd.Components.table')
                    </div>
                    <div class="tab-pane fade" id="five-years" role="tabpanel">
                        @include('lkpd.Apbd.Components.table-5-years')
                    </div>
                </div>
            </div>
        </div>
        @include('lkpd.Apbd.Components.import')
        @include('lkpd.Apbd.Components.add')
    </div>
    <div class="row mt">
        <div class="col-lg-6">
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
        $('apbd-table').dataTable();

        tahun_anggaran = $('#get_ta').val();

        function getApbd() {
            ta = $('#tahun_anggaran').val();
            window.location.href = window.location.origin + '/admin/lkpd/apbd/' + ta
        }

        // get years

        years1 = $('#years1').val();
        years2 = $('#years2').val();
        years3 = $('#years3').val();
        years4 = $('#years4').val();

        // chart Apbd
        jumlah_pendapatan1 = $('#jumlah_pendapatan1').val();
        jumlah_pendapatan2 = $('#jumlah_pendapatan2').val();
        selisih_pendapatan = Math.abs(jumlah_pendapatan1 - jumlah_pendapatan2);
        data_pendapatan_years1 = $('#jumlah_pendapatan_' + years1).val();

        data_pendapatan_years2 = $('#jumlah_pendapatan_' + years2).val();
        data_pendapatan_years3 = $('#jumlah_pendapatan_' + years3).val();
        data_pendapatan_years4 = $('#jumlah_pendapatan_' + years4).val();

        jumlah_belanja1 = $('#jumlah_belanja1').val();
        jumlah_belanja2 = $('#jumlah_belanja2').val();
        selisih_belanja = Math.abs(jumlah_belanja1 - jumlah_belanja2);
        data_belanja_years1 = $('#jumlah_belanja_' + years1).val();
        data_belanja_years2 = $('#jumlah_belanja_' + years2).val();
        data_belanja_years3 = $('#jumlah_belanja_' + years3).val();
        data_belanja_years4 = $('#jumlah_belanja_' + years4).val();

        jumlah_pembiayaan1 = $('#jumlah_pembiayaan1').val();
        jumlah_pembiayaan2 = $('#jumlah_pembiayaan2').val();
        selisih_pembiayaan = Math.abs(jumlah_pembiayaan1 - jumlah_pembiayaan2);
        data_pembiayaan_years1 = $('#jumlah_pembiayaan_' + years1).val();
        data_pembiayaan_years2 = $('#jumlah_pembiayaan_' + years2).val();
        data_pembiayaan_years3 = $('#jumlah_pembiayaan_' + years3).val();
        data_pembiayaan_years4 = $('#jumlah_pembiayaan_' + years4).val();

        data_pembiayaan2_years1 = $('#jumlah_pembiayaan2_' + years1).val();
        data_pembiayaan2_years2 = $('#jumlah_pembiayaan2_' + years2).val();
        data_pembiayaan2_years3 = $('#jumlah_pembiayaan2_' + years3).val();
        data_pembiayaan2_years4 = $('#jumlah_pembiayaan2_' + years4).val();
    </script>
    @include('layouts.admin.lkpd.Script.apbd.add-script')
    @include('layouts.admin.lkpd.Script.apbd-chart')
@endsection
