<header id="header" class="fixed-top">
    <h1 class="logo mr-auto"><a href="{{'/'}}"><img src="{{asset('uploads/profile/favicon.png')}}" alt="" style="margin-left: 10px;"> BPKAD<span> NTB</span></a></h1>
    <div class="container d-flex align-items-center">
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{'/'}}">Home</a></li>
                <li><a href="#news">Berita</a></li>
                @php
                $menus = App\Models\Menu::getAll();
                @endphp
                @foreach ($menus as $menu)
                    @php
                        $sub_menu = App\Models\Pages::getById($menu->menu_id);
                    @endphp
                    @if (count($sub_menu) != 0)
                        <li class="drop-down"><a href="">{{ $menu->name }}</a>
                            <ul>
                                @foreach ($sub_menu as $item)
                                    @if ($item->sub_menu_id != "0")
                                        <li class="drop-down"><a href="#">{{ $item->title }}</a>
                                        @php $sub_item = App\Models\SubPages::getSubMenu($item->sub_menu_id) @endphp
                                        @foreach ($sub_item as $item2)
                                            <ul>
                                                <li><a href="#">{{ $item2->title }}</a></li>
                                            </ul>
                                        </li>
                                        @endforeach
                                    @elseif ($item->sub_menu_id == "0")
                                        <li><a href="#">{{ $item->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @elseif (count($sub_menu) == 0)
                        <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                    @endif
                @endforeach
                <li><a href="#contact">Kontak</a></li>
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
