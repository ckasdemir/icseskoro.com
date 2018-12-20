<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Anasayfa</a>
    <ul>
        <li class="active"><a href="{{route('admin.index')}}"><i class="icon icon-home"></i> <span>Anasayfa</span></a>
        </li>
        <li><a href="{{route('news.index')}}"><i class="icon icon-globe"></i> <span>Haber Yönetimi</span></a></li>
        <li><a href="{{route('events.index')}}"><i class="icon icon-calendar"></i> <span>Etkinlik Yönetimi</span></a>
        </li>
        <li><a href="{{route('pages.index')}}"><i class="icon icon-link"></i> <span>İçerik Yönetimi</span></a></li>
        <li class="submenu"><a href="#"><i class="icon icon-music"></i> <span>Şarkı Yönetimi</span><span
                    class="label" style="background-color: transparent"><i
                        class="icon icon-chevron-down"></i></span></a>
            <ul>
                <li><a href="{{route('albums.index')}}">Albümler</a></li>
                <li><a href="{{route('songs.index')}}">Şarkılar</a></li>
            </ul>
        </li>
        <li class="submenu"><a href="#"><i class="icon icon-picture"></i> <span>Foto Galeri Yönetimi</span><span
                    class="label" style="background-color: transparent"><i
                        class="icon icon-chevron-down"></i></span></a>
            <ul>
                <li><a href="{{route('photo_gallery.index')}}">Galeriler</a></li>
                <li><a href="{{route('photos.index')}}">Fotoğraflar</a></li>
            </ul>
        </li>
        <li class="submenu"><a href="#"><i class="icon icon-facetime-video"></i> <span>Video Galeri Yönetimi</span><span
                    class="label" style="background-color: transparent"><i
                        class="icon icon-chevron-down"></i></span></a>
            <ul>
                <li><a href="{{route('video_gallery.index')}}">Galeriler</a></li>
                <li><a href="{{route('videos.index')}}">Videolar</a></li>
            </ul>
        </li>
        <li><a href="{{route('sliders.index')}}"><i class="icon icon-film"></i> <span>Slider Yönetimi</span></a></li>
        <li><a href="{{route('images.index')}}"><i class="icon icon-picture"></i> <span>Resim Yönetimi</span></a></li>
        <li><a href="{{route('partners.index')}}"><i class="icon icon-sitemap"></i> <span>Partner Yönetimi</span></a>
        </li>
        <li><a href="{{route('advertisements.index')}}"><i class="icon icon-th-large"></i> <span>Reklam Yönetimi</span></a>
        </li>
        <li><a href="{{route('users.index')}}"><i class="icon icon-group"></i> <span>Kullanıcı Yönetimi</span></a></li>
        <li><a href="{{route('messages.index')}}"><i class="icon icon-envelope"></i> <span>Mesajlar</span></a>
        </li>
        <li><a href="{{route('settings.index')}}"><i class="icon icon-cog"></i> <span>Ayarlar</span></a></li>
        <li><a href="{{route('site.index')}}" target="_blank"><i class="icon icon-link"></i> <span>Siteye git</span></a>
        </li>
        <li><a href="{{route('admin.logout')}}"><i class="icon icon-signout"></i> <span>Çıkış</span></a></li>
    </ul>
</div>
<!--sidebar-menu-->
