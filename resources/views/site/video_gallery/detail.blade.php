@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>{{$video_gallery->title}}</h2>
                        @if(!empty($video_gallery->description))
                            <span>{{$video_gallery->description}}</span>
                        @endif
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li><a href="{{route('site.videoGallery')}}">Video Galeri</a></li>
                            <li class="active">{{$video_gallery->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($videos) && sizeof($videos) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <section class="album-detail">
                        <div class="col-md-12">
                            @php
                                $count = 1;
                            @endphp
                            @foreach($videos as $item)
                                @if($count % 2 == 1)
                                    <div class="row">
                                        <div class="video-sec">
                                            @endif
                                            <div class="col-md-6">
                                                @if($item->channel == "youtube")
                                                    <iframe width="100%"
                                                            height="492"
                                                            src="https://www.youtube.com/embed/{{$item->video}}"
                                                            frameborder="0"
                                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen>
                                                    </iframe>
                                                @else
                                                    <iframe
                                                        src="https://player.vimeo.com/video/{{$item->video}}?portrait=0"
                                                        width="100%"
                                                        height="492"
                                                        frameborder="0" webkitallowfullscreen mozallowfullscreen
                                                        allowfullscreen>
                                                    </iframe>
                                                @endif
                                            </div>
                                            @if($count % 2 == 0)
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('css')
@endsection

@section('js')
@endsection
