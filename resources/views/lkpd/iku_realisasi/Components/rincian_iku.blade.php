@extends('lkpd.index')
@section('title', 'Data Kinerja')
@section('iku', 'here show')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-text-number fs-1 me-2"></i> Data Kinerja
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalImport">
            <i class="ki-outline ki-cloud-add fs-2"></i> Import Data
        </button>
        @include('lkpd.iku_realisasi.Addons.RincianIku.import')
    </div>
@endsection
@section('content')
<div class="row g-5 g-xl-12">
    <div class="col-xl-12">
        <div class="card card-flush p-5">
            @foreach ($KegiatanIku as $kegiatan)
                <!-- Begin::Accordion -->
                <div class="accordion accordion-icon-toggle" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                            @php
                                $persen = Iku::GetAllPersentase($kegiatan->kode_kegiatan);
                                if ($persen == 100) {
                                    $warna = 'success';
                                } elseif ($persen > 50) {
                                    $warna = 'warning';
                                } else {
                                    $warna = 'danger';
                                }
                            @endphp
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                {{ Helpers::GetBidang($kegiatan->bidang_id) }}
                                <span class="badge badge-light-{{ $warna }} ms-2">{{ $persen }}%</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ol style="list-style-type: upper-roman;">
                                    <li class="fw-bold fs-5 text-dark">
                                        {{ $kegiatan->nama_kegiatan }}
                                    </li>
                                    @php $SubKegiatan = Iku::GetSubKegiatanAll($kegiatan->kode_kegiatan) @endphp
                                    <ol type="a" class="ms-4">
                                        @foreach ($SubKegiatan as $item)
                                            <li class="fs-6 text-active-dark fw-bold">
                                                {{ $item->sub_kegiatan }}
                                                <span class="badge badge-light-{{ $item->persentase != 100 ? 'warning' : 'success' }}">
                                                    {{ $item->persentase }}%
                                                </span>
                                                <ol class="ms-4 mt-2">
                                                    <li class="fs-7 text-{{ $item->persentase == 100 ? 'success' : 'danger' }}">
                                                        {{ $item->indikator_kinerja }}
                                                    </li>
                                                    <li class="fs-7 text-{{ $item->persentase == 100 ? 'success' : 'danger' }}">
                                                        {{ $item->target_kinerja }}
                                                        <a href="{{ route('rincian-iku.show', $item->id) }}" class="btn btn-link btn-sm btn-active-light-primary">
                                                            Lihat Rincian
                                                        </a>
                                                    </li>
                                                </ol>
                                            </li>
                                        @endforeach
                                    </ol>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End::Accordion -->
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <script>
        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('fas fa-plus fas fa-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
@endsection
