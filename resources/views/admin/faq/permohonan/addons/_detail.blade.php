<div class="modal fade" id="ShowPermohonan{{ $loop->iteration }}" tabindex="-1">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-info-circle"></i>
                    Detail Permohonan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pemohon <span style="margin-left: 60px;">:</span> <strong><u>{{ $item->nama }}</u></strong></p>
                <p>kode Registrasi <span style="margin-left: 20px;">:</span> <strong><u>{{ $item->kode_pemohon }}</u></strong></p>
                <p>Asal Instansi <span style="margin-left: 40px;">:</span> <strong><u>{{ $item->asal_instansi }}</u></strong></p>
                <p>Informasi yg diminta <span style="margin-left: 10px;">:</span> <span class="badge bg-secondary">{{ $item->informasi_diminta }}</span></p>
                <p>Tujuan Penggunaan Informasi <span style="margin-left: 10px;">:</span> <br/> <q>{{ $item->tujuan_informasi }}</q></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
