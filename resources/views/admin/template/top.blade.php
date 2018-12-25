<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown"
                                                      data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Merhaba, {{Auth::user()->name}}</span><b
                    class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('users.edit', Auth::user()->id)}}"><i class="icon-user"></i> Profilim</a></li>
                <li class="divider"></li>
                <li><a href="{{route('admin.logout')}}"><i class="icon-signout"></i> Çıkış</a></li>
            </ul>
        </li>
        <li class="dropdown" id="menu-messages"><a href="{{route('messages.index')}}" data-toggle="dropdown"
                                                   data-target="#menu-messages"
                                                   class="dropdown-toggle"><i class="icon icon-envelope"></i> <span
                    class="text">Messages</span> <span
                    class="label label-important">{{ \App\Message::where('is_read','=',false)->count() }}</span> <b
                    class="caret"></b></a>
        </li>
        <li class=""><a title="" href="{{route('settings.index')}}"><i class="icon icon-cog"></i> <span class="text">Ayarlar</span></a>
        </li>
        <li class=""><a title="" href="{{route('admin.logout')}}"><i class="icon icon-signout"></i> <span class="text">Çıkış</span></a>
        </li>
    </ul>
</div>
<!--close-top-Header-menu-->
