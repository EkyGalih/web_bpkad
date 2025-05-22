<div class="modal fade" id="deleteCategory{{ $loop->iteration }}" tabindex="-1" aria-labelledby="deleteCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryLabel">Hapus Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventaris.kategori.destroy', $kategori->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>Apakah Anda yakin ingin menghapus kategori <b>{{ $kategori->nama_kategori }}</b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-2x">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Tidak
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="ki-duotone ki-double-check fs-2x">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Ya
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
