@extends('client.index')
@section('menu-home', 'active')
@section('additional-css')
    <!-- Basic stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/plugins/owl-carousel/owl.carousel.css') }}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ asset('client/plugins/owl-carousel/owl.theme.css') }}">
    <style>
        #owl-video .item {
            margin: 3px;
        }

        #owl-video .item img {
            display: block;
            width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content_home')
    <section id="hero" class="d-flex align-items-center">
        {{-- <div class="portfolio-details-container">
            <div class="owl-carousel portfolio-details-carousel">
                @foreach ($slides as $slide)
                    <img src="{{ asset($slide->foto) }}" alt="{{ $slide->title }}" style="margin-top: 40%; width: 100%; height: 5%;">
                @endforeach
            </div>
        </div> --}}
    </section>
    <div class="row py-2">
        <!--Breaking box-->
        <div class="col-1 col-md-3 col-lg-2 py-1 pr-md-0 mb-md-1">
            <div class="d-inline-block d-md-block bg-primary text-white text-center breaking-caret py-1 px-2">
                <span class="d-none d-md-inline-block">Informasi</span>
            </div>
        </div>
        <!--Breaking content-->
        <div class="col-11 col-md-9 col-lg-10 pl-1 pl-md-2">
            <div class="breaking-box pt-2 pb-1">
                <!--marque-->
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseleave="this.start();">
                    @foreach ($slidesInformasi as $info)
                        <a class="h6 font-weight-light" href="{{ $info->url }}"><span
                                class="position-relative mx-2 badge badge-primary rounded-0">{{ $info->title }}</span>
                            {{ $info->keterangan }}
                        </a>
                    @endforeach
                </marquee>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="news" class="news">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3>Berita <span>Terkini</span></h3>
                <hr />
            </div>


            <div class="row">
                <div class="col-12 pb-5">
                    <!--SECTION START-->
                    <section class="row">
                        <!--Start slider news-->
                        <div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
                            <div id="featured" class="carousel slide carousel" data-ride="carousel">
                                <!--dots navigate-->
                                <ol class="carousel-indicators top-indicator">
                                    <li data-target="#featured" data-slide-to="0" class="active"></li>
                                    <li data-target="#featured" data-slide-to="1"></li>
                                    <li data-target="#featured" data-slide-to="2"></li>
                                    <li data-target="#featured" data-slide-to="3"></li>
                                </ol>

                                <!--carousel inner-->
                                <div class="carousel-inner">
                                    <!--Item slider-->
                                    <div class="carousel-item active">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[0]->id . '/' . Helpers::randomString(100)) }}">
                                                        <img height="437" src="{{ asset($carousel[0]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="#">{{ Helpers::PostCategory($carousel[0]->posts_category_id) }}</a>
                                                    <!--title-->
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[0]->id . '/' . Helpers::randomString(100)) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[0]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="#">{{ $carousel[0]->users->nama }}</a></span>
                                                        <span
                                                            class="news-date">{{ Helpers::GetDate($carousel[0]->created_at) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[1]->id . '/' . Helpers::randomString(100)) }}">
                                                        <img height="437" src="{{ asset($carousel[1]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="#">{{ Helpers::PostCategory($carousel[1]->posts_category_id) }}</a>
                                                    <!--title-->
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[1]->id . '/' . Helpers::randomString(100)) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[1]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="#">{{ $carousel[1]->users->nama }}</a></span>
                                                        <span
                                                            class="news-date">{{ Helpers::GetDate($carousel[1]->created_at) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[2]->id . '/' . Helpers::randomString(100)) }}">
                                                        <img height="437" src="{{ asset($carousel[2]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="#">{{ Helpers::PostCategory($carousel[2]->posts_category_id) }}</a>
                                                    <!--title-->
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[2]->id . '/' . Helpers::randomString(100)) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[2]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="#">{{ $carousel[2]->users->nama }}</a></span>
                                                        <span
                                                            class="news-date">{{ Helpers::GetDate($carousel[2]->created_at) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="card border-0 rounded-0 text-light overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_left-cover-1 image-wrapper">
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[3]->id . '/' . Helpers::randomString(100)) }}">
                                                        <img height="437" src="{{ asset($carousel[3]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="#">{{ Helpers::PostCategory($carousel[3]->posts_category_id) }}</a>
                                                    <!--title-->
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(100) . '/' . $carousel[3]->id . '/' . Helpers::randomString(100)) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[3]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="#">{{ $carousel[3]->users->nama }}</a></span>
                                                        <span
                                                            class="news-date">{{ Helpers::GetDate($carousel[3]->created_at) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--end carousel inner-->
                            </div>

                            <!--navigation-->
                            <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End slider news-->

                        <!--Start box news-->
                        <div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
                            <div class="row">
                                <!--news box-->
                                @foreach ($new_posts as $post)
                                    <div class="col-6 pb-1 pt-0 pr-1">
                                        <div class="card border-0 rounded-0 text-white overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_right-cover-2 image-wrapper">
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(120) . '/' . $post->id . '/' . Helpers::randomString(100)) }}">
                                                        <img height="200" src="{{ asset($post->foto_berita) }}"
                                                            alt="simple blog template bootstrap">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a class="p-1 badge badge-primary rounded-0"
                                                        href="#">{{ Helpers::PostCategory($post->posts_category_id) }}</a>

                                                    <!--title-->
                                                    <a
                                                        href="{{ route('client.show', Helpers::randomString(120) . '/' . $post->id . '/' . Helpers::randomString(100)) }}">
                                                        <h4 class="h5 text-white my-1">
                                                            {{ substr($post->title, 0, 50) }}...
                                                            <span style="font-size: 16px;">Selengkapnyaaa</span>
                                                        </h4>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--End box news-->
                        <a class="btn btn-primary btn-block" href="{{ route('post.index') }}">Selengkapnya</a>
                    </section>
                    <!--END SECTION-->
                </div>
            </div>

        </div>
    </section>

    <section class="section-bg" style="padding-left: 3%; padding-right: 3%;">
        {{-- <div class="container"> --}}
        <div class="section-title">
            <h3>Agenda & Informasi <span>Terbaru</span></h3>
            <hr />
        </div>
        <div class="row">
            <div class="col-8">
                <div class="col-12">
                    <div class="row">
                        @foreach ($agenda as $item)
                            <div class="col-3 pb-1 pt-0 pr-1">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset($item->foto_berita) }}" class="card-img-top"
                                        alt="{{ $item->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ Helpers::getDate($item->created_at) . ' - ' . Helpers::getTime($item->created_at) }}
                                        </h5>
                                        <p class="card-text">{{ $item->title }}</p>
                                        <a href="{{ route('client.show', Helpers::randomString(100) . '/' . $item->id . '/' . Helpers::randomString(100)) }}"
                                            class="btn btn-primary">
                                            <i class="bx bx-link-external"></i> Lihat Agenda
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                        <i class="bx bx-news"></i> Informasi Terbuka
                    </button>
                    @foreach ($informasi as $berkala)
                        <a href="{{ $berkala->files }}" type="button" data-bs-tooltip="tooltip" target="_blank"
                            data-bs-placement="top" title="{{ $berkala->jenis_file == 'link' ? 'Download' : 'Lihat File' }}" class="list-group-item list-group-item-action"><span
                                style="color: #0844c5;">#</span>
                            {{ $berkala->nama_informasi }}</a>
                    @endforeach
                </div>
                @foreach ($informasi as $berkala)
                @endforeach
            </div>
        </div>
        {{-- </div> --}}
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <h3>Art<span>ikel</span></h3>
                <hr />
            </div>
            <div class="col-12">
                <div class="row">
                    <!--news box-->
                    @foreach ($artikels as $artikel)
                        <div class="col-4 pb-1 pt-0 pr-1">
                            <div class="card border-0 rounded-0 text-white overflow zoom">
                                <div class="position-relative">
                                    <!--thumbnail img-->
                                    <div class="ratio_right-cover-2 image-wrapper">
                                        <a
                                            href="{{ route('artikel.show', Helpers::randomString(120) . '/' . $artikel->id . '/' . Helpers::randomString(100)) }}">
                                            <img height="200" src="{{ asset($artikel->foto_berita) }}"
                                                alt="simple blog template bootstrap">
                                        </a>
                                    </div>
                                    <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                        <!-- category -->
                                        <a class="p-1 badge badge-primary rounded-0"
                                            href="#">{{ Helpers::PostCategory($artikel->posts_category_id) }}</a>

                                        <!--title-->
                                        <a
                                            href="{{ route('artikel.show', Helpers::randomString(120) . '/' . $artikel->id . '/' . Helpers::randomString(100)) }}">
                                            <h4 class="h5 text-white my-1">
                                                {{ substr($artikel->title, 0, 50) }}...
                                                <span style="font-size: 16px;">Selengkapnyaaa</span>
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="btn btn-primary btn-block" href="{{ route('artikel.index') }}">Selengkapnya</a>
        </div>
    </section>

    <section id="about" class="about section-bg">
        <div class="container">
            <div class="section-title">
                <h3>Video <span>BPKAD</span></h3>
                <hr />
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    @foreach ($videos as $video)
                        <center>
                            <iframe width="350" height="250" src="https://www.youtube.com/embed/0k99VGaKa9c">
                            </iframe>
                        </center>
                    @endforeach
                </div>
            </div> --}}
            <div class="owl-carousel owl-theme" id="owl-video">
                @foreach ($banners as $banner)
                    <iframe width="350" height="250" src="{{ $banner->path }}"></iframe>
                @endforeach
            </div>
        </div>
    </section>
    {{-- <section id="team" class="team">
        <div class="container">
            <div class="section-title">
                <h3>Layanan <span>BPKAD</span></h3>
                <hr />
            </div>
            <div class="row">
                @foreach ($apps as $app)
                    <a href="{{ $app->url }}" class="box-apps col-lg-3 col-md-6 d-flex align-item-stretch"
                        data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}">
                    </a>
                    {{-- <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset($app->icon) }}" class="img-fluid" alt="{{ $app->name }}}">
                                <div class="social">
                                    <a href="{{ $app->url }}" target="_blank"><i class="icofont-web"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $app->name }}</h4>
                                <span>{{ $app->deskripsi }}</span>
                            </div>
                        </div>
                    </div> --}}
    {{-- @endforeach --}}
    </div>
    </div>
    </section>
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="zoom-in">
            <div class="owl-carousel testimonials-carousel">
                @foreach ($apps as $app)
                    <div class="testimonial-item">
                        <a href="{{ $app->url }}"><img src="{{ $app->icon }}" class="testimonial-img"
                                alt=""></a>
                        <h3>{{ $app->name }}</h3>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            {{ $app->deskripsi }}
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3>Kontak <span>BPKAD</span></h3>
                <hr />
            </div>

            @php $address = Helpers::__address() @endphp
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Alamat Kantor</h3>
                        <p>{{ $address->address }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <p>bpkad@ntbprov.go.id</p>
                        <p>{{ $address->email }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Telepon</h3>
                        <p>{{ Helpers::__phone($address->phone) }}</p>
                    </div>
                </div>

            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 ">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.135917515381!2d116.1083764142942!3d-8.58292808948207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdc09f19da683b%3A0x9f800d0a99b1a506!2sKantor%20BPKAD%20NTB!5e0!3m2!1sen!2sid!4v1659492989350!5m2!1sen!2sid"
                        width="550" height="370" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="form-row">
                            <div class="col form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Nama Lengkap" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Alamat Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Judul" data-rule="minlen:4"
                                data-msg="Please enter at least 8 chars of subject" />
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required"
                                data-msg="Please write something for us" placeholder="Pesan Anda"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-md">Kirim Pesan</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection
@section('additional-js')
    <script src="{{ asset('client/plugins/owl-carousel/owl.carousel.js') }}"></script>
    <script>
        //FEATURED HOVER
        $(document).ready(function() {
            $(".linkfeat").hover(
                function() {
                    $(".textfeat").show(500);
                },
                function() {
                    $(".textfeat").hide(500);
                }
            );

            $("#owl-video").owlCarousel({

                autoPlay: 3000, //Set AutoPlay to 3 seconds

                items: 3,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]

            });
        });
    </script>
@endsection
