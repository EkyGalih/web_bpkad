@extends('admin.index')
@section('title', 'Menu')
@section('menu-faq', 'show')
@section('faq-permohonan', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>PERMOHONAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('laporan-admin.index') }}">Permohonan</a></li>
                    <li class="breadcrumb-item active">Data Permohonan Masyarakat</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('warning_ext'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('warning_ext') }}
                        </div>
                    @endif
                    @if (Session::has('warning_size'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('warning_size') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Laporan Masyarakat</h5>
                                </div>
                            </div>
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Permohonan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No.Hp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tgl Pengajuan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permohonan as $item)
                                        @php
                                            $tes = Helpers::getDate($item->created_at);
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td><button class="btn btn-link" data-bs-tooltip="tooltip"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ShowPermohonan{{ $loop->iteration }}"
                                                    data-bs-placement="top"
                                                    title="Lihat Permohonan">{{ $item->kode_pemohon }}</button> <sup
                                                    class="{{ Helpers::NewData($item->created_at) == 'true' ? 'blink' : '' }}">{{ Helpers::NewData($item->created_at) == 'true' ? 'Baru' : '' }}</sup>
                                            </td>
                                            @include('admin/faq/permohonan/addons/_detail')
                                            <td>
                                                <a href="https://mail.google.com/mail/u/0/#inbox?compose=new"
                                                    target="_blank" data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Send Data via Email">
                                                    {{ $item->email }}
                                                </a>
                                                <p id="email" hidden>{{ $item->email }}</p>
                                                <sup><button class="btn btn-xs" data-bs-tooltip="tooltip"
                                                        data-bs-placement="top" title="copy email address"
                                                        onclick="copyToClipboard('#email')"><i class="bx bx-copy"></i></button></sup>
                                            </td>
                                            <td><a href="https://wa.me/62{{ substr($item->telepon, 1) }}" target="_blank"
                                                    data-bs-tooltip="tooltip" data-bs-placement="top"
                                                    title="Send Data via Whatsapp">{{ $item->telepon }}</a></td>
                                            <td>
                                                <address>{{ $item->alamat }}</address>
                                            </td>
                                            <td>
                                                {{ Helpers::getDate($item->created_at) }}
                                            </td>
                                            <td>
                                                @if ($item->status == 'proses')
                                                    <a href="{{ route('permohonan-admin.status', $item->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="bi bi-clock"></i>
                                                        Proses</a>
                                                @else
                                                    <a href="#" class="btn btn-success btn-sm"><i
                                                            class="bi bi-check"></i> selesai</a>
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
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script type="text/javascript" src="{{ asset('server/js/jquery-5.3.1.js') }}"></script>
    <script src="{{ asset('server/vendor/DataTables/DataTables-1.13.1/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
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
