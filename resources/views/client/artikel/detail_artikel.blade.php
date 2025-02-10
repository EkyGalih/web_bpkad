@extends('client.index')
@section('title', 'Detail Artikel |')
@section('menu-berita', 'active')
@section('additional-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .tags {
            font-weight: bold;
            border-radius: 2px;
            color: #fff;
            font-size: 14px;
            padding: 4px;
            margin-right: 4px;
            background-color: #3f8bee;
        }

        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 5px;
            border: 1px solid #0844c5;
            margin: 2px;
            font-size: 15px;
            color: #fff;
            background-color: #0844c5;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post {
            position: relative;
            padding: 0px 0px 0px 75px;
            padding-bottom: 10px;
            margin-bottom: 6px;
            border-bottom: 1px solid #e5e5e5;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post:last-child {
            border-bottom: none;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date {
            position: absolute;
            left: 0px;
            top: 4px;
            width: 54px;
            height: 54px;
            text-align: center;
            border-radius: 5px;

        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date {
            background: rgb(2, 0, 36);
            background: -moz-linear-gradient(rgba(0, 123, 255, 1) 100%);
            background: -webkit-linear-gradient(rgba(0, 123, 255, 1) 100%);
            background: linear-gradient(rgba(0, 123, 255, 1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#020024", endColorstr="#007bff", GradientType=1);
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date p {
            display: block;
            font-size: 18px;
            font-weight: 500;
            color: #fff;
            text-align: center;
            margin: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .post-date span {
            position: relative;
            display: block;
            font-size: 13px;
            line-height: 18px;
            text-transform: uppercase;
            color: #fff;
            margin: 0px;
            padding: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box {
            position: relative;
            margin-bottom: 9px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box i {
            position: relative;
            display: inline-block;
            font-size: 14px;
            color: #666666 !important;
            margin-right: 10px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post .file-box p {
            position: relative;
            display: inline-block;
            margin-bottom: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 {
            position: relative;
            display: block;
            font-size: 18px;
            line-height: 28px;
            font-weight: 600;
            margin-bottom: 0px;
            color: #1d165c;
            margin: 0px;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 a {
            display: inline-block;
            color: #1d165c;
        }

        .sidebar-page-container .sidebar .sidebar-post .post-inner .post h5 a:hover {
            color: #e61819;
        }

        .carousel-inner-data {
            margin: 0px auto;
            height: 350px;
            overflow: hidden;
        }

        .carousel-inner-data ul {
            list-style: none;
            position: relative;
        }

        .carousel-inner-data li {
            height: auto;
        }
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">

        <!-- ======= Berita ======= -->
        <section class="portfolio-details" style="margin-top: 8%; padding: 2%;">
            <div class="row">
                <div class="col-lg-8">
                    <div class="portfolio-details-container">

                        <div class="owl-carousel portfolio-details-carousel">
                            <img src="{{ asset($artikel->foto_berita) }}" class="img-fluid" alt="{{ $artikel->title }}">
                        </div>
                    </div>

                    <div class="artikel-description">
                        <h2>{{ $artikel->title }}</h2>
                        <p>
                            {!! $artikel->content !!}
                        </p><br /><br />
                        <label class="pull-left">
                            {!! $share !!}
                        </label>
                        @foreach (Helpers::Tags($artikel->tags) as $tags)
                            <label class="tags pull-right">
                                <i class="bx bx-purchase-tag-alt"></i> {{ $tags }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3" style="margin-left: 2%;">
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-border-all"></i> Kategori
                        </button>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a
                                href="{{ route('post.index') }}"> Berita
                            </a>
                            <span
                                class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('1') }})</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a
                                href="{{ route('artikel.show') }}"> Artikel
                            </a>
                            <span
                                class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('2') }})</span>
                        </li>
                    </ul>
                    <br /><br />
                    @php
                        $artikels = Helpers::getPostTag($artikel->tags, $artikel->posts_category_id);
                    @endphp
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-file"></i> Artikel Serupa
                        </button>
                        {{-- <a href="{{ route('artikel.show', Helpers::randomString(120) . '/' . $post->id . '/' . Helpers::randomString(100)) }}"
                            type="button" class="list-group-item list-group-item-action">{{ $post->title }}</a> --}}
                        <div class="col-lg-12 col-md-12 col-sm-12 sidebar-page-container">
                            <div class="sidebar">
                                <div class="sidebar-widget sidebar-post">
                                    <div class="post-inner">
                                        <div class="carousel-inner-data">
                                            <ul>
                                                @foreach ($artikels as $artikel)
                                                    <li>
                                                        <div class="post">
                                                            <div class="post-date">
                                                                <img src="{{ asset($artikel->foto_berita) }}" height="70"
                                                                    width="70" alt="artikel">
                                                            </div>
                                                            <div class="file-box"><i class="far fa-folder-open"></i>
                                                                <p>{{ Helpers::PostCategory($artikel->posts_category_id) }}
                                                                </p>
                                                            </div>
                                                            <h5><a href="#">{{ $artikel->title }}</a></h5>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
    <footer id="footer">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
@section('additional-js')
    <script>
        $(function() {
            var tickerLength = $('.carousel-inner-data ul li').length;
            var tickerHeight = $('.carousel-inner-data ul li').outerHeight();
            $('.carousel-inner-data ul li:last-child').prependTo('.carousel-inner-data ul');
            $('.carousel-inner-data ul').css('marginTop', -tickerHeight);

            function moveTop() {
                $('.carousel-inner-data ul').animate({
                    top: -tickerHeight
                }, 600, function() {
                    $('.carousel-inner-data ul li:first-child').appendTo('.carousel-inner-data ul');
                    $('.carousel-inner-data ul').css('top', '');
                });

            }
            setInterval(function() {
                moveTop();
            }, 3000);
        });
    </script>
@endsection
