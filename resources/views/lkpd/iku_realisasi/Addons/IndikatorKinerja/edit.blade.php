<div class="modal fade" id="EditData{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Indikator Kinerja</h5>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-indikator.update', $ik->ik_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="indikator_kinerja">Indikator Kinerja</label>
                        <textarea name="indikator_kinerja" class="form-control">{{ $ik->indikator_kinerja }}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme04" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" class="btn btn-theme"><i class="fas fa-save"></i>
                    Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
