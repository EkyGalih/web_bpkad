<div class="modal fade" id="ShowLaporan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Detail Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ Helpers::GetDate($lap->tgl_laporan) }} {{ Helpers::GetTime($lap->tgl_laporan) }}</p>
                <fieldset>
                    <legend>{{ $lap->lokasi_kejadian }}</legend>
                    <p>{{ $lap->isi_laporan }}</p>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
