@extends('lkpd.index')
@section('title', 'Formula IKU Realisasi')
@section('iku', 'here show')
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-flask fs-1 me-2"></i> Formulasi Iku
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <div type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#TambahData">
            <i class="fas fa-plus"></i> Tambah Data
        </div>
        @include('lkpd.iku_realisasi.Addons.Formula.add')
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-12">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <div class="card-header p-0">
                    <div class="card-title">
                        <h4>Daftar Formulasi Iku</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-35">Formulasi</th>
                                    <th>Tipe Perhitungan</th>
                                    <th>Sumber Data</th>
                                    <th class="w-35">Alasan</th>
                                    <th class="w-100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Formulasi as $formula)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $formula->formulasi }}</td>
                                        <td>{{ $formula->tipe_penghitungan }}</td>
                                        <td>{{ Helpers::GetBidang($formula->bidang_id) }}</td>
                                        <td>{{ $formula->alasan }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-icon btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#EditData{{ $loop->iteration }}"
                                                data-bs-tooltip="tooltip" data-bs-placement="left" title="Ubah Formula">
                                                <i class="ki-outline ki-notepad-edit fs-2"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-icon btn-sm"
                                                data-bs-tooltip="tooltip" data-bs-placement="right" title="Hapus Formula"
                                                onclick="deleteData('{{ route('iku-formulasi.destroy', $formula->formula_id) }}')">
                                                <i class="ki-outline ki-trash fs-2"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('lkpd.iku_realisasi.Addons.Formula.edit')
                                @endforeach
                            </tbody>
                        </table>
                        {{ $Formulasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
