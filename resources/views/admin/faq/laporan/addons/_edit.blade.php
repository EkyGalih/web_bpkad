<div class="modal fade" id="EditMenu{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square"></i>
                    Ubah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('menu-admin.update', $lap->id) }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama
                            Menu</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $lap->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="inputText"
                            class="col-sm-2 col-form-label">Page</label>
                        <div class="col-sm-10">
                            <select name="order_pos" class="form-control">
                                <option value="">--Page--</option>

                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="inputText"
                            class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="url" value="{{ $lap->url }}" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save2"></i> Simpan
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
