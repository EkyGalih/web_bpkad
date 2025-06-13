@extends('admin.index')
@section('title', 'Link Terkait')
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
                    <h4 class="mb-0">Link Terkait</h4>
                    <div class="d-flex gap-2">
                        <button data-bs-toggle="modal" data-bs-target="#TambahModal" data-bs-tooltip="tooltip"
                            data-bs-placement="top" title="Tambah Link" class="btn btn-primary btn-md">
                            <i class="icon-base ri ri-add-fill icon-18px"></i> Tambah
                        </button>
                    </div>
                </div>
                @include('admin.Tools.Links.addons._add')
            </div>
            <div class="card-datatable table-responsive text-nowrap">
                <table class="table table-hover table-link">
                    <thead>
                        <tr>
                            <th>Link</th>
                            <th class="d-flex align-items-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $link)
                            <tr>
                                <td>
                                    <div class="d-flex gap-3 border-start border-3 border-primary ps-3">
                                        <div>
                                            <a href="#" class="mb-1 text-gray-900 text-primary fw-bold">
                                                {{ strtoupper($link->name) }}
                                            </a>
                                            <div class="fs-7 text-muted fw-bold">{{ $link->link }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#EditModal{{ $link->id }}"><i
                                                    class="icon-base ri ri-pencil-line icon-18px me-2"></i> Edit</button>
                                            <button class="dropdown-item"
                                                onclick="trashData('{{ route('link.destroy', $link->id) }}')"><i
                                                    class="icon-base ri ri-delete-bin-6-line icon-18px me-2"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @include('admin.Tools.Links.addons._edit')
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
            $('.table-link').DataTable();
        });
        document.addEventListener("DOMContentLoaded", function() {
            const linkInput = document.getElementById('link');
            const submitBtn = document.getElementById('submitBtn');
            const errorText = document.getElementById('linkError');

            linkInput.addEventListener('input', function() {
                if (linkInput.checkValidity()) {
                    submitBtn.disabled = false;
                    errorText.classList.add('d-none');
                } else {
                    submitBtn.disabled = true;
                    errorText.classList.remove('d-none');
                }
            });
        });
    </script>
@endsection
