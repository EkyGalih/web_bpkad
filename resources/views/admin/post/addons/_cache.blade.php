<div class="modal fade" id="CachePost" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"> {{-- scrollable modal --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon-base ri ri-delete-bin-5-line icon-18px"></i> File Sampah
                </h5>
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
                                <span
                                    class="badge bg-label-{{ \App\Enum\CategoryEnum::tryFrom($del->category->category)?->getColor() ?? 'secondary' }}">
                                    <i class="ri ri-newspaper-fill"></i> {{ $del->category->category }}</span>
                            </td>
                            <td>{{ GetUser($del->users_id) }}</td>
                            <td>{{ get_date($del->deleted_at) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post-admin.restore', $del->id) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="top" title="Pulihkan" class="dropdown-item">
                                            <i class="icon-base ri ri-arrow-left-circle-line icon-18px me-2"></i> Pulihkan
                                        </a>
                                        <a href="{{ route('post-admin.delete', $del->id) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="top" title="Hapus Permanen"
                                            class="dropdown-item">
                                            <i class="icon-base ri ri-eraser-line icon-18px me-2"></i> Hapus Permanen
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="icon-base ri ri-close-line icon-18px me-2"></i> Close
                </button>
                <a href="{{ route('post-admin.clear') }}" class="btn btn-danger">
                    <i class="icon-base ri ri-delete-bin-3-line icon-18px me-2"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>