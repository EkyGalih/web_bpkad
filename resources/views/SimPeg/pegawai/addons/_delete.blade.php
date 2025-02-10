<div class="modal fade" id="HapusPegawai{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-octagon-fill"></i> Hapus Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin menghapus {{ $item->name }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Tidak</button>
                <a href="{{ route('pegawai.destroy', $item->id) }}" class="btn btn-outline-success">
                    <i class="bx bx-check"></i> Ya
                </a>
            </div>
        </div>
    </div>
</div>
