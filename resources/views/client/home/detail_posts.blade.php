@extends('client.index')
@section('title', 'Detail Berita')
@section('content_home')
    <main id="main" data-aos="fade-up">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Detail Berita</h2>
                </div>

            </div>
        </section><!-- Breadcrumbs Section -->

        <!-- ======= Berita ======= -->
        <section class="portfolio-details">
            <div class="container">

                <div class="portfolio-details-container">

                    <div class="owl-carousel portfolio-details-carousel">
                        <img src="{{ asset($posts->foto_berita) }}" class="img-fluid" alt="{{ $posts->title }}">
                    </div>
                    <div class="portfolio-info">
                        <h3>Informasi berita </h3>
                        <ul>
                            <li><strong>Kategori</strong>: Lifestyle</li>
                            <li><strong>Uploaded</strong>: {{ $posts->users->nama }}</li>
                            <li><strong>Waktu Post</strong>: {{ $posts->created_at }}</li>
                        </ul>
                    </div>
                    <div class="btn-group btn-group-lg" role="group" aria-label="Basic outlined example">
                        <a href="{{ route('post.like', $posts->id) }}" type="button" class="btn btn-outline-primary"><i class="bx bx-like"></i>
                            <sup>{{ Helpers::CountLike($posts->id) ?? '0' }}</sup></a>
                        <button type="button" class="btn btn-outline-primary"><i class="bx bx-chat"></i>
                            <sup>{{ Helpers::CountComment($posts->id) ?? '0' }}</sup></button>
                        <button type="button" class="btn btn-outline-primary"><i class="bx bx-share-alt"></i></button>
                    </div>
                </div>

                <div class="portfolio-description">
                    <h2>Berita Acara</h2>
                    <p>
                        {!! $posts->content !!}
                    </p>
                </div>
                <hr />
                <div class="well">
                    <h4><i class="fa fa-paper-plane-o"></i> Tinggalkan Komentar:</h4>
                    <form role="form" method="POST" onsubmit="return validateForm()" action="{{ route('post.comment', $posts->id) }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <input type="hidden" name="ip_addr" value=" {{ Helpers::getUserIP() }}">
                                <div class="col-lg-6">
                                    <input type="text" name="nama" placeholder="Nama Anda" class="form-control"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email Anda" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="komentar" rows="3" placeholder="Tulis komentar anda ..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-send"></i> Send</button>
                    </form>
                </div>
                <hr>

                <!-- the comments -->
                @php $comments = Helpers::GetComment($posts->id) @endphp

                @foreach ($comments as $comment)
                <h5>
                    <i class="bx bx-message-square-dots"></i> {{ $comment->nama }}:
                    <small> {{ Helpers::GetTime($comment->created_at) }} on {{ Helpers::GetDate($comment->created_at) }}</small>
                </h5>
                <p>{{ $comment->komentar }}</p>
                @endforeach

            </div>
        </section><!-- End Portfolio Details Section -->

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
