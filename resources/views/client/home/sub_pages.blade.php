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
          </div>
        </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
    <footer id="footer">
        <div class="footer-newsletter">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                <h4>Join Our Newsletter</h4>
                <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                <form action="" method="post">
                    <input type="email" name="email"><input type="submit" value="Subscribe">
                </form>
                </div>
            </div>
            </div>
        </div>
    </footer>
@endsection
