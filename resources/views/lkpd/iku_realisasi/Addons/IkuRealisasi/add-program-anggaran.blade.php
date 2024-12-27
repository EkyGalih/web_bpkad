<div class="modal fade" id="TambahDataProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title"><i class="fas fa-plus-square"></i> Tambah Data</h5>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('program-anggaran-iku.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" name="program" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="anggaran">Anggaran</label>
                        <input type="text" name="anggaran" id="anggaran_program" class="form-control" onkeypress="isInputNumber(event)">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme04" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" class="btn btn-theme"><i class="fas fa-plus"></i>
                    Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
