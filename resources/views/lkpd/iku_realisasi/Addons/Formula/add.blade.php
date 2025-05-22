<div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ki-outline ki-plus-square fs-3"></i> Tambah Formulasi</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-formulasi.store') }}" method="POST">
                    @csrf
                    <div class="fv-row mb-3">
                        <label class="form-label" for="ik_id">Indikator Kinerja</label>
                        <select name="indikator_kinerja_id" class="form-control mb-3">
                            <option>-----</option>
                            @php $indikatorKinerja = Iku::GetIK() @endphp
                            @if ($indikatorKinerja->isEmpty())
                                <option disabled>Tidak ada data</option>
                            @else
                                @foreach ($indikatorKinerja as $ik)
                                    <option value="{{ $ik->ik_id }}">{{ $ik->indikator_kinerja }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="formulasi">Formulasi</label>
                        <textarea name="formulasi" class="form-control mb-3"></textarea>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="tipe_penghitungan">Tipe Perhitungan</label>
                        <input type="text" name="tipe_penghitungan" class="form-control mb-3">
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="sumber_data">Sumber Data</label>
                        <select name="bidang_id" class="form-control mb-3">
                            <option value="">-------</option>
                            @php $Divisi = Helpers::GetAllBidang() @endphp
                            @foreach ($Divisi as $div)
                                <option value="{{ $div->bidang_id }}">{{ strtoupper($div->nama_bidang) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-3">
                        <label class="form-label" for="alasan">Alasan</label>
                        <textarea name="alasan" class="form-control mb-3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                    Close</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="ki-outline ki-plus fs-2"></i>
                    Tambah
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
