@extends('admin.index')
@section('title', 'Menu')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <style>
        .image_upload>input {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">FAQ - Permohonan Masyarakat</h4>
                </div>
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover faq-permohonan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Permohonan</th>
                            <th>Email</th>
                            <th>No.Hp</th>
                            <th>Alamat</th>
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $item)
                            @php
                                $tes = get_date($item->created_at);
                            @endphp
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><button class="btn btn-link" data-bs-tooltip="tooltip" data-bs-toggle="modal"
                                        data-bs-target="#ShowPermohonan{{ $loop->iteration }}" data-bs-placement="top"
                                        title="Lihat Permohonan">{{ $item->kode_pemohon }}</button> <sup
                                        class="{{ NewData($item->created_at) == 'true' ? 'blink' : '' }}">{{ NewData($item->created_at) == 'true' ? 'Baru' : '' }}</sup>
                                </td>
                                @include('admin/faq/permohonan/addons/_detail')
                                <td>
                                    <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" target="_blank"
                                        data-bs-tooltip="tooltip" data-bs-placement="top" title="Send Data via Email">
                                        {{ $item->email }}
                                    </a>
                                    <p id="email" hidden>{{ $item->email }}</p>
                                    <sup><button class="btn btn-xs" data-bs-tooltip="tooltip" data-bs-placement="top"
                                            title="copy email address" onclick="copyToClipboard('#email')"><i
                                                class="bx bx-copy"></i></button></sup>
                                </td>
                                <td><a href="https://wa.me/62{{ substr($item->telepon, 1) }}" target="_blank"
                                        data-bs-tooltip="tooltip" data-bs-placement="top"
                                        title="Send Data via Whatsapp">{{ $item->telepon }}</a></td>
                                <td>
                                    <address>{{ $item->alamat }}</address>
                                </td>
                                <td>
                                    {{ get_date($item->created_at) }}
                                </td>
                                <td>
                                    @if ($item->status == 'proses')
                                        <a href="{{ route('permohonan-admin.status', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-clock"></i>
                                            Proses</a>
                                    @else
                                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-check"></i>
                                            selesai</a>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-md" data-bs-toggle="modal"
                                        data-bs-target="#DeletePermohonan{{ $loop->iteration }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    @include('admin/faq/permohonan/addons/_delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.faq-permohonan').DataTable();
        });

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection
