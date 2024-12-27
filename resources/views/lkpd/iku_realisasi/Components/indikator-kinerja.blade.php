@extends('admin.index')
@section('title', 'Indikator Kinerja')
@section('menu-iku-realisasi', 'active')
@section('iku-indikator', 'active')
@section('content')
    <h3><a href="{{ route('iku-realisasi.index') }}"><i class="fas fa-tachometer-alt"></i> Indikator Kinerja</a></h3>
    <hr />
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <div class="row">
                    <div class="col-lg-11">
                        <h4 class="title">Indikator Kinerja</h4>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-theme btn-sm" data-toggle="modal" data-target="#TambahData">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                        @include('admin.iku_realisasi.Addons.IndikatorKinerja.add')

                    </div>
                </div>

                <hr />
                @include('admin.iku_realisasi.Addons.IndikatorKinerja.table')
            </div>
        </div>
    </div>
@endsection
