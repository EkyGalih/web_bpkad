@extends('admin.index')
@section('title', 'Rincian Iku Realisasi')
@section('menu-iku-realisasi', 'active')
@section('rincian-iku', 'active')
@section('css-additional')
<link rel="stylesheet" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}">
@endsection
@section('content')
    <h3><a href="{{ route('rincian-iku-admin') }}"><i class="fas fa-info"></i> Rincian Iku Realisasi</a></h3>
    <hr />
    <div class="row mt">
        <div class="col-lg-11"></div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalImport">
                <i class="fas fa-upload"></i> Import
            </button>
            @include('admin.iku_realisasi.Addons.RincianIku.import')
        </div><br /><br />
        <div class="col-lg-12">
            <div class="content-panel">
                @foreach ($KegiatanIku as $kegiatan)
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    @php
                                        $persen =  Helpers::GetAllPersentase($kegiatan->kode_kegiatan);
                                        if ($persen == 100) {
                                            $warna = 'success';
                                        } elseif ($persen > 50) {
                                            $warna = 'warning';
                                        } elseif ($persen <= 50) {
                                            $warna = 'danger';
                                        }
                                    @endphp
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <i class="more-less fas fa-plus"></i> {{ $kegiatan->Divisi->nama_divisi }}
                                        <label class="label label-{{ $warna }}">{{ $persen}} %</label>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <ol style="list-style-type:upper-roman">
                                        <li style="font-size: 18px; color: #000000;">
                                            <strong>{{ $kegiatan->nama_kegiatan }}</strong>
                                        </li>
                                        @php $SubKegiatan = Helpers::GetSubKegiatanAll($kegiatan->kode_kegiatan) @endphp
                                        <ol type="a" start="a">
                                            @foreach ($SubKegiatan as $item)
                                                <li style="font-size: 16px; color: #161515;">{{ $item->sub_kegiatan }}
                                                    <sup>[<strong
                                                            class="label label-{{ $item->persentase != 100 ? 'warning' : 'success' }}">{{ $item->persentase }} %</strong>
                                                        ]</sup>
                                                </li>
                                                <ol style="list-style-type: inherit">
                                                    <li style="color: {{ $item->persentase == 100 ? 'green' : 'red' }}; font-size: 14px;">{{ $item->indikator_kinerja }}
                                                    </li>
                                                    <li style="color: {{ $item->persentase == 100 ? 'green' : 'red' }}; font-size: 14px;">{{ $item->target_kinerja }}
                                                        <a href="{{ route('rincian-iku-admin.show', $item->id) }}" class="btn btn-link btn-xs">
                                                            Lihat Rincian
                                                        </a>
                                                    </li>
                                                </ol>
                                                </table>
                                            @endforeach
                                        </ol>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js-additional')
<script src="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
    <script>
        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('fas fa-plus fas fa-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
@endsection
