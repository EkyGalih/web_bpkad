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
            <a class="nav-link collapsed" href="{{ route('pages-admin.index') }}">
                <i class="bi bi-files"></i>
                <span>Pages</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#data-bpkad" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button"></i><span>Data Bpakd</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data-bpkad" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Aset</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
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
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Slider/Carousel</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Powerpoint</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Bender</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

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
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Social Media</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Link</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
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
    </ul>

</aside><!-- End Sidebar-->
