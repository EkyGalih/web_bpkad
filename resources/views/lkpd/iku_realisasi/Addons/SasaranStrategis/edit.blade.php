<div class="modal fade" id="EditData{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-notepad-edit fs-3"></i> Edit Sasaran Strategis</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-sasaran.update', $sasaran->sasaran_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="sasaran_strategis">Sasaran Strategis</label>
                        <textarea name="sasaran_strategis" class="form-control">{{ $sasaran->sasaran_strategis }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="ki-outline ki-cross fs-2"></i>
                    Close</button>
                <button type="submit" class="btn btn-success btn-sm"><i class="ki-outline ki-send fs-2"></i>
                    Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
