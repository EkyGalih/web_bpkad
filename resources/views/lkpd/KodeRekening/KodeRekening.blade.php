@extends('lkpd.index')
@section('title', 'Kode Rekening')

@section('apbd', 'here show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
            Kode Rekening
        </h1>
    </div>
    <div class="d-flex align-self-center flex-center flex-shrink-0">
        <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-success btn-custom px-4" data-bs-toggle="modal" data-bs-target="#ModalImport">
            <i class="ki-outline ki-cloud-add me-1"></i> Import Kode Rekening
        </a>
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-8">
            <div class="card card-flush p-5">
                <div class="card-header p-5">
                    <div class="card-title">
                        <i class="ki-outline ki-barcode fs-2 me-1"></i> Daftar Kode Rekening
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex flex-stack">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Rekening</th>
                                        <th>Kode Rekening</th>
                                        <th>REF</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kodeRekening as $rekening)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rekening->nama_rekening }}</td>
                                            <td>{{ $rekening->kode_rekening }}</td>
                                            <td>{{ $rekening->ref }}</td>
                                            <td>
                                                <a href="{{ route('lkpk.kode-rekening', $rekening->rekening_id) }}"
                                                    class="btn btn-icon btn-warning btn-xs" data-bs-tooltip="tooltip"
                                                    data-placement="top" title="Edit Kode Rekening">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-icon btn-danger btn-xs"
                                                    data-bs-tooltip="tooltip" data-placement="top"
                                                    title="Hapus Kode Rekening"
                                                    onclick="deleteData('{{ route('lkpk.kode-rekening.destroy', $rekening->rekening_id) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $kodeRekening->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush p-5">
                <form
                    action="{{ isset($rekeningDetail) ? route('lkpk.kode-rekening.update', $rekeningDetail->rekening_id) : route('lkpk.kode-rekening.store') }}"
                    method="POST" onsubmit="return validateForm()">
                    @csrf
                    @if (isset($rekeningDetail))
                        @method('PUT')
                    @endif
                    <div class="card-header p-0 mb-5">
                        <div class="m-0">
                            <div class="d-flex align-items-center mb-2">
                                @if (isset($rekeningDetail))
                                    <h4 class="card-title">Update Kode Rekening</h4>
                                @else
                                    <h4 class="card-title">Tambah Kode Rekening</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="fv-row mb-3">
                            <label class="form-label required">Nama Rekening</label>
                            <input type="text" name="nama_rekening" class="form-control mb-2" placeholder="Nama Rekening"
                                value="{{ isset($rekeningDetail) ? $rekeningDetail->nama_rekening : '' }}"
                                required="true" />
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label required">Kode Rekening</label>
                            <input type="text" name="kode_rekening" class="form-control mb-2" placeholder="Kode Rekening"
                                value="{{ isset($rekeningDetail) ? $rekeningDetail->kode_rekening : '' }}"
                                required="true" />
                        </div>
                        <div class="fv-row mb-3">
                            <label class="form-label required">Ref</label>
                            <input type="text" name="ref" class="form-control mb-2" placeholder="Ref"
                                value="{{ isset($rekeningDetail) ? $rekeningDetail->ref : '' }}" required="true" />
                        </div>
                        <div class="d-grid gap-2">
                            @if (!isset($rekeningDetail))
                                <button type="submit" class="btn btn-primary btn-block" id="simpan"><i
                                        class="ki-outline ki-plus-square"></i> Tambah</button>
                            @else
                                <button type="submit" class="btn btn-success btn-block" id="simpan"><i
                                        class="ki-outline ki-send"></i> Simpan</button>
                            @endif
                            @if (isset($rekeningDetail))
                                <a href="{{ route('lkpk.kode-rekening') }}" class="btn btn-danger btn-block"><i
                                        class="ki-outline ki-arrow-left"></i> Batal</a>
                            @endif
                        </div>
                    </div>
                </form>

                {{-- MODAL IMPORT KODE REKENING --}}
                <div class="modal fade" id="ModalImport" tabindex="-1" aria-labelledby="ModalImport"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" style="margin-top: 14%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="ki-outline ki-cloud-add fs-4"></i> Import Kode Rekening
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('lkpk.kode-rekening.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <span class="btn btn-outline-secondary btn-file">
                                            <span class="fileupload-new"><i class="ki-outline ki-paper-clip fs-2"></i>
                                                Pilih
                                                File</span>
                                            <span class="fileupload-exists"><i
                                                    class="ki-outline ki-arrow-circle-left fs-2"></i> Ubah</span>
                                            <input type="file" class="default" name="data-kode-rekening">
                                        </span>
                                        <span class="fileupload-preview" style="margin-left: 5px;"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                            style="float: none; margin-left: 5px;"></a>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">upload</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
@endsection
