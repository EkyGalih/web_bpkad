@extends('admin.index')
@section('title', 'Olympic')
@section('styles')
    <link rel="stylesheet" href="{{ asset('server/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('server/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Olimpiade BPKAD</h4>
                    <div class="d-flex gap-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#olympicModal"
                            class="btn btn-outline-primary btn-md">
                            <i class="icon-base ri ri-file-add-line icon-18px me-2"></i> Tambah Periode
                        </button>
                        <form method="GET" action="{{ route('olympic-admin.index') }}" class="d-flex align-items-center">
                            <select name="tahun" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                @foreach ($years as $tahun)
                                    <option value="{{ $tahun }}" {{ $year == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}</option>
                                @endforeach
                            </select>
                            <noscript><button type="submit" class="btn btn-primary btn-sm">Filter</button></noscript>
                        </form>
                    </div>
                </div>
                @include('admin.Tools.olympic.addons._add')
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                @php
                    $rankingMap = $before_winners->pluck('ranking', 'bidang_id'); // [bidang_id => ranking]
                @endphp
                <table class="table table-hover table-olympic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bidang</th>
                            <th>Emas</th>
                            <th>Perak</th>
                            <th>Perunggu</th>
                            <th>Total</th>
                            <th class="d-flex align-items-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($olympics as $olympic)
                            @php
                                $ranking = $rankingMap[$olympic->bidang_id] ?? null;
                                $rowClass = match ($ranking) {
                                    1 => 'table-warning', // Emas
                                    2 => 'table-secondary', // Perak
                                    3 => 'table-danger', // Perunggu (buat sendiri jika tidak ada)
                                    default => '',
                                };
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $olympic->nama_bidang }}</td>
                                <td>{{ $olympic->emas }}</td>
                                <td>{{ $olympic->perak }}</td>
                                <td>{{ $olympic->perunggu }}</td>
                                <td>{{ $olympic->total }}</td>
                                <td>
                                    <a href="{{ route('olympic-admin.index', $olympic->id) }}"
                                        class="btn btn-outline-success btn-xs">
                                        <i class="icon-base ri ri-save-2-line me-2"></i> Save
                                    </a>
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
            $('.table-olympic').DataTable();
        });
    </script>
@endsection
