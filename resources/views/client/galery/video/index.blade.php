@extends('client.index')

@section('title', 'Galeri Video - ')

@section('content_home')
    @include('layouts.client._header', [
        'title' => 'Daftar Galery',
        'keterangan' => 'Video',
    ])

    <!-- Galeri Video -->
    <section class="wrapper bg-light">
        <div class="container py-10">
            @include('client.galery.partials._header')

            <div class="row g-6">
                @forelse($gallery as $galery)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="mb-0 small text-muted">Total {{ $galery->galeryVideo->count() }} Video</p>
                                    <ul class="avatar-group mb-0 list-unstyled d-flex align-items-center">
                                        @foreach ($galery->galeryVideo->take(3) as $item)
                                            <li class="me-1" data-bs-toggle="tooltip" title="{{ $item->galery->name }}">
                                                <video class="rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover;" muted loop>
                                                    <source src="{{ asset($item->path) }}" type="video/mp4">
                                                </video>
                                            </li>
                                        @endforeach
                                        @if ($galery->galeryVideo->count() > 3)
                                            <li>
                                                <span
                                                    class="avatar-initial rounded-circle bg-light text-dark d-inline-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;" data-bs-toggle="tooltip"
                                                    title="{{ $galery->galeryVideo->skip(3)->count() }} lainnya">
                                                    +{{ $galery->galeryVideo->skip(3)->count() }}
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div>
                                    <h5 class="mb-1">{{ $galery->name }}</h5>
                                    <a href="{{ route('video.show', $galery->id) }}"
                                        class="text-info small">Lihat Galeri</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <h4 class="text-muted">Tidak ada video tersedia.</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
