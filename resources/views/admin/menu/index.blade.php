@extends('admin.index')
@section('title', 'Menu')
@section('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .sortable-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sortable-item {
            padding: 12px 16px;
            margin-bottom: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            cursor: move;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ui-state-highlight {
            height: 50px;
            background-color: #e9ecef;
            border: 2px dashed #adb5bd;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Menu</h4>
                <button type="button" class="btn btn-outline-primary add-btn">
                    <i class="icon-base ri ri-add-large-line icon-18px me-2"></i> Tambah
                </button>
                <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form id="addMenuForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="add-menu-id">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="text" id="add-menu-name" placeholder="Masukkan nama menu"
                                            class="form-control" required>
                                        <label for="add-menu-name">Nama</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="text" id="add-menu-url" placeholder="Masukkan URL menu"
                                            class="form-control">
                                        <label for="add-menu-url">URL</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul id="sortable-menu" class="sortable-list">
                    @foreach ($menus as $menu)
                        <li class="sortable-item d-flex justify-content-between align-items-center" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}"
                            data-url="{{ $menu->url }}" style="cursor:pointer;">
                            <span class="me-2" style="cursor:move;">
                                <i class="icon-base ri ri-drag-move-2-line icon-18px"></i>
                            </span>
                            <span class="menu-name flex-grow-1 edit-btn" style="flex:1; cursor:pointer;">{{ $menu->name }}</span>
                            <button type="button" class="btn btn-sm btn-outline-danger ms-2 delete-btn" data-id="{{ $menu->id }}" style="z-index:1;">
                                <i class="ri ri-delete-bin-6-line"></i>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editMenuForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Nama Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit-menu-id">
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="edit-menu-name" placeholder="Masukkan nama menu" class="form-control"
                                required>
                            <label for="edit-menu-name">Nama</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="text" id="edit-menu-url" placeholder="Masukkan URL menu" class="form-control">
                            <label for="edit-menu-url">URL</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function() {
            // Urutan
            $("#sortable-menu").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    let order = [];
                    $("#sortable-menu .sortable-item").each(function(index) {
                        order.push({
                            id: $(this).data("id"),
                            position: index + 1
                        });
                    });

                    $.ajax({
                        url: "{{ route('menu-admin.sort') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            order: order
                        },
                        success: function(response) {
                            Swal.fire({
                                toast: true,
                                position: 'bottom-end',
                                icon: 'success',
                                title: 'Urutan berhasil disimpan',
                                showConfirmButton: false,
                                timer: 1200,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'p-1',
                                    title: 'fs-6'
                                }
                            });
                        },
                        error: function() {
                            alert("Gagal menyimpan urutan.");
                        }
                    });
                }
            }).disableSelection();

            // Buka modal
            $(".add-btn").on("click", function() {
                $("#add-menu-id").val('');
                $("#add-menu-name").val('');
                $("#add-menu-url").val('');
                $("#addMenuModal").modal("show");
            });

            // Edit menu hanya jika klik pada .edit-btn (bukan tombol hapus)
            $(document).on("click", ".edit-btn", function() {
                let $li = $(this).closest("li");
                let id = $li.data("id");
                let name = $li.data("name");
                let url = $li.data("url");
                $("#edit-menu-id").val(id);
                $("#edit-menu-name").val(name);
                $("#edit-menu-url").val(url);
                $("#editMenuModal").modal("show");
            });

            // Hapus menu
            $(document).on("click", ".delete-btn", function() {
                let id = $(this).data("id");
                let $li = $(this).closest("li");
                Swal.fire({
                    title: 'Hapus menu?',
                    text: "Menu akan dihapus secara permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/web/tools/menu/destroy/" + id,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE"
                            },
                            success: function() {
                                Swal.fire({
                                    toast: true,
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Menu berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1200,
                                    timerProgressBar: true,
                                    customClass: {
                                        popup: 'p-1',
                                        title: 'fs-6'
                                    }
                                });
                                $li.remove();
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                alert("Gagal menghapus menu.");
                            }
                        });
                    }
                });
            });

            // Submit modal
            $("#addMenuForm").on("submit", function(e) {
                e.preventDefault();
                let name = $("#add-menu-name").val();
                let url = $("#add-menu-url").val();

                $.ajax({
                    url: "{{ route('menu-admin.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        url: url
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Menu berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1200,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'p-1',
                                title: 'fs-6'
                            }
                        });
                        $("#sortable-menu").append(`
                            <li class="sortable-item edit-btn" data-id="${response.id}" data-name="${name}" data-url="${url}" style="cursor:pointer;">
                                <span class="me-2" style="cursor:move;">
                                    <i class="icon-base ri ri-drag-move-2-line icon-18px"></i>
                                </span>
                                <span class="menu-name" style="flex:1;">${name}</span>
                            </li>
                        `);
                        $("#addMenuModal").modal("hide");
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Gagal menambahkan menu.");
                    }
                });
            });
            $("#editMenuForm").on("submit", function(e) {
                e.preventDefault();
                let id = $("#edit-menu-id").val();
                let name = $("#edit-menu-name").val();

                $.ajax({
                    url: "/admin/web/tools/menu/update/" + id,
                    method: "POST", // pakai POST karena kita spoofing PUT
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT", // Laravel akan membaca ini sebagai method PUT
                        name: name
                    },
                    success: function() {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Perubahan berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1200,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'p-1',
                                title: 'fs-6'
                            }
                        });
                        $(`.sortable-item[data-id="${id}"] .menu-name`).text(name);
                        $("#editMenuModal").modal("hide");
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Gagal mengubah nama menu.");
                    }
                });
            });
        });
    </script>
@endsection
