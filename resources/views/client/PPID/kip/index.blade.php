@extends('client.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($kip_title as $title)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="{{ $title->jenis_informasi }}-tab" data-toggle="tab" data-target="#{{ $title->jenis_informasi }}"
                                type="button" role="tab" aria-controls="{{ $title->jenis_informasi }}"
                                aria-selected="true">{{ ucfirst($title->jenis_informasi) }}</button>
                        </li>
                    @endforeach
                </ul>
                <ol>
                    <li><a href="{{ '/' }}">Home</a></li>
                    <li><a href="PPID">PPID</a></li>
                    <li>Klasifikasi Informasi Publik</li>
                </ol>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="permohonan" role="tabpanel" aria-labelledby="permohonan-tab">

                    
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
