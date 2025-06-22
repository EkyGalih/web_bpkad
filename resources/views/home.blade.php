@extends('layouts.app')
@section('title', 'Home')
@section('menu-beranda', 'active')
@section('additional-css')
    <style>
        .radial-menu {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 70px;
            height: 70px;
            z-index: 999;
        }

        .center-btn {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .item {
            position: absolute;
            width: 50px;
            height: 50px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0);
            transition: all 0.4s ease;
            text-decoration: none;
            font-size: 20px;
        }

        /* Show when active */
        .radial-menu.active .item {
            opacity: 1;
            transform: scale(1);
        }

        /* Positioning each item circularly (4 items, 360/4 = 90 deg spacing) */
        .item:nth-child(2) {
            transform: rotate(0deg) translate(100px) rotate(0deg);
        }

        .item:nth-child(3) {
            transform: rotate(90deg) translate(100px) rotate(-90deg);
        }

        .item:nth-child(4) {
            transform: rotate(180deg) translate(100px) rotate(-180deg);
        }

        .item:nth-child(5) {
            transform: rotate(270deg) translate(100px) rotate(-270deg);
        }

        .radial-menu.active .item:nth-child(2) {
            transform: rotate(0deg) translate(100px) rotate(0deg);
        }

        .radial-menu.active .item:nth-child(3) {
            transform: rotate(90deg) translate(100px) rotate(-90deg);
        }

        .radial-menu.active .item:nth-child(4) {
            transform: rotate(180deg) translate(100px) rotate(-180deg);
        }

        .radial-menu.active .item:nth-child(5) {
            transform: rotate(270deg) translate(100px) rotate(-270deg);
        }

        .item:hover {
            background: #6610f2;
        }
    </style>
@endsection
@section('content')
    <div class="radial-menu">
        <button class="center-btn" id="menuToggle">
            <img src="{{ asset('server/assets/img/logo-bkn.png') }}" alt="BKN" width="50">
        </button>

        <!-- Menu Items -->
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item" title="BPKAD">
            <i class="ri-home-2-line"></i>
        </a>
        <a href="{{ env('SIMPEG_ADMIN') }}" class="item" title="SimPeg">
            <i class="ri-user-3-line"></i>
        </a>
        <a href="{{ env('APBD_ADMIN') }}" class="item" title="APBD">
            <i class="ri-folder-3-line"></i>
        </a>
        <a href="{{ env('WEB_BPKAD_ADMIN') }}" class="item" title="Aset TIK">
            <i class="ri-computer-line"></i>
        </a>
    </div>
@endsection
@section('additional-js')
    <script>
        document.getElementById("menuToggle").addEventListener("click", function() {
            document.querySelector(".radial-menu").classList.toggle("active");
        });
    </script>
@endsection
