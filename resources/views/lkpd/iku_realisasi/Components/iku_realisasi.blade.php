@extends('admin.index')
@section('title', 'IKU & Realisasi')
@section('menu-iku-realisasi', 'active')
@section('iku-realisasi', 'active')
@section('content')
    <h3><a href="{{ route('iku-realisasi.index') }}"><i class="fas fa-book"></i> IKU & Realisasi BPKAD</a></h3>
    <hr />
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="title"><i class="fas fa-list"></i> Capaian Iku & Realisasi</h4>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-lg-6">
                        @include('lkpd.iku_realisasi.Addons.IkuRealisasi.table-rkt')
                        @include('lkpd.iku_realisasi.Addons.IkuRealisasi.add')
                    </div>
                    <div class="col-lg-6">
                        @include('lkpd.iku_realisasi.Addons.IkuRealisasi.program-anggaran')
                        @include('lkpd.iku_realisasi.Addons.IkuRealisasi.add-program-anggaran')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        @include('lkpd.iku_realisasi.Addons.IkuRealisasi.table-iku')
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
