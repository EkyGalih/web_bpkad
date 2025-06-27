<footer class="bg-dark text-inverse">
    <div class="container py-13 pb-md-15">
        {{-- <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-300 mb-14"
            data-image-src="./assets/img/photos/bg16.png">
            <div class="card-body p-10 p-xl-12">
                <div class="row text-center">
                    <div class="col-xl-11 col-xxl-9 mx-auto">
                        <h2 class="fs-16 text-uppercase text-white mb-3">Join Our Community</h2>
                        <h3 class="display-3 mb-8 px-lg-8 text-white">We are <span
                                class="underline-3 style-2 yellow">trusted</span> by over 5000+ clients. Join them now
                            and grow your business.</h3>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-center">
                    <span><a class="btn btn-white rounded">Get Started</a></span>
                </div>
            </div>
            <!--/.card-body -->
        </div> --}}
        <!--/.card -->
        <div class="row gy-6 gy-lg-0">
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <div class="d-flex align-items-center mb-4">
                        <img style="height: 50px" class="logo-dark me-2" src="{{ asset('static/images/ntb.png') }}"
                            srcset="{{ asset('static/images/ntb.png') }}" alt="{{ $settings->title }}" />
                        <img src="{{ $settings->logo_image }}" srcset="{{ $settings->logo_image }}"
                            style="max-width: 150px; height: 50px;" alt="" />
                    </div>
                    <p class="mb-4">©
                        <script>
                            document.write(new Date().getUTCFullYear());
                        </script> {{ ENV('APP_NAME') }}. <br class="d-none d-lg-block" />
                    </p>
                    <nav class="nav social ">
                        @if (isset($settings->sosmed) && is_array($settings->sosmed))
                            @foreach ($settings->sosmed as $sosmed)
                                <a href="{{ $sosmed['url'] ?? '#' }}" target="_blank">
                                    <i class="{{ $sosmed['icon'] ?? 'uil uil-link' }}"></i>
                                </a>
                            @endforeach
                        @else
                            <a href="https://twitter.com/BpkadNtb" target="_blank"><i class="uil uil-twitter"></i></a>
                            <a href="https://www.facebook.com/bpkadntbprov" target="_blank"><i
                                    class="uil uil-facebook-f"></i></a>
                            <a href="https://wa.me/message/47I56AXXZMGWB1" target="_blank"><i
                                    class="uil uil-whatsapp"></i></a>
                            <a href="https://www.instagram.com/ntbbpkad/" target="_blank"><i
                                    class="uil uil-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCZ-UDCXEyRvOJfdWtD2jv5g" target="_blank"><i
                                    class="uil uil-youtube"></i></a>
                        @endif
                    </nav>
                    <!-- /.social -->
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Kontak & Alamat</h4>
                    <address class="pe-xl-15 pe-xxl-17">{{ __address()->address }}</address>
                    <a href="mailto:#" class="link-body">{{ $settings->email }}</a><br />
                    {{ __phone($settings->contact_number) }}
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Layanan Lainnya</h4>
                    <ul class="list-unstyled text-reset mb-0">
                        <li><a href="https://lapakaset.ntbprov.go.id" target="_blank">Lapak Aset</a></li>
                        <li><a href="https://arsip.bpkad.ntbprov.go.id" target="_blank">Arsip</a></li>
                        <li><a href="https://silamo.ntbprov.go.id" target="_blank">Silamo</a></li>
                        <li><a href="https://buka-aset.ntbprov.go.id" target="_blank">Buka Aset</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-12 col-lg-3">
                <div class="widget">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4854.364344670461!2d116.1078112758967!3d-8.58309358711536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdc09f19da683b%3A0x9f800d0a99b1a506!2sKantor%20BPKAD%20NTB!5e1!3m2!1sen!2sid!4v1747878316576!5m2!1sen!2sid"
                        width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</footer>
