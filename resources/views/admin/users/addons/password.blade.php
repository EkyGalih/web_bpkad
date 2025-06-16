<div class="modal fade" id="UbahSandi{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-lock-password-fill me-2"></i> Reset Sandi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.password', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" name="password"
                            id="passwordModal{{ $loop->iteration }}" placeholder="New Password" required>
                        <label for="password">New Password</label>

                        <!-- Bar Progress -->
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar" id="passwordStrengthBarModal{{ $loop->iteration }}"
                                style="width: 0%;"></div>
                        </div>

                        <!-- Status Text -->
                        <small id="passwordStrengthTextModal{{ $loop->iteration }}"
                            class="form-text text-muted"></small>

                        <!-- Error Message -->
                        <div id="passwordErrorModal{{ $loop->iteration }}" class="text-danger small mt-1">Password belum
                            memenuhi aturan.</div>

                        <!-- Aturan Password -->
                        <div id="passwordRulesModal{{ $loop->iteration }}" class="text-danger small mt-1">
                            Password minimal 8 karakter, huruf besar, huruf kecil, angka & simbol.
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line me-2"></i>
                    Tidak</button>
                <button type="submit" id="updatePass" class="btn btn-outline-success">
                    <i class="icon-base ri ri-check-double-fill me-2"></i> Ya
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
