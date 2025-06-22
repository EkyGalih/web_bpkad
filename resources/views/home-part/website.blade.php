@section('content_home')
    <div class="radial-menu">
        <button class="center-btn" id="menuToggle">
            <img src="{{ asset('server/assets/img/logo-bkn.png') }}" alt="BKN" width="50">
        </button>

        <!-- Menu Items -->
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item" title="BPKAD">
            <i class="ri-home-2-line"></i>
        </a>
        <a href="{{ env('SIMPEG_ADMIN') }}" class="item" title="SimPeg">
            <i class="ri-user-3-line"></i>
        </a>
        <a href="{{ env('APBD_ADMIN') }}" class="item" title="APBD">
            <i class="ri-folder-3-line"></i>
        </a>
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item" title="Aset TIK">
            <i class="ri-computer-line"></i>
        </a>
    </div>
@endsection
