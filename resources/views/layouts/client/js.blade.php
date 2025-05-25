<script src="{{ asset('client/assets/js/plugins.js') }}"></script>
<script src="{{ asset('client/assets/js/theme.js') }}"></script>
@yield('additional-js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Fungsi initialize untuk mempersiapkan peta Google Maps
    function initialize() {
        const lat = parseFloat(-8.5830920000);
        const lng = parseFloat(116.1104040000);
        const bpkad = {
            lat: lat > 0 ? lat : -8.582999,
            lng: lng > 0 ? lng : 116.110505
        };

        const mapKantor = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 17,
            center: bpkad,
        });

        const infoWindowKantor = new google.maps.InfoWindow({
            content: "Kantor BPKAD NTB"
        });

        const markerKantor = new google.maps.Marker({
            position: bpkad,
            map: mapKantor,
        });

        let open = true;
        infoWindowKantor.open(mapKantor, markerKantor);

        markerKantor.addListener('click', function() {
            if (open) {
                infoWindowKantor.close();
            } else {
                infoWindowKantor.open(mapKantor, markerKantor);
            }
            open = !open;
        });

        google.maps.event.addListener(infoWindowKantor, 'closeclick', function() {
            open = false;
        });
    }

    // Jalankan initialize saat window di-load
    window.addEventListener('load', initialize);
</script>
