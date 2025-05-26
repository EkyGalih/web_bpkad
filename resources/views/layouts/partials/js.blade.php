<script src="{{ asset('server/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('server/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/pickr/pickr.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/nouislider/nouislider.js') }}"></script>
<script src="{{ asset('server/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('server/assets/js/front-main.js') }}"></script>
<script src="{{ asset('server/assets/js/front-page-landing.js') }}"></script>
<script src="{{ asset('client/assets/js/sweet-alert.min.js') }}"></script>
@yield('addtional-js')
<script>
    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
        const lat = parseFloat(-8.5830920000);
        const lng = parseFloat(116.1104040000);
        const bpkad = {
            lat: lat > 0 ? lat : -8.582999,
            lng: lng > 0 ? lng : 116.110505
        }
        var mapKantor = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 17,
            center: bpkad,
        });
        const infoWindowKantor = new google.maps.InfoWindow({
            content: "Kantor BPKAD NTB"
        });

        const markerKantor = new google.maps.Marker({
            position: bpkad,
            map: mapKantor,
        })
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

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@include('layouts.sweet-alert-notification')