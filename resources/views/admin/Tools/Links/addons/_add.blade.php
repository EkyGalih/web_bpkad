<div class="modal fade" id="TambahModal" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TambahModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('link.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" id="nama" placeholder="Nama"
                            class="form-control @error('name') is-invalid @enderror" name="name">
                        <label for="nama">Nama</label>
                        @error('name')
                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="url" id="link" placeholder="Link" required
                            class="form-control @error('link') is-invalid @enderror" name="link">
                        <label for="link">Link</label>
                        <small id="linkError" class="text-danger d-none">Masukkan link yang valid (harus http/https)</small>
                        @error('link')
                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-outline-primary" id="submitBtn" disabled>
                            <i class="icon-base ri ri-add-large-line icon-18px me-2"></i> Tambah
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="icon-base ri ri-close-line icon-18px me-2"></i> Tutup
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
