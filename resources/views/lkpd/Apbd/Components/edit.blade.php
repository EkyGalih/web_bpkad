@extends('lkpd.index')
@section('title', 'Edit Anggaran APBD')
@section('apbd', 'here show')
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-6">
            <div class="card card-flush p-5">
                <div class="card-header border-bottom">
                    <h4 class="card-title"><i class="ki-outline ki-pencil me-1"></i> Edit Anggaran</h4>
                    <ul>
                        <li><strong><u>{{ substr($apbd->kode_rekening, 0, 1) }} - {{ $apbd->nama_rekening }}</u></strong>
                            <ul>
                                <li><strong><u>{{ substr($apbd->kode_rekening, 0, 3) }} -
                                            {{ $apbd->uraian }}</u></strong>
                                    <ul>
                                        <li><strong><u>{{ $apbd->kode_rekening }} - {{ $apbd->sub_uraian }}</u></strong>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <form class="form" method="POST" action="{{ route('apbd.update', $apbd->id) }}" id="kt_form">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="anggaran_sebelum_perubahan">MURNI</label>
                                        <input type="text" name="jml_anggaran_sebelum" id="jml_anggaran_sebelum_edit"
                                            class="form-control" value="{{ $apbd->jml_anggaran_sebelum }}"
                                            onkeypress="isInputNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="anggaran_setelah_perubahan">PERUBAHAN</label>
                                        <input type="text" name="jml_anggaran_setelah" id="jml_anggaran_setelah_edit"
                                            class="form-control" value="{{ $apbd->jml_anggaran_setelah }}"
                                            onkeypress="isInputNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label" for="selisih">Bertambah/(Berkurang)</label>
                                        <input type="text" name="selisih" id="selisih_edit" class="form-control"
                                            value="{{ $apbd->selisih_anggaran }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="persen">%</label>
                                        <input type="text" name="persen" id="persen_edit" class="form-control"
                                            value="{{ $apbd->persen }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" class="btn btn-success me-2"><i
                                        class="ki-outline ki-send me-1 fs-4"></i>Simpan</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="ki-outline ki-arrow-left me-1 fs-2"></i>Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/jquery-mask/jquery-mask.js') }}"></script>
    @include('layouts.admin.lkpd.Script.apbd.edit-script')
@endsection
