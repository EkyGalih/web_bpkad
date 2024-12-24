@extends('SimPeg.index')
@section('title', 'Pegawai')
@section('title_page', 'Pegawai')
@section('pegawai', 'here show')
@section('styles')
    <style>
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 2.5rem;
            /* Increase font size */
            font-weight: bold;
            color: rgba(255, 0, 0, 0.7);
            /* Make color less transparent */
            text-transform: uppercase;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            /* Add shadow for more visibility */
            pointer-events: none;
            /* Prevents watermark from being clicked */
            z-index: 1;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #search {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-menu {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f9f9f9;
        }

        .dropdown-item img {
            width: 50px;
            height: 50px;
            border-radius: 10%;
            margin-right: 15px;
        }

        .dropdown-item .details {
            display: flex;
            flex-direction: column;
        }

        .dropdown-item .details .name {
            font-weight: bold;
            font-size: 16px;
        }

        .dropdown-item .details .nip {
            font-size: 14px;
            color: #888;
        }
    </style>
@endsection
@section('header')
    <div class="d-flex flex-stack justify-content-end flex-row-fluid" id="kt_app_navbar_wrapper">
        <div class="app-page-entry d-flex align-items-center flex-row-fluid gap-3">
            <div class="d-flex flex-column">
                <h1 class="text-gray-900 fs-2 fw-bold mb-0">Pegawai</h1>
            </div>
        </div>
    </div>
    <div class="float-end p-7">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-square"></i> Tambah Pegawai
        </a>
    </div>
@endsection
@section('content')
    <div class="dropdown">
        <input type="text" id="search" placeholder="Cari pegawai..." autocomplete="off">
        <ul class="dropdown-menu" id="results"></ul>
    </div>
    <hr class="my-5" />
    @foreach ($pegawai as $item)
        <div class="card mb-6">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->name }}" />
                            @if ($item->status_pegawai == 'pensiun')
                                <div class="watermark">PENSIUN</div>
                            @elseif($item->status_pegawai == 'pindah')
                                <div class="watermark">PINDAH</div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="{{ route('pegawai.show', $item->id) }}"
                                        class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $item->name }}</a>
                                    <a href="#">
                                        @if ($item->jenis_pegawai == 'asn')
                                            <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                        @endif
                                    </a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-duotone ki-profile-user fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>{{ strtoupper($item->jenis_kelamin) ?? '-' }}</a>
                                    <a href="#"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i
                                            class="ki-outline ki-barcode fs-4 me-1"></i>{{ Helpers::NIP($item->nip) ?? '-' }}</a>
                                    <a href="{{ route('bidang.getPegawai', $item->bidang->id) }}"
                                        class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                        <i class="ki-duotone ki-office-bag fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>{{ $item->bidang->nama_bidang }}</a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4">
                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning me-2"
                                    id="kt_user_follow_button">
                                    <i class="ki-outline ki-check fs-3 d-none"></i>
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Edit</span>
                                    <!--end::Indicator label-->
                                </a>
                                <button type="button" class="btn btn-sm btn-danger me-3" data-bs-toggle="modal"
                                    data-bs-target="#HapusPegawai{{ $loop->iteration }}">Hapus</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <i class="ki-outline ki-medal-star fs-3 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <div class="fs-2 fw-bold">{{ $item->pangkat->nama_pangkat ?? '-' }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-500">
                                            {{ $item->golongan->nama_golongan ?? '-' }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-calendar-2 fs-3 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            @if ($item->tanggal_lahir != null && \Carbon\Carbon::hasFormat($item->tanggal_lahir, 'Y-m-d'))
                                                @php
                                                    try {
                                                        $tanggalLahir = \Carbon\Carbon::createFromFormat(
                                                            'Y-m-d',
                                                            $item->tanggal_lahir,
                                                        );
                                                        $sekarang = \Carbon\Carbon::now();

                                                        // Menghitung umur dalam tahun
                                                        $umurTahun = $tanggalLahir->diffInYears($sekarang);
                                                    } catch (\Exception $e) {
                                                        $umurTahun = '-'; // Mengatur umur menjadi '-' jika format salah
                                                    }
                                                @endphp
                                            @else
                                                @php
                                                    $umurTahun = '-';
                                                @endphp
                                            @endif
                                            <div class="fs-2 fw-bold">{{ $umurTahun }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-500">Tahun</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div
                                        class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-star fs-3 text-warning me-2"></i>
                                            <div class="fs-2 fw-bold">{{ strtoupper($item->jenis_pegawai) }}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-semibold fs-6 text-gray-500">{{ $item->status_pegawai }}</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Progress-->
                            @if ($item->kenaikan_pangkat != null)
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-semibold fs-6 text-gray-500">Kenaikan Pangkat</span>
                                        <span
                                            class="fw-bold fs-6">{{ Helpers::progressBarPangkat($item->kenaikan_pangkat) }}%</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar"
                                            style="width: {{ Helpers::progressBarPangkat($item->kenaikan_pangkat) }}%;"
                                            aria-valuenow="{{ Helpers::progressBarPangkat($item->kenaikan_pangkat) }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endif
                            <!--end::Progress-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        @include('SimPeg.pegawai.addons._delete')
    @endforeach
    {{-- {{ $pegawai->links() }} --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                let query = $(this).val();

                if (query.length > 2) {
                    $.ajax({
                        url: '{{ route('pegawai.search') }}',
                        type: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            console.log(data);

                            $('#results').empty().show();
                            if (data.length > 0) {
                                data.forEach(item => {
                                    $('#results').append(`
                                        <li class="dropdown-item" data-url="{{ route('pegawai.show', '') }}/${item.id}">
                                            <img src="{{ Storage::url('${item.foto}') }}" alt="${item.name}">
                                            <div class="details">
                                                <span class="name">${item.name}</span>
                                                <span class="nip">NIP: ${item.nip}</span>
                                            </div>
                                        </li>
                                    `);
                                });

                                $('.dropdown-item').on('click', function() {
                                    let url = $(this).data('url');
                                    window.location.href = url;
                                    $('#results').hide();
                                });
                            } else {
                                $('#results').append(
                                    '<li class="dropdown-item">No results found</li>');
                            }
                        }
                    });
                } else {
                    $('#results').hide();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search, .dropdown-menu').length) {
                    $('#results').hide();
                }
            });
        });
    </script>
@endsection
