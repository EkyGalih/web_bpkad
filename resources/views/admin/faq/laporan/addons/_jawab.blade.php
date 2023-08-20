<div class="modal fade" id="Jawab{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Jawab Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('faq.update', $lap->id) }}" method="POST" enctype="multipart/form-data"
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
                                            <i class="bi bi-upload"></i> Upload Berkas
                                        </a>
                                    </label>
                                    <input type="file" name="berkas_jawaban" id="berkasFile" accept="image/*"
                                    onchange="loadBerkas(event)" class="form-control">
                                </p>
                            </div>
                            <div class="col-lg-7">
                                <img src="{{ asset('static/images/no_image.png') }}" alt="berkas" id="berkas" style="height: 120px; max-width: 80%;">
                            </div>
                        </div>
                    </div>
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
