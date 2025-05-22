<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 14%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="ki-outline ki-notepad-edit fs-2"></i> Realisasi Anggaran</h3>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('lkpd.realisasi-anggaran.update') }}"
                    style="margin-left: 10px; margin-right: 10px;" onsubmit="return validateForm()">
                    @csrf
                    @method('PUT')
                    <div class="fv-row mb-3">
                        @php $KodeRekening = Apbd::GetSubKode() @endphp
                        <label class="form-label required" for="kode_rekening">Kode Rekening</label>
                        <select name="kode_rekening" class="form-control">
                            <option value="">------</option>
                            @foreach ($KodeRekening['kode_rekening'] as $key => $kode)
                                <option value="{{ $kode }}">[{{ $kode }}] -
                                    {{ $KodeRekening['nama_rekening'][$key] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label required" for="anggaran_terealisasi">Anggaran Terealisasi</label>
                        <input type="text" name="anggaran_terealisasi" id="anggaran_terealisasi" class="form-control"
                            required>
                        <input type="hidden" name="tahun_anggaran" value="{{ date('Y') }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
