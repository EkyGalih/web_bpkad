@extends('client.index')
@section('title', 'Agenda Pimpinan |')
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
    <section class="breadcrumbs" style="margin-top: 5%;">

        <div class="card" style="padding: 5%; margin-right: 5%; margin-left: 5%; margin-top: 1%;">
            <div class="fortofolio-description">
                <div class="col-12">
                    <div class="row">
                        <!--news box-->
                        @foreach ($agenda as $item)
                            <div class="col-3 pb-1 pt-0 pr-1">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset($item->foto_berita) }}" class="card-img-top" alt="{{ $item->title }}">
                                    <div class="card-body">
                                      <h5 class="card-title">{{ Helpers::getDate($item->created_at) .'-'. Helpers::getTime($item->created_at) }}</h5>
                                      <p class="card-text">{{ $item->title }}</p>
                                      <a href="{{ route('client.show', Helpers::randomString(100) . '/' . $item->id . '/' . Helpers::randomString(100)) }}" class="btn btn-primary">
                                        <i class="bx bx-link"></i> Link Berita
                                      </a>
                                    </div>
                                  </div>
                            </div>
                        @endforeach
                    </div>
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
