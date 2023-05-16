<div class="modal fade" id="DeleteVideo{{ $loop->iteration }}"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i
                        class="bi bi-exclamation-octagon-fill"></i>
                    Hapus Postingan</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Video Banner akan dihapus.<br /> Anda Yakin?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Tidak</button>
                <a href="{{ route('banner-video.destroy', $item->id) }}"
                    class="btn btn-outline-danger">
                    <i class="bi bi-check-circle"></i> Ya
                </a>
            </div>
        </div>
    </div>
</div>
