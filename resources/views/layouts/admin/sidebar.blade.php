<aside id="layout-menu" class="layout-menu menu-vertical" data-bs-theme="dark">
    <div class="app-brand demo">
        <a href="{{ route('admin') }}" style="background: #ffffff8e; border-radius: 6px; padding: 4px;"
            class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2 me-3">
                <img src="{{ asset('static/images/ntb.png') }}" alt="Logo NTB" style="height:32px;">
            </span>
            <span class="app-brand-logo demo">
                <img style="max-width: 150px; height: 45px;" src="{{ $settings->logo_image }}" alt="Logo BPKAD">
            </span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <div class="px-3 py-2">
        <div class="dropdown w-100">
            <button type="button" class="btn btn-light btn-sm d-flex align-items-center w-100 px-3 py-2 border rounded"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="flex-grow-1 text-start">
                    <span class="fw-semibold">Aplikasi</span>
                    @if (request()->path() == 'admin/web')
                        <span class="text-primary small ms-1">Web</span>
                    @elseif (request()->path() == 'admin/simpeg')
                        <span class="text-success small ms-1">SimPeg</span>
                    @endif
                </span>
                <span class="ms-auto d-flex align-items-center">
                    <i class="ri-arrow-down-s-line text-muted"></i>
                </span>
            </button>
            <ul class="dropdown-menu w-100 mt-1 shadow-sm small">
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin') }}">
                        <i class="ri-global-line me-2 text-primary"></i>
                        Web Informasi
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.simpeg') }}">
                        <i class="ri-user-settings-line me-2 text-success"></i>
                        SimPeg
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ ENV('APP_URL') }}/bpkad/home">
                        <i class="ri-home-4-line me-2 text-info"></i>
                        Landing Page
                    </a>
                </li>
                <!-- Tambahkan aplikasi lain di sini -->
            </ul>
        </div>
    </div>
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
        <li class="menu-item @if (request()->is('admin/web/data-informasi*')) open @endif">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-database-2-fill"></i>
                <div data-i18n="Data Informasi">Data Informasi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/web/data-informasi/galery*')) open @endif">
                    <a href="#" class="menu-link menu-toggle">
                        <div data-i18n="Galery">Galery</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->is('admin/web/data-informasi/galery/foto*')) active @endif">
                            <a href="{{ route('galery-foto.index') }}" class="menu-link">
                                <div data-i18n="Foto">Foto</div>
                            </a>
                        </li>
                        <li class="menu-item @if (request()->is('admin/web/data-informasi/galery/video*')) active @endif">
                            <a href="{{ route('galery-video.index') }}" class="menu-link">
                                <div data-i18n="Video">Video</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item @if (request()->is('admin/web/data-informasi/slider*')) active @endif">
                    <a href="#" class="menu-link">
                        <div data-i18n="Sliders">Sliders</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/data-informasi/pengumuman*')) active @endif">
                    <a href="{{ route('pengumuman.index') }}" class="menu-link">
                        <div data-i18n="Pengumuman">Pengumuman</div>
                    </a>
                </li>
            </ul>
        </li>

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
        <li class="menu-item @if (request()->is('admin/web/faq/*')) open @endif">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-question-fill"></i>
                <div data-i18n="F.A.Q">F.A.Q</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/web/faq/laporan*')) active @endif">
                    <a href="{{ route('laporan-admin.index') }}" class="menu-link">
                        <div data-i18n="Laporan">Laporan</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/web/faq/permohonan*')) active @endif">
                    <a href="{{ route('permohonan-admin.index') }}" class="menu-link">
                        <div data-i18n="Permohonan">Permohonan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if (request()->is('admin/web/Users*')) active @endif">
            <a href="{{ route('users') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-group-3-fill"></i>
                <div data-i18n="Pengguna">Pengguna</div>
            </a>
        </li>
        <li class="menu-item @if (request()->is('admin/web/website-settings*')) active @endif">
            <a href="{{ route('settings') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-settings-4-fill"></i>
                <div data-i18n="Website Settings">Website Settings</div>
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
