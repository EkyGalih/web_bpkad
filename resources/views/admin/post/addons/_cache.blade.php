<div class="modal fade" id="CachePost" tabindex="-1">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-trash"></i> File Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Dihapus Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DeletedPosts as $del)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $del->title }}</td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-{{ $del->posts_category_id == '1' ? 'success' : 'primary' }}">
                                        <i
                                            class="bi bi-{{ $del->posts_category_id == '1' ? 'newspaper' : 'file-text' }}"></i>
                                        {{ Helpers::GetCategoryContent($del->posts_category_id) }}
                                    </button>
                                </td>
                                <td>{{ Helpers::GetUser($del->users_id) }}</td>
                                <td>{{ Helpers::GetDate($del->deleted_at) }}</td>
                                <td>
                                    <a href="{{ route('post-admin.restore', $del->id) }}" data-bs-tooltip="tooltip" data-bs-placement="top" title="Pulihkan" class="btn btn-success btn-md">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                    <a href="{{ route('post-admin.delete', $del->id) }}" data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Permanen" class="btn btn-danger btn-md">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Close</button>
                <a href="{{ route('post-admin.clear') }}" class="btn btn-success">
                    <i class="bi bi-arrow-clockwise"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>
