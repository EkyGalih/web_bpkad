<div class="table-responsive">
    <table class="table table-hover table-striped table-borderd">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 500px;">Formulasi</th>
                <th>Tipe Perhitungan</th>
                <th>Sumber Data</th>
                <th style="width: 500px;">Alasan</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Formulasi as $formula)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $formula->formulasi }}</td>
                    <td>{{ $formula->tipe_penghitungan }}</td>
                    <td>{{ $formula->divisi->nama_divisi }}</td>
                    <td>{{ $formula->alasan }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-link btn-xs" data-toggle="modal"
                                data-target="#EditData{{ $loop->iteration }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-link btn-xs"
                                onclick="deleteData('{{ route('iku-formulasi.destroy', $formula->formula_id) }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @include('admin.iku_realisasi.Addons.Formula.edit')
            @endforeach
        </tbody>
    </table>
    {{ $Formulasi->links() }}
</div>
