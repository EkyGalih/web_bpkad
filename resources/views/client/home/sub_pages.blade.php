@extends('client.index')
@section('title', $subPages->title)
@section('content_home')
    <main id="main" data-aos="fade-up">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $subPages->title }}</h2>
                </div>

            </div>
        </section><!-- Breadcrumbs Section -->

        <!-- ======= Berita ======= -->
        <section class="portfolio-details">
            <div class="container">

                <div class="portfolio-description">
                    <h2>{{ $subPages->title }}</h2>
                    <p>
                        {!! $subPages->content !!}
                    </p>
                    @if ($subPages->pdf_file != null)
                        <img src="{{ asset($subPages->pdf_file) }}" alt="" width="600" height="500">
                    @endif
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
@endsection
