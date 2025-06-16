<div class="modal fade" id="ShowPemohon{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-base ri ri-info-card-line me-2"></i>
                    Berkas Pemohon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-center">
                    <!-- Foto Kiri -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset($item->ktp) ?? asset('server/assets/img/avatars/1.png') }}" alt="{{ $item->nama }}"
                            class="img-fluid rounded thumbnail-img" style="max-height: 150px; cursor: zoom-in;">
                    </div>
                    <!-- Lightbox Preview -->
                    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
                        <div class="lightbox-inner" onclick="event.stopPropagation()">
                            <span class="close-lightbox" onclick="closeLightbox(event)">&#10006;</span>
                            <img id="lightbox-img" src="" alt="Preview">
                        </div>
                    </div>
                    <!-- Biodata -->
                    <div class="col-md-9 text-wrap">
                        <h5 class="mb-3">Nama: <span class="fw-normal">{{ $item->nama }}</span></h5>
                        <p class="mb-1">Alamat: <span class="fw-normal">{{ $item->alamat }}</span></p>
                        @php
                            // Normalisasi nomor telepon
                            $nomor = preg_replace('/[^0-9]/', '', $item->telepon); // hilangkan semua karakter selain angka

                            if (substr($nomor, 0, 1) === '0') {
                                $nomor = '62' . substr($nomor, 1);
                            }
                        @endphp
                        <p class="mb-1">Telepon: <a href="https://wa.me/{{ $nomor }}" target="_blank"
                                data-bs-tooltip="tooltip" data-bs-placement="top" title="Kirim Pesan Whatsapp"
                                class="fw-normal">{{ $item->telepon }}</a></p>
                        <p class="mb-1">Email: <a
                                href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $item->email }}"
                                data-bs-tooltip="tooltip" data-bs-placement="top" title="Kirim Email"
                                target="_blank"class="fw-normal">{{ $item->email }}</a></p>
                        <p class="mb-1">Asal: <span class="fw-normal">{{ $item->asal_instansi }}</span></p>
                        <p class="mb-1">Profesi: <span class="fw-normal">{{ $item->pekerjaan }}</span></p>
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
