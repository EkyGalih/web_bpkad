<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="{{ '/' }}">BPKAD<span> NTB </span></a></h1>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="@yield('menu-home')"><a href="{{ '/' }}">Beranda</a></li>
                <li class="@yield('menu-berita')"><a href="{{ $_SERVER['REQUEST_URI'] == '/' ? '#news' : route('post.index') }}">Blog</a></li>
                @php
                    $menus = Helpers::Menu();
                @endphp
                @foreach ($menus as $menu)
                    @php
                        $sub_menu = Helpers::Pages($menu->menu_id);
                    @endphp
                    @if (count($sub_menu) != 0)
                        <li class="drop-down"><a
                                href="{{ route('client.pages', $menu->slug) }}">{{ $menu->name }}</a>
                            <ul>
                                @foreach ($sub_menu as $item)
                                    @php $sub_item = Helpers::SubPages($item->sub_menu_id) @endphp
                                    @if (count($sub_item))
                                        <li class="drop-down"><a href="#">{{ $item->title }}</a>
                                            <ul>
                                                @foreach ($sub_item as $item2)
                                                    <li>
                                                        <a
                                                            href="{{ $item2->jenis_link == 'non-link' ? route('client.sub_pages', $item2->slug) : $item2->link }}">
                                                            {{ $item2->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @elseif (count($sub_item) == 0)
                                        <li><a
                                                href="{{ $item->jenis_link == 'non-link' ? route('client.pages', $item->slug) : '/' . $item->link }}">{{ $item->title }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @elseif (count($sub_menu) == 0)
                        <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                    @endif
                @endforeach
                <li class="@yield('menu-kontak')"><a href="{{ $_SERVER['REQUEST_URI'] == '/' ? '#contact' : '/#contact' }}">Kontak</a></li>
            </ul>
        </nav>

    </div>
</header>
{{-- <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#team">Team</a></li>
                <li class="drop-down"><a href="">Drop Down</a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="drop-down"><a href="#">Deep Drop Down</a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
