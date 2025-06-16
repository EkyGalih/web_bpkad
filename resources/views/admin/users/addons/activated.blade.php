<div class="modal fade" id="ActiveModal{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-error-warning-fill me-2"></i>
                    {{ $user->role == '1' ? 'NonAktifkan' : 'Aktifkan' }} User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.activated', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>Apakah anda yakin {{ $user->role == '1' ? 'menonaktifkan' : 'mengaktifkan' }} user <span
                            class="fw-bold">{{ $user->nama }}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-fill me-2"></i>
                    Tidak</button>
                <button type="submit" class="btn btn-outline-success">
                    <i class="icon-base ri ri-check-double-fill me-2"></i> Ya
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
