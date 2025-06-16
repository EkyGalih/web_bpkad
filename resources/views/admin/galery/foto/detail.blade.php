@extends('admin.index')
@section('title', 'Galery Foto')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h4 class="mb-0">Galery Foto</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('galery-foto.index') }}" class="btn btn-outline-secondary">
                    <i class="icon-base ri ri-arrow-left-box-fill me-2"></i> Kembali
                </a>
                <a href="{{ route('galery-foto.create', $foto->id) }}" class="btn btn-outline-success">
                    <i class="icon-base ri ri-upload-2-fill me-2"></i> Upload
                </a>
            </div>
        </div>
        <p class="mb-6">
            {{ $foto->name }}
        </p>
        <!-- Role cards -->
        <div class="row g-6">
            @foreach ($fotos as $item)
                <div class="col-md-6 col-xl-4">
                    <div class="card text-bg-dark border-0">
                        <img class="card-img" src="{{ asset($item->path) }}" alt="{{ $foto->name }}" />
                        <div class="card-img-overlay">
                            <p class="card-text">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $fotos->links() }}
        </div>
    </div>
@endsection
