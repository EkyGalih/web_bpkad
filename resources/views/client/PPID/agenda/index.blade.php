@extends('client.index')
@section('title', 'Semua Berita |')
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
        <section class="breadcrumbs">
            <div class="card" style="padding: 5%; margin-right: 5%; margin-left: 5%; margin-top: 1%;">

                <h3 style="text-align: center; padding: 20px;">AGENDA PIMPINAN SELAMA 1 TAHUN - 2022</h3>
                <div class="portfolio-description">
                    @foreach ($agenda as $item)
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset($item->foto_berita) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ Helpers::getDate($item->created_at) . '-' . Helpers::getTime($item->created_at) }}</h5>
                                <p class="card-text">{{ $item->title }}</p>
                                <a href="{{ route('client.show', Helpers::randomString(100) . '/' . $item->id . '/' . Helpers::randomString(100)) }}" class="btn btn-primary">Link berita</a>
                            </div>
                        </div>
                    @endforeach
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
