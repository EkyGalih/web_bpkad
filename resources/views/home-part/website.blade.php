<div class="col-lg-3 col-sm-6">
    <div class="card hovercard">
        <div class="cardheader">
        </div>
        <div class="avatar">
            <img alt="" src="{{ asset('client/assets/img/website.png') }}">
        </div>
        <div class="info">
            <div class="title">
                <h4>WEBSITE</h4>
            </div>
            <div class="desc">
                <h4 class="badge badge-primary">{{ Auth::user()->role }}</h4>
            </div>
        </div>
        <div class="bottom">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            <a class="btn btn-primary btn-block btn-sm" href="{{ ENV('WEB_BPKAD_ADMIN') }}">
            {{-- <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_ADMIN') }}"> --}}
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @elseif (Auth::user()->role == 'operator')
            <a class="btn btn-primary btn-block btn-sm" href="{{ ENV('WEB_BPKAD_OPERATOR') }}">
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6">
    <div class="card hovercard">
        <div class="cardheader-simpeg">
        </div>
        <div class="avatar">
            <img alt="" src="{{ asset('client/assets/img/pegawai.png') }}">
        </div>
        <div class="info">
            <div class="title">
                <h4>SimPeg</h4>
            </div>
            <div class="desc">
                <h4 class="badge badge-primary">{{ Auth::user()->role }}</h4>
            </div>
        </div>
        <div class="bottom">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            {{-- <a class="btn btn-secondary btn-block btn-sm" href="#"> --}}
            <a class="btn btn-primary btn-block btn-sm" href="{{ ENV('SIMPEG_ADMIN') }}">
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6">
    <div class="card hovercard">
        <div class="cardheader-lkpd">
        </div>
        <div class="avatar">
            <img alt="" src="{{ asset('client/assets/img/lkpd-logo.png') }}">
        </div>
        <div class="info">
            <div class="title">
                <h4>LKPD</h4>
            </div>
            <div class="desc">
                <h4 class="badge badge-primary">{{ Auth::user()->role }}</h4>
            </div>
        </div>
        <div class="bottom">
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            {{-- <a class="btn btn-secondary btn-block btn-sm" href="#"> --}}
            <a class="btn btn-primary btn-block btn-sm" href="{{ ENV('APBD_ADMIN') }}">
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @endif
        </div>
    </div>
</div>
{{-- <div class="col-lg-3 col-sm-6"> --}}
    {{-- <div class="card hovercard"> --}}
        {{-- <div class="cardheader-inv"> --}}
        {{-- </div> --}}
        {{-- <div class="avatar"> --}}
            {{-- <img alt="" src="{{ asset('client/assets/img/invent.png') }}"> --}}
        {{-- </div> --}}
        {{-- <div class="info"> --}}
            {{-- <div class="title"> --}}
                {{-- <h4>ASET TIK</h4> --}}
            {{-- </div> --}}
            {{-- <div class="desc"> --}}
                {{-- <h4 class="badge badge-primary">{{ Auth::user()->role }}</h4> --}}
            {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div class="bottom"> --}}
            {{-- @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') --}}
            {{-- <a class="btn btn-secondary btn-block btn-sm" href="#"> --}}
            {{-- <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_ADMIN') }}"> --}}
                {{-- <i class="bx bx-time"></i> Ongoing --}}
            {{-- </a> --}}
            {{-- @endif --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}
