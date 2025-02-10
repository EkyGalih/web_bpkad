<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="ki-outline ki-plus-square me-1 fs-2"></i> Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('apbd.store') }}" style="margin-left: 10px; margin-right: 10px;">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="kode_rekening">Nama Rekening</label>
                        <select name="kode_rekening" id="kode_rekening_add" class="form-control mb-2"
                            onchange="KodeRekeningAdd()">
                            <option value="">Pilih</option>
                            @foreach ($kodeRekening as $kode)
                                @if (strlen($kode->kode_rekening) == 1)
                                    <option value="{{ $kode->kode_rekening }}">[{{ $kode->kode_rekening }}]
                                        {{ $kode->nama_rekening }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="hidden" name="nama_rekening" id="nama_rekening_add" class="form-control">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="uraian">Uraian</label>
                        <select name="kode_rekening2" id="kode_rekening2_add" class="form-control mb-2"
                            onchange="getSubKodeAdd()"></select>
                        <input type="hidden" name="uraian" id="uraian_add" class="form-control">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="sub_uraian">Sub Uraian</label>
                        <select name="kode_rekening3" id="kode_rekening3_add" class="form-control mb-2"
                            onchange="getSubUraianAdd()"></select>
                        <input type="hidden" name="sub_uraian" id="sub_uraian_add" class="form-control">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="anggaran_sebelum_perubahan">Anggaran Sebelum
                            Perubahan</label>
                        <input type="text" name="jml_anggaran_sebelum" id="jml_anggaran_sebelum_add"
                            class="form-control mb-2" onkeypress="isInputNumber(event)">
                        <label class="form-label required" for="anggaran_setelah_perubahan">Anggaran Setelah Perubahan</label>
                        <input type="text" name="jml_anggaran_setelah" id="jml_anggaran_setelah_add"
                            class="form-control mb-2" onkeypress="isInputNumber(event)">
                    </div>
                    <div class="fv-row mb-3 d-flex">
                        <div class="col-10 me-2">
                            <label class="form-label" for="selisih" id="label_add">Bertambah/(Berkurang)</label>
                            <input type="text" name="selisih" id="selisih_add" class="form-control" readonly>
                        </div>
                        <div class="col-2">
                            <label class="form-label" for="persen">%</label>
                            <input type="text" name="persen" id="persen_add" class="form-control" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>
