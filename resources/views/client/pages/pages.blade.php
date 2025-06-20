@extends('client.index')
@section('title', $pages->title . ' |')
@section('content_home')
    @include('layouts.client._header', [
        'title' => 'HALAMAN',
        'keterangan' => $pages->title,
    ])
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
