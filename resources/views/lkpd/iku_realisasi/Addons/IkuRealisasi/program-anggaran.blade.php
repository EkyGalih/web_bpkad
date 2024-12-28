<h2 style="text-align: center;">PROGRAM ANGGARAN IKU & RKT {{ date('Y') }}<br /> BADAN PENGELOLAAN KEUANGAN DAN ASET
    DAERAH</h2>
<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#TambahDataProgram"
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
                <th></th>
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
                    <form action="{{ route('program-anggaran-iku.update', $pai->program_anggaran_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td style="padding: 10px;">{{ $loop->iteration }}. </td>
                        <td style="padding: 10px;">{{ $pai->program }}</td>
                        <td style="padding: 10px;">Rp. {{ number_format($pai->anggaran) }} <input type="hidden"
                                name="anggaran" value="{{ $pai->anggaran }}"></td>
                        <td style="padding: 10px;">
                            <input type="text" onkeypress="isInputNumber(event)" name="anggaran_terpakai"
                                id="anggaran_terpakai" value="{{ $pai->anggaran_terpakai }}" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-link btn-xs" data-tooltip="tooltip"
                                data-placement="top" title="Simpan Perubahan"><i class="fas fa-check"></i></button>
                        </td>
                        <td style="padding: 10px; text-align: center;">{{ $pai->persentase_anggaran }} %</td>
                        <td style="padding: 10px;">{{ $pai->keterangan }}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-icon"
                                onclick="deleteData('{{ route('program-anggaran-iku.destroy', $pai->program_anggaran_id) }}')"
                                data-tooltip="tooltip" data-placement="top" title="Hapus Program"><i
                                    class="ki-outline ki-trash"></i></button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
