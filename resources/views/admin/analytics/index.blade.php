@extends('admin.index')
@section('title', 'Statistik Pengunjung')

@section('content')
<div id="main" class="main">
    <div class="pagetitle">
        <h1>Berita/Artikel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('post-admin.index') }}">Berita/Artikel</a></li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @livewire('admin.analytycs-livewire')
            </div>
        </div>
    </section>
</div>
@endsection
