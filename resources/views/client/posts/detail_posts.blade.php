@extends('client.index')
@section('title', 'Detail Berita |')
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

        .created {}

        .created .img-circle {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            margin-bottom: 2%;
            margin-top: -3%;
        }

        .created .created-p {
            color: #000;
        }

        .quote {
            margin: 0.1%;
            color: #757474;
            font-family: 'Dancing Script', cursive;
        }
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">

        <!-- ======= Berita ======= -->
        <section class="portfolio-details" style="margin-top: 8%; padding: 5%;">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-8">
                    <div class="portfolio-details-container">
                        <h2>{{ $posts->title }}</h2>
                        <div class="row created">
                            <div class="col-lg-1">
                                <img class="img-circle" src="{{ asset($posts->users->avatar) }}" alt="">
                            </div>
                            <div class="col-lg-7">
                                <p class="created-p"
                                    style="margin-left: 1%; margin-bottom: 0%; color: #0844c5; font-weight: bold; font-size: 12px;">
                                    {{ $posts->users->nama }}</p>
                                <p class="created-p" style="margin-left: 1%; margin-bottom: -0.5%; font-size: 12px;">
                                    <strong>Diterbitkan</strong>
                                    {{ Helpers::getDate($posts->created_at) . ', ' . Helpers::getTime($posts->created_at) }}
                                </p>
                                <p class="created-p" style="margin-left: 1%; font-size: 12px;"><strong>Diperbaharui</strong>
                                    {{ Helpers::getDate($posts->updated_at) . ', ' . Helpers::getTime($posts->updated_at) }}
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <p>{!! $share !!}</p>
                            </div>
                        </div>
                        <div class="owl-carousel portfolio-details-carousel">
                            <img src="{{ asset($posts->foto_berita) }}" class="img-fluid" alt="{{ $posts->title }}">
                        </div>
                        <p class="quote">{{ $posts->caption ?? '' }}</p>
                        <hr/>
                    </div>

                    <div class="portfolio-description">
                        <p style="margin-top: -5%;">
                            {!! $posts->content !!}
                        </p><br /><br />
                        @foreach (Helpers::Tags($posts->tags) as $tags)
                            <label class="tags pull-right">
                                <i class="bx bx-purchase-tag-alt"></i> {{ $tags }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2" style="margin-left: 2%; margin-right: 2%;">
                    @php
                        $cat = Helpers::getPostCategory();
                    @endphp
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-border-all"></i> Kategori
                        </button>
                        @foreach ($cat as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a
                                    href="{{ route('post.post_cat', Helpers::randomString(120) . '/' . Helpers::randomString(100) . '/' . $cat->id) }}">{{ $cat->category }}
                                </a>
                                <span
                                    class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost($cat->id) }})</span>
                            </li>
                        @endforeach
                    </ul>
                    <br /><br />
                    @php
                        $posting = Helpers::getPostTag($posts->tags, '1');
                    @endphp
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-news"></i> Topik Terkait
                        </button>
                        @foreach ($posting as $post)
                            <a href="{{ route('client.show', Helpers::randomString(120) . '/' . $post->id . '/' . Helpers::randomString(100)) }}"
                                type="button" class="list-group-item list-group-item-action"><span
                                    style="color: #0844c5;">#</span> {{ $post->title }}</a>
                        @endforeach
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
