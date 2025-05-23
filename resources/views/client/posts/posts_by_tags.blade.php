@extends('client.index')
@section('title', 'Tags |')
@section('menu-berita', 'active')
@section('content_home')
<section class="section-frame overflow-hidden">
    <div class="wrapper bg-info">
        <div class="container py-12 py-md-16 text-center">
            <div class="row">
                <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <h1 class="display-1 mb-3 text-white">{{ $tags }}</h1>
                    <p class="lead px-lg-5 px-xxl-8 mb-1 text-white">Semua berita terkait agenda & kegiatan tags {{ $tags }}.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <div class="blog classic-view">
                    @foreach ($posts->take(3) as $post)
                    <article class="post">
                        <div class="card">
                            @php
                            $defaultImage = asset('static/images/no-image-post.png');
                            $imageUrl = Str::contains(
                            $post->foto_berita,
                            'https://storage.ntbprov.go.id/bpkad/uploads/berita',
                            )
                            ? $post->foto_berita
                            : asset($post->foto_berita);
                            @endphp
                            <figure class="card-img-top overlay overlay-1 hover-scale"><a
                                    href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}"><img
                                        src="{{ $imageUrl ?: $defaultImage }}"
                                        alt="{{ substr($post->slug, 0, 50) }}" /></a>
                                <figcaption>
                                    <h5 class="from-top mb-0">Selengkapnya</h5>
                                </figcaption>
                            </figure>
                            <div class="card-body">
                                <div class="post-header">
                                    <div class="post-category text-line">
                                        <a href="#" class="hover" rel="category">{{
                                            Helpers::PostCategory($post->posts_category_id) }}</a>
                                    </div>
                                    <h2 class="post-title mt-1 mb-0"><a class="link-dark"
                                            href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">{{
                                            $post->title }}</a></h2>
                                </div>
                                <div class="post-content">
                                    <p>{!! substr($post->content, 0, 500) !!}...</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{
                                            Helpers::getDate($post->created_at) }}</span>
                                    </li>
                                    <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By
                                                {{ $post->users->nama }}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="blog grid grid-view">
                    <div class="row isotope gx-md-8 gy-8 mb-8">
                        @foreach ($posts->skip(3)->take(4) as $post)
                        <article class="item post col-md-6">
                            <div class="card">
                                @php
                                $defaultImage = asset('static/images/no-image-post.png');
                                $imageUrl = Str::contains(
                                $post->foto_berita,
                                'https://storage.ntbprov.go.id/bpkad/uploads/berita',
                                )
                                ? $post->foto_berita
                                : asset($post->foto_berita);
                                @endphp
                                <figure class="card-img-top overlay overlay-1 hover-scale"><a
                                        href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">
                                        <img src="{{ $imageUrl ?: $defaultImage }}"
                                            alt="{{ substr($post->slug, 0, 50) }}" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Selengkapnya</h5>
                                    </figcaption>
                                </figure>
                                <div class="card-body">
                                    <div class="post-header">
                                        <div class="post-category text-line">
                                            <a href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}"
                                                class="hover" rel="category">{{
                                                Helpers::PostCategory($post->posts_category_id) }}</a>
                                        </div>
                                        <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark"
                                                href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">{{
                                                substr($post->title, 0, 50) }}</a></h2>
                                    </div>
                                    <div class="post-content">
                                        <p>{!! substr($post->content, 0, 100) !!}...</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <ul class="post-meta d-flex mb-0">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{
                                                Helpers::getDate($post->created_at) }}</span>
                                        </li>
                                        <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By
                                                    {{ $post->users->nama }}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
            <aside class="col-lg-4 sidebar mt-8 mt-lg-6">
                <div class="widget">
                    <form action="{{ route('post.search') }}" class="search-form" method="POST">
                        @csrf
                        <div class="form-floating mb-0">
                            <input id="search-form" name="cari" type="text" class="form-control" placeholder="Search">
                            <label for="search-form">Cari Berita</label>
                        </div>
                    </form>
                </div>
                <!-- /.widget -->
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
        </div>
    </div>
</section>
@endsection
