<div class="modal fade" id="EditModal{{ $link->id }}" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('link.update', $link->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" id="nama" placeholder="Nama"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $link->name }}" name="name">
                        <label for="nama">Nama</label>
                        @error('name')
                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="url" id="link-update" placeholder="Link" required
                            class="form-control @error('link') is-invalid @enderror" value="{{ $link->link }}" name="link">
                        <label for="link">Link</label>
                        <small id="linkErrorUpdate" class="text-danger d-none">Masukkan link yang valid (harus
                            http/https)</small>
                        @error('link')
                            <div class="alert alert-danger" style="padding: 8px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="icon-base ri ri-save-3-line icon-18px me-2"></i> Simpan
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
