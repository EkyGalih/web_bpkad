<div class="modal fade" id="ShowPermohonan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Detail Permohonan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                        Pemohon
                    </div>
                    <div class="col-lg-1">
                        <span>:</span>
                    </div>
                    <div class="col-lg-8">
                        <strong><u>{{ $item->nama }}</u></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        kode Registrasi
                    </div>
                    <div class="col-lg-1">
                        <span>:</span>
                    </div>
                    <div class="col-lg-8">
                        <strong><u>{{ $item->kode_pemohon }}</u></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        Asal Instansi
                    </div>
                    <div class="col-lg-1">
                        <span>:</span>
                    </div>
                    <div class="col-lg-8">
                        <strong><u>{{ $item->asal_instansi }}</u></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        Informasi diminta
                    </div>
                    <div class="col-lg-1">
                        <span>:</span>
                    </div>
                    <div class="col-lg-8">
                        {{ $item->informasi_diminta }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        Tujuan Informasi
                    </div>
                    <div class="col-lg-1">
                        <span>:</span>
                    </div>
                    <div class="col-lg-8">
                        <q>{{ $item->tujuan_informasi }}</q>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
