@extends('lkpd.index')
@section('title', 'IKU & Realisasi')
@section('iku', 'here show')
@section('toolbar')
    <div class="page-title me-5">
        <h1 class="page-heading d-flex text-white fw-bold fs-2 justify-content-center my-0">
            <i class="ki-outline ki-graph-up fs-1 me-2"></i> IKU & Realisasi BPKAD
        </h1>
    </div>
@endsection
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush p-5">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-iku">IKU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-rkt">RKT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-program-anggaran">Program Anggaran</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body pt-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-iku">
                            <h2 style="text-align: center;">INDIKATOR KINERJA UTAMA (IKU) {{ date('Y') }}</h2>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman';">Sasaran Strategis
                                            </th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman';">Indikator Kinerja
                                            </th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman';">Penjelasan
                                                <br />(Formulasi Pengukuran, Tipe
                                                Perhitungan, Sumber Data, Alasan)
                                            </th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman';">Target</th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman';">Target Tercapai
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($IkuRealisasi as $data)
                                            <tr>
                                                <td rowspan="4">{{ $loop->iteration }}</td>
                                                <td rowspan="4">{{ $data->sasaran->sasaran_strategis }}</td>
                                                <td rowspan="4">{{ $data->IK->indikator_kinerja }}</td>
                                                <td><strong>Formulasi Pengukuran :</strong> {{ $data->formula->formulasi }}
                                                </td>
                                                <td rowspan="4">{{ $data->target }}%</td>
                                                <td rowspan="4"><label style="font-size: 13px;"
                                                        class="label label-{{ $data->target > $data->target_tercapai ? 'danger' : 'success' }}">{{ $data->target_tercapai }}%</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tipe Penghitungan :
                                                    </strong>{{ $data->formula->tipe_penghitungan }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sumber Data : </strong>-</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Alasan : </strong>{{ $data->formula->alasan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-rkt">
                            <h2 style="text-align: center;">RENCANAN KINERJA TAHUNAN (RKT) {{ date('Y') }}<br />TINGKAT
                                ORGANISASI PERANGKAT
                                DAERAH</h2>
                            <div class="table-responsive">
                                <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                                    data-bs-target="#TambahData" style="float: right; margin-bottom: 5px;">
                                    <i class="ki-outline ki-plus-square fs-2 me-1"></i> Tambah Data
                                </button>
                                @include('lkpd.iku_realisasi.Addons.IkuRealisasi.add')
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman'; width: 300px;">
                                                Sasaran Strategis</th>
                                            <th style="font-size: 16px; font-family: 'Times New Roman'; width: 300px;">
                                                Indikator Kinerja</th>
                                            <th
                                                style="font-size: 16px; font-family: 'Times New Roman'; text-align: center;">
                                                Target</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($IkuRealisasi as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->sasaran->sasaran_strategis }}</td>
                                                <td>{{ $data->IK->indikator_kinerja }}</td>
                                                <td style="text-align: center;">{{ $data->target }}%</td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-icon btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#EditData{{ $loop->iteration }}"
                                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Ubah Iku">
                                                        <i class="ki-outline ki-notepad-edit fs-2 me-1"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger"
                                                        onclick="deleteData('{{ route('iku-realisasi.destroy', $data->iku_realisasi_id) }}')"
                                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Iku">
                                                        <i class="ki-outline ki-trash fs-2 me-1"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('lkpd.iku_realisasi.Addons.IkuRealisasi.edit')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-program-anggaran">
                            <h2 style="text-align: center;">PROGRAM ANGGARAN IKU & RKT {{ date('Y') }}<br /> BADAN
                                PENGELOLAAN KEUANGAN DAN ASET
                                DAERAH</h2>
                            <div class="table-responsive">
                                <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal"
                                    data-bs-target="#TambahDataProgram"
                                    style="float: right; margin-bottom: 5px; margin-right: 40px;">
                                    <i class="ki-outline ki-plus-square fs-2 me-1"></i> Tambah Data
                                </button>
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th
                                                style="width: 250px; text-align: center; padding: 10px; font-size: 16px; font-family: 'Times New Roman', Times, serif;">
                                                Program</th>
                                            <th
                                                style="width: 200px; text-align: center; padding: 10px; font-size: 16px; font-family: 'Times New Roman', Times, serif;">
                                                Anggaran</th>
                                            <th
                                                style="width: 200px; text-align: center; padding: 10px; font-size: 16px; font-family: 'Times New Roman', Times, serif;">
                                                Anggaran Terpakai</th>
                                            <th
                                                style="width: 200px; text-align: center; padding: 10px; font-size: 16px; font-family: 'Times New Roman', Times, serif;">
                                                Persentase</th>
                                            <th
                                                style="width: 250px; text-align: center; padding: 10px; font-size: 16px; font-family: 'Times New Roman', Times, serif;">
                                                Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $ProgramAnggaranIku = Iku::GetProgramAnggaran() @endphp
                                        @foreach ($ProgramAnggaranIku as $pai)
                                            <tr>
                                                <form
                                                    action="{{ route('program-anggaran-iku.update', $pai->program_anggaran_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td style="padding: 10px;">{{ $loop->iteration }}. </td>
                                                    <td style="padding: 10px;">{{ $pai->program }}</td>
                                                    <td style="padding: 10px;">Rp. {{ number_format($pai->anggaran) }}
                                                        <input type="hidden" name="anggaran" value="{{ $pai->anggaran }}">
                                                    </td>
                                                    <td style="padding: 10px;">
                                                        <input type="text" onkeypress="isInputNumber(event)"
                                                            name="anggaran_terpakai" id="anggaran_terpakai"
                                                            value="{{ $pai->anggaran_terpakai }}" class="form-control d-inline-block w-75 me-2">
                                                        <button type="submit" class="btn btn-link btn-xs d-inline-block"
                                                            data-tooltip="tooltip" data-placement="top"
                                                            title="Simpan Perubahan"><i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                    <td style="padding: 10px; text-align: center;">
                                                        {{ $pai->persentase_anggaran }} %</td>
                                                    <td style="padding: 10px;">{{ $pai->keterangan }}</td>
                                                    <td><button type="button" class="btn btn-danger btn-icon"
                                                            onclick="deleteData('{{ route('program-anggaran-iku.destroy', $pai->program_anggaran_id) }}')"
                                                            data-bs-tooltip="tooltip" data-bs-placement="top"
                                                            title="Hapus Program"><i
                                                                class="ki-outline ki-trash fs-2"></i></button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('lkpd.iku_realisasi.Addons.IkuRealisasi.add-program-anggaran')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/custom/jquery-mask/jquery-mask.js') }}"></script>
    <script src="{{ asset('assets/js/lkpd/iku.js') }}"></script>
@endsection
