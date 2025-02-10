<div class="modal fade" id="CacheSlider" tabindex="-1">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-trash"></i> File Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover cache">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama/Katergori</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Jenis Slide</th>
                            <th scope="col">Hapus Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DeletedSlider as $del)
                            <tr>
                                <th style="width: 10px;">{{ $loop->iteration }}</th>
                                <td>{{ $del->title }}</td>
                                <td style="width: 35%;">{{ $del->keterangan }}</td>
                                <td>{{ $del->Slide->nama_slide }}</td>
                                <td>{{ Helpers::GetDate($del->deleted_at) ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('slider.restore', $del->id) }}" class="btn btn-info btn-sm"
                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Pulihkan Slide">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                    <a href="{{ route('slider.delete', $del->id) }}" class="btn btn-danger btn-sm"
                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Hapus Permanen Slide">
                                        <i class="bi bi-trash"></i>
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
                <a href="{{ route('slider.clear') }}" class="btn btn-success">
                    <i class="bi bi-arrow-clockwise"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>
