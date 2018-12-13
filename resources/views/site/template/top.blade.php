<!-- Header Start -->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="logo">
                @if(isset($setting) && !empty($setting->logo))
                    <a href="{{route('site.index')}}">
                        <img src="/site/assets/images/{{$setting->logo}}" alt="{{$setting->title}}"/>
                    </a>
                @endif
            </div>
            <div class="px-header-right">
                <div class="navigation">
                    <ul>
                        <li class="active"><a href="{{route('site.index')}}">ANASAYFA</a></li>
                        @if(isset($nav_pages) && sizeof($nav_pages) > 0)
                            @foreach($nav_pages as $item)
                                <li><a href="/page/{{$item->id}}/{{$item->slug}}">{{$item->title}}</a></li>
                            @endforeach
                        @endif
                        <li><a href="{{route('site.news')}}">HABERLER</a></li>
                        <li><a href="{{route('site.events')}}">ETKİNLİKLERİMİZ</a></li>
                        <li><a href="#">GALERİ</a>
                            <ul>
                                <li><a href="{{route('site.photoGallery')}}">FOTO GALERİ</a></li>
                                <li><a href="{{route('site.videoGallery')}}">VIDEO GALERİ</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('contact.index')}}">İLETİŞİM</a></li>
                        @if(!Auth::check())
                            <li><a href="{{route('register')}}">ÜYE OL</a></li>
                            <li><a href="{{route('login')}}">GİRİŞ YAP</a></li>
                        @else
                            <li>
                                <a href="#"><i class="icon-user2"></i> {{Auth::user()->name}}</a>
                                <ul>
                                    @if(Auth::user()->role() == 'admin')
                                        <li><a href="{{route('admin.index')}}" target="_blank">YÖNETİM PANELİ</a></li>
                                    @endif
                                    <li><a href="{{route('site.albums')}}">ALBÜMLER</a></li>
                                    <li><a href="#">ŞARKI YÜKLE</a></li>
                                    <li><a href="{{route('site.profile')}}">PROFİLİM</a></li>
                                    <li><a href="{{route('site.logout')}}">ÇIKIŞ</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="px-share"><a href="#"><i class="icon-share2"></i></a>
                    <ul>
                        @if(isset($setting) && !empty($setting->facebook))
                            <li><a href="{{$setting->facebook}}" target="_blank" data-original-title="facebook"><i
                                        class="icon-facebook-square"></i></a></li>
                        @endif

                        @if(isset($setting) && !empty($setting->twitter))
                            <li><a href="{{$setting->twitter}}" target="_blank" data-original-title="twitter"><i
                                        class="icon-twitter2"></i></a></li>
                        @endif

                        @if(isset($setting) && !empty($setting->instagram))
                            <li><a href="{{$setting->instagram}}" target="_blank" data-original-title="instagram"><i
                                        class="icon-instagram"></i></a></li>
                        @endif

                        @if(isset($setting) && !empty($setting->youtube))
                            <li><a href="{{$setting->youtube}}" target="_blank" data-original-title="youtube"><i
                                        class="icon-youtube"></i></a></li>
                        @endif

                        @if(isset($setting) && !empty($setting->vimeo))
                            <li><a href="{{$setting->vimeo}}" target="_blank" data-original-title="vimeo"><i
                                        class="icon-vimeo4"></i></a></li>
                        @endif

                        @if(isset($setting) && !empty($setting->soundcloud))
                            <li><a href="{{$setting->soundcloud}}" target="_blank" data-original-title="cloud"><i
                                        class="icon-soundcloud"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
</header>
<!-- Header End -->
