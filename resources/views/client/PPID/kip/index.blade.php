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
                            <button class="nav-link active" id="{{ $title->jenis_informasi }}-tab" data-toggle="tab"
                                data-target="#{{ $title->jenis_informasi }}" type="button" role="tab"
                                aria-controls="{{ $title->jenis_informasi }}"
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
                @php
                    $berkala = Helpers::_KipPPID('berkala');
                @endphp
                <div class="tab-pane fade show active" id="berkala" role="tabpanel" aria-labelledby="berkala-tab">
                    <h2 class="title" style="margin: 20px;">Informasi Berkala</h2>
                   <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th colspan="4">Informasi Berkala</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berkala as $item1)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item1->nama_informasi }}</td>
                                <td>{{ Helpers::GetDate($item1->created_at).' '. Helpers::GetTime($item1->created_at) }}</td>
                                <td>Link</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio">
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>
    </section>
@endsection
