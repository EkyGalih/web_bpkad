@extends('client.index')
@section('title', 'Semua Berita')
@section('menu-berita', 'active')
@section('additional-css')
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
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">
        <!-- ======= Berita ======= -->
        <section class="portfolio-details" style="margin-top: 5%;">

            <div class="portfolio-details" style="margin: 2%;">
                <div class="row">
                    <div class="col-2">
                        @php
                            $cat = Helpers::getPostCategory();
                        @endphp
                        <ul class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                                <i class="bx bx-purchase-tag-alt"></i> Kategori
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
                        <br/><br/>
                        @php
                            $tags = Helpers::countTag();
                        @endphp
                        <ul class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active"
                                aria-current="true">
                                <i class="bx bx-purchase-tag-alt"></i> Tags
                            </button>
                            @foreach ($tags as $tag)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a
                                        href="#">{{ $tag->tags }}
                                    </a>
                                    <span
                                        class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost($tag->tags) }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <!--news box-->
                            @foreach ($posts as $post)
                                <div class="col-3 pb-1 pt-0 pr-1">
                                    <div class="card border-0 rounded-0 text-white overflow zoom">
                                        <div class="position-relative">
                                            <!--thumbnail img-->
                                            <div class="ratio_right-cover-2 image-wrapper">
                                                <a
                                                    href="{{ route('client.show', Helpers::randomString(100) . '/' . $post->id . '/' . Helpers::randomString(100)) }}">
                                                    <img height="200" src="{{ asset($post->foto_berita) }}"
                                                        alt="simple blog template bootstrap">
                                                </a>
                                            </div>
                                            <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                <!-- category -->
                                                <a class="p-1 badge badge-primary rounded-0"
                                                    href="">{{ Helpers::PostCategory($post->posts_category_id) }}</a>

                                                <!--title-->
                                                <a
                                                    href="{{ route('client.show', Helpers::randomString(100) . '/' . $post->id . '/' . Helpers::randomString(100)) }}">
                                                    <h4 class="h5 text-white my-1">
                                                        {{ substr($post->title, 0, 50) }}...
                                                        <span style="font-size: 16px;">Selengkapnya</span>
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $posts->links() }}
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
