<div class="modal fade" id="Jawab{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Jawab Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('faq.update', $lap->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return formValidate()">
                    @csrf
                    @method('PUT')
                    <textarea name="jawaban" class="form-control" cols="30" rows="10" placeholder="Tulis Jawaban" required></textarea>
                    <input type="file" name="berkas_jawaban" class="form-control">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">
                    <i class="bi bi-pencil"></i> Jawab
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
