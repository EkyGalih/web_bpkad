@extends('client.index')
@section('title', $pages->title)
@section('content_home')
    <main id="main" data-aos="fade-up">
        <!-- ======= Berita ======= -->
        <section class="portfolio-details" style="margin-top: 8%;">
            <div class="container">

                <div class="card" style="padding: 3%;">
                    <div class="portfolio-description">
                        <h2>{{ $pages->title }}</h2>
                        <p>
                            {!! $pages->content !!}
                        </p>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
    <footer id="footer">

    </footer>
@endsection
