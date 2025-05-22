<div class="modal fade" id="DeletePages{{ $loop->iteration }}"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i
                        class="bi bi-trash3"></i> Hapus
                    Halaman</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Halaman <strong><u>{{ $page->title }}</u></strong>
                    akan dipindahkan ke tong sampah.<br /> Anda Yakin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"
                    data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Tidak</button>
                <a href="{{ route('pages-admin.destroy', $page->id) }}"
                    class="btn btn-outline-danger">
                    <i class="bi bi-check-circle"></i> Ya
                </a>
            </div>
        </div>
    </div>
</div>
