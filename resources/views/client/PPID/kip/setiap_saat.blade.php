<h2 class="title" style="margin: 20px; font-size: 30px;"><strong>INFORMASI SERTA MERTA</strong></h2>
<table class="table table-hover table-bordered">
    @foreach ($KipSetiapSaat as $item)
        <thead>
            <tr>
                <th colspan="4" class="text-center" style="font-size: 25px;">Tahun {{ $item['tahun'] }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item['kip'] as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['nama_informasi'] }}</td>
                    <td>{{ Helpers::GetDate($data['created_at']) . ' ' . Helpers::GetTime($data['created_at']) }}</td>
                    <td>
                        @if ($data['jenis_file'] == 'link')
                            <a href="{{ $data['files'] }}" target="_blank" class="btn btn-success btn-sm">Download</a>
                        @else
                            <a href="{{ route('ppid-kip.view_pdf', $data['id']) }}" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endforeach
</table>
