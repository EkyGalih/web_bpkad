@extends('admin.index')
@section('title', 'Formula IKU Realisasi')
@section('menu-iku-realisasi', 'active')
@section('iku-formulasi', 'active')
@section('content')
    <h3><a href="{{ route('iku-formulasi') }}"><i class="fas fa-file-code"></i> Formulasi Iku Realisasi</a></h3>
    <hr />
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <div class="row">
                    <div class="col-lg-11">
                        <h4 class="title">Formulasi Iku Realisasi</h4>
                    </div>
                    <div class="col-lg-1">
                        <div type="button" class="btn btn-theme btn-sm" data-toggle="modal" data-target="#TambahData">
                            <i class="fas fa-plus"></i> Tambah Data
                        </div>
                        @include('admin.iku_realisasi.Addons.Formula.add')

                    </div>
                </div>

                <hr />
                @include('admin.iku_realisasi.Addons.Formula.table')
            </div>
        </div>
    </div>
@endsection
