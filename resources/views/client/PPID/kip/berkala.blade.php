@extends('client.index')
@section('title', 'PPID | Klasifikasi Informasi Publik')
@section('content_home')
<section class="section-frame overflow-hidden">
    <div class="wrapper bg-info">
        <div class="container py-12 py-md-16 text-center">
            <div class="row">
                <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                    <h1 class="display-1 mb-3 text-white">Informasi Publik</h1>
                    <p class="lead px-lg-5 px-xxl-8 mb-1 text-white">Daftar Informasi yang dapat di lihat dan unduh.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wrapper bg-active-primary">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-12 gx-xl-12">
            <div class="card" style="padding: 1%; margin: 1% 5%;">
                <h1 class="text-center mb-4">Daftar Informasi Publik</h1>
                @php
                $KipBerkala = Helpers::_KipPPID('berkala', $query);
                $KipSetiapSaat = Helpers::_KipPPID('setiap saat', $query);
                $KipDikecualikan = Helpers::_KipPPID('dikecualikan', $query);
                $KipSertaMerta = Helpers::_KipPPID('serta merta', $query);
                @endphp
                <div class="d-flex">
                    <ul class="nav nav-tabs" id="kipTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="berkala-tab" data-bs-toggle="tab"
                                data-bs-target="#berkala" type="button" role="tab">Berkala</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="serta-tab" data-bs-toggle="tab" data-bs-target="#serta"
                                type="button" role="tab">Serta Merta</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="setiap-tab" data-bs-toggle="tab" data-bs-target="#setiap"
                                type="button" role="tab">Setiap Saat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dikecualikan-tab" data-bs-toggle="tab"
                                data-bs-target="#dikecualikan" type="button" role="tab">Dikecualikan</button>
                        </li>
                    </ul>
                    <form action="{{ route('ppid-kip.search_berkala') }}">
                        <div class="form-row align-items-center">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bx bx-search"></i></div>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="Cari Data .."
                                    value="{{ old('search') ?? $query }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('additional-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    // var route = "{{ route('ppid-kip.search_berkala') }}";
        // http://web_bpkad.suru.test/PPID/Klasifikasi-Informasi-Publik/info-berkala?search=tes
        // pencarian dengan tekan enter untuk jquery
        // $('#search_berkala').on('keyup', function(e) {
        //     if (e.keyCode === 13) {
        //         var query = $('#search_berkala').val();
        //         console.log(route);
        //     }
        // });

        $('#search_berkala').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
</script>
@endsection