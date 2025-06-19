<div class="navbar-collapse-wrapper d-flex flex-row align-items-center w-100">
    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
        <div class="offcanvas-header mx-lg-auto order-0 order-lg-1 d-lg-flex px-lg-10">
            <a href="/" class="transition-none d-none d-lg-flex">
                <img style="height: 50px" class="logo-dark" src="{{ asset('static/images/ntb.png') }}"
                    srcset="{{ asset('static/images/ntb.png') }}" alt="{{ $settings->title }}" />
                <img style="height: 40px; width: 100px;" class="logo-dark" src="{{ asset($settings->logo_image) }}"
                    srcset="{{ asset($settings->logo_image) }}" alt="{{ $settings->title }}" />
                <img style="height: 50px" class="logo-light me-2" src="{{ asset('static/images/ntb.png') }}"
                    srcset="{{ asset('static/images/ntb.png') }}" alt="{{ $settings->title }}" />
                <img style="height: 40px; width: 100px;" class="logo-light" src="{{ asset($settings->logo_image) }}"
                    srcset="{{ asset($settings->logo_image) }}" alt="{{ $settings->title }}" /></a>
            <h3 class="text-white fs-30 mb-0 d-lg-none">{{ $settings->title }}</h3>
            <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="w-100 order-3 order-lg-2 d-lg-flex offcanvas-body">
            <ul class="navbar-nav me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('post.index')) underline-3 style-3 blue @endif"
                        href="{{ route('post.index') }}">Berita</a>
                </li>
                @php
                    $menus = Menu();
                @endphp
                <ul class="navbar-nav ms-lg-auto">
                    @foreach ($menus as $menu)
                        @php
                            $sub_menu = Pages($menu->menu_id);
                            $currentUrl = url()->current(); // URL penuh saat ini
                            $submenuUrls = collect();

                            foreach ($sub_menu as $item) {
                                // sub page
                                if ($item->jenis_link === 'non-link') {
                                    $submenuUrls->push(route('client.pages', $item->slug));
                                } else {
                                    $submenuUrls->push(url($item->link));
                                }

                                // sub-sub page
                                foreach (SubPages($item->sub_menu_id) as $subitem) {
                                    if ($subitem->jenis_link === 'non-link') {
                                        $submenuUrls->push(route('client.sub_pages', $subitem->slug));
                                    } else {
                                        $submenuUrls->push(url($subitem->link));
                                    }
                                }
                            }

                            // tambahkan URL menu utama sendiri
                            $submenuUrls->push(route('client.pages', $menu->slug));

                            $isSubMenu = $submenuUrls->contains($currentUrl);
                        @endphp
                        @if (count($sub_menu) > 0)
                            <li class="nav-item dropdown {{ $isSubMenu ? 'underline-3 style-3 blue' : '' }}">
                                <a class="nav-link dropdown-toggle {{ $isSubMenu ? 'underline-3 style-3 blue' : '' }}"
                                    href="{{ route('client.pages', $menu->slug) }}" data-bs-toggle="dropdown">
                                    {{ $menu->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($sub_menu as $item)
                                        @php
                                            $sub_item = SubPages($item->sub_menu_id);
                                        @endphp
                                        @if (count($sub_item) > 0)
                                            <li class="dropdown-submenu dropend">
                                                <a class="dropdown-item dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">
                                                    {{ $item->slug }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @foreach ($sub_item as $item2)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ $item2->jenis_link == 'non-link' ? route('client.sub_pages', $item2->slug) : $item2->link }}">
                                                                {{ $item2->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ $item->jenis_link == 'non-link' ? route('client.pages', $item->slug) : $item->link }}">
                                                    {{ $item->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item {{ '/'.request()->path() == $menu->url ? 'underline-3 style-3 blue' : '' }}">
                                <a class="nav-link {{ '/'.request()->path() == $menu->url ? 'underline-3 style-3 blue' : '' }}"
                                    href="{{ $menu->url }}">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
            <!-- /.navbar-nav -->
        </div>
        <div class="offcanvas-body d-lg-none order-4 mt-auto">
            <div class="offcanvas-footer">
                <div>
                    <a href="mailto:first.last@email.com" class="link-inverse">{{ $settings->email }}</a>
                    <br /> {{ $settings->contact_number }} <br />
                    <nav class="nav social social-white mt-4">
                        @if (!empty($settings->twitter))
                            <a href="{{ $settings->twitter }}" target="_blank"><i class="uil uil-twitter"></i></a>
                        @endif
                        @if (!empty($settings->facebook))
                            <a href="{{ $settings->facebook }}" target="_blank"><i class="uil uil-facebook-f"></i></a>
                        @endif
                        @if (!empty($settings->whatsapp))
                            <a href="{{ $settings->whatsapp }}" target="_blank"><i class="uil uil-whatsapp"></i></a>
                        @endif
                        @if (!empty($settings->instagram))
                            <a href="{{ $settings->instagram }}" target="_blank"><i class="uil uil-instagram"></i></a>
                        @endif
                        @if (!empty($settings->youtube))
                            <a href="{{ $settings->youtube }}" target="_blank"><i class="uil uil-youtube"></i></a>
                        @endif
                    </nav>
                    <!-- /.social -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.navbar-collapse -->
</div>
