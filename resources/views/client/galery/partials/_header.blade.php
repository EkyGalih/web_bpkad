<div class="mb-4 d-flex justify-content-center">
    <a href="{{ route('foto') }}" class="btn btn-outline-info me-2 {{ Route::is('foto*') ? 'active' : '' }}">
        Foto
    </a>
    <a href="{{ route('video') }}" class="btn btn-outline-info {{ Route::is('video*') ? 'active' : '' }}">
        Video
    </a>
</div>
