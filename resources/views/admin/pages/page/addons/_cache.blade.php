<div class="modal fade" id="CachePages" tabindex="-1">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-trash"></i> File Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover recycle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tipe Halaman</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Hapus Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DeletedPages as $del)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $del->title }}</td>
                                <td>
                                    {{ Helpers::GetTypePage($del->pages_type_id) }}
                                </td>
                                <td>{{ Helpers::GetUser($del->create_by_id) }}</td>
                                <td>{{ Helpers::GetDate($del->deleted_at) }}</td>
                                <td>
                                    <a href="{{ route('pages-admin.restore', $del->id) }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" title="Pulihkan" class="btn btn-success btn-md">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                    <a href="{{ route('pages-admin.delete', $del->id) }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" title="Hapus Permanen" class="btn btn-danger btn-md">
                                        <i class="bi bi-eraser-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
                <a href="{{ route('post-admin.clear') }}" class="btn btn-outline-danger">
                    <i class="bi bi-trash3-fill"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>
