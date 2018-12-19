@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>{{$album->album_name}}</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li><a href="{{route('site.albums')}}">Albümler</a></li>
                            <li class="active">{{$album->album_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    <section>
        <div class="container">
            <div class="row">
                <section class="album-detail">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="px-portfolio list">
                                <article class="col-md-12">
                                    <figure>
                                        @if(!empty($album->image) && file_exists(public_path("/uploads/albums/".$album->folder_name."/".$album->image)))
                                            <a href="#"><img alt="#"
                                                             src="/uploads/albums/{{$album->folder_name}}/{{$album->image}}"
                                                             style="width: 300px; height: 300px"/></a>
                                        @else
                                            <a href="#"><img alt="#"
                                                             src="/site/assets/images/default/default_album.jpg"
                                                             style="width: 300px; height: 300px"/></a>
                                        @endif
                                    </figure>
                                    <div class="text">
                                        <a href="#" class="tracks-btn">{{$album->song->count()}} şarkı</a>
                                        <ul class="post-options">
                                            <li><i class="icon-calendar6"></i>Tarih:
                                                <span>{{date('d.m.Y', strtotime($album->created_at))}}</span></li>
                                            <li>
                                                <i class="icon-user"></i>
                                                {{$album->user->username}}
                                            </li>
                                        </ul>
                                        {!! str_limit(str_replace(array('<b>','</b>'), array('<strong>','</strong>'), $album->description), 150) !!}
                                    </div>
                                </article>
                            </div>
                            <div class="albumbanner">
                                <div class="px-player">
                                    <div class="col-md-12">
                                        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                                        <div id="jp_container_1" class="jp-audio" role="application"
                                             aria-label="media player">
                                            <div class="jp-type-playlist">
                                                <div class="jp-gui jp-interface">
                                                    <div class="jp-controls">
                                                        <button class="jp-previous" role="button" tabindex="0">
                                                            previous
                                                        </button>
                                                        <button class="jp-play" role="button" tabindex="0">play</button>
                                                        <button class="jp-next" role="button" tabindex="0">next</button>
                                                    </div>
                                                    <div class="jp-progress">
                                                        <div class="jp-seek-bar">
                                                            <div class="jp-play-bar"></div>
                                                        </div>
                                                    </div>
                                                    <div class="jp-volume-controls">
                                                        <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                        <div class="jp-volume-bar">
                                                            <div class="jp-volume-bar-value"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="jp-playlist no2">
                                                    <ul>
                                                        <li>&nbsp;</li>
                                                    </ul>
                                                </div>
                                                <div class="jp-no-solution"><span>Update Required</span> To play the
                                                    media you will need to either update your browser to a recent
                                                    version or update your <a href="http://get.adobe.com/flashplayer/"
                                                                              target="_blank">Flash plugin</a>.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-section-title">
                                <div class="col-md-12">
                                    <h3>ALBÜM HAKKINDA</h3>
                                </div>
                            </div>
                            <div class="rich-editor-text">
                                <div class="col-md-12">
                                    {!! str_replace(array('<b>','</b>'), array('<strong>','</strong>'), $album->description) !!}
                                </div>
                            </div>
                            <div class="px-team grid">
                                @if(isset($users) && sizeof($users) > 0)
                                    <div class="px-section-title">
                                        <div class="col-md-12">
                                            <h3>KORO ÜYELERİMİZ</h3>
                                        </div>
                                    </div>
                                    @foreach($users as $item)
                                        <article class="col-md-4">
                                            <figure>
                                                @if(!empty($item->image) && file_exists(public_path("/uploads/users/".$item->image)))
                                                    <a href="#"><img src="/uploads/users/{{$item->image}}"
                                                                     alt="{{$item->name}}"
                                                                     style="width: 250px; height: 250px"></a>
                                                @else
                                                    <a href="#"><img src="/site/assets/images/default/default_user.jpg"
                                                                     alt="{{$item->name}}"
                                                                     style="width: 250px; height: 250px"></a>
                                                @endif
                                            </figure>
                                            <div class="text">
                                                <h4><a href="#">{{$item->name}}</a></h4>
                                                <div class="info-sec">
                                                    <span>{{$item->voice_type->type_name}}</span>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--sidebar-->
                    <aside class="page-sidebar col-md-3">
                        @if(isset($songs) && sizeof($songs) > 0)
                            <div class="widget widget_downloads">
                                <div class="widget-section-title"><h2>DOWNLOAD</h2></div>
                                <ul style="content: none;">
                                    @foreach($songs as $item)
                                        <li><a href="#">{{$item->song_name}}</a>
                                            @if(!empty($item->document))
                                                <span style="float: right; padding-left: 5px">
                                                <a href="{{route('download.document',$item->id)}}"
                                                   title="{{$item->song_name}} dokümanı indir"><i
                                                        class="icon icon-download5"></i></a>
                                            </span>
                                            @endif

                                            @if(!empty($item->recording))
                                                <span style="float: right; padding-left: 5px">
                                                <a href="{{route('download.recording',$item->id)}}"
                                                   title="{{$item->song_name}} ses dosyasını indir"><i
                                                        class="icon icon-music6"></i></a>
                                            </span>
                                            @endif
                                            <div style="clear: both"></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(isset($advertisements) && sizeof($advertisements) > 0)
                            @foreach($advertisements as $item)
                                @if(!empty($item->image) && file_exists(public_path("/uploads/advertisements/".$item->image)))
                                    <div class="widget widget_advertisement">
                                        <figure>
                                            <a href="{{$item->url}}" title="{{$item->title}}"
                                               @if($item->url != "#") target="_blank" @endif />
                                            <img alt="{{$item->slug}}" src="/uploads/advertisements/{{$item->image}}"
                                                 style="width: 250px; height: 250px">
                                            </a>
                                        </figure>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </aside>
                    <!--end sidebar-->
                </section>
            </div>
        </div>
    </section>

    @if(isset($new_albums) && sizeof($new_albums) > 0)
        <section class="album-detail">
            <section class="px-portfolio small">
                <div class="container">
                    <div class="row">
                        <div class="px-section-title">
                            <div class="col-md-12">
                                <h3>EN YENİ ALBÜMLER</h3>
                            </div>
                        </div>
                        @foreach($new_albums as $item)
                            <article class="col-md-3">
                                <figure>
                                    @if(!empty($item->image) && file_exists(public_path("/uploads/albums/".$item->folder_name."/".$item->image)))
                                        <a href="{{route('site.albumDetail', $item->id)}}"><img
                                                src="/uploads/albums/{{$item->folder_name}}/{{$item->image}}"
                                                alt="{{$item->album_name}}" style="width: 240px; height: 240px"></a>
                                    @else
                                        <a href="{{route('site.albumDetail', $item->id)}}"><img
                                                src="/site/assets/images/default/default_album.jpg"
                                                alt="{{$item->album_name}}" style="width: 240px; height: 240px"/></a>
                                    @endif
                                </figure>
                                <div class="text">
                                    <span>{{$item->song->count()}} ŞARKI</span>
                                    <h5><a href="{{route('site.albumDetail', $item->id)}}">{{$item->album_name}}</a>
                                    </h5>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        </section>
    @endif
@endsection

@section('css')
    <link href="/site/assets/css/jplayer.blue.monday.min.css" rel="stylesheet">
@endsection

@section('js')
    <script>
        Response.AddHeader("Accept-Ranges", "bytes");
    </script>
    <script type="text/javascript" src="/site/assets/scripts/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="/site/assets/scripts/jplayer.playlist.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // JPlatyer

            if (jQuery('#jquery_jplayer_1').length != '') {
                new jPlayerPlaylist({
                    jPlayer: "#jquery_jplayer_1",
                    cssSelectorAncestor: "#jp_container_1"
                }, [
                        @foreach($songs as $item)
                    {
                        title: "{{$item->song_name}}",
                        mp3: "{{request()->root()}}/uploads/albums/{{$item->album->folder_name}}/songs/{{$item->recording}}"
                    },
                    @endforeach
                ], {
                    swfPath: "../../dist/jplayer",
                    supplied: "mp3",
                    wmode: "window",
                    useStateClassSkin: true,
                    autoBlur: false,
                    smoothPlayBar: true,
                    keyEnabled: true,
                });
            }

            $('#cglyn ul').append('<li>asdas</li>');
        });
    </script>
@endsection
