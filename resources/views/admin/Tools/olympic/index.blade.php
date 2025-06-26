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
                    <div>
                        <h4 class="mb-0">Olimpiade BPKAD - {{ $year }}</h4>
                        <div class="fs-12 text-muted fst-italic">{{ strtoupper($season) }}</div>
                    </div>
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
                    // Buat rankingMap berdasarkan urutan emas, perak, perunggu (tahun aktif)
                    $sortedOlympics = $olympics->sortByDesc(fn($o) => [$o->emas, $o->perak, $o->perunggu])->values();
                    $rankingMap = collect();
                    foreach ($sortedOlympics as $index => $item) {
                        $rankingMap[$item->id] = $index + 1;
                    }
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($olympics as $olympic)
                            @php
                                $ranking = $rankingMap[$olympic->id] ?? null;
                                $rowClass = match ($ranking) {
                                    1 => 'table-warning', // Juara 1
                                    2 => 'table-secondary', // Juara 2
                                    3 => 'table-danger', // Juara 3
                                    default => '',
                                };
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $ranking }}</td>
                                <td>{{ $olympic->nama_bidang }}</td>
                                <td>
                                    <span class="editable" data-id="{{ $olympic->id }}" data-field="emas">
                                        {{ $olympic->emas }}
                                    </span>
                                    <input type="number" class="form-control form-control-sm d-none edit-input"
                                        value="{{ $olympic->emas }}">
                                </td>
                                <td>
                                    <span class="editable" data-id="{{ $olympic->id }}" data-field="perak">
                                        {{ $olympic->perak }}
                                    </span>
                                    <input type="number" class="form-control form-control-sm d-none edit-input"
                                        value="{{ $olympic->perak }}">
                                </td>
                                <td>
                                    <span class="editable" data-id="{{ $olympic->id }}" data-field="perunggu">
                                        {{ $olympic->perunggu }}
                                    </span>
                                    <input type="number" class="form-control form-control-sm d-none edit-input"
                                        value="{{ $olympic->perunggu }}">
                                </td>
                                <td>{{ $olympic->total }}</td>
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

        $(document).ready(function() {
            $('.table-olympic').on('click', '.editable', function() {
                const $span = $(this);
                const $input = $span.siblings('input.edit-input');

                $span.addClass('d-none');
                $input.removeClass('d-none').focus();
            });

            $('.table-olympic').on('blur', '.edit-input', function() {
                const $input = $(this);
                const newValue = $input.val();
                const $span = $input.siblings('span.editable');
                const id = $span.data('id');
                const field = $span.data('field');

                // Kirim AJAX untuk update
                $.ajax({
                    url: '{{ route('olympic-admin.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        field: field,
                        value: newValue
                    },
                    success: function(response) {
                        $span.text(newValue);
                        $input.addClass('d-none');
                        $span.removeClass('d-none');

                        // Update total jika tersedia
                        if (response.total !== undefined) {
                            $input.closest('tr').find('td').eq(5).text(response.total);
                        }
                    }
                });
            });
        });
    </script>
@endsection
