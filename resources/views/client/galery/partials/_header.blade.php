<div class="mb-4 d-flex justify-content-center">
    <a href="{{ route('foto') }}" class="btn btn-outline-info me-2 {{ Route::is('foto*') ? 'active' : '' }}">
        <img src="{{ asset('client/assets/img/icons/solid/images.svg') }}"
            class="me-1 svg-inject icon-svg icon-svg-sm solid-mono text-info" style="height: 35px; width: 35px;"
            alt="Foto">
        Foto
    </a>
    <a href="{{ route('video') }}" class="btn btn-outline-info {{ Route::is('video*') ? 'active' : '' }}">
        <img src="{{ asset('client/assets/img/icons/lineal/video-camera.svg') }}"
            class="me-1 svg-inject icon-svg icon-svg-sm solid-mono text-info" style="height: 35px; width: 35px;"
            alt="Video"> Video
    </a>
</div>
