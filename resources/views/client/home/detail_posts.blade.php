@extends('client.index')
@section('title', 'Detail Berita')
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
        <section class="portfolio-details" style="margin-top: 8%;">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-8">
                    <div class="portfolio-details-container">

                        <div class="owl-carousel portfolio-details-carousel">
                            <img src="{{ asset($posts->foto_berita) }}" class="img-fluid" alt="{{ $posts->title }}">
                        </div>
                        <div class="portfolio-info">
                            <h3>Informasi berita</h3>
                            <ul>
                                <li><strong>Kategori</strong>: {{ Helpers::PostCategory($posts->posts_category_id) }}
                                </li>
                                <li><strong>Uploaded</strong>: {{ $posts->users->nama }}</li>
                                <li><strong>Waktu Post</strong>:
                                    {{ Helpers::getDate($posts->created_at) . ',' . Helpers::getTime($posts->created_at) }}
                                </li>
                            </ul>
                            <button type="button" class="btn btn-info btn-sm pull-right">
                                <i class="bx bx-share-alt"></i> Bagikan
                            </button>
                        </div>
                    </div>

                    <div class="portfolio-description">
                        <h2>{{ $posts->title }}</h2>
                        <p>
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
                            <i class="bx bx-purchase-tag-alt"></i> Kategori
                        </button>
                        @foreach ($cat as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('post.post_cat', $cat->id) }}">{{ $cat->category }}
                                </a>
                                <span
                                    class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost($cat->id) }})</span>
                            </li>
                        @endforeach
                    </ul>
                    <br /><br />
                    @php
                        $posting = Helpers::getPostTag($posts->tags);
                    @endphp
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-news"></i> Berita Serupa
                        </button>
                        @foreach ($posting as $post)
                            <a href="{{ route('client.show', $post->id) }}" type="button"
                                class="list-group-item list-group-item-action">{{ $post->title }}</a>
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
