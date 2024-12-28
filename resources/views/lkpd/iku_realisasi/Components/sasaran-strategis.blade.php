@extends('lkpd.index')
@section('title', 'Sasaran Strategis')
@section('iku', 'here show')
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-focus fs-1 me-2"></i> Sasaran Strategis
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#TambahData">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
        @include('lkpd.iku_realisasi.Addons.SasaranStrategis.add')
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <div class="card-header p-0">
                    <div class="card-title">
                        <h4>Sasaran Strategis</h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sasaran Strategis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SasaranStrategis as $sasaran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sasaran->sasaran_strategis }}</td>
                                    <td>
                                        <button type="button" class="btn btn-icon btn-warning btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#EditData{{ $loop->iteration }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="left" title="Ubah Sasaran">
                                            <i class="ki-outline ki-notepad-edit fs-2"></i>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-danger btn-sm"
                                            data-bs-tooltip="tooltip" data-bs-placement="right" title="Hapus Sasaran"
                                            onclick="deleteData('{{ route('iku-sasaran.destroy', $sasaran->sasaran_id) }}')">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('lkpd.iku_realisasi.Addons.SasaranStrategis.edit')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $SasaranStrategis->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
