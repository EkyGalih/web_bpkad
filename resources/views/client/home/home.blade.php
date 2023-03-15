@extends('client.index')
@section('title', 'Home')
@section('content_home')
    <section id="hero" class="d-flex align-items-center">
        <div class="portfolio-details-container">
            <div class="owl-carousel portfolio-details-carousel">
                @foreach ($slides as $slide)
                    <img src="{{ asset($slide->foto) }}" alt="{{ $slide->title }}" style="margin-top: 40%">
                @endforeach
            </div>
        </div>
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
    {{-- <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3>Informasi <span>COVID19 NTB</span></h3>
                <hr />
                Update Terakhir : {{ Helpers::GetDate($data_covid['update_terakhir']) }}
            </div>
            <div class="row">
                @php
                    $isolasi = $data_covid['total']['konfirmasi']['masih_isolasi'];
                    $sembuh = $data_covid['total']['konfirmasi']['sembuh'];
                    $meninggal = $data_covid['total']['konfirmasi']['meninggal'];
                    $total = $isolasi + $sembuh + $meninggal;
                @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-bed"></i>
                        <span data-toggle="counter-up">{{ number_format($isolasi) }}</span>
                        <p>Pasien Rawat</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-simple-smile"></i>
                        <span data-toggle="counter-up">{{ number_format($sembuh) }}</span>
                        <p>Pasien Sembuh</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-sad"></i>
                        <span data-toggle="counter-up">{{ number_format($meninggal) }}</span>
                        <p>Pasien Meninggal</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="icofont-address-book"></i>
                        <span data-toggle="counter-up">{{ number_format($total) }}</span>
                        <p>Total Kasus</p>
                    </div>
                </div>
            </div>
            <br />
            <center>
                <a href="https://corona.ntbprov.go.id/" target="_blank" class="btn-facebook">Selengkapnya</a>
            </center>
        </div>
    </section> --}}
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
                                                    <a href="{{ route('client.show', $carousel[0]->id) }}">
                                                        <img height="437" src="{{ asset($carousel[0]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Terbaru</a>
                                                    <!--title-->
                                                    <a href="{{ route('client.show', $carousel[0]->id) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[0]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="../category/author.html">{{ $carousel[0]->users->nama }}</a></span>
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
                                                    <a href="{{ route('client.show', $carousel[1]->id) }}">
                                                        <img height="437" src="{{ asset($carousel[1]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Terbaru</a>
                                                    <!--title-->
                                                    <a href="{{ route('client.show', $carousel[1]->id) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[1]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="../category/author.html">{{ $carousel[1]->users->nama }}</a></span>
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
                                                    <a href="{{ route('client.show', $carousel[2]->id) }}">
                                                        <img height="437" src="{{ asset($carousel[2]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Terbaru</a>
                                                    <!--title-->
                                                    <a href="{{ route('client.show', $carousel[2]->id) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[2]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="../category/author.html">{{ $carousel[2]->users->nama }}</a></span>
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
                                                    <a href="{{ route('client.show', $carousel[3]->id) }}">
                                                        <img height="437" src="{{ asset($carousel[3]->foto_berita) }}"
                                                            alt="Bootstrap news template">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <a class="p-1 badge badge-info rounded-0"
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Terbaru</a>
                                                    <!--title-->
                                                    <a href="{{ route('client.show', $carousel[3]->id) }}">
                                                        <h2 class="h3 post-title text-white my-1">
                                                            {{ substr($carousel[3]->title, 0, 50) }}... <span
                                                                style="font-size: 20px;">Selengkapnya</span></h2>
                                                    </a>
                                                    <!-- meta title -->
                                                    <div class="news-meta">by
                                                        <span class="news-author badge badge-success"><a
                                                                class="text-white font-weight-bold"
                                                                href="../category/author.html">{{ $carousel[3]->users->nama }}</a></span>
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
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
                                                        <img height="200" src="{{ asset($post->foto_berita) }}"
                                                            alt="simple blog template bootstrap">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a class="p-1 badge badge-primary rounded-0"
                                                        href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">Lifestyle</a>

                                                    <!--title-->
                                                    <a href="{{ route('client.show', $post->id) }}">
                                                        <h4 class="h5 text-white my-1">
                                                            {{ substr($post->title, 0, 50) }}...
                                                            <span style="font-size: 16px;">Selengkapnya</span>
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
                    </section>
                    <!--END SECTION-->
                </div>
            </div>

        </div>
    </section>

    <section id="about" class="about section-bg">
        <div class="container">
            <div class="section-title">
                <h3>Video <span>Terbaru</span></h3>
                <hr />
            </div>
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-out" data-aos-delay="100">
                    @foreach ($videos as $video)
                        <center>
                            <object width="1000" height="500" data="{{ $video->path }}">
                            </object>
                        </center>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="team" class="team">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h3>Aplikasi <span>Pelayanan Lainnya</span></h3>
            </div>
            <div class="row">
                @foreach ($apps as $app)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
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
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="faq" class="faq section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h3>Informasi <span>APBD</span> Kabupaten/Kota Se-<span>NTB</span></h3>
                <hr />
            </div>
            <center>
                <iframe
                    src="https://docs.google.com/presentation/d/1-kognj_-f8-UxEvn0J38e5bADXpbIyE9Bfv7RfmbFTQ/embed?start=true&loop=true&delayms=3000"
                    frameborder="0" width="1000" height="450" allowfullscreen="true" mozallowfullscreen="true"
                    webkitallowfullscreen="true"></iframe>
            </center>
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
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
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
                            <button type="submit">Kirim Pesan</button>
                        </div>
                    </form>
                </div>

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
@endsection
@section('js-additional')
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
        });
    </script>
@endsection
