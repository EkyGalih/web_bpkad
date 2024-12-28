<div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-plus-square fs-3"></i> Tambah Indikator
                    Kinerja</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-indikator.store') }}" method="POST">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="indikator_kinerja">Indikator Kinerja</label>
                        <textarea name="indikator_kinerja" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="ki-outline ki-cross fs-2"></i>
                    Close</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="ki-outline ki-plus fs-2"></i>
                    Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
