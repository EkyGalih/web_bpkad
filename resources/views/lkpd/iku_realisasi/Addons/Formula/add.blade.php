<div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title"><i class="fas fa-plus-square"></i> Tambah Formulasi</h5>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('iku-formulasi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="ik_id">Indikator Kinerja</label>
                        <select name="indikator_kinerja_id" class="form-control">
                            <option>-----</option>
                            @php $indikatorKinerja = Helpers::GetIK() @endphp
                            @foreach ($indikatorKinerja as $ik)
                                <option value="{{ $ik->ik_id }}">{{ $ik->indikator_kinerja }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formulasi">Formulasi</label>
                        <textarea name="formulasi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipe_penghitungan">Tipe Perhitungan</label>
                        <input type="text" name="tipe_penghitungan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sumber_data">Sumber Data</label>
                        <select name="divisi_id" class="form-control">
                            <option value="">-------</option>
                            @php $Divisi = Helpers::GetDivisi() @endphp
                            @foreach ($Divisi as $div)
                            <option value="{{ $div->divisi_id }}">{{ $div->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Alasan</label>
                        <textarea name="alasan" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme04" data-dismiss="modal"><i class="fas fa-times"></i>
                    Close</button>
                <button type="submit" class="btn btn-theme"><i class="fas fa-plus"></i>
                    Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
