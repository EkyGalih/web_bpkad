@extends('client.index')
@section('title', $pages->title. ' |')
@section('content_home')
<section class="section-frame overflow-hidden">
    <div class="wrapper image-wrapper bg-image bg-overlay bg-overlay-300" data-image-src="{{ asset($settings->header_image) }}">
        <div class="container pt-17 pb-19 pt-md-18 pb-md-17 text-center">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line text-white">
                        <a href="#" class="text-reset" rel="category">Halaman</a>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white">{{ $pages->title }}</h1>
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
    <div class="container py-14 py-md-10">
        <div class="row gx-lg-12 gx-xl-12">
            <div class="col-lg-12">
                <div class="blog single">
                    <div class="card">
                        <div class="card-body">
                            <div class="classic-view">
                                <article class="post">
                                    <div class="post-content mb-5">
                                        {!! $pages->content !!}
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <main id="main" data-aos="fade-up">
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

</footer> --}}
@endsection
