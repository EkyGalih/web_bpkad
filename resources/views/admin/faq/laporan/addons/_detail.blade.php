<div class="modal fade" id="ShowLaporan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><i class="bi bi-calendar"></i> {{ Helpers::GetDate($lap->tgl_laporan) }} {{ Helpers::GetTime($lap->tgl_laporan) }}</p>
                <fieldset>
                    <legend><i class="bi bi-geo-alt-fill"></i> {{ $lap->lokasi_kejadian }}</legend>
                    <p style="border: 2px solid; border-top-left-radius: 50px; border-bottom-right-radius: 50px; padding-left: 25px; padding-bottom: 10px; padding-top: 10px;">
                        <i class="bi bi-volume-up-fill">:</i>
                        {{ $lap->isi_laporan }}
                    </p>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
