<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Lihat Dokumen</h5>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" width="100%" height="600px" frameborder="0"
                    allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <a href="#" id="pdfDownloadBtn" class="btn btn-success btn-sm" target="_blank">
                    <img src="{{ asset('client/assets/img/icons/solid/cloud-download.svg') }}"
                        class="svg-inject icon-svg icon-svg-sm solid-mono text-info me-2" alt="Search Icon"
                        style="width: 18px; height: 18px;"> Download
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
