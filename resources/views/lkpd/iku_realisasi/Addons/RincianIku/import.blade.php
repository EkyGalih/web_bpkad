<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="modalimport" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-file-added fs-3"></i> Upload Bukti Pekerjaan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('rincian-iku.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-secondary btn-file">
                            <span class="fileupload-new"><i class="ki-outline ki-paper-clip fs-3"></i> Pilih
                                File</span>
                            <span class="fileupload-exists"><i class="ki-outline ki-arrow-circle-left fs-3"></i>
                                Ubah</span>
                            <input type="file" class="default" name="file-iku">
                        </span>
                        <span class="fileupload-preview" style="margin-left: 5px;"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                            style="float: none; margin-left: 5px;"></a>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="ki-outline ki-cross fs-2"></i>Close</button>
                <button type="submit" class="btn btn-primary btn-sm"><i
                        class="ki-outline ki-cloud-change fs-2"></i>Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>
