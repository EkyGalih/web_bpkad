<table class="table table-hover table-striped table-borderd">
    <thead>
        <tr>
            <th>#</th>
            <th>Sasaran Strategis</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($SasaranStrategis as $sasaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sasaran->sasaran_strategis }}</td>
                <td>
                    <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#EditData{{ $loop->iteration }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-xs" onclick="deleteData('{{ route('iku-sasaran.destroy', $sasaran->sasaran_id) }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @include('admin.iku_realisasi.Addons.SasaranStrategis.edit')
        @endforeach
    </tbody>
</table>
{{ $SasaranStrategis->links() }}
