@extends('client.index')
@section('title', $pages->title. ' |')
@section('content_home')
    <main id="main" data-aos="fade-up">
        <!-- ======= Berita ======= -->
        <section class="breadcrumbs">
            <div class="card" style="padding: 5%; margin-right: 5%; margin-left: 5%; margin-top: 1%;">

                <div class="portfolio-description">
                    <h2>{{ $pages->title }}</h2>
                    <p>
                        {!! $pages->content !!}
                    </p>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
    <footer id="footer">

    </footer>
@endsection
