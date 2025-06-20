@extends('client.index')
@section('title', $subPages->title . ' |')
@section('content_home')
    @include('layouts.client._header', [
        'title' => 'HALAMAN',
        'keterangan' => $subPages->title,
    ])
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="col-lg-12">
                    <div class="blog single">
                        <div class="card">
                            <div class="card-body">
                                <div class="classic-view">
                                    <article class="post">
                                        <div class="post-content mb-5">
                                            {!! $subPages->content !!}
                                        </div>
                                        @if ($subPages->pdf_file != null)
                                            <img src="{{ asset($subPages->pdf_file) }}" alt="" width="600"
                                                height="500">
                                        @endif
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
