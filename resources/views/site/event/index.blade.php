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
                            <li class="active">Etkinliklerimiz</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($events) && sizeof($events) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <div class="page-content col-md-12">
                        <section class="px-event list">
                            <div class="row">
                                @foreach($events as $item)
                                    <article class="col-md-12">
                                        <div class="icon-box">
                                            <span></span>
                                        </div>
                                        <div class="event-box">
                                            <div class="event-date">
                                                <strong>{{ iconv('latin5', 'utf-8', strftime('%d', strtotime($item->event_date))) }}</strong>
                                                <span>{{ iconv('latin5', 'utf-8', strftime('%B', strtotime($item->event_date))) }}</span>
                                            </div>
                                            <div class="event-inner">
                                                <figure>
                                                    <a href="{{route('site.eventDetail', $item->id)}}">
                                                        @if(!empty($item->image) && file_exists(public_path("/uploads/events/".$item->image)))
                                                            <img src="/uploads/events/{{$item->image}}"
                                                                 alt="{{$item->slug}}"
                                                                 width="170"
                                                                 height="170">
                                                        @else
                                                            <img src="/site/assets/images/default/default_event.jpg"
                                                                 alt="{{$item->slug}}">
                                                        @endif
                                                    </a>
                                                </figure>
                                                <div class="text">
                                                    <h4>
                                                        <a href="{{route('site.eventDetail', $item->id)}}">{{$item->title}}</a>
                                                    </h4>
                                                    <ul>
                                                        <li>
                                                            <i class="icon-calendar5"></i>
                                                            <p>
                                                                {{ iconv('latin5', 'utf-8', strftime('%d %B %Y, %A', strtotime($item->event_date))) }}
                                                                <br>
                                                                {{ date('H:i', strtotime($item->event_start_time)) }}
                                                                - {{ date('H:i', strtotime($item->event_end_time)) }}
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <i class="icon-location6"></i>
                                                            <p>
                                                                {{$item->location}}<br>
                                                                {{$item->address}}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    @if($item->is_free)
                                                        <a href="{{route('site.eventDetail', $item->id)}}"
                                                           class="ticket-btn"
                                                           style="background-color: #ffc600">Ücretsiz</a>
                                                    @else
                                                        <a href="{{route('site.eventDetail', $item->id)}}"
                                                           class="ticket-btn"
                                                           style="background-color: #ffc600">{{$item->price}}₺</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </div>
                    <!-- Page Side Bar Start -->
                    <aside class="page-sidebar col-md-3">
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
                    <!-- Page Side Bar End -->
                </div>
            </div>
        </section>
    @endif
@endsection

@section('css')
@endsection

@section('js')
@endsection
