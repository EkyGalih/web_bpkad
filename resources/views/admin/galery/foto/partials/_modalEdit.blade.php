<div class="modal fade" id="EditFoto{{ $loop->iteration }}" tabindex="-1" aria-labelledby="EditFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditFotoLabel">Edit Galery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form method="POST" action="{{ route('galery.update', $galery->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Form atau konten modal di sini -->
                    <input type="hidden" value="1" name="galery_type_id">
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="nama" value="{{ $galery->name }}"
                            name="nama" placeholder="Nama Album" required>
                        <label for="nama">Nama Album</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>{{ $galery->keterangan }}</textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="icon-base ri ri-close-fill me-2"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-outline-success">
                        <i class="icon-base ri ri-save-3-fill me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
