@extends('admin.index')
@section('title', 'Olympic')
@section('menu-tools', 'show')
@section('tools-olympic', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Olympic</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('olympic-admin.index') }}">Tools</a></li>
                    <li class="breadcrumb-item active">olympic</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Form Input <br />
                                        <span>Input Peraihan Medali</span>
                                    </h5>
                                </div>
                                <hr />
                            </div>
                            <form
                                action="{{ $olympic == null ? route('olympic-admin.store') : route('olympic-admin.update', $olympic->id) }}"
                                method="POST">
                                @csrf
                                @if (!empty($olympic))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <label for="inputtext"><i class="bi bi-instagram"></i> Bidang</label>
                                    <div class="col-lg-12">
                                        <select name="bidang_id" class="form-control">
                                            <option value="">--- Pilih Bidang ---</option>
                                            @foreach ($bidangs as $bidang)
                                                @if (empty($olympic))
                                                    <option value="{{ $bidang->uuid }}">{{ $bidang->nama_bidang }}</option>
                                                @else
                                                    <option value="{{ $bidang->uuid }}"
                                                        {{ $olympic->bidang_id == $bidang->uuid ? 'selected' : '' }}>
                                                        {{ $bidang->nama_bidang }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Emas</label>
                                        <input type="link" class="form-control" name="emas"
                                            value="{{ $olympic->emas ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Perak</label>
                                        <input type="link" class="form-control" name="perak"
                                            value="{{ $olympic->perak ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Perunggu</label>
                                        <input type="link" class="form-control" name="perunggu"
                                            value="{{ $olympic->perunggu ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success btn-md">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h5 class="card-title"><i class="bi bi-trophy-fill"></i> Perolehan Medali <br />
                                        <span>Data semua
                                            perolehan medali</span>
                                    </h5>
                                </div>
                            </div>
                            <table class="table table-hover" id="table-link">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bidang</th>
                                        <th style="text-align: center;">Emas</th>
                                        <th style="text-align: center;">Perak</th>
                                        <th style="text-align: center;">Perunggu</th>
                                        <th style="text-align: center;">Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($olympics as $olympic)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $olympic->nama_bidang }}</td>
                                            <td style="text-align: center;">{{ $olympic->emas }}</td>
                                            <td style="text-align: center;">{{ $olympic->perak }}</td>
                                            <td style="text-align: center;">{{ $olympic->perunggu }}</td>
                                            <td style="text-align: center;">{{ $olympic->total }}</td>
                                            <td>
                                                <a href="{{ route('olympic-admin.index', $olympic->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-edit"></i> Edit
                                                </a>
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
            $('#table-link').DataTable();
        });
    </script>
@endsection
