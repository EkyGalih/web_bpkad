<div class="modal fade" id="CacheKIP" tabindex="-1">
    @php
    use App\Enum\KlasifikasiEnum;
    @endphp
    <div class="modal-lg modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-trash"></i> File Sampah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover recycle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Files</th>
                            <th>Diupload Oleh</th>
                            <th>Pada</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($DeletedKIP->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada file sampah.</td>
                        </tr>
                        @else
                        @foreach ($DeletedKIP as $del)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-wrap">
                                <div
                                    class="d-flex gap-3 border-start border-3 border-{{ KlasifikasiEnum::tryFrom($del->jenis_informasi)?->getColor() ?? 'muted' }} ps-3">
                                    <div>
                                        <a href="#"
                                            class="mb-1 text-gray-900 text-{{ KlasifikasiEnum::tryFrom($del->jenis_informasi)?->getColor() ?? 'muted' }} fw-bold">
                                            {{ strtoupper($del->jenis_informasi) }}
                                        </a>
                                        <div class="fs-7 text-muted fw-bold">{{ $del->nama_informasi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($del->jenis_file == 'link')
                                <a href="{{ $del->files }}" target="_blank" class="btn btn-success btn-sm"><i
                                        class="icon-base ri ri-download-2-line icon-18px me-2"></i>
                                    Download</a>
                                @else
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#ShowFile{{ $loop->iteration }}">
                                    <i class="icon-base ri ri-eye-2-line icon-18px me-2"></i>View
                                </button>
                                @endif
                            </td>
                            <td>{{ GetUser($del->upload_by) }}</td>
                            <td>{{ $del->created_at == null ? 'None' :
                                \Carbon\Carbon::parse($del->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ppid-kip.restore', $del->id) }}"><i
                                                class="icon-base ri ri-arrow-left-circle-line icon-18px me-2"></i> Pulihkan</a>
                                        <a href="{{ route('ppid-kip.delete', $del->id) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="top" title="Hapus Permanen" class="dropdown-item">
                                            <i class="icon-base ri ri-eraser-line icon-18px me-2"></i> Hapus Permanen
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
                <a href="{{ route('ppid-kip.clear') }}" class="btn btn-danger">
                    <i class="bi bi-trash3-fill"></i> Bersihkan
                </a>
            </div>
        </div>
    </div>
</div>