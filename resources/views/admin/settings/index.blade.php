@extends('admin.index')
@section('title', 'Website Settings')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Website Settings</h4>
            </div>

            <div class="card-body">
                {{-- Tabs Navigation --}}
                <ul class="nav nav-tabs mb-3" id="settingsTabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#general"
                            role="tab">General</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#sosial" role="tab">Sosial
                            Media</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#simaskot"
                            role="tab">SIMASKOT</a></li>
                </ul>
                <div id="form-alert" class="alert d-none"></div>
                <form id="settings-form" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        {{-- Tab general --}}
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="mb-4">
                                <label class="form-label d-block mb-2">Maintenance Mode</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="maintenance_mode"
                                        id="maintenance_on" value="1"
                                        {{ (bool) old('maintenance_mode', $settings->maintenance_mode) === true ? 'checked' : '' }}>
                                    <label class="form-check-label" for="maintenance_on">On</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="maintenance_mode"
                                        id="maintenance_off" value="0"
                                        {{ (bool) old('maintenance_mode', $settings->maintenance_mode) === false ? 'checked' : '' }}>
                                    <label class="form-check-label" for="maintenance_off">Off</label>
                                </div>
                            </div>
                            @foreach (['title', 'subtitle', 'email', 'contact_number'] as $field)
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="{{ $field }}"
                                        name="{{ $field }}" value="{{ old($field, $settings->$field) }}"
                                        placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                </div>
                            @endforeach
                            <div class="row mb-4">
                                <div class="col-md-6 form-floating form-floating-outline">
                                    <input type="file" class="form-control" name="logo_image" id="logo_image"
                                        accept="image/*" onchange="previewImage(this)">
                                    <label for="logo_image">Logo Website</label>
                                </div>
                                <div class="col-md-6 form-floating form-floating-outline">
                                    <input type="file" class="form-control" name="header_image" id="header_image"
                                        accept="image/*" onchange="previewImage(this)">
                                    <label for="header_image">Header</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        @if (!empty($settings->logo_image))
                                            <img src="{{ asset($settings->logo_image) }}"
                                                class="img-thumbnail preview-image" data-preview="logo_image"
                                                style="max-height: 150px;">
                                        @else
                                            <img src="" class="img-thumbnail preview-image d-none"
                                                data-preview="logo_image" style="max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        @if (!empty($settings->header_image))
                                            <img src="{{ asset($settings->header_image) }}"
                                                class="img-thumbnail preview-image" data-preview="header_image"
                                                style="max-height: 150px;">
                                        @else
                                            <img src="" class="img-thumbnail preview-image d-none"
                                                data-preview="header_image" style="max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab sosial media --}}
                        <div class="tab-pane fade" id="sosial" role="tabpanel">
                            @foreach (['facebook', 'twitter', 'instagram', 'youtube', 'tiktok'] as $field)
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="{{ $field }}"
                                        name="{{ $field }}" value="{{ old($field, $settings->$field) }}"
                                        placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Tab SIMASKOT --}}
                        <div class="tab-pane fade" id="simaskot" role="tabpanel">
                            @foreach (['simaskot_link', 'simaskot_opd'] as $field)
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" id="{{ $field }}"
                                        name="{{ $field }}" value="{{ old($field, $settings->$field) }}"
                                        placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                </div>
                            @endforeach
                            <div class="row mb-4">
                                <div class="col-md-6 form-floating form-floating-outline">
                                    <input type="file" class="form-control" name="simaskot_qrcode_image"
                                        id="simaskot_qrcode_image" accept="image/*" onchange="previewImage(this)">
                                    <label for="simaskot_qrcode_image">Logo Website</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        @if (!empty($settings->simaskot_qrcode_image))
                                            <img src="{{ asset($settings->simaskot_qrcode_image) }}"
                                                class="img-thumbnail preview-image" data-preview="simaskot_qrcode_image"
                                                style="max-height: 150px;">
                                        @else
                                            <img src="" class="img-thumbnail preview-image d-none"
                                                data-preview="simaskot_qrcode_image" style="max-height: 150px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="ri ri-save-line"></i> Simpan
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function previewImage(input) {
            const name = input.name; // Ambil nama input (contoh: logo_image)
            const preview = document.querySelector(`img[data-preview="${name}"]`);

            if (input.files && input.files[0] && preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("settings-form");
            const alertBox = document.getElementById("form-alert");

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch("{{ route('settings.update') }}", {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(async res => {
                        const contentType = res.headers.get("content-type") || "";

                        if (!res.ok) {
                            // Jika bukan response 200 OK, tangani error
                            const data = contentType.includes("application/json") ? await res
                                .json() : {
                                    message: await res.text()
                                };
                            throw {
                                status: res.status,
                                data
                            };
                        }

                        return res.json(); // response sukses
                    })
                    .then(data => {
                        alertBox.className = "alert alert-success";
                        alertBox.innerText = data.message || "Settings berhasil disimpan.";
                        alertBox.classList.remove("d-none");

                        setTimeout(() => {
                            alertBox.classList.add("d-none");
                        }, 5000);
                    })
                    .catch(error => {
                        alertBox.className = "alert alert-danger";
                        if (error.status === 422) {
                            // Tampilkan semua error validasi
                            const errors = error.data.errors || {};
                            const messages = Object.values(errors).flat().join('\n');
                            alertBox.innerText = "Validasi gagal:\n" + messages;
                        } else {
                            alertBox.innerText = error.data?.message || "Terjadi kesalahan.";
                        }
                        alertBox.classList.remove("d-none");
                    });
            });
        });
    </script>
@endsection
