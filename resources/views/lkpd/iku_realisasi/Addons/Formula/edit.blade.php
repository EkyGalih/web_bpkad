<div class="modal fade" id="EditData{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-notepad-edit fs-3"></i> Ubah Formula Iku</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-formulasi.update', $formula->formula_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="fv-row mb-3">
                        <label class="form-label" for="ik_id">Indikator Kinerja</label>
                        <select name="indikator_kinerja_id" class="form-control">
                            <option>-----</option>
                            @php $indikatorKinerja = Iku::GetIK() @endphp
                            @foreach ($indikatorKinerja as $ik)
                                <option value="{{ $ik->ik_id }}"
                                    {{ $formula->indikator_kinerja_id == $ik->ik_id ? 'selected' : '' }}>
                                    {{ $ik->indikator_kinerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="formulasi">Formulasi</label>
                        <textarea name="formulasi" class="form-control">{{ $formula->formulasi }}</textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="tipe_penghitungan">Tipe Perhitungan</label>
                        <input type="text" name="tipe_penghitungan" value="{{ $formula->tipe_penghitungan }}"
                            class="form-control">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="sumber_data">Sumber Data</label>
                        <select name="bidang_id" class="form-control">
                            <option value="">-------</option>
                            @php $Divisi = Helpers::GetAllBidang() @endphp
                            @foreach ($Divisi as $div)
                                <option value="{{ $div->bidang_id }}"
                                    {{ $formula->bidang_id == $div->bidang_id ? 'selected' : '' }}>
                                    {{ strtoupper($div->nama_bidang) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="alasan">Alasan</label>
                        <textarea name="alasan" class="form-control">{{ $formula->alasan }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                    Close</button>
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="ki-outline ki-send fs-2"></i>
                    Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
