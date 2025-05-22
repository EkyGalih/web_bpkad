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
            font-size: 18px;
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
            background-color: #ffffff;
            margin-left: 1.5%;
            margin-right: 1.5%;
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
                $kaban = Helpers::getPimpinan('select', 'kaban');
                $sekban = Helpers::getPimpinan('select', 'sekban');
                $kabag = Helpers::getKabag('select', 'kabid', 'kepala');
            @endphp
            <div class="row">
                <ul id="tree-data" style="display:none">
                    <li id="root">
                        <img class="img" src="{{ asset($kaban->foto) }}" />
                        <h5 class="title label-title">{{ strtoupper($kaban->nama_jabatan) }}</h5>
                        <p class="name">{{ $kaban->name }}</p>
                        <ul>
                            <li id="node1">
                                <img class="img" src="{{ asset($sekban->foto) }}" />
                                <h5 class="title label-title">{{ strtoupper($sekban->nama_jabatan) }}</h5>
                                <p class="name">{{ $sekban->name }}</p>
                                <ul>
                                    @foreach ($kabag as $kabag)
                                        <li id="node2">
                                            <img class="img" src="{{ asset($kabag->foto) }}" />
                                            <h5 class="title label-title">
                                                {{ strtoupper($kabag->nama_jabatan) . ' ' . $kabag->jabatan }}</h5>
                                            <p class="name">{{ $kabag->name }}</p>
                                        </li>
                                    @endforeach
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
