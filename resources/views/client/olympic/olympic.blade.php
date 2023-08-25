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

        h1 {
            background: -webkit-linear-gradient(white, red);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* efek kembang api */
        @import "compass/css3";

        html,
        body {
            padding: 0;
            margin: 0;
            height: 10%;
            background: black;
        }

        canvas {
            display: block;
        }

        /* box champions */
        .box h3 {
            text-align: center;
            position: relative;
            top: 10px;
        }

        .box {
            border-top-right-radius: 5%;
            border-top-left-radius: 5%;
            border-bottom-left-radius: 5%;
            border-bottom-right-radius: 5%;
            width: 85%;
            height: 150px;
            background: #ffd900c0;
            margin: 40px auto;
        }

        /*==================================================
                 * Efek 2
                 * ===============================================*/
        .Efek2 {
            position: relative;
        }

        .Efek2:before,
        .Efek2:after {
            z-index: -1;
            position: absolute;
            content: &quot;
            &quot;
            ;
            bottom: 15px;
            left: 10px;
            width: 50%;
            top: 10%;
            max-width: 300px;
            background: #777;
            -webkit-box-shadow: 0 15px 10px #777;
            -moz-box-shadow: 0 15px 10px #777;
            box-shadow: 0 15px 10px #777;
            -webkit-transform: rotate(-3deg);
            -moz-transform: rotate(-3deg);
            -o-transform: rotate(-3deg);
            -ms-transform: rotate(-3deg);
            transform: rotate(-3deg);
        }

        .Efek2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        }

        /* css blink */
        @-webkit-keyframes blinker {
            from {
                opacity: 1.0;
            }

            to {
                opacity: 0.0;
            }
        }

        .blink {
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
            -webkit-animation-direction: alternate;
        }
    </style>
