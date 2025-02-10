<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 14%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-cloud-add fs-3 me-1"></i> Import APBD</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('apbd.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-secondary btn-file">
                            <span class="fileupload-new"><i class="ki-outline ki-paper-clip fs-4"></i> Pilih
                                File</span>
                            <span class="fileupload-exists"><i class="ki-outline ki-arrow-circle-left fs-4"></i> Ubah</span>
                            <input type="file" class="default" name="data-apbd">
                        </span>
                        <span class="fileupload-preview" style="margin-left: 5px;"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                            style="float: none; margin-left: 5px;"></a>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>
