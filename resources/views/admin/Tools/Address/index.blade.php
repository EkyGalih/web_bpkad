@extends('admin.index')
@section('title', 'Alamat kantor')
@section('styles')
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Berita/Artikel</h4>
                    <div class="d-flex gap-2">
                    </div>
                </div>
                <form action="{{ route('address.update', $address->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 form-floating form-floating-outline mb-6">
                                <input type="text" id="phone" placeholder="Phone" class="form-control" name="phone"
                                    value="{{ $address->phone }}">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-lg-6 form-floating form-floating-outline mb-6">
                                <input type="text" id="email" placeholder="Email" class="form-control" name="email"
                                    value="{{ $address->email }}">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-floating form-floating-outline mb-6">
                                <input type="text" id="lat" placeholder="lat" class="form-control"
                                    value="{{ $address->lat }}" name="lat">
                                <label for="lat">Latitude</label>
                            </div>
                            <div class="col-lg-6 form-floating form-floating-outline mb-6">
                                <input type="text" id="lng" placeholder="lng" class="form-control"
                                    value="{{ $address->lng }}" name="lng">
                                <label for="lng">Longitude</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating form-floating-outline mb-6">
                                <textarea id="alamat" class="form-control" name="address">{{ $address->address }}</textarea>
                                <label for="alamat">Alamat/Jalan</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="icon-base ri ri-save-3-line icon-18px me-2"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $address->lat ?? -8.6525 }};
            const lng = {{ $address->lng ?? 116.3247 }};
            const map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([lat, lng]).addTo(map);

            map.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;

                if (marker) map.removeLayer(marker);
                marker = L.marker([lat, lng]).addTo(map);

                document.querySelector('input[name="lat"]').value = lat;
                document.querySelector('input[name="lng"]').value = lng;
            });
        });
    </script>
@endsection
