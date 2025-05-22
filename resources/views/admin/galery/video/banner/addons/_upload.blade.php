<div class="modal fade" id="AddVideo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-upload"></i> Upload Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('banner-video.addVideo') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="galery_id" value="{{ $banner->id }}">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Jenis Video</label>
                        <div class="col-sm-8">
                            <select name="jenis_video" id="jenis_video" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="upload">Upload</option>
                                <option value="non-upload">Non Upload</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Video</label>
                        <div class="col-sm-8">
                            <input type="file" name="path" id="video_input" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send"></i> Send
                </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
