<div class="modal fade" id="CachePages" tabindex="-1">
    <div class="modal-lg modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-delete-bin-4-fill icon-18px me-2"></i> File Sampah</h5>
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
                                    {{ GetTypePage($del->pages_type_id) }}
                                </td>
                                <td>{{ GetUser($del->create_by_id) }}</td>
                                <td>{{ \Carbon\Carbon::parse($del->deleted_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('pages-admin.restore', $del->id) }}"><i
                                                    class="icon-base ri ri-arrow-left-circle-line icon-18px me-2"></i>
                                                Pulihkan</a>
                                            <a class="dropdown-item" href="{{ route('pages-admin.delete', $del->id) }}"
                                                data-bs-tooltip="tooltip" data-bs-placement="top"
                                                title="Hapus Permanen"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Hapus Permanen</a>
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
                <a href="{{ route('pages-admin.clear') }}" class="btn btn-danger">
                    <i class="icon-base ri ri-delete-bin-3-line icon-18px me-2"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>
