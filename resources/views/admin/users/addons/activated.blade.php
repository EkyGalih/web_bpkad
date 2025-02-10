<div class="modal fade" id="ActiveModal{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-octagon-fill"></i> NonAktifkan User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.activated', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>Apakah anda yakin menonaktifkan user {{ $user->nama }}</p>
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
