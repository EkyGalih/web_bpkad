@extends('client.index')
@section('title', 'Halaman')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Permohonan & Pelayanan</h2>
                <ol>
                    <li><a href="{{'/'}}">Home</a></li>
                    <li><a href="{{route('faq.index')}}">F.A.Q</a></li>
                    <li>Permohonan dan Pengaduan</li>
                </ol>
            </div>

        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            
        </div>
    </section>
@endsection
