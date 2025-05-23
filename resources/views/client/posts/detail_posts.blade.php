@extends('client.index')
@section('menu-berita', 'active')
@section('content_home')
<section class="wrapper image-wrapper bg-image bg-overlay text-white" data-image-src="{{  asset('client/assets/img/photos/bg3.jpg') }}">
    <div class="container pt-18 pb-15 pt-md-20 pb-md-19 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line text-white">
                        <a href="#" class="text-reset" rel="category">{{
                            Helpers::PostCategory($posts->posts_category_id) }}</a>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white">{{ $posts->title }}</h1>
                    <ul class="post-meta text-white">
                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{
                                Helpers::getDate($posts->created_at) }}</span>
                        </li>
                        <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By
                                    {{ $posts->users->nama }}</span></a></li>
                    </ul>
                    <!-- /.post-meta -->
                </div>
                <!-- /.post-header -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <div class="blog single">
                    <div class="card">
                        <figure class="card-img-top"><img src="{{ asset($posts->foto_berita) }}"
                                alt="{{ $posts->title }}" /></figure>
                        <div class="card-body">
                            <div class="classic-view">
                                <article class="post">
                                    <div class="post-content mb-5">
                                        <h2 class="h1 mb-4">{{ $posts->title }}</h2>
                                        <p>{!! $posts->content !!}</p>
                                        <div class="row g-6 mt-3 mb-10">
                                            <div class="col-md-6">
                                                <figure class="hover-scale rounded cursor-dark"><a
                                                        href="./assets/img/photos/b8-full.jpg"
                                                        data-glightbox="title: Heading; description: Purus Vulputate Sem Tellus Quam"
                                                        data-gallery="post"> <img src="./assets/img/photos/b8.jpg"
                                                            alt="" /></a></figure>
                                            </div>
                                            <!--/column -->
                                            <div class="col-md-6">
                                                <figure class="hover-scale rounded cursor-dark"><a
                                                        href="./assets/img/photos/b9-full.jpg" data-glightbox
                                                        data-gallery="post"> <img src="./assets/img/photos/b9.jpg"
                                                            alt="" /></a></figure>
                                            </div>
                                            <!--/column -->
                                            <div class="col-md-6">
                                                <figure class="hover-scale rounded cursor-dark"><a
                                                        href="./assets/img/photos/b10-full.jpg" data-glightbox
                                                        data-gallery="post"> <img src="./assets/img/photos/b10.jpg"
                                                            alt="" /></a></figure>
                                            </div>
                                            <!--/column -->
                                            <div class="col-md-6">
                                                <figure class="hover-scale rounded cursor-dark"><a
                                                        href="./assets/img/photos/b11-full.jpg" data-glightbox
                                                        data-gallery="post"> <img src="./assets/img/photos/b11.jpg"
                                                            alt="" /></a></figure>
                                            </div>
                                            <!--/column -->
                                        </div>
                                    </div>
                                    <!-- /.post-content -->
                                    <div
                                        class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                                        <div>
                                            <ul class="list-unstyled tag-list mb-0">
                                                @foreach (Helpers::Tags($posts->tags) as $tags)
                                                <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill mb-0">{{
                                                        $tags }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="mb-0 mb-md-2">
                                            <div class="dropdown share-dropdown btn-group">
                                                <button
                                                    class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="uil uil-share-alt"></i> Share </button>
                                                <div class="dropdown-menu">
                                                    {!! $share !!}
                                                </div>
                                                <!--/.dropdown-menu -->
                                            </div>
                                            <!--/.share-dropdown -->
                                        </div>
                                    </div>
                                    <!-- /.post-footer -->
                                </article>
                                <!-- /.post -->
                            </div>
                            <!-- /.classic-view -->
                            <hr />
                            <h3 class="mb-6">Topik Terkait</h3>
                            <div class="swiper-container blog grid-view mb-16" data-margin="30" data-dots="true"
                                data-items-md="2" data-items-xs="1">
                                @php
                                $posting = Helpers::getPostTag($posts->tags, '1');
                                @endphp
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($posting as $post)
                                        <div class="swiper-slide">
                                            <article>
                                                @php
                                                $defaultImage = asset('static/images/no-image-post.png');
                                                $imageUrl = Str::contains(
                                                $post->foto_berita,
                                                'https://storage.ntbprov.go.id/bpkad/uploads/berita',
                                                )
                                                ? $post->foto_berita
                                                : asset($post->foto_berita);
                                                @endphp
                                                <figure class="overlay overlay-1 hover-scale rounded mb-5"><a
                                                        href="{{ route('post.show', [Helpers::GetCategoryContent($post->posts_category_id), $post->slug]) }}">
                                                        <img src="{{ $imageUrl ?: $defaultImage }}"
                                                            alt="{{ $post->title }}" /></a>
                                                    <figcaption>
                                                        <h5 class="from-top mb-0">Selengkapnya</h5>
                                                    </figcaption>
                                                </figure>
                                                <div class="post-header">
                                                    <div class="post-category text-line">
                                                        <a href="{{ route('post.show', [Helpers::GetCategoryContent($post->posts_category_id), $post->slug]) }}"
                                                            class="hover" rel="category">{{
                                                            Helpers::PostCategory($post->posts_category_id) }}</a>
                                                    </div>
                                                    <!-- /.post-category -->
                                                    <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                                            href="{{ route('post.show', [Helpers::GetCategoryContent($post->posts_category_id), $post->slug]) }}">{{
                                                            substr($post->title, 0, 50) }}...</a></h2>
                                                </div>
                                                <!-- /.post-header -->
                                                <div class="post-footer">
                                                    <ul class="post-meta mb-0">
                                                        <li class="post-date"><i
                                                                class="uil uil-calendar-alt"></i><span>{{
                                                                Helpers::getDate($post->created_at) }}</span>
                                                        </li>
                                                        <li class="post-author"><a href="#"><i
                                                                    class="uil uil-user"></i><span>By
                                                                    {{ $post->users->nama }}</span></a></li>
                                                    </ul>
                                                    <!-- /.post-meta -->
                                                </div>
                                                <!-- /.post-footer -->
                                            </article>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--/.swiper-wrapper -->
                                </div>
                                <!-- /.swiper -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
            <aside class="col-lg-4 sidebar mt-11 mt-lg-6">
                <div class="widget">
                    <form action="{{ route('post.search') }}" class="search-form" method="POST">
                        @csrf
                        <div class="form-floating mb-0">
                            <input id="search-form" type="text" name="cari" class="form-control" placeholder="Search">
                            <label for="search-form">Cari Berita</label>
                        </div>
                    </form>
                </div>
                <div class="widget">
                    <h4 class="widget-title mb-3">Categories</h4>
                    <ul class="unordered-list bullet-primary text-reset">
                        <li><a href="{{ route('post.index') }}">Berita ({{ Helpers::countCategoryPost('1') }})</a></li>
                        <li><a href="{{ route('artikel.index') }}">Artikel ({{ Helpers::countCategoryPost('2') }})</a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
                <div class="widget">
                    <h4 class="widget-title mb-3">Tags</h4>
                    @php
                    $tags = array_unique(Helpers::countTag());
                    @endphp
                    <ul class="list-unstyled tag-list">
                        @foreach ($tags as $key => $tag)
                        <li><a href="{{ route('post.tags', $tags[$key]) }}"
                                class="btn btn-soft-ash btn-sm rounded-pill">{{ $tag }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </aside>
            <!-- /column .sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
@endsection