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
@section('content_home')
    <section class="section-frame overflow-hidden">
        <div class="wrapper bg-info">
            <div class="container py-12 py-md-16 text-center">
                <div class="row">
                    <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                        <h1 class="display-1 mb-3 text-white">PPID</h1>
                        <p class="lead px-lg-5 px-xxl-8 mb-1 text-white">Struktur Organisasi PPID</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper bg-active-primary">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="col-lg-12">

                </div>
            </div>
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
