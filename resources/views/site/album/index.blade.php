@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>Albümler</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">Albümler</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($albums) && sizeof($albums) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <div class="px-portfolio grid portfolio-items">
                        @foreach($albums as $item)
                            <article class="col-md-4 portfolio-item jquery">
                                <figure>
                                    @if(!empty($item->image) && file_exists(public_path("/uploads/albums/".$item->folder_name."/".$item->image)))
                                        <img src="/uploads/albums/{{$item->folder_name}}/{{$item->image}}"
                                             alt="{{$item->album_name}}" width="340px" height="340px">
                                    @else
                                        <img
                                            src="/site/assets/images/default/default_album.jpg"
                                            alt="{{$item->album_name}}"/>
                                    @endif
                                    <figcaption>
                                        <div class="px-bottom">
                                            <a href="{{route('site.albumDetail', $item->id)}}"><i
                                                    class="icon icon-play7"></i></a>
                                        </div>
                                    </figcaption>
                                </figure>
                                <div class="text">
                                    <h5><a href="{{route('site.albumDetail', $item->id)}}">{{$item->album_name}}</a>
                                    </h5>
                                    <a href="#"
                                       class="tracks-btn">{{\App\Song::where('album_id','=', $item->id)->where('status','=',true)->count()}}
                                        şarkı</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('css')
    <link href="/site/assets/css/jplayer.blue.monday.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="/site/assets/scripts/jquery.prettyPhoto.js"></script>
    <script src="/site/assets/scripts/custom.js"></script>
    <script src="/site/assets/scripts/isotope.min.js"></script>
    <script type="text/javascript" src="/site/assets/scripts/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="/site/assets/scripts/jplayer.playlist.min.js"></script>
@endsection
