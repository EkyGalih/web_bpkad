<header id="header" class="fixed-top">
    <div class="container-fluid d-flex">

        <div class="logo mr-auto">
            <h1 class="text-light">
                <a href="{{'/'}}"><img src="{{asset('client/assets/img/favicon.png')}}" alt="Logo BPKAD"
                                       class="img-fluid">
                    BPKAD NTB</a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            {{--            <a href="index.html"><img src="{{asset('assets/img/favicon.png')}}" alt="" class="img-fluid">--}}
            {{--                BPKAD NTB--}}
            {{--            </a>--}}
        </div>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{'/'}}">Home</a></li>
                @foreach($menu as $key => $menus)
                    @php $sub_menu = \Illuminate\Support\Facades\DB::table('pages')->where('menu_id', $menus->id)->first() @endphp
                    <li @if($sub_menu != null) class="drop-down" @endif><a href="#">{{$menus->name}}</a>
                        @if($sub_menu != null)
                            @php $sub_menu_2 = \Illuminate\Support\Facades\DB::table('pages')->where('menu_id', $menus->id)->get() @endphp
                            <ul>
                                @foreach($sub_menu_2 as $item)
                                    <li><a href="{{route('client.show', $item->id)}}">{{$item->title}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
