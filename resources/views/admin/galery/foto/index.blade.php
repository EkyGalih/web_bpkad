@extends('admin.index')
@section('title', 'Galery Foto')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h4 class="mb-0">Galery Foto</h4>
            <a href="{{ route('galery.create') }}" class="btn btn-outline-primary">
                <i class="icon-base ri ri-add-fill me-2"></i> Tambah
            </a>
        </div>
        <p class="mb-6">
            Daftar Galery Foto
        </p>
        <!-- Role cards -->
        <div class="row g-6">
            @foreach ($gallery as $galery)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="mb-0">Total {{ $galery->GaleryFoto->count() }} Foto</p>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($galery->GaleryFoto->take(3) as $item)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="Vinnie Mostowy" class="avatar pull-up">
                                            <img class="rounded-circle" src="{{ asset($item->path) }}" alt="Avatar" />
                                        </li>
                                    @endforeach
                                    @if ($galery->GaleryFoto->skip(3)->count() != 0)
                                    <li class="avatar">
                                        <span class="avatar-initial rounded-circle pull-up bg-lightest text-body"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ $galery->GaleryFoto->skip(3)->count() }} more">{{ $galery->GaleryFoto->skip(3)->count() }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="role-heading">
                                    <h5 class="mb-1">{{ $galery->name }}</h5>
                                    <a href="{{ route('galery-foto.show', $galery->id) }}" data-bs-tooltip="tooltip"
                                        data-bs-placement="right" title="Lihat Foto" class="role-edit-modal">
                                        <p class="mb-0">Lihat Galery</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
