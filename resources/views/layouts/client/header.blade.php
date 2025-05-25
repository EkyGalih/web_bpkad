<div class="navbar-collapse-wrapper d-flex flex-row align-items-center w-100">
    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
        <div class="offcanvas-header mx-lg-auto order-0 order-lg-1 d-lg-flex px-lg-15">
            <a href="./index.html" class="transition-none d-none d-lg-flex"><img class="logo-dark"
                    src="{{ asset('client/assets/img/logo-dark.png') }}"
                    srcset="{{ asset('client/assets/img/logo-dark@2x.png 2x') }}" alt="" />
                <img class="logo-light" src="{{ asset('client/assets/img/logo-light.png') }}"
                    srcset="{{ asset('client/assets/img/logo-light@2x.png 2x') }}" alt="" /></a>
            <h3 class="text-white fs-30 mb-0 d-lg-none">BPKAD NTB</h3>
            <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="w-100 order-3 order-lg-2 d-lg-flex offcanvas-body">
            <ul class="navbar-nav me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.index') }}">Berita</a>
                </li>
                @php
                    $menus = Helpers::Menu();
                @endphp
                <ul class="navbar-nav ms-lg-auto">
                    @foreach ($menus as $menu)
                        @php
                            $sub_menu = Helpers::Pages($menu->menu_id);
                        @endphp
                        @if (count($sub_menu) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('client.pages', $menu->slug) }}"
                                    data-bs-toggle="dropdown">
                                    {{ $menu->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($sub_menu as $item)
                                        @php
                                            $sub_item = Helpers::SubPages($item->sub_menu_id);
                                        @endphp
                                        @if (count($sub_item) > 0)
                                            <li class="dropdown-submenu dropend">
                                                <a class="dropdown-item dropdown-toggle" href="#"
                                                    data-bs-toggle="dropdown">
                                                    {{ $item->title }}
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
                                                    href="{{ $item->jenis_link == 'non-link' ? route('client.pages', $item->slug) : '/' . $item->link }}">
                                                    {{ $item->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menu->url }}">{{ $menu->name }}</a>
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
                    <a href="mailto:first.last@email.com" class="link-inverse">bpkad@ntbprov.go.id</a>
                    <br /> 00 (123) 456 78 90 <br />
                    <nav class="nav social social-white mt-4">
                        <a href="https://twitter.com/BpkadNtb" target="_blank"><i class="uil uil-twitter"></i></a>
                        <a href="https://www.facebook.com/bpkadntbprov" target="_blank"><i
                                class="uil uil-facebook-f"></i></a>
                        <a href="https://wa.me/message/47I56AXXZMGWB1" target="_blank"><i
                                class="uil uil-whatsapp"></i></a>
                        <a href="https://www.instagram.com/ntbbpkad/" target="_blank"><i
                                class="uil uil-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCZ-UDCXEyRvOJfdWtD2jv5g" target="_blank"><i
                                class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.navbar-collapse -->
</div>
