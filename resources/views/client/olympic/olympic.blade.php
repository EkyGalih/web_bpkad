@extends('client.index')
@section('title', 'OLYMPIC |')
@section('additional-css')
    <style>
        .olympic-card {
            max-width: 100%;
            height: 80%;
            background-image: url('{{ asset('upload/olympic.jpg') }}');
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            color: #FFFFFF;
        }

        .styled-table thead tr {
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #03457a;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #0162b1;
        }

        .styled-table tbody tr {
            background-color: #0162b1;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .blink {
            animation: blinker 3s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        .card-olympic {
            border-style: solid;
            width: auto;
            height: auto;

            padding-top: 35px;
            padding-bottom: 20px;
            padding-left: 40px;

            background: linear-gradient(red, white);
        }

        h2 {
            background: -webkit-linear-gradient(white, black);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">
        <section class="breadcrumbs">
            <div class="card olympic-card" style="padding: 5%; margin-right: 2%; margin-left: 2%; margin-top: 1%;">
                <div class="portofolio-description">
                    <div style="overflow-x:auto;">
                        <div class="card-olympic">
                            <h2 class="blink"
                                style="margin-top: 25%; color: #FFFFFF; font-weight: bold; margin-top: -10%; padding: -5%;">
                                KLASEMEN SEMENTARA OLIMPIADE BPKAD AGUSTUS {{ date('Y') }}</h2>
                        </div>
                        <table class="table styled-table">
                            <thead>
                                <tr>
                                    <td>Rank</td>
                                    <td>Bidang</td>
                                    <td style="text-align: center; font-weight: bold;">Emas</td>
                                    <td style="text-align: center; font-weight: bold;">Perak</td>
                                    <td style="text-align: center; font-weight: bold;">Perunggu</td>
                                    <td style="text-align: center;">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $emas1 .$perak1.$perunggu1 }}<br/>
                            {{ $emas2 .$perak2.$perunggu2 }}<br/>
                            {{ $emas3 .$perak3.$perunggu3 }} --}}
                                @foreach ($olympics as $olympic)
                                    <tr>
                                        @if (
                                            $max1 == $olympic->total &&
                                                $emas1 == $olympic->emas &&
                                                $perak1 == $olympic->perak &&
                                                $perunggu1 == $olympic->perunggu)
                                            <td><img height="20px" width="20px" src="{{ asset('upload/1st.png') }}"
                                                    alt="1st"></td>
                                        @elseif (
                                            $max2 == $olympic->total &&
                                                $emas2 == $olympic->emas &&
                                                $perak2 == $olympic->perak &&
                                                $perunggu2 == $olympic->perunggu)
                                            <td><img height="20px" width="20px" src="{{ asset('upload/2nd.png') }}"
                                                    alt="1st"></td>
                                        @elseif (
                                            $max3 == $olympic->total &&
                                                $emas3 == $olympic->emas &&
                                                $perak3 == $olympic->perak &&
                                                $perunggu3 == $olympic->perunggu)
                                            <td><img height="20px" width="20px" src="{{ asset('upload/3trd.png') }}"
                                                    alt="1st"></td>
                                        @else
                                            <td style="text-align: center'">{{ $loop->iteration }}</td>
                                        @endif
                                        <td>{{ $olympic->nama_bidang }}</td>
                                        <td style="text-align: center; font-weight: bold;">
                                            {{ $olympic->emas }}</td>
                                        <td style="text-align: center; font-weight: bold;">
                                            {{ $olympic->perak }}</td>
                                        <td style="text-align: center; font-weight: bold;">
                                            {{ $olympic->perunggu }}</td>
                                        <td style="text-align: center;">{{ $olympic->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
