<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('post-admin.index') }}">
                <i class="bi bi-file-earmark-post"></i>
                <span>Post</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages" href="#">
                <i class="bi bi-files"></i>
                <span>Pages</span> <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pages" class="nav-content collapse @yield('pages-menu')" data-bs-parent="#pages">
                <li>
                    <a href="{{ route('pages-admin.index') }}" class="@yield('p-pages')">
                        <i class="bi bi-circle"></i> <span>Page</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subpages-admin.index') }}" class="@yield('p-subpages')">
                        <i class="bi bi-circle"></i> <span>Sub Page</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data-bpkad" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button"></i><span>Data Bpakd</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data-bpkad" class="nav-content collapse @yield('db-menu')" data-bs-parent="#data-bpkad">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Data Aset</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin-pegawai.index') }}" class="@yield('db-pegawai')">
                        <i class="bi bi-circle"></i><span>Data Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Data Transparansi</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data-informasi" data-bs-toggle="collapse" href="#">
                <i class="bi bi-info-circle"></i><span>Data Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data-informasi" class="nav-content collapse @yield('di-menu')" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('galery-admin.index') }}" class="@yield('di-galery')">
                        <i class="bi bi-circle"></i><span>Galery</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('slider.index') }}" class="@yield('di-slider')">
                        <i class="bi bi-circle"></i><span>Slider/Carousel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('banner-video.index') }}" class="@yield('di-video')">
                        <i class="bi bi-circle"></i><span>Video Banner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('banner.index') }}" class="@yield('di-banner')">
                        <i class="bi bi-circle"></i><span>Banner Informasi</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        {{-- MENU PPID --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ppid" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>PPID</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ppid" class="nav-content collapse @yield('ppid-menu')" data-bs-parent="#sidebar-mav">
                <li>
                    <a href="{{ route('ppid-kip.index') }}" class="@yield('ppid-ki')">
                        <i class="bi bi-circle"></i><span>Klasifikasi Informasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ppid-struktur.index') }}" class="@yield('ppid-struktur')">
                        <i class="bi bi-circle"></i><span>Struktur Organisasi PPID</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-heading">Addon</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tools" data-bs-toggle="collapse" href="#">
                <i class="bi bi-tools"></i><span>Tools</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tools" class="nav-content collapse @yield('menu-tools')" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('menu-admin.index') }}" class="@yield('tools-menu')">
                        <i class="bi bi-circle"></i><span>Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tools-social') }}" class="@yield('tools-social')">
                        <i class="bi bi-circle"></i><span>Social Media</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tools-link') }}" class="@yield('tools-link')">
                        <i class="bi bi-circle"></i><span>Link</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tools-address') }}" class="@yield('tools-address')">
                        <i class="bi bi-circle"></i><span>Address Office</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('apps-admin.index') }}" class="@yield('tools-apps')">
                        <i class="bi bi-circle"></i><span>Apps</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#faq" data-bs-toggle="collapse" href="#">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span> <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="faq" class="nav-content collapse @yield('menu-faq')" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('laporan-admin.index') }}" class="@yield('faq-laporan')">
                        <i class="bi bi-circle"></i><span>Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('permohonan-admin.index') }}" class="@yield('faq-permohonan')">
                        <i class="bi bi-circle"></i><span>Permohonan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('users') }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
