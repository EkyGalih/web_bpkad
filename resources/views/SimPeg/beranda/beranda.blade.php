@extends('SimPeg.index')
@section('title', env('APP_NAME') . ' - SIMPEG')
@section('title_page', 'Beranda')
@section('home', 'here show')

@section('content')
   <h1>Welcome {{ Auth::user()->nama }}</h1>
    <div class="row g-5 g-xl-10">
        <div class="col-sm-6 col-xl-2 mb-xl-10">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <img src="{{ asset('assets/media/avatars/asn.png') }}" class="w-35px" alt="">
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ App\Models\Pegawai::where('jenis_pegawai', 'asn')->count() }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-6 text-gray-500">ASN</span>
                        </div>
                    </div>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-light-success btn-sm">
                        <i class="ki-outline ki-arrow-right fs-5 text-success ms-n1"></i> Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2 mb-xl-10">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <img src="{{ asset('assets/media/avatars/non-asn.png') }}" class="w-35px" alt="">
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ App\Models\Pegawai::where('jenis_pegawai', 'non asn')->count() }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-6 text-gray-500">NON ASN</span>
                        </div>
                    </div>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-light-success btn-sm">
                        <i class="ki-outline ki-arrow-right fs-5 text-success ms-n1"></i> Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-2 mb-xl-10">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <img src="{{ asset('assets/media/avatars/bidang.png') }}" class="w-35px" alt="">
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ App\Models\Bidang::count() }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-6 text-gray-500">Bidang</span>
                        </div>
                    </div>
                    <a href="{{ route('bidang.index') }}" class="btn btn-light-success btn-sm">
                        <i class="ki-outline ki-arrow-right fs-5 text-success ms-n1"></i> Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
