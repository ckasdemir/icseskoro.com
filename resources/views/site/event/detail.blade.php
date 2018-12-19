@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>Etkinliklerimiz</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li><a href="{{route('site.events')}}">Etkinliklerimiz</a></li>
                            <li class="active">{{$event->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    <!-- Main Start -->
    <div id="main">
        <div class="container">
            <div class="row">
                <!--page Content-->
                <div class="col-md-9 event-detail">
                    <section class="event-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="px-media">
                                    <figure>
                                        @if(!empty($event->image) && file_exists(public_path("/uploads/events/".$event->image)))
                                            <img src="/uploads/events/{{$event->image}}" class="img-responsive"
                                                 alt="{{$event->title}}"/>
                                        @else
                                            <img src="/site/assets/images/default/default_event.jpg"
                                                 class="img-responsive" alt="{{$event->title}}">
                                        @endif
                                    </figure>
                                </div>
                                <div class="content">
                                    <div class="heading">
                                        <h4>{{$event->title}}</h4>
                                    </div>
                                    <div class="function-time">
                                        <p>
                                            <span>Tarih: <em>{{ iconv('latin5', 'utf-8', strftime('%d %B %Y, %A', strtotime($event->event_date))) }}</em></span>
                                        </p>
                                        <p><span>Saat: <em>{{ date('H:i', strtotime($event->event_start_time)) }}
                                                - {{ date('H:i', strtotime($event->event_end_time)) }}</em></span>
                                        </p>
                                    </div>
                                    <div class="ticket-info">
                                        <div class="ticket-price">
                                            <h6>Fiyat</h6>
                                            @if($event->is_free)
                                                <p style="font-size: 20px">ÜCRETSİZ</p>
                                            @else
                                                <p style="font-size: 28px"><span>₺</span>{{$event->price}}</p>
                                            @endif
                                        </div>
                                        <div class="description">
                                            <address>
                                                {{$event->location}}<br>
                                                {{$event->address}}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @if(!empty($event->map))
                        <section class="contect-infoarea">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="px-map-sec">
                                        {!! $event->map !!}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if(!empty($event->description))
                        <section class="px-tabs simple">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                                              role="tab"
                                                                              data-toggle="tab" aria-expanded="false">Açıklama</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active"
                                         id="home">
                                        <p>{!! str_replace(array('<b>','</b>'), array('<strong>','</strong>'), $event->description) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if(isset($photos) && sizeof($photos) > 0)
                        <section class="px-gallry classic" style="margin-top: 20px; overflow: hidden">
                            <div class="row">
                                <div class="px-section-title col-md-12">
                                    <h3>FOTO GALERİ</h3>
                                </div>
                                @foreach($photos as $item)
                                    <article class="col-md-4">
                                        <div class="px-media">
                                            <figure>
                                                @if(!empty($item->image) && file_exists(public_path("/uploads/photo_gallery/".$item->photo_gallery->folder_name."/photos/".$item->image)))
                                                    <a href="#"><img
                                                            src="/uploads/photo_gallery/{{$item->photo_gallery->folder_name}}/photos/{{$item->image}}"
                                                            alt="{{$item->title}}"/></a>
                                                @else
                                                    <img
                                                        src="/site/assets/images/default/default_photo_gallery.jpg"
                                                        alt="{{$item->title}}"/>
                                                @endif
                                                <figcaption>
                                                    <div class="caption-inner"><i class="icon-camera5"></i> <a
                                                            href="{{route('site.photoGalleryDetail',$item->photo_gallery->id)}}">{{$item->photo_gallery->title}}</a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                    @if(isset($tags) && !empty($tags))
                        <section class="px-blog tag">
                            <div class="row">
                                <article class="col-md-12">
                                    <h6>Tags</h6>
                                    <ul>
                                        @foreach($tags as $item)
                                            <li><a href="#">{{$item}}</a></li>
                                        @endforeach
                                    </ul>
                                </article>
                            </div>
                        </section>
                    @endif
                </div>
                <!--end page content-->
                <!--sidebar-->
                <aside class="page-sidebar col-md-3">
                    @if(Auth::check() && isset($albums) && sizeof($albums) > 0)
                        <div class="widget widget_albums">
                            <div class="widget-section-title"><h2>Albümler</h2></div>
                            <ul>
                                @foreach($albums as $item)
                                    <li>
                                        <figure>
                                            <a href="#">
                                                @if(!empty($item->image) && file_exists(public_path("/uploads/albums/".$item->image)))
                                                    <img alt="{{$item->album_name}}"
                                                         src="/uploads/albums/{{$item->image}}"
                                                         style="width: 70px; height: 70px">
                                                @else
                                                    <img alt="{{$item->album_name}}"
                                                         src="/site/assets/images/default/default_album.jpg"
                                                         style="width: 70px; height: 70px">
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="px-text">
                                            <h6>
                                                <a href="{{route('site.albumDetail',$item->id)}}">{{$item->album_name}}</a>
                                            </h6>
                                            <a class="buy-album" href="#"><i
                                                    class="icon-music6"></i>{{$item->song->count()}} şarkı</a>
                                        </div>
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
            </div>
        </div>
    </div>
    <!-- Main End -->
@endsection

@section('css')
@endsection

@section('js')
@endsection
