@extends('client.index')
@section('title', 'Semua Berita |')
@section('menu-berita', 'active')
@section('additional-css')
    <style>
        html,
        .tags {
            font-weight: bold;
            border-radius: 2px;
            color: #fff;
            font-size: 14px;
            padding: 4px;
            margin-right: 4px;
            background-color: #3f8bee;
        }
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">
        @desktop
            <!-- ======= Berita ======= -->
            <section class="portfolio-details" style="margin-top: 5%;">

                <div class="portfolio-details" style="margin: 2%;">
                    <div class="row">
                        <div class="col-2">
                            <ul class="list-group">
                                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                                    <i class="bx bx-border-all"></i> Kategori
                                </button>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('post.index') }}"> Berita
                                    </a>
                                    <span class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('1') }})</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('artikel.index') }}"> Artikel
                                    </a>
                                    <span class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('2') }})</span>
                                </li>
                            </ul>
                            <br /><br />
                            @php
                                $tags = array_unique(Helpers::countTag());
                            @endphp
                            <ul class="list-group">
                                <button type="button" class="list-group-item list-group-item-action active"
                                    aria-current="true">
                                    <i class="bx bx-purchase-tag-alt"></i> Tags
                                </button>
                                @foreach ($tags as $key => $tag)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('post.tags', $tags[$key]) }}">{{ $tag }}
                                        </a>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="#"><strong>Lihat Semua Tags</strong></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-10">
                            {{-- <div class="row">
                                <div class="col-6"> --}}
                                    <form action="{{ route('post.search') }}" method="POST">
                                        @csrf
                                        <div class="form-row align-items-center">
                                            <div class="col-6">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="bx bx-search"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="cari" class="form-control"
                                                        id="inlineFormInputGroup" placeholder="Cari Berita ...">
                                                </div>
                                            </div>
                                            <div class="col-auto" style="margin-bottom: 2%;">
                                                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                {{-- </div> --}}
                                {{-- <div class="col-6">
                                    <div class="row">
                                        <div class="col-2">
                                            <p style="margin-top: 5%;">short by :</p>
                                        </div>
                                        <div class="col-5">
                                            <select name="bulan" id="bulan" class="form-control">
                                                <option value="">Bulan</option>
                                                <option value="01">Jan</option>
                                                <option value="02">Feb</option>
                                                <option value="03">Mar</option>
                                                <option value="04">Apr</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Jun</option>
                                                <option value="07">Jul</option>
                                                <option value="08">Agu</option>
                                                <option value="09">Sep</option>
                                                <option value="10">Okt</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Des</option>
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            @php
                                                $years = [
                                                    date('Y'),
                                                    date('Y') - 1,
                                                    date('Y') - 2,
                                                    date('Y') - 3,
                                                    date('Y') - 4,
                                                ];
                                            @endphp
                                            <select name="tahun" id="tahun" class="form-control">
                                                <option value="">Tahun</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </div> --}}
                            @if ($cari != 'Seluruh Berita')
                                <p>Menampilkan hasil pencarian : <strong>{{ $cari }}</strong></p>
                                <a href="{{ route('post.index') }}">Lihat Seluruh Berita</a>
                                <hr />
                            @endif
                            <div class="row">
                                <!--news box-->
                                @foreach ($posts as $post)
                                    <div class="col-3 pb-1 pt-0 pr-1">
                                        <div class="card border-0 rounded-0 text-white overflow zoom">
                                            <div class="position-relative">
                                                <!--thumbnail img-->
                                                <div class="ratio_right-cover-2 image-wrapper">
                                                    <a
                                                        href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">
                                                        <img height="250" width="100%"
                                                            src="{{ asset($post->foto_berita) ?? asset('static/images/no-image-post.png') }}"
                                                            alt="{{ substr($post->title, 0, 50) }}">
                                                    </a>
                                                </div>
                                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                    <!-- category -->
                                                    <a class="p-1 badge badge-primary rounded-0"
                                                        href="">{{ Helpers::PostCategory($post->posts_category_id) }}</a>
                                                    {{ Helpers::getDate($post->created_at) }}
                                                    <!--title-->
                                                    <a
                                                        href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">
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
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </section><!-- End Portfolio Details Section -->
        @elsedesktop
            <section class="portfolio-details" style="margin-top: 5%;">

                <div class="portfolio-details" style="margin: 2%;">
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-border-all"></i> Kategori
                        </button>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('post.index') }}"> Berita
                            </a>
                            <span class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('1') }})</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('artikel.index') }}"> Artikel
                            </a>
                            <span class="badge badge-primary badge-pill">({{ Helpers::countCategoryPost('2') }})</span>
                        </li>
                    </ul> <br />
                    <form action="{{ route('post.search') }}" method="POST">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-10">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bx bx-search"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="cari" class="form-control" id="inlineFormInputGroup"
                                        placeholder="Cari Berita ...">
                                </div>
                            </div>
                            <div class="col-auto" style="margin-bottom: 1%;">
                                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="row">
                        <div class="col-2">
                            <p style="margin-top: 5%;">short by :</p>
                        </div>
                        <div class="col-5">
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">Bulan</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">Mei</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Agu</option>
                                <option value="09">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nov</option>
                                <option value="12">Des</option>
                            </select>
                        </div>
                        <div class="col-5">
                            @php
                                $years = [date('Y'), date('Y') - 1, date('Y') - 2, date('Y') - 3, date('Y') - 4];
                            @endphp
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    @if ($cari != 'Seluruh Berita')
                        <p>Menampilkan hasil pencarian : <strong>{{ $cari }}</strong></p>
                        <a href="{{ route('post.index') }}">Lihat Seluruh Berita</a>
                        <hr />
                    @endif
                    @foreach ($posts as $post)
                        <div class="card border-0 rounded-0 text-white overflow zoom">
                            <div class="position-relative">
                                <!--thumbnail img-->
                                <div class="ratio_right-cover-2 image-wrapper">
                                    <a
                                        href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">
                                        <img height="250" width="100%" src="{{ asset($post->foto_berita) ?? asset('static/images/no-image-post.png') }}"
                                            alt="{{ substr($post->title, 0, 50) }}">
                                    </a>
                                </div>
                                <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                    <!-- category -->
                                    <a class="p-1 badge badge-primary rounded-0"
                                        href="">{{ Helpers::PostCategory($post->posts_category_id) }}</a>
                                    {{ Helpers::getDate($post->created_at) }}
                                    <!--title-->
                                    <a
                                        href="{{ route('post.show', [Helpers::PostCategory($post->posts_category_id), $post->slug]) }}">
                                        <h4 class="h5 text-white my-1">
                                            {{ substr($post->title, 0, 50) }}...
                                            <span style="font-size: 16px;">Selengkapnya</span>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <p style="max-width: 50px">{{ $posts->links() }}</p>
                    <br />
                    @php
                        $tags = array_unique(Helpers::countTag());
                    @endphp
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            <i class="bx bx-purchase-tag-alt"></i> Tags
                        </button>
                        @foreach ($tags as $key => $tag)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('post.tags', $tags[$key]) }}">{{ $tag }}
                                </a>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="#"><strong>Lihat Semua Tags</strong></a>
                        </li>
                    </ul>
                </div>
            </section>
        @enddesktop
    </main><!-- End #main -->
    <footer id="footer">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
