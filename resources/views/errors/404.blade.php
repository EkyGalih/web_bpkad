@extends('client.index')
@section('title', '404 - ')
@section('content_home')
    <section class="wrapper bg-light">
        <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 mx-auto">
                    <figure class="mb-10"><img class="img-fluid" src="{{ asset('client/assets/img/illustrations/404.png') }}"
                            srcset="{{ asset('client/assets/img/illustrations/404@2x.png 2x') }}" alt=""></figure>
                </div>
                <!-- /column -->
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                    <h1 class="mb-3">Oops! Page Not Found.</h1>
                    <button onclick="history.back(-1)" class="btn btn-primary rounded-pill">ke Beranda</button>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
