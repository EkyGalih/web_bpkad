<footer id="footer">

    {{--    <div class="footer-newsletter"> --}}
    {{--        <div class="container"> --}}
    {{--            <div class="row justify-content-center"> --}}
    {{--                <div class="col-lg-6"> --}}
    {{--                    <h4>Join Our Newsletter</h4> --}}
    {{--                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p> --}}
    {{--                    <form action="" method="post"> --}}
    {{--                        <input type="email" name="email"><input type="submit" value="Subscribe"> --}}
    {{--                    </form> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>KONTAK<span> & ALAMAT</span></h3>
                    <p>
                        @php $address = Helpers::__address() @endphp
                        <i class="icofont-map-pins"></i> {{ $address->address }}<br/>
                        <strong><i class="icofont-smart-phone"></i></strong> {{ Helpers::__phone($address->phone) }}<br>
                        <strong><i class="icofont-email"></i></strong> {{ $address->email }}<br>
                        <strong><i class="icofont-email"></i></strong> bpkad@ntbprov.go.id<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Halaman Populer</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('dashboard') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('dashboard') }}/#contact">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Laporan Masyarakat</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('faq.index') }}">Permohonan & Pengaduan</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('ppid-kip') }}">Klasifiksi Informasi Publik</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Pelayanan Kami</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://lapakaset.ntbprov.go.id" target="_blank">Lapak Aset</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://arsip.bpkad.ntbprov.go.id" target="_blank">Arsip</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="https://silamo.ntbprov.go.id" target="_blank">Silamo</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links mt-3">
                        <a href="https://twitter.com/BpkadNtb" target="_blank" class="twitter"><i
                                class="bx bxl-twitter"></i></a>
                        <a href="https://www.facebook.com/bpkadntbprov" target="_blank" class="facebook"><i
                                class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/ntbbpkad/" target="_blank" class="instagram"><i
                                class="bx bxl-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCZ-UDCXEyRvOJfdWtD2jv5g" target="_blank"
                            class="youtube"><i class="bx bxl-youtube"></i></a>
                        <a href="https://wa.me/message/47I56AXXZMGWB1" target="_blank" class="whatsapp"><i
                                class="bx bxl-whatsapp"></i></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="copyright">
            &copy; 2017-{{ date('Y') }} <strong><span>BPKAD</span></strong>. All Rights Reserved
        </div>
    </div>
    </div>
</footer>
