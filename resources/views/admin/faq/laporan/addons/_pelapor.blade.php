<div class="modal fade" id="ShowPelapor{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-info-card-line me-2"></i>
                    Berkas Pelapor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <!-- Foto Kiri -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('server/assets/img/avatars/1.png') }}" alt="Foto Pelapor"
                            class="img-fluid rounded" style="max-height: 150px;">
                    </div>
                    <!-- Biodata -->
                    <div class="col-md-6">
                        <h5 class="mb-3">Nama Lengkap: <span class="fw-normal">{{ $lap->nama_pelapor }}</span></h5>
                        <p class="mb-1">Lokasi Laporan: <span class="fw-normal">{{ $lap->lokasi_kejadian }}</span></p>
                        <p class="mb-1">Telepon: <span class="fw-normal">{{ $lap->no_pelapor }}</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="icon-base ri ri-close-line me-2"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
</div>
