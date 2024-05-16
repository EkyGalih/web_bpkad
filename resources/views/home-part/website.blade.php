{{-- @if ($app->aplikasi == 'website' && $app->nama_rule == 'superadmin') --}}
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
            <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_ADMIN') }}">
            {{-- <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_ADMIN') }}"> --}}
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @elseif (Auth::user()->role == 'operator')
            <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_OPERATOR') }}">
                <i class="bx bx-log-in-circle"></i> Ke Aplikasi
            </a>
            @endif
        </div>
    </div>
</div>
{{-- @elseif($app->aplikasi == 'website' && $app->nama_rule == 'admin')
<div class="col-lg-3 col-sm-6">

    <div class="card hovercard">
        <div class="cardheader">
        </div>
        <div class="avatar">
            <img alt="" src="{{ asset('client/assets/img/website.png') }}">
        </div>
        <div class="info">
            <div class="title">
                <a target="_blank" href="https://scripteden.com/">Website</a>
            </div>
            <div class="desc"><small class="badge badge-success">OPERATOR</small></div>
        </div>
        <div class="bottom">
            <a class="btn btn-primary btn-block btn-sm" href="https://twitter.com/webmaniac">
                <i class="icofont-sign-in"></i> Ke Aplikasi
            </a>
        </div>
    </div>
</div>
@endif --}}
