@extends('client.index')
@section('title', 'Galery - ')
@section('content_home')
    @include('layouts.client._header', [
        'title' => 'Daftar Galery',
        'keterangan' => 'Foto',
    ])
    <section class="container py-10">
        @include('client.galery.partials._header')
        <div>
            <div class="row g-4">
                @forelse($gallery as $galery)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="mb-0">Total {{ $galery->GaleryFoto->count() }} Foto</p>
                                    <ul class="avatar-group mb-0 list-unstyled d-flex align-items-center">
                                        @foreach ($galery->GaleryFoto->take(3) as $item)
                                            <li class="me-1" data-bs-toggle="tooltip" title="{{ $item->galery->name }}">
                                                <img class="rounded-circle" src="{{ asset($item->path) }}" width="40"
                                                    height="40" alt="Foto" />
                                            </li>
                                        @endforeach
                                        @if ($galery->GaleryFoto->count() > 3)
                                            <li>
                                                <span
                                                    class="avatar-initial rounded-circle bg-light text-dark d-inline-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;" data-bs-toggle="tooltip"
                                                    title="{{ $galery->GaleryFoto->skip(3)->count() }} lainnya">
                                                    +{{ $galery->GaleryFoto->skip(3)->count() }}
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $galery->name }}</h5>
                                        <a href="{{ route('foto.show', $galery->id) }}"
                                            class="text-info small">Lihat Galeri</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada foto tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
