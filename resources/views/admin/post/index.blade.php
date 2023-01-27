@extends('admin.index')
@section('title', 'Post')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Post</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Post</li>
                <li class="breadcrumb-item active">Data Post</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Post</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Tipe Postingan</th>
                                    <th scope="col">Dibuat Oleh</th>
                                    <th scope="col">Buat Pada</th>
                                    <th scope="col">Ubah Pada</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Helpers::GetTypeContent($post->content_type_id) }}</td>
                                    <td>{{ Helpers::GetUser($post->users_id) }}</td>
                                    <td>{{ Helpers::GetDate($post->created_at) }}</td>
                                    <td>{{ $post->updated_at == NULL ? "None" : Helpers::GetDate($post->updated_at) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-md">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-md">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
