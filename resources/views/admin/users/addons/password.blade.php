<div class="modal fade" id="UbahSandi{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-octagon-fill"></i> Reset Sandi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.password', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Tidak</button>
                <button type="submit" class="btn btn-outline-success">
                    <i class="bx bx-check"></i> Ya
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
