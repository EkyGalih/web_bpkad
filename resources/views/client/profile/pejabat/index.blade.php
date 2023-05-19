@extends('client.index')
@section('title', 'Profile | Profile Pejabat')
@section('additional-css')
    <style>
        #tree {
            width: auto;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <input type="hidden" id="kepala" value="{{ Helpers::getPimpinan('kaban') }}">
            <input type="hidden" id="sekban" value="{{ Helpers::getPimpinan('sekban') }}">
            <input type="hidden" id="kabag" value="{{ Helpers::getKabag('kabag') }}">
            <input type="hidden" id="kasubag_anggaran" value="{{ Helpers::getKasubag('kasubag','Anggaran') }}">
            <input type="hidden" id="kasubag_bmd" value="{{ Helpers::getKasubag('kasubag','BMD') }}">
            <input type="hidden" id="kasubag_sek" value="{{ Helpers::getKasubag('kasubag','Sekretariat') }}">
            <input type="hidden" id="kasubag_bekk" value="{{ Helpers::getKasubag('kasubag','BEKK') }}">
            <div id="tree"></div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
@section('additional-js')
    <script src="{{ asset('client/plugins/balkan-orgchart/orgchart.js') }}"></script>
    <script>
        var DataKepala = $('#kepala').val();
        var DataSekban = $('#sekban').val();
        var DataKabag = $('#kabag').val();
        var DataKasubagAnggaran = $('#kasubag_anggaran').val();
        var DataKasubagBmd = $('#kasubag_bmd').val();
        var DataKasubagSek = $('#kasubag_sek').val();
        var DataKasubagBekk = $('#kasubag_bekk').val();

        var kepala = JSON.parse("["+DataKepala+"]");
        var sekban = JSON.parse("["+DataSekban+"]");
        var kabag = JSON.parse("["+DataKabag+"]");
        var kasubag_anggaran = JSON.parse("["+DataKasubagAnggaran+"]");
        var kasubag_bmd = JSON.parse("["+DataKasubagBmd+"]");
        var kasubag_sek = JSON.parse("["+DataKasubagSek+"]");
        var kasubag_bekk = JSON.parse("["+DataKasubagBekk+"]");
        console.log(kasubag_bekk[0]);
        //JavaScript

        var chart = new OrgChart(document.getElementById("tree"), {
            template: "rony",
            mouseScrool: OrgChart.action.none,
            scaleInitial: OrgChart.match.boundary,
            collapse: {
                level: 3
            },
            tags: {
                "Kepala": {
                    template: "rony"
                },
                "Sekertaris": {
                    template: "polina"
                },
                "kasub_sek": {
                    template: "polina",
                    subLevels: 1
                },
                "Kabag": {
                    template: "ana"
                },
                "Kasubag": {
                    template: "ula"
                },
                "Pegawai": {
                    template: "belinda"
                }
            },
            nodeBinding: {
                field_0: "name",
                field_1: "title",
                img_0: "img"
            },
            nodes: [{
                    id: 1,
                    tags: ["Kepala"],
                    name: kepala[0].name,
                    title: kepala[0].nama_jabatan.toUpperCase(),
                    img: window.location.origin+"/uploads/pegawai/"+kepala[0].foto
                },
                {
                    id: 2,
                    pid: 1,
                    tags: ["Sekertaris"],
                    name: sekban[0].name,
                    title: sekban[0].nama_jabatan.toUpperCase(),
                    img: window.location.origin+"/uploads/pegawai/"+sekban[0].foto
                },
                {
                    id: 3,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][0].name,
                    title: kabag[0][0].nama_jabatan.toUpperCase()+" "+kabag[0][0].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][0].foto
                },
                {
                    id: 4,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][1].name,
                    title: kabag[0][1].nama_jabatan.toUpperCase()+" "+kabag[0][1].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][1].foto
                },
                {
                    id: 5,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][2].name,
                    title: kabag[0][2].nama_jabatan.toUpperCase()+" "+kabag[0][2].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][2].foto
                },
                {
                    id: 6,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][3].name,
                    title: kabag[0][3].nama_jabatan.toUpperCase()+" "+kabag[0][3].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][3].foto
                },
                {
                    id: 7,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][4].name,
                    title: kabag[0][4].nama_jabatan.toUpperCase()+" "+kabag[0][4].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][4].foto
                },
                {
                    id: 8,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][5].name,
                    title: kabag[0][5].nama_jabatan.toUpperCase()+" "+kabag[0][5].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kabag[0][5].foto
                },
                {
                    id: 10,
                    pid: 6,
                    tags: ["Kasubag"],
                    name: kasubag_anggaran[0][0].name,
                    title: kasubag_anggaran[0][0].nama_jabatan.toUpperCase()+" "+kasubag_anggaran[0][0].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_anggaran[0][0].foto
                },
                {
                    id: 11,
                    pid: 6,
                    tags: ["Kasubag"],
                    name: kasubag_anggaran[0][1].name,
                    title: kasubag_anggaran[0][1].nama_jabatan.toUpperCase()+" "+kasubag_anggaran[0][1].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_anggaran[0][1].foto
                },
                {
                    id: 12,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][0].name,
                    title: kasubag_bmd[0][0].nama_jabatan.toUpperCase()+" "+kasubag_bmd[0][0].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_bmd[0][0].foto
                },
                {
                    id: 13,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][1].name,
                    title: kasubag_bmd[0][1].nama_jabatan.toUpperCase()+" "+kasubag_bmd[0][1].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_bmd[0][1].foto
                },
                {
                    id: 14,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][2].name,
                    title: kasubag_bmd[0][2].nama_jabatan.toUpperCase()+" "+kasubag_bmd[0][2].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_bmd[0][2].foto
                },
                {
                    id: 15,
                    pid: 2,
                    tags: ["kasub_sek"],
                    name: kasubag_sek[0][0].name,
                    title: kasubag_sek[0][0].nama_jabatan.toUpperCase()+" "+kasubag_sek[0][0].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_sek[0][0].foto
                },
                {
                    id: 16,
                    pid: 2,
                    tags: ["kasub_sek"],
                    name: kasubag_sek[0][1].name,
                    title: kasubag_sek[0][1].nama_jabatan.toUpperCase()+" "+kasubag_sek[0][1].initial_jabatan,
                    img: window.location.origin+"/uploads/pegawai/"+kasubag_sek[0][1].foto
                },
            ]
        });
    </script>
@endsection
