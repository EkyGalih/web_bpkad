@extends('SimPeg.index')
@section('title', env('APP_NAME') . ' - SIMPEG')
@section('title_page', 'Beranda')
@section('home', 'here show')

@section('content')
   <h1>Welcome {{ Auth::user()->nama }}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-body">
                <h5 class="card-title">Jumlah Pegawai ASN</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ \App\Models\Pegawai::where('jenis_pegawai', 'asn')->count() }} Pegawai</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body">
                <h5 class="card-title">Jumlah Pegawai Non ASN</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ \App\Models\Pegawai::where('jenis_pegawai', 'non asn')->count() }} Pegawai</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body">
                <h5 class="card-title">Jumlah Bidang</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ \App\Models\Bidang::count() }} Bidang</h6>
            </div>
        </div>
    </div>
@endsection
