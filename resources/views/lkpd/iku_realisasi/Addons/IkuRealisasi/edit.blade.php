<div class="modal fade" id="EditData{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title"><i class="fas fa-plus-square"></i> Ubah IKU</h5>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-realisasi.update', $data->iku_realisasi_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="sasaran_strategis">Sasaran Strategis</label>
                        @php $SasaranStrategis = Helpers::GetSasaran() @endphp
                        <select name="sasaran_strategis_id" class="form-control" onclick="enableForm()">
                            <option value="">------</option>
                            @foreach ($SasaranStrategis as $sasaran)
                                <option value="{{ $sasaran->sasaran_id }}" {{ $data->sasaran_strategis_id == $sasaran->sasaran_id ? 'selected' : '' }}>{{ $sasaran->sasaran_strategis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="indikator_kinerja">Indikator Kinerja</label>
                        @php $IndikatorKinerja = Helpers::GetIK() @endphp
                        <select name="indikator_kinerja_id" id="indikator_kinerja_id_edit" onchange="editData()" class="form-control">
                            <option value="">------</option>
                            @foreach ($IndikatorKinerja as $ik)
                                <option value="{{ $ik->ik_id }}" {{ $data->indikator_kinerja_id == $ik->ik_id ? 'selected' : '' }}>{{ $ik->indikator_kinerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formula">Formulasi Perhitungan</label>
                        <textarea id="formula_edit" class="form-control" readonly="readonly">{{ $data->formula->formulasi }}</textarea>
                        <input type="hidden" name="formula_id" id="formula_id_edit" value="{{ $data->formula_id }}">
                    </div>
                    <div class="form-group">
                        <label for="tipe_penghitungan">Tipe Pernghitungan</label>
                        <input type="text" id="tipe_penghitungan_edit" class="form-control" value="{{ $data->formula->tipe_penghitungan }}" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="divisi_id">Sumber Data</label>
                        <input type="text" id="divisi_id_edit" class="form-control" value="{{ $data->formula->divisi->nama_divisi }}" readonly="readonly">
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="target">Target</label>
                                <input type="text" name="target" id="target" class="form-control" readonly="readonly" value="{{ $data->target }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="target">Target Tercapai</label>
                                <input type="text" name="target_tercapai" class="form-control" value="{{ $data->target_tercapai }}">
                                <input type="hidden" class="form-control" name="kode_iku" value="IkuBpkad-{{ Helpers::GenerateString(3) }}-{{ date('Y') }}-{{ Helpers::GenerateString(3) }}">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme04" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" class="btn btn-theme"><i class="fas fa-save"></i>
                    Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
