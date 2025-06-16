<div class="modal fade" id="ShowPermohonan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i> Detail Permohonan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body d-flex flex-column align-items-start mb-6" style="background-color: #f5f6fa;">
                <div class="mb-2">
                    <span class="badge bg-secondary">
                        <i class="icon-base ri ri-calendar-2-fill me-2"></i>
                        {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </span>
                </div>
                <div class="d-flex mb-3">
                    <div
                        style="background: #fff; border-left: 5px solid #4CAF50; border-radius: 10px; padding: 15px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                        <div class="mb-1 text-muted" style="font-size: 0.9em;">
                            <i class="icon-base ri ri-user-2-fill"></i> {{ $item->nama . ' - ' . $item->pekerjaan }}
                        </div>
                        <div class="text-wrap">
                            <div class="fw-bold mb-1">Memohon: </div>
                            {{ $item->informasi_diminta }}
                            <div class="fw-bold mt-2 mb-2">Tujuan:</div>
                            {{ $item->tujuan_informasi }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line me-2"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>
