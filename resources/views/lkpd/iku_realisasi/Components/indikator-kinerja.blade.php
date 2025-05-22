@extends('lkpd.index')
@section('title', 'Indikator Kinerja')
@section('iku', 'here show')
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-questionnaire-tablet fs-1 me-2"></i> Indikator Kinerja
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#TambahData">
            <i class="ki-outline ki-plus-square fs-2"></i> Tambah Data
        </button>
        @include('lkpd.iku_realisasi.Addons.IndikatorKinerja.add')
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Daftar Indikator Kinerja</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Indikator Kinerja</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indikatorKinerja as $ik)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $ik->indikator_kinerja }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-icon btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#EditData{{ $loop->iteration }}" data-bs-tooltip="tooltip" data-bs-placement="left" title="Ubah Indikator">
                                            <i class="ki-outline ki-notepad-edit fs-2"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-icon btn-sm" data-bs-tooltip="tooltip" data-bs-placement="right" title="Hapus Indikator"
                                            onclick="deleteData('{{ route('iku-indikator.destroy', $ik->ik_id) }}')">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('lkpd.iku_realisasi.Addons.IndikatorKinerja.edit')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $indikatorKinerja->links() }}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
