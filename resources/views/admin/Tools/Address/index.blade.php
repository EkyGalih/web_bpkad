@extends('admin.index')
@section('title', 'Alamat kantor')
@section('menu-tools', 'show')
@section('tools-address', 'active')
@section('additional-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('server/vendor/DataTables/DataTables-1.13.1/css/jquery.dataTables.min.css') }}" />
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Alamat Kantor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages-admin.index') }}">Tools</a></li>
                    <li class="breadcrumb-item active">Alamat Kantor</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Alamat Kantor <br /> <span>Atur alamat kantor (Jalan, Koordinat,
                                            nomor telepon/fax, dan email)</span></h5>
                                </div>
                            </div>
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <label for="inputtext">Alamat/Jalan</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="address">{{ $address->address }}</textarea>
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Latitude</label>
                                        <input type="text" class="form-control" value="{{ $address->lat }}"
                                            name="lat">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText">Longitude</label>
                                        <input type="text" class="form-control" value="{{ $address->lng }}"
                                            name="lng">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $address->phone }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="inputText">Fax</label>
                                        <input type="text" class="form-control" name="fax"
                                            value="{{ $address->fax }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="inputText">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $address->email }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Alamat Kantor <br /> <span>Atur alamat kantor (Koordinat
                                            Kantor)</span></h5>
                                </div>
                            </div>
                            <div id="map-kantor" style="width:100%;height:380px;">
                                {!! Mapper::render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('additional-js')
    <script>
        const latitude = $("input[name='lat']");
        const longitude = $("input[name='lng']");

        var lat = parseFloat(latitude.val());
        var lng = parseFloat(longitude.val());

        function initLokasiKantor() {

            const center = {
                lat: lat > 0 ? lat : -8.582999,
                lng: lng > 0 ? lng : 116.110505
            }
            var mapKantor = new google.maps.Map(document.getElementById('map-kantor'), {
                zoom: 17,
                center: center,
            });
            const infoWindowKantor = new google.maps.InfoWindow({
                content: "Kantor BPKAD NTB"
            });

            const markerKantor = new google.maps.Marker({
                position: center,
                map: mapKantor,
            })
            mapKantor.addListener('click', (event) => {
                mapKantor.setCenter(event.latLng)

                markerKantor.setPosition(event.latLng);
                $("input[name='lat']").val(event.latLng.lat())
                $("input[name='lng']").val(event.latLng.lng())
            })
            // mapKantor.addListener('dbclick', (event) => {
            // })
            var open = true;
            infoWindowKantor.open(mapKantor, markerKantor)
            markerKantor.addListener('click', function() {
                open ? infoWindowKantor.close() : infoWindowKantor.open(mapKantor, markerKantor)
                open = !open;
            })

            google.maps.event.addListener(infoWindowKantor, 'closeclick', function() {
                open = !open;
            });
        }
    </script>
    <script async="" defer=""
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuqtVUWuomslcA6TY6GBMRrAz9Yw26_p8&amp;callback=initLokasiKantor">
    </script>
@endsection
