<div class="modal fade" id="EditData{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-notepad-edit fs-3"></i> Edit Indikator Kinerja</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-indikator.update', $ik->ik_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="indikator_kinerja">Indikator Kinerja</label>
                        <textarea name="indikator_kinerja" class="form-control">{{ $ik->indikator_kinerja }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="ki-outline ki-cross fs-2"></i>
                    Close</button>
                <button type="submit" class="btn btn-success btn-sm"><i class="ki-outline ki-send fs-2"></i>
                    Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
