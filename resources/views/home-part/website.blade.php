@if ($app->aplikasi == 'website' && $app->nama_rule == 'superadmin')
<div class="col-lg-3 col-sm-6">
    <div class="card hovercard">
        <div class="cardheader">
        </div>
        <div class="avatar">
            <img alt="" src="{{ asset('client/assets/img/website.png') }}">
        </div>
        <div class="info">
            <div class="title">
                <h4>{{ App\Helpers\Converter::appConverter($app->aplikasi) }}</h4>
            </div>
            <div class="desc"><small class="badge badge-primary">ADMIN</small></div>
        </div>
        <div class="bottom">
            <a class="btn btn-primary btn-block btn-sm" href="{{ env('WEB_BPKAD_ADMIN') }}">
                <i class="icofont-sign-in"></i> Ke Aplikasi
            </a>
        </div>
    </div>
</div>
@elseif($app->aplikasi == 'website' && $app->nama_rule == 'admin')
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
@endif