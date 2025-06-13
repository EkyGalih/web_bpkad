<aside id="layout-menu" class="layout-menu menu-vertical" data-bs-theme="dark">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('client/assets/img/logo-light.png') }}" alt="Logo BPKAD">
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">NTB</span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item @if (request()->is('admin/web')) active @endif">
            <a href="{{ route('admin') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small mt-5">
            <span class="menu-header-text" data-i18n="MENU">MENU</span>
        </li>
        <li class="menu-item @if (request()->is('admin/web/post*')) active @endif">
            <a href="{{ route('post-admin.index') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-newspaper-fill"></i>
                <div data-i18n="Berita & Artikel">Berita & Artikel</div>
            </a>
        </li>
        <li class="menu-item @if (request()->is('admin/web/pages*') || request()->is('admin/web/sub-pages*')) open @endif">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                <div data-i18n="Halaman">Halaman</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/web/pages*')) active @endif">
                    <a href="{{ route('pages-admin.index') }}" class="menu-link">
                        <div data-i18n="Halaman">Halaman</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/sub-pages*')) active @endif">
                    <a href="{{ route('subpages-admin.index') }}" class="menu-link">
                        <div data-i18n="Sub Halaman">Sub Halaman</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- e-commerce-app menu end -->
        <!-- Academy menu start -->
        {{-- <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-database-2-fill"></i>
                <div data-i18n="Data BPKAD">Data BPKAD</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Data Aset">Data Aset</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Data Pegawai">Data Pegawai</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Data Transparansi">Data Transparansi</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Components -->
        <li class="menu-header small mt-5">
            <span class="menu-header-text" data-i18n="PPID">PPID</span>
        </li>
        <!-- Cards -->
        <li class="menu-item @if (request()->is('admin/web/ppid/*')) open @endif">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-book-3-fill"></i>
                <div data-i18n="PPID">PPID</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/web/ppid/kip*')) active @endif">
                    <a href="{{ route('kip.index') }}" class="menu-link">
                        <div data-i18n="Klasifikasi Informasi">Klasifikasi Informasi</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/ppid/agenda-pimpinan*')) active @endif">
                    <a href="{{ route('agenda-pimpinan.index') }}" class="menu-link">
                        <div data-i18n="Agenda Pimpinan">Agenda Pimpinan</div>
                    </a>
                </li>
                <li class="menu-item  @if (request()->is('admin/web/ppid/struktur-organisasi*')) active @endif">
                    <a href="{{ route('struktur-organisasi.index') }}" class="menu-link">
                        <div data-i18n="Struktur Organisasi PPID">Struktur Organisasi PPID</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Forms & Tables -->
        <li class="menu-header small mt-5">
            <span class="menu-header-text" data-i18n="ADDON">ADDON</span>
        </li>
        <!-- Forms -->
        <li class="menu-item @if (request()->is('admin/web/tools/*')) open @endif">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-tools-fill"></i>
                <div data-i18n="Tools">Tools</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/web/tools/menu*')) active @endif">
                    <a href="{{ route('menu-admin.index') }}" class="menu-link">
                        <div data-i18n="Menu">Menu</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/tools/social*')) active @endif">
                    <a href="{{ route('social.index') }}" class="menu-link">
                        <div data-i18n="Social Media">Social Media</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/tools/link*')) active @endif">
                    <a href="{{ route('link.index') }}" class="menu-link">
                        <div data-i18n="Link">Link</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/tools/address*')) active @endif">
                    <a href="{{ route('address.index') }}" class="menu-link">
                        <div data-i18n="Alamat Kantor">Alamat Kantor</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/tools/apps*')) active @endif">
                    <a href="{{ route('apps.index') }}" class="menu-link">
                        <div data-i18n="Aplikasi">Aplikasi</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/tools/olympic*')) active @endif">
                    <a href="{{ route('olympic-admin.index') }}" class="menu-link">
                        <div data-i18n="Olympic">Olympic</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-question-fill"></i>
                <div data-i18n="F.A.Q">F.A.Q</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('laporan-admin.index') }}" class="menu-link">
                        <div data-i18n="Laporan">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('permohonan-admin.index') }}" class="menu-link">
                        <div data-i18n="Permohonan">Permohonan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('users') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-group-3-fill"></i>
                <div data-i18n="Pengguna">Pengguna</div>
            </a>
        </li>
    </ul>
</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="ri ri-menu-line icon-base"></i>
        <i class="ri ri-arrow-right-s-line icon-base"></i>
    </a>
</div>
