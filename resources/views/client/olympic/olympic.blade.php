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

        .title {
            background: -webkit-linear-gradient(45deg, #ffffff, #df0606);
            font-weight: bold;
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
                    <table class="table styled-table" style="margin-top: 25%;">
                        <thead>
                            <tr>
                                <td style="text-align: center;">No</td>
                                <td>Bidang</td>
                                <td style="text-align: center; font-weight: bold;">Emas</td>
                                <td style="text-align: center; font-weight: bold;">Perak</td>
                                <td style="text-align: center; font-weight: bold;">Perunggu</td>
                                <td style="text-align: center;">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($olympics as $olympic)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
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
        </section>
    </main>
@endsection
