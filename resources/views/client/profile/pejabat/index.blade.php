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
            <input type="hidden" id="kasubag_anggaran" value="{{ Helpers::getKasubag('kasubag', 'Anggaran') }}">
            <input type="hidden" id="kasubag_bmd" value="{{ Helpers::getKasubag('kasubag', 'BMD') }}">
            <input type="hidden" id="kasubag_sek" value="{{ Helpers::getKasubag('kasubag', 'Sekretariat') }}">
            <input type="hidden" id="kasubag_bekk" value="{{ Helpers::getKasubag('kasubag', 'BEKK') }}">
            <input type="hidden" id="kasubag_akt" value="{{ Helpers::getKasubag('kasubag', 'Akuntansi') }}">
            <input type="hidden" id="kasubag_uptb1" value="{{ Helpers::getKasubag('kasubag', 'UPTB Perbend') }}">
            <input type="hidden" id="kasubag_uptb2" value="{{ Helpers::getKasubag('kasubag', 'UPTB Aset') }}">
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
        var DataKasubagAkt = $('#kasubag_akt').val();
        var DataKasubagUptb1 = $('#kasubag_uptb1').val();
        var DataKasubagUptb2 = $('#kasubag_uptb2').val();

        var kepala = JSON.parse("[" + DataKepala + "]");
        var sekban = JSON.parse("[" + DataSekban + "]");
        var kabag = JSON.parse("[" + DataKabag + "]");
        var kasubag_anggaran = JSON.parse("[" + DataKasubagAnggaran + "]");
        var kasubag_bmd = JSON.parse("[" + DataKasubagBmd + "]");
        var kasubag_sek = JSON.parse("[" + DataKasubagSek + "]");
        var kasubag_bekk = JSON.parse("[" + DataKasubagBekk + "]");
        var kasubag_akt = JSON.parse("[" + DataKasubagAkt + "]");
        var kasubag_uptb1 = JSON.parse("[" + DataKasubagUptb1 + "]");
        var kasubag_uptb2 = JSON.parse("[" + DataKasubagUptb2 + "]");
        console.log(kasubag_uptb2[0]);
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
                    template: "ana",
                    subLevels: 2
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
                field_1: "jabatan",
                img_0: "img"
            },
            nodes: [{
                    id: 1,
                    tags: ["Kepala"],
                    name: kepala[0].name,
                    jabatan: kepala[0].nama_jabatan.toUpperCase(),
                    img: window.location.origin + "/uploads/pegawai/" + kepala[0].foto
                },
                {
                    id: 2,
                    pid: 1,
                    tags: ["Sekertaris"],
                    name: sekban[0].name,
                    jabatan: sekban[0].nama_jabatan.toUpperCase(),
                    img: window.location.origin + "/uploads/pegawai/" + sekban[0].foto
                },
                {
                    id: 3,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][0].name,
                    jabatan: kabag[0][0].nama_jabatan.toUpperCase() + " " + kabag[0][0].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][0].foto
                },
                {
                    id: 4,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][1].name,
                    jabatan: kabag[0][1].nama_jabatan.toUpperCase() + " " + kabag[0][1].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][1].foto
                },
                {
                    id: 5,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][2].name,
                    jabatan: kabag[0][2].nama_jabatan.toUpperCase() + " " + kabag[0][2].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][2].foto
                },
                {
                    id: 6,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][3].name,
                    jabatan: kabag[0][3].nama_jabatan.toUpperCase() + " " + kabag[0][3].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][3].foto
                },
                {
                    id: 7,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][4].name,
                    jabatan: kabag[0][4].nama_jabatan.toUpperCase() + " " + kabag[0][4].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][4].foto
                },
                {
                    id: 8,
                    pid: 2,
                    tags: ["Kabag"],
                    name: kabag[0][5].name,
                    jabatan: kabag[0][5].nama_jabatan.toUpperCase() + " " + kabag[0][5].initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kabag[0][5].foto
                },
                {
                    id: 10,
                    pid: 6,
                    tags: ["Kasubag"],
                    name: kasubag_anggaran[0][0].name,
                    jabatan: kasubag_anggaran[0][0].nama_jabatan.toUpperCase() + " " + kasubag_anggaran[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_anggaran[0][0].foto
                },
                {
                    id: 11,
                    pid: 6,
                    tags: ["Kasubag"],
                    name: kasubag_anggaran[0][1].name,
                    jabatan: kasubag_anggaran[0][1].nama_jabatan.toUpperCase() + " " + kasubag_anggaran[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_anggaran[0][1].foto
                },
                {
                    id: 12,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][0].name,
                    jabatan: kasubag_bmd[0][0].nama_jabatan.toUpperCase() + " " + kasubag_bmd[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_bmd[0][0].foto
                },
                {
                    id: 13,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][1].name,
                    jabatan: kasubag_bmd[0][1].nama_jabatan.toUpperCase() + " " + kasubag_bmd[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_bmd[0][1].foto
                },
                {
                    id: 14,
                    pid: 7,
                    tags: ["Kasubag"],
                    name: kasubag_bmd[0][2].name,
                    jabatan: kasubag_bmd[0][2].nama_jabatan.toUpperCase() + " " + kasubag_bmd[0][2]
                        .initial_jabatan,
                        img: window.location.origin + "/uploads/pegawai/" + kasubag_bmd[0][2].foto
                    },
                    {
                    id: 18,
                    pid: 8,
                    tags: ["Kasubag"],
                    name: kasubag_bekk[0][0].name,
                    jabatan: kasubag_bekk[0][0].nama_jabatan.toUpperCase() + " " + kasubag_bekk[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_bekk[0][0].foto
                },
                {
                    id: 19,
                    pid: 8,
                    tags: ["Kasubag"],
                    name: kasubag_bekk[0][1].name,
                    jabatan: kasubag_bekk[0][1].nama_jabatan.toUpperCase() + " " + kasubag_bekk[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_bekk[0][1].foto
                },
                {
                    id: 20,
                    pid: 8,
                    tags: ["Kasubag"],
                    name: kasubag_bekk[0][2].name,
                    jabatan: kasubag_bekk[0][2].nama_jabatan.toUpperCase() + " " + kasubag_bekk[0][2]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_bekk[0][2].foto
                },
                {
                    id: 21,
                    pid: 4,
                    tags: ["Kasubag"],
                    name: kasubag_akt[0][0].name,
                    jabatan: kasubag_akt[0][0].nama_jabatan.toUpperCase() + " " + kasubag_akt[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_akt[0][0].foto
                },
                {
                    id: 22,
                    pid: 4,
                    tags: ["Kasubag"],
                    name: kasubag_akt[0][1].name,
                    jabatan: kasubag_akt[0][1].nama_jabatan.toUpperCase() + " " + kasubag_akt[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_akt[0][1].foto
                },
                {
                    id: 23,
                    pid: 4,
                    tags: ["Kasubag"],
                    name: kasubag_akt[0][2].name,
                    jabatan: kasubag_akt[0][2].nama_jabatan.toUpperCase() + " " + kasubag_akt[0][2]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_akt[0][2].foto
                },
                {
                    id: 24,
                    pid: 5,
                    tags: ["Kasubag"],
                    name: kasubag_uptb1[0][0].name,
                    jabatan: kasubag_uptb1[0][0].nama_jabatan.toUpperCase() + " " + kasubag_uptb1[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb1[0][0].foto
                },
                {
                    id: 25,
                    pid: 5,
                    tags: ["Kasubag"],
                    name: kasubag_uptb1[0][1].name,
                    jabatan: kasubag_uptb1[0][1].nama_jabatan.toUpperCase() + " " + kasubag_uptb1[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb1[0][1].foto
                },
                {
                    id: 26,
                    pid: 5,
                    tags: ["Kasubag"],
                    name: kasubag_uptb1[0][2].name,
                    jabatan: kasubag_uptb1[0][2].nama_jabatan.toUpperCase() + " " + kasubag_uptb1[0][2]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb1[0][2].foto
                },
                {
                    id: 27,
                    pid: 3,
                    tags: ["Kasubag"],
                    name: kasubag_uptb2[0][0].name,
                    jabatan: kasubag_uptb2[0][0].nama_jabatan.toUpperCase() + " " + kasubag_uptb2[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb2[0][0].foto
                },
                {
                    id: 28,
                    pid: 3,
                    tags: ["Kasubag"],
                    name: kasubag_uptb2[0][1].name,
                    jabatan: kasubag_uptb2[0][1].nama_jabatan.toUpperCase() + " " + kasubag_uptb2[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb2[0][1].foto
                },
                {
                    id: 29,
                    pid: 3,
                    tags: ["Kasubag"],
                    name: kasubag_uptb2[0][2].name,
                    jabatan: kasubag_uptb2[0][2].nama_jabatan.toUpperCase() + " " + kasubag_uptb2[0][2]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_uptb2[0][2].foto
                },
                {
                    id: 30,
                    pid: 2,
                    tags: ["kasub_sek"],
                    name: kasubag_sek[0][0].name,
                    jabatan: kasubag_sek[0][0].nama_jabatan.toUpperCase() + " " + kasubag_sek[0][0]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_sek[0][0].foto
                },
                {
                    id: 31,
                    pid: 2,
                    tags: ["kasub_sek"],
                    name: kasubag_sek[0][1].name,
                    jabatan: kasubag_sek[0][1].nama_jabatan.toUpperCase() + " " + kasubag_sek[0][1]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_sek[0][1].foto
                },
                {
                    id: 32,
                    pid: 2,
                    tags: ["kasub_sek"],
                    name: kasubag_sek[0][2].name,
                    jabatan: kasubag_sek[0][2].nama_jabatan.toUpperCase() + " " + kasubag_sek[0][2]
                        .initial_jabatan,
                    img: window.location.origin + "/uploads/pegawai/" + kasubag_sek[0][2].foto
                },
            ]
        });
    </script>
@endsection
