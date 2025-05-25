@extends('client.index')
@section('title', $subPages->title . ' |')
@section('content_home')
    <section class="wrapper image-wrapper bg-image bg-overlay text-white"
        data-image-src="{{ asset('client/assets/img/photos/bg3.jpg') }}">
        <div class="container pt-18 pb-15 pt-md-20 pb-md-19 text-center">
            <div class="row">
                <div class="col-md-10 col-xl-8 mx-auto">
                    <div class="post-header">
                        <div class="post-category text-line text-white">
                            <a href="#" class="text-reset" rel="category">Halaman</a>
                        </div>
                        <!-- /.post-category -->
                        <h1 class="display-1 mb-4 text-white">{{ $subPages->title }}</h1>
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
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="col-lg-12">
                    <div class="blog single">
                        <div class="card">
                            <div class="card-body">
                                <div class="classic-view">
                                    <article class="post">
                                        <div class="post-content mb-5">
                                            {!! $subPages->content !!}
                                        </div>
                                        @if ($subPages->pdf_file != null)
                                            <img src="{{ asset($subPages->pdf_file) }}" alt="" width="600"
                                                height="500">
                                        @endif
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
