@extends('client.index')
@section('title', $pages->title)
@section('content_home')
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">

        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Berita ======= -->
    <section class="portfolio-details">
        <div class="container">

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
