<div class="modal fade" id="ShowJawaban{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Jawab Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend>Jawaban</legend>
                    <p>{{ $lap->jawaban }}</p>
                </fieldset>
                <p><i class="bi bi-file-earmark-post"></i> <a href="{{ asset($lap->berkas_jawaban) }}">Berkas Jawaban</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