@endsection
@section('content_home')
    <main id="main" data-aos="fade-up">
        <section class="breadcrumbs">
            <div class="card olympic-card" style="padding: 5%; margin-right: 2%; margin-left: 2%; margin-top: 1%;">
                <div class="portofolio-description">
                    <div style="overflow-x:auto;">
                        <div class="box Efek2" style="margin-bottom: -20%;">
                            <h3> <span style="color: #FFFFFF; font-size: 20px;">Champions of BPKAD</span><br /> <img
                                    class="blink" src="{{ asset('upload/mahkota.png') }}" alt="mahkota" height="50px"
                                    width="60px" style="margin-top: -6px;">
                                <br /> <span style="font-weight: bold;">{{ $champions->nama_bidang }}</span>
                            </h3>
                        </div>
                        <table class="table styled-table" style="margin-top: -25%;">
                            <canvas id="canvas"></canvas>
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
                                        <td>{{ strtoupper($olympic->nama_bidang) }}</td>
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
@section('additional-js')
    <script>
        (function() {
            'use strict';

            var canvas = document.querySelector('canvas'),
                ctx = canvas.getContext('2d'),
                W = canvas.width = window.innerWidth,
                H = canvas.height = window.innerHeight,
                maxP = 700,
                minP = 1000,
                fireworks = [];

            function tick() {
                var newFireworks = [];
                ctx.clearRect(0, 0, W, H);

                fireworks.forEach(function(firework) {
                    firework.draw();
                    if (!firework.done) newFireworks.push(firework);
                });

                fireworks = newFireworks;
                window.requestAnimationFrame(tick);
            }

            function Vector(x, y) {
                this.x = x;
                this.y = y;
            }

            Vector.prototype = {
                constructor: Vector,

                add: function(vector) {
                    this.x += vector.x;
                    this.y += vector.y;
                },

                diff: function(vector) {
                    var target = this.copy();
                    return Math.sqrt(
                        (target.x -= vector.x) * target.x + (target.y -= vector.y) * target.y
                    );
                },

                copy: function() {
                    return new Vector(this.x, this.y);
                }
            };

            var colors = [
                ['rgba(179,255,129,', 'rgba(0,255,0,'], //green / white
                ['rgba(0,0,255,', 'rgba(100,217,255,'], //blue / cyan
                ['rgba(255,0,0,', 'rgba(255,255,0,'], //red / yellow
                ['rgba(145,0,213,', 'rgba(251,144,204,'] //purple / pink
            ];

            function Firework(start, target, speed) {
                this.start = start;
                this.pos = this.start.copy();
                this.target = target;
                this.spread = Math.round(Math.random() * (maxP - minP)) + minP;
                this.distance = target.diff(start);
                this.speed = speed || Math.random() * 5 + 15;
                this.angle = Math.atan2(target.y - start.y, target.x - start.x);
                this.velocity = new Vector(
                    Math.cos(this.angle) * this.speed,
                    Math.sin(this.angle) * this.speed
                );

                this.particals = [];
                this.prevPositions = [];

                var colorSet = colors[Math.round(Math.random() * (colors.length - 1))];

                for (var i = 0; i < this.spread; i++) {
                    this.particals.push(new Partical(target.copy(), colorSet));
                }
            }

            Firework.prototype = {
                constructor: Firework,

                draw: function() {
                    var last = this.prevPositions[this.prevPositions.length - 1] || this.pos;

                    ctx.beginPath();
                    ctx.moveTo(last.x, last.y);
                    ctx.lineTo(this.pos.x, this.pos.y);
                    ctx.strokeStyle = 'rgba(255,255,255,.7)';
                    ctx.stroke();

                    this.update();
                },

                update: function() {
                    if (this.start.diff(this.pos) >= this.distance) {
                        var newParticals = [];
                        this.particals.forEach(function(partical) {
                            partical.draw();
                            if (!partical.done) newParticals.push(partical);
                        });

                        this.particals = newParticals;
                        this.prevPositions = [];

                        if (!newParticals.length) this.done = true;
                    } else {
                        this.prevPositions.push(this.pos.copy());

                        if (this.prevPositions.length > 8) {
                            this.prevPositions.shift();
                        }

                        this.pos.add(this.velocity);
                    }
                }
            };

            function Partical(pos, colors) {
                this.pos = pos;
                this.ease = 0.2;
                this.speed = Math.random() * 6 + 2;
                this.gravity = Math.random() * 3 + 0.1;
                this.alpha = .8;
                this.angle = Math.random() * (Math.PI * 2);
                this.color = colors[Math.round(Math.random() * (colors.length - 1))];
                this.prevPositions = [];
            }

            Partical.prototype = {
                constructor: Partical,

                draw: function() {
                    var last = this.prevPositions[this.prevPositions.length - 1] || this.pos;

                    ctx.beginPath();
                    ctx.moveTo(last.x, last.y);
                    ctx.lineTo(this.pos.x, this.pos.y);
                    ctx.strokeStyle = this.color + this.alpha + ')';
                    ctx.stroke();

                    this.update();
                },

                update: function() {
                    if (this.alpha <= 0) {
                        this.done = true;
                    } else {
                        this.prevPositions.push(this.pos.copy());

                        if (this.prevPositions.length > 10) this.prevPositions.shift();
                        if (this.speed > 1) this.speed -= this.ease;

                        this.alpha -= 0.01;
                        this.gravity += 0.01;

                        this.pos.add({
                            x: Math.cos(this.angle) * this.speed,
                            y: Math.sin(this.angle) * this.speed + this.gravity
                        });
                    }
                }
            };

            function addFirework(target) {
                var startPos = new Vector(W / 2, H);
                target = target || new Vector(Math.random() * W, Math.random() * (H - 300));
                fireworks.push(new Firework(startPos, target));
            }

            canvas.addEventListener('click', function(e) {
                addFirework(new Vector(e.clientX, e.clientY))
            }, false);

            function randomFirework() {
                addFirework();
                window.setTimeout(randomFirework, Math.random() * 500);
            }

            tick();
            randomFirework();

        })();
    </script>
@endsection
