<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('client/assets/img/favicon.png') }}" alt="">
            <span class="d-none d-lg-block">WEBSITE BPKAD</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">
                @php
                    $laporan = Helpers::_getLaporan();
                    $count = count($laporan);
                @endphp

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    @if ($count != 0)
                    <span class="badge bg-danger badge-number">{{ $count }}</span>
                    @endif
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have {{ $count }} new notifications
                        <a href="{{ route('laporan-admin.index') }}"><span
                                class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @foreach ($laporan as $lap)
                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>{{ $lap->kode_laporan }}</h4>
                                <p>{{ $lap->judul_laporan }}</p>
                                <p><span class="badge bg-secondary">{{ Helpers::RangeTime($lap->created_at) }}</span>
                                </p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endforeach

                    <li class="dropdown-footer">
                        <a href="{{ route('laporan-admin.index') }}">show all report</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown">
                @php
                    $permohonan = Helpers::_getPermohonan();
                    $count2 = count($permohonan);
                @endphp
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    @if ($count2 != 0)
                    <span class="badge bg-success badge-number">{{ $count2 }}</span>
                    @endif
                </a><!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have {{ $count2 }} new messages
                        <a href="{{ route('permohonan-admin.index') }}"><span
                                class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @foreach ($permohonan as $item)
                        <li class="message-item">
                            <a href="#">
                                <img src="{{ asset($item->ktp) }}" alt="" class="rounded-circle">
                                <div>
                                    <h4>{{ $item->nama }}</h4>
                                    <p>{{ $item->informasi_diminta }}</p>
                                    <p><span
                                            class="badge bg-secondary">{{ Helpers::RangeTime($item->created_at) }}</span>
                                        <span
                                            class="{{ Helpers::NewData($item->created_at) == 'false' ? '' : 'blink' }}"
                                            style="font-size: 8px;">{{ Helpers::NewData($item->created_at) == 'true' ? 'Baru' : '' }}</span>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endforeach

                    <li class="dropdown-footer">
                        <a href="{{ route('permohonan-admin.index') }}">Show all messages</a>
                    </li>

                </ul><!-- End Messages Dropdown Items -->

            </li><!-- End Messages Nav -->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nama }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->nama }}</h6>
                        <span>{{ Auth::user()->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('profile', Auth::user()->id) }}">
                            <i class="bi bi-person"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
