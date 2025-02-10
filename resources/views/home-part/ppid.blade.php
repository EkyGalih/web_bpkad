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
                <a target="_blank" href="https://scripteden.com/">Website</a>
            </div>
            <div class="desc"><small class="badge badge-danger">ADMIN</small></div>
        </div>
        <div class="bottom">
            <a class="btn btn-primary btn-block btn-sm" href="https://twitter.com/webmaniac">
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
            <div class="desc"><small class="badge badge-secondary">OPERATOR</small></div>
        </div>
        <div class="bottom">
            <a class="btn btn-primary btn-block btn-sm" href="https://twitter.com/webmaniac">
                <i class="icofont-sign-in"></i> Ke Aplikasi
            </a>
        </div>
    </div>
</div>
@endif