<div class="modal fade" id="TambahDataProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-plus-square fs-4 me-1"></i> Tambah Program Anggaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('program-anggaran-iku.store') }}" method="POST">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="form-label" for="program">Program</label>
                        <input type="text" name="program" class="form-control">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="anggaran">Anggaran</label>
                        <input type="text" name="anggaran" id="anggaran_program" class="form-control"
                            onkeypress="isInputNumber(event)">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>
                    Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
