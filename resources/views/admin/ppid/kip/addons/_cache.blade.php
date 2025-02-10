<div class="modal fade" id="CacheKIP" tabindex="-1">
    <div class="modal-xl modal-dialog">
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
                            <th scope="col">Nama Data</th>
                            <th scope="col">Jenis Informasi</th>
                            <th scope="col">Jenis File</th>
                            <th scope="col">Files</th>
                            <th scope="col">Diupload Oleh</th>
                            <th scope="col">Hapus Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DeletedKIP as $del)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td style="width: 35%;">{{ $del->nama_informasi }}</td>
                                <td>
                                    @if ($del->jenis_informasi == 'berkala')
                                        <span class="badge bg-info"><i class="bi bi-arrow-repeat"></i>
                                            {{ ucfirst($del->jenis_informasi) }}
                                        </span>
                                    @elseif ($del->jenis_informasi == 'dikecualikan')
                                        <span class="badge bg-danger"><i class="bi bi-eye-slash"></i>
                                            {{ ucfirst($del->jenis_informasi) }}
                                        </span>
                                    @elseif ($del->jenis_informasi == 'setiap saat')
                                        <span class="badge bg-warning"><i class="bi bi-stars"></i>
                                            {{ ucfirst($del->jenis_informasi) }}
                                        </span>
                                    @elseif ($del->jenis_informasi == 'serta merta')
                                        <span class="badge bg-secondary"><i class="bi bi-info-circle"></i>
                                            {{ ucfirst($del->jenis_informasi) }}
                                        </span>
                                    @endif
                                </td>
                                <td><span class="badge bg-{{ $del->jenis_file == 'link' ? 'secondary' : 'info' }}"><i
                                            class="bi bi-{{ $del->jenis_file == 'link' ? 'link' : 'upload' }}"></i>
                                        {{ ucfirst($del->jenis_file) }}</span></td>
                                <td><a href="#" class="btn btn-success btn-sm"><i class="bi bi-download"></i>
                                        Download</a></td>
                                <td>{{ Helpers::GetUser($del->upload_by) }}</td>
                                <td>{{ $del->deleted_at == null ? 'None' : Helpers::GetDate($del->deleted_at) }}
                                </td>
                                <td>
                                    <a href="{{ route('ppid-kip.edit', $del->id) }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" title="Restore" class="btn btn-success btn-md">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-md" data-bs-tooltip="tooltip"
                                        data-bs-placement="top" title="Hapus Permanen">
                                        <i class="bi bi-eraser-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
                <a href="{{ route('post-admin.clear') }}" class="btn btn-danger">
                    <i class="bi bi-trash3-fill"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>
