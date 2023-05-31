@extends('client.index')
@section('title', 'Profile | Profile Pejabat')
@section('additional-css')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" href="{{ asset('client/plugins/orgchart/orgchart.css') }}">
    <style type="text/css">
        .navbar-default .navbar-nav>li.clr1 a {
            color: #ffffff;
        }

        .navbar-default .navbar-nav>li.clr2 a {
            color: #FFEB3B;
            ;
        }

        .navbar-default .navbar-nav>li.clr3 a {
            color: #5EC64D;
        }

        .navbar-default .navbar-nav>li.clr4 a {
            color: #29AAE2;
        }

        .navbar-default .navbar-nav>li.clr1 a:hover,
        .navbar-default .navbar-nav>li.clr1.active a {
            color: #fff;
            background: #F55;
        }

        .navbar-default .navbar-nav>li.clr2 a:hover,
        .navbar-default .navbar-nav>li.clr2.active a {
            color: #fff;
            background: #973CB6;
        }

        .navbar-default .navbar-nav>li.clr3 a:hover,
        .navbar-default .navbar-nav>li.clr3.active a {
            color: #fff;
            background: #5EC64D;
        }

        .navbar-default .navbar-nav>li.clr4 a:hover,
        .navbar-default .navbar-nav>li.clr4.active a {
            color: #fff;
            background: #29AAE2;
        }

        .navbar-default {
            background-color: #3b5998;
            font-size: 18px;
        }

        .navbar-default .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }

        .navbar-default .navbar-text {
            color: #ffffff;
        }

        a {
            color: #FFC107;
            text-decoration: none;
        }

        .img {
            width: 180px;
            height: 170px;
            margin-bottom: 5px;
        }

        .title {
            font-size: 16px;
            margin-bottom: 0%;
            font-family: 'Times New Roman', Times, serif;
            -webkit-animation: text-flicker-in-glow 3s linear both;
            animation: text-flicker-in-glow 3s linear both;
            both;
            animation: title 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) 0.5s both;
        }

        @-webkit-keyframes title {
            0% {
                letter-spacing: -0.5em;
                opacity: 0;
            }

            40% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes title {
            0% {
                letter-spacing: -0.5em;
                opacity: 0;
            }

            40% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }


        .label-title {
            background-color: #e4e4e0;
            border-radius: 0%;
            margin-left: 2%;
            margin-right: 2%;
        }

        .name {
            font-size: 14px;
            color: #fff;
            font-weight: bold;
            font-family: 'Times New Roman';
            -webkit-animation: name 2s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            animation: name 2s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
        }

        @-webkit-keyframes name {
            0% {
                -webkit-filter: blur(12px);
                filter: blur(12px);
                opacity: 0;
            }

            100% {
                -webkit-filter: blur(0px);
                filter: blur(0px);
                opacity: 1;
            }
        }

        @keyframes name {
            0% {
                -webkit-filter: blur(12px);
                filter: blur(12px);
                opacity: 0;
            }

            100% {
                -webkit-filter: blur(0px);
                filter: blur(0px);
                opacity: 1;
            }
        }


        sumber: https: //www.posciety.com/cara-membuat-gambar-bulat-melingkar-bundar-html-css/
    </style>
@endsection
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            @php
                $atasan = Helpers::getPejabatPPID('atasan');
                $ketua = Helpers::getPejabatPPID('ketua');

                $kepala_pengelola = Helpers::getPejabatPPID('kepala_pengelola');
                $kepala_pengaduan = Helpers::getPejabatPPID('kepala_pengaduan');
                $kepala_pelayanan = Helpers::getPejabatPPID('kepala_pelayanan');
            @endphp
            <div class="row">
                <ul id="tree-data" style="display:none">
                    <li id="root">
                        <img class="img" src="{{ asset('uploads/pegawai/' . $atasan->foto) }}" />
                        <h5 class="title label-title">{{ strtoupper($atasan->nama_jabatan) }}</h5>
                        <p class="name">{{ $atasan->name }}</p>
                        <ul>
                            <li id="node1">
                                <img class="img" src="{{ asset('uploads/pegawai/' . $ketua->foto) }}" />
                                <h5 class="title label-title">{{ strtoupper($ketua->nama_jabatan) }}</h5>
                                <p class="name">{{ $ketua->name }}</p>
                                <ul>
                                    <li id="node2">
                                        <img class="img"
                                            src="{{ asset('uploads/pegawai/' . $kepala_pengelola->foto) }}" />
                                        <h5 class="title label-title">
                                            {{ strtoupper($kepala_pengelola->nama_jabatan) . ' ' . $kepala_pengelola->initial_jabatan }}
                                        </h5>
                                        <p class="name">{{ $kepala_pengelola->name }}</p>
                                        <ul>
                                            @php
                                                $anggota_pengelola = Helpers::getAnggotaPPID('anggota_pengelola');
                                            @endphp
                                            @foreach ($anggota_pengelola as $pengelola)
                                                <li id="node3">
                                                    <img class="img"
                                                        src="{{ asset('uploads/pegawai/' . $pengelola->foto) }}" />
                                                    <h5 class="title label-title">
                                                        {{ strtoupper($pengelola->nama_jabatan) . ' ' . $pengelola->initial_jabatan }}
                                                    </h5>
                                                    <p class="name">{{ $pengelola->name }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li id="node2">
                                        <img class="img"
                                            src="{{ asset('uploads/pegawai/' . $kepala_pelayanan->foto) }}" />
                                        <h5 class="title label-title">
                                            {{ strtoupper($kepala_pelayanan->nama_jabatan) . ' ' . $kepala_pelayanan->initial_jabatan }}
                                        </h5>
                                        <p class="name">{{ $kepala_pelayanan->name }}</p>
                                        <ul>
                                            @php
                                                $anggota_pelayanan = Helpers::getAnggotaPPID('anggota_pelayanan');
                                            @endphp
                                            @foreach ($anggota_pelayanan as $pelayanan)
                                                <li id="node3">
                                                    <img class="img"
                                                        src="{{ asset('uploads/pegawai/' . $pelayanan->foto) }}" />
                                                    <h5 class="title label-title">
                                                        {{ strtoupper($pelayanan->nama_jabatan) . ' ' . $pelayanan->initial_jabatan }}
                                                    </h5>
                                                    <p class="name">{{ $pelayanan->name }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li id="node2">
                                        <img class="img"
                                            src="{{ asset('uploads/pegawai/' . $kepala_pengaduan->foto) }}" />
                                        <h5 class="title label-title">
                                            {{ strtoupper($kepala_pengaduan->nama_jabatan) . ' ' . $kepala_pengaduan->initial_jabatan }}
                                        </h5>
                                        <p class="name">{{ $kepala_pengaduan->name }}</p>
                                        <ul>
                                            @php
                                                $anggota_pengaduan = Helpers::getAnggotaPPID('anggota_pengaduan');
                                            @endphp
                                            @foreach ($anggota_pengaduan as $pengaduan)
                                                <li id="node3">
                                                    <img class="img"
                                                        src="{{ asset('uploads/pegawai/' . $pengaduan->foto) }}" />
                                                    <h5 class="title label-title">
                                                        {{ strtoupper($pengaduan->nama_jabatan) . ' ' . $pengaduan->initial_jabatan }}
                                                    </h5>
                                                    <p class="name">{{ $pengaduan->name }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </li>
                </ul>
                <div id="tree-view"></div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
@section('additional-js')
    <script src="{{ asset('client/plugins/orgchart/orgchart.js') }}"></script>
    <script>
        $(document).ready(function() {
            // create a tree
            $("#tree-data").jOrgChart({
                chartElement: $("#tree-view"),
                nodeClicked: nodeClicked
            });
            // lighting a node in the selection
            function nodeClicked(node, type) {
                node = node || $(this);
                $('.jOrgChart .selected').removeClass('selected');
                node.addClass('selected');
            }
        });
    </script>
@endsection
