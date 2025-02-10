<div class="row mb-8 p-0">
    <div class="col-xl-6">
        <h4 class="title"><i class="ki-outline ki-tablet-text-down fs-3"></i> DATA APBD {{ $tahun_anggaran }}</h4>
    </div>
    <input type="hidden" value="{{ $get_tahun == null ? date('Y') : $tahun_anggaran }}" id="get_ta">
</div>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="apbd-table">
        <thead>
            <tr>
                <td style="text-align: center; vertical-align: middle;" rowspan="2">Kode</td>
                <td style="text-align: center; vertical-align: middle;" rowspan="2">Uraian</td>
                <td style="text-align: center; vertical-align: middle;" colspan="2">Jumlah (Rp)</td>
                <td style="text-align: center; vertical-align: middle;" colspan="2">Bertambah/(Berkurang)</td>
                <td style="text-align: center; vertical-align: middle;" rowspan="2"></td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: middle;">MURNI ({{ date('Y') }})</td>
                <td style="text-align: center; vertical-align: middle;">PERUBAHAN ({{ date('Y') }})</td>
                <td style="text-align: center; vertical-align: middle;">(Rp)</td>
                <td style="text-align: center; vertical-align: middle;">%</td>
            </tr>
        </thead>
        <tbody>
            {{-- HITUNG JUMLAH ANGGARAN --}}
            @php
                $jumlah_pendapatan1 = [];
                $jumlah_pendapatan2 = [];

                $jumlah_belanja1 = [];
                $jumlah_belanja2 = [];

                $jumlah_pembiayaan1 = [];
                $jumlah_pembiayaan2 = [];

                $jumlah_pembiayaan3 = [];
                $jumlah_pembiayaan4 = [];
            @endphp
            @foreach ($Apbd as $apbd)
                <tr>
                    <td>{{ $apbd['kode_rekening'] }}</td>
                    <td colspan="{{ count($get_tahun) + 5 }}"><strong>{{ $apbd['nama_rekening'] }}</strong></td>
                </tr>
                @foreach ($apbd['data'] as $item)
                    @if ($apbd['kode_rekening'] != $item['kode_rekening'])
                        <tr>
                            <td>{{ $item['kode_rekening'] }}</td>
                            @if (isset($item['nama_rekening']) && !isset($item['sub_uraian']))
                                <td style="padding-left: 20px;"><strong>{{ $item['uraian'] }}</strong></td>
                                <td style="text-align: right; font-size: 14px;">
                                    <strong>{{ number_format($item['jml_anggaran_sebelum']) }}</strong>
                                </td>
                                <td style="text-align: right; font-size: 14px;">
                                    <strong>{{ number_format($item['jml_anggaran_setelah']) }}</strong>
                                </td>
                                <td style="text-align: right; font-size: 14px;">
                                    <strong>{{ number_format($item['selisih_anggaran']) }}</strong>
                                </td>
                                <td style="text-align: right; font-size: 14px;">
                                    <strong>{{ $item['persen'] }}%</strong>
                                </td>
                            @elseif (isset($item['nama_rekening']) && isset($item['uraian']))
                                <td style="padding-left: 40px;">{{ $item['sub_uraian'] }}</td>
                                <td style="text-align: right; font-size: 12px;">
                                    {{ number_format($item['jml_anggaran_sebelum']) }}</td>
                                <td style="text-align: right; font-size: 12px;">
                                    {{ number_format($item['jml_anggaran_setelah']) }}</td>
                                <td style="text-align: right; font-size: 12px;">
                                    {{ number_format($item['selisih_anggaran']) }}</td>
                                <td style="text-align: right; font-size: 12px;">{{ $item['persen'] }}%</td>
                            @endif
                            <td style="text-align: center;">
                                @if (strlen($item['kode_rekening']) == 6)
                                    <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-tooltip="tooltip"
                                        data-bs-placement="left" title="Hapus Sub Kegiatan"
                                        onclick="deleteData('{{ route('apbd.destroy', $item['apbd_id']) }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a class="btn btn-icon btn-warning btn-sm" data-bs-tooltip="tooltip" data-bs-placement="right"
                                        title="Ubah Anggaran" href="{{ route('apbd.edit', $item['apbd_id']) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        {{-- @include('admin.Apbd.Components.edit') --}}
                    @endif
                    @php
                        if (
                            strlen($item['kode_rekening']) == 3 &&
                            $item['nama_rekening'] == strtoupper('pendapatan daerah')
                        ) {
                            array_push($jumlah_pendapatan1, $item['jml_anggaran_sebelum']);
                            array_push($jumlah_pendapatan2, $item['jml_anggaran_setelah']);
                        } elseif (
                            strlen($item['kode_rekening']) == 3 &&
                            $item['nama_rekening'] == strtoupper('belanja')
                        ) {
                            array_push($jumlah_belanja1, $item['jml_anggaran_sebelum']);
                            array_push($jumlah_belanja2, $item['jml_anggaran_setelah']);
                        } elseif (
                            strlen($item['kode_rekening']) == 6 &&
                            $item['uraian'] == strtoupper('penerimaan pembiayaan')
                        ) {
                            array_push($jumlah_pembiayaan1, $item['jml_anggaran_sebelum']);
                            array_push($jumlah_pembiayaan2, $item['jml_anggaran_setelah']);
                        } elseif (
                            strlen($item['kode_rekening']) == 6 &&
                            $item['uraian'] == strtoupper('pengeluaran pembiayaan')
                        ) {
                            array_push($jumlah_pembiayaan3, $item['jml_anggaran_sebelum']);
                            array_push($jumlah_pembiayaan4, $item['jml_anggaran_setelah']);
                        }
                    @endphp
                @endforeach
                <tr>
                    @if ($apbd['nama_rekening'] == 'PENDAPATAN DAERAH')
                        <td></td>
                        <td><strong>JUMLAH PENDAPATAN</strong></td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pendapatan1)) }}</strong>
                        </td>
                        {{-- simpan data jumlah pendapatan1 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_pendapatan1) }}" id="jumlah_pendapatan1">
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pendapatan2)) }}</strong>
                        </td>
                        {{-- simpan data jumlah pendapatan2 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_pendapatan2) }}" id="jumlah_pendapatan2">
                        @php
                            $selisih_pendapatan1 = array_sum($jumlah_pendapatan1) - array_sum($jumlah_pendapatan2);
                            $count_persen_pendapatan1 =
                                (array_sum($jumlah_pendapatan1) - array_sum($jumlah_pendapatan2)) /
                                array_sum($jumlah_pendapatan1);
                            if ($count_persen_pendapatan1 < 0) {
                                $persen_pendapatan1 = abs(round($count_persen_pendapatan1 * 100, 2));
                            } elseif ($count_persen_pendapatan1 > 0) {
                                $persen_pendapatan1 = round($count_persen_pendapatan1 * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(abs($selisih_pendapatan1)) }}</strong>
                        </td>
                        <td style="text-align: right;"><strong>{{ $persen_pendapatan1 }}%</strong></td>
                        <td></td>
                    @elseif ($apbd['nama_rekening'] == 'BELANJA')
                        <td></td>
                        <td><strong>JUMLAH BELANJA</strong></td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_belanja1)) }}</strong>
                        </td>
                        {{-- simpan data jumlah belanja1 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_belanja1) }}" id="jumlah_belanja1">
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_belanja2)) }}</strong>
                        </td>
                        {{-- simpan data jumlah belanja2 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_belanja2) }}" id="jumlah_belanja2">
                        @php
                            $selisih_belanja = array_sum($jumlah_belanja1) - array_sum($jumlah_belanja2);
                            $count_persen_belanja =
                                (array_sum($jumlah_belanja1) - array_sum($jumlah_belanja2)) /
                                array_sum($jumlah_belanja1);
                            if ($count_persen_belanja < 0) {
                                $persen_belanja = abs(round($count_persen_belanja * 100, 2));
                            } elseif ($count_persen_belanja > 0) {
                                $persen_belanja = round($count_persen_belanja * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(abs($selisih_belanja)) }}</strong>
                        </td>
                        <td style="text-align: right"><strong>{{ $persen_belanja }}%</strong></td>
                        <td></td>
                    @endif
                </tr>
                <tr>
                    @if ($apbd['nama_rekening'] == 'BELANJA')
                        <td></td>
                        <td><strong>TOTAL SURPLUS/(DEFISIT)</strong></td>
                        @php
                            $defisit1 = array_sum($jumlah_pendapatan1) - array_sum($jumlah_belanja1);
                            $defisit2 = array_sum($jumlah_pendapatan2) - array_sum($jumlah_belanja2);
                            $total_defisit = $defisit1 - $defisit2;
                            $count_persen_defisit = ($defisit1 - $defisit2) / $defisit1;
                            if ($count_persen_defisit < 0) {
                                $persen_defisit = abs(round($count_persen_defisit * 100, 2));
                            } elseif ($count_persen_defisit > 0) {
                                $persen_defisit = round($count_persen_defisit * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right;">
                            <strong>{{ number_format($defisit1) }}</strong>
                        </td>
                        <td style="text-align: right;">
                            <strong>{{ number_format($defisit2) }}</strong>
                        </td>
                        <td style="text-align: right;">
                            <strong>{{ number_format($total_defisit) }}</strong>
                        </td>
                        <td style="text-align: right;"><strong>{{ $persen_defisit }}%</strong></td>
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <td height="35px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @if ($apbd['nama_rekening'] == strtoupper('pembiayaan'))
                    <tr>
                        <td></td>
                        <td><strong>JUMLAH PENERIMAAN PEMBIAYAAN</strong></td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pembiayaan1)) }}</strong>
                        </td>
                        {{-- simpan data jumlah pembiayaan1 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_pembiayaan1) }}" id="jumlah_pembiayaan1">
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pembiayaan2)) }}</strong>
                        </td>
                        {{-- simpan data jumlah pembiayaan2 untuk di kirim ke grafik --}}
                        <input type="hidden" value="{{ array_sum($jumlah_pembiayaan2) }}" id="jumlah_pembiayaan2">
                        @php
                            $selisih_pembiayaan1 = array_sum($jumlah_pembiayaan1) - array_sum($jumlah_pembiayaan2);
                            $count_persen_pembiayaan1 =
                                (array_sum($jumlah_pembiayaan1) - array_sum($jumlah_pembiayaan2)) /
                                array_sum($jumlah_pembiayaan1);
                            if ($count_persen_pembiayaan1 < 0) {
                                $persen_pembiayaan1 = abs(round($count_persen_pembiayaan1 * 100, 2));
                            } elseif ($count_persen_pembiayaan1 > 0) {
                                $persen_pembiayaan1 = round($count_persen_pembiayaan1 * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format($selisih_pembiayaan1) }}</strong>
                        </td>
                        <td style="text-align: right"><strong>{{ $persen_pembiayaan1 }}%</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><strong>JUMLAH PENGELUARAN PEMBIAYAAN</strong></td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pembiayaan3)) }}</strong>
                        </td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format(array_sum($jumlah_pembiayaan4)) }}</strong>
                        </td>
                        @php
                            $selisih_pembiayaan2 = array_sum($jumlah_pembiayaan3) - array_sum($jumlah_pembiayaan4);
                            if (array_sum($jumlah_pembiayaan3) > 0 && array_sum($jumlah_pembiayaan4) > 0) {
                                $count_persen_pembiayaan2 =
                                    (array_sum($jumlah_pembiayaan3) - array_sum($jumlah_pembiayaan4)) /
                                    array_sum($jumlah_pembiayaan3);
                            } else {
                                $count_persen_pembiayaan2 = 0;
                            }

                            if ($count_persen_pembiayaan2 < 0) {
                                $persen_pembiayaan2 = abs(round($count_persen_pembiayaan2 * 100, 2));
                            } else {
                                $persen_pembiayaan2 = round($count_persen_pembiayaan2 * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format($selisih_pembiayaan2) }}</strong>
                        </td>
                        <td style="text-align: right;"><strong>{{ $persen_pembiayaan2 }}%</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><strong>PEMBIAYAAN NETO</strong></td>
                        @php
                            $neto1 = array_sum($jumlah_pembiayaan1) - array_sum($jumlah_pembiayaan3);
                            $neto2 = array_sum($jumlah_pembiayaan2) - array_sum($jumlah_pembiayaan4);
                            $selisih_neto = $neto1 - $neto2;
                            $count_persen_neto = ($neto1 - $neto2) / $neto1;
                            if ($count_persen_neto < 0) {
                                $persen_neto = abs(round($count_persen_neto * 100, 2));
                            } elseif ($count_persen_neto > 0) {
                                $persen_neto = round($count_persen_neto * 100, 2);
                            }
                        @endphp
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format($neto1) }}</strong>
                        </td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format($neto2) }}</strong>
                        </td>
                        <td style="text-align: right; font-size: 14px;">
                            <strong>{{ number_format($selisih_neto) }}</strong>
                        </td>
                        <td style="text-align: right; font-size: 14px;"><strong>{{ $persen_neto }}%</strong></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
