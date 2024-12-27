<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="modalimport" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title"><i class="fas fa-upload"></i> Upload Bukti Pekerjaan</h5>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('rincian-iku-admin.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-theme02 btn-file">
                            <span class="fileupload-new"><i class="fas fa-paperclip"></i> Pilih
                                File</span>
                            <span class="fileupload-exists"><i class="fas fa-undo"></i> Ubah</span>
                            <input type="file" class="default" name="file-iku">
                        </span>
                        <span class="fileupload-preview" style="margin-left: 5px;"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                            style="float: none; margin-left: 5px;"></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-theme">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
