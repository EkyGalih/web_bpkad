<div class="modal fade" id="DeletePost{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-information-2-line icon-18px me-2"></i> Hapus Berita/Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-wrap">Postingan <strong><u>{{ $post->title }}</u></strong>
                    akan dipindahkan ke tong sampah.<br /> Anda Yakin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line icon-18px me-2"></i>
                    Tidak</button>
                <a href="{{ route('post-admin.destroy', $post->id) }}" class="btn btn-outline-danger">
                    <i class="icon-base ri ri-check-double-line icon-18px me-2"></i> Ya
                </a>
            </div>
        </div>
    </div>
</div>
