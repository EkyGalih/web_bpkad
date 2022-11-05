@extends('client.index')
@section('title', 'Halaman')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Semua berita</h2>
                <ol>
                    <li><a href="{{'/'}}">Home</a></li>
                    <li><a href="{{route('client.posts')}}">Berita</a></li>
                    <li>Semua Berita</li>
                </ol>
            </div>

        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{$post->foto_berita}}" class="img-fluid" alt="">
                        <div class="portfolio-links">
                            <a href="{{$post->foto_berita}}" data-gall="portfolioGallery"
                               class="venobox"
                               title="{{$post->title}}"><i class="icofont-plus-circle"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="icofont-link"></i></a>
                        </div>
                        <div class="portfolio-info">
                            <h4>{{$post->title}}</h4>
                            <p>{{$post->create_at}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
