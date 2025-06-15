<div class="modal fade" id="Jawab{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-question-answer-fill me-2"></i>
                    Jawab Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('laporan-admin.update', $lap->id) }}" method="POST" enctype="multipart/form-data"
                    onsubmit="return formValidate()">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <textarea name="jawaban" class="form-control" cols="30" rows="10" placeholder="Tulis Jawaban" required>{{ $lap->jawaban }}</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-5">
                                <p class="image_upload">
                                    <label for="berkasFile">
                                        <a rel="nofollow" class="btn btn-info btn-sm">
                                            <i class="icon-base ri ri-upload-2-fill me-2"></i> Upload Berkas
                                        </a>
                                    </label>
                                    <input type="file" name="berkas_jawaban" id="berkasFile" accept="image/*"
                                        onchange="loadBerkas(event)" class="form-control">
                                </p>
                            </div>
                            <div class="col-lg-7">
                                <img src="{{ asset('static/images/no_image.png') }}" alt="berkas" id="berkas"
                                    style="height: 120px; max-width: 80%;">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">
                    <i class="icon-base ri ri-pencil-fill me-2"></i> Jawab
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line me-2"></i>
                    Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>
