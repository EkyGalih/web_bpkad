<div class="modal fade" id="ShowFile{{ $loop->iteration }}" tabindex="-1" aria-labelledby="ShowFileLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ShowFileLabel">
                    {{ $items->nama_informasi }}</h5>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <iframe src="{{ route('kip-admin.view_pdf', $items->id) }}" width="100%" height="600px"
                    frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <a href="{{ route('kip-admin.download_pdf', $items->id) }}" class="btn btn-success btn-sm">
                    <i class="bx bx-download"></i> Download
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
