@extends('client.index')
@section('menu-berita', 'active')
@section('additional-css')
    <style>
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
    @include('layouts.client._header', [
        'title' => 'Agenda',
        'keterangan' => 'Pimpinan',
    ])
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-12 gx-xl-12">
                <div class="col-lg-12">
                    <div class="blog single">
                        <div class="card">
                            <div class="card-header">
                                @php
                                    $years = [date('Y'), date('Y') - 1, date('Y') - 2, date('Y') - 3, date('Y') - 4];
                                @endphp
                                <div style="text-align: center; margin-bottom: 5%;">
                                    <h1 style="display: inline-block; margin: 0;">
                                        AGENDA PIMPINAN TAHUN
                                    </h1>
                                    <select name="tahun" id="filter_tahun"
                                        style="padding: 5px 10px; margin-left: 10px; font-size: 18px; border-radius: 6px; border: 1px solid #ccc;">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row grid-view" data-margin="30" data-dots="true" data-items-xl="3"
                                    data-items-md="2" data-items-xs="1">
                                    <!--news box-->
                                    @foreach ($agenda as $item)
                                        <div class="col-4 pb-1 pt-0 pr-1">
                                            <figure class="rounded mb-6">
                                                <a class="item-link" href="{{ $item->foto_berita }}" data-glightbox
                                                    data-gallery="projects-group">
                                                    <img src="{{ $item->foto_berita }}"
                                                        onerror="this.onerror=null;this.src='{{ asset('static/images/no-image-post.png') }}';"
                                                        srcset="{{ $item->foto_berita }}" alt="{{ $item->title }}"
                                                        style="max-width: 500px; max-height: 700px;" />
                                                    <i class="uil uil-focus-add"
                                                        style="position: absolute; top: 10px; right: 10px; color: white;"></i>
                                                </a>
                                            </figure>
                                            <div class="project-details d-flex justify-content-center flex-column">
                                                <div class="post-header">
                                                    <h2 class="post-title h3"><a
                                                            href="{{ route('post.show', [PostCategory($item->posts_category_id), $item->slug]) }}"
                                                            class="link-dark">{{ substr($item->title, 0, 50) }}</a></h2>
                                                    <div class="post-category text-ash">
                                                        {{ PostCategory($item->posts_category_id) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $agenda->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectTahun = document.getElementById("filter_tahun");

            if (selectTahun) {
                selectTahun.addEventListener("change", function() {
                    const tahun = selectTahun.value;
                    window.location.href = window.location.origin + '/PPID/agenda/' + tahun;
                });
            }
        });
    </script>
@endsection
