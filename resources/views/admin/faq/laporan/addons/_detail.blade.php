<div class="modal fade" id="ShowLaporan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-">
                <h5 class="modal-title"><i class="icon-base ri ri-chat-4-fill me-2"></i>
                    Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-start mb-6" style="background-color: #f5f6fa;">
                <div class="mb-2">
                    <span class="badge bg-secondary"><i class="bi bi-calendar"></i> {{ get_date($lap->tgl_laporan) }}
                        {{ GetTime($lap->tgl_laporan) }}</span>
                </div>
                <div class="d-flex mb-3">
                    <div
                        style="background: #e1ffc7; border-radius: 20px 20px 20px 0; padding: 15px 20px; max-width: 100%; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <div class="mb-1 text-muted" style="font-size: 0.9em;">
                            <i class="icon-base ri ri-map-pin-2-fill"></i> {{ $lap->lokasi_kejadian }}
                        </div>
                        <div class="text-wrap">
                            <i class="icon-base ri ri-volume-down-fill"></i> {{ $lap->isi_laporan }}
                        </div>
                    </div>
                </div>

                @if ($lap->jawaban)
                    <div class="d-flex justify-content-end w-100 mt-3">
                        <div
                            style="background: #fff; border-left: 5px solid #4CAF50; border-radius: 10px; padding: 15px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                            <div class="mb-1 text-muted" style="font-size: 0.9em;">
                                <i class="icon-base ri ri-chat-1-line"></i> Jawaban
                            </div>
                            <div>
                                {{ $lap->jawaban }}
                                <p><a class="text-decoration-none text-primary"
                                        href="{{ asset($lap->berkas_jawaban) }}">{{ $lap->berkas_jawaban }}</a></p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-muted fst-italic">Belum ada jawaban untuk laporan ini.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line me-2"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>
