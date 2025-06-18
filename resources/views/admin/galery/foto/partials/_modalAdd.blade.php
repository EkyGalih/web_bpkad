<div class="modal fade" id="TambahFoto" tabindex="-1" aria-labelledby="TambahFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahFotoLabel">Tambah Galery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <!-- Form atau konten modal di sini -->
                <form id="formAddFoto" method="POST" action="{{ route('galery.store') }}">
                    @csrf
                    <input type="hidden" value="1" name="galery_type_id">
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Album" required>
                        <label for="nama">Nama Album</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required></textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="icon-base ri ri-close-fill me-2"></i> Tutup
                </button>
                <button type="submit" class="btn btn-primary" form="formAddFoto">
                    <i class="icon-base ri ri-add-fill me-2"></i> Tambah
                </button>
            </div>
        </div>
    </div>
</div>
