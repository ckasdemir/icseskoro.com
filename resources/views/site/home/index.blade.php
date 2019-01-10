@extends('site/template/layout')

@section('content')
    @if(isset($pages) && sizeof($pages) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <section class="px-biography">
                        <article class="col-md-6">
                            <div class="px-text">
                                <div class="main-heading">
                                    <h2>{{$pages[0]->title}}</h2>
                                </div>
                                {!! str_limit(str_replace(array('<b>','</b>'), array('<strong>','</strong>'), $pages[0]->content), 1200) !!}
                            </div>
                        </article>
                        <article class="col-md-6">
                            <figure>
                                @if(!empty($pages[0]->image) && file_exists(public_path("/uploads/pages/".$pages[0]->image)))
                                    <img src="/uploads/pages/{{$pages[0]->image}}"
                                         style="max-width: 520px; max-height: 520px"/>
                                @else
                                    <img src="/site/assets/images/default/default_page.jpg"
                                         style="max-width: 520px; max-height: 520px"/>
                                @endif
                            </figure>
                        </article>
                    </section>
                </div>
            </div>
        </section>
    @endif

    @if(isset($next_event))
        <section class="counter-bg">
            <div class="container">
                <div class="row">
                    <section class="px-counter">
                        <div class="col-md-12">
                            <div class="main-heading">
                                <h2>GELECEK PROGRAM</h2>
                            </div>
                            <div class="px-countdown">
                                <time
                                    datetime="{{ date('Y-m-d', strtotime($next_event->event_date))}}T{{ date('H:i:s', strtotime($next_event->event_start_time)) }}">
                                    {{ date('l, d F Y H:i', strtotime($next_event->event_date)) }}
                                </time>
                            </div>
                            <div class="px-holder">
                                <article>
                                    <h3>{{$next_event->title}}</h3>
                                </article>
                                <article>
                                    <figure>
                                        <img src="/site/assets/extra-images/icon-claendar.png" alt=""/>
                                        <figcaption>
                                            <span>{{ iconv('latin5','utf-8',strftime('%d %B %Y, %A', strtotime($next_event->event_date))) }}</span><br/>
                                            <span>{{ date('H:i', strtotime($next_event->event_start_time)) }} - {{ date('H:i', strtotime($next_event->event_end_time)) }}</span>
                                        </figcaption>
                                    </figure>
                                    <figure>
                                        <img src="/site/assets/extra-images/icon-price.png" alt=""
                                             style="width: 24px; height: 24px; margin-top: 0px; overflow: hidden"/>
                                        <figcaption>
                                             <span>
                                                 @if($next_event->is_free || $next_event->price == 0)
                                                     ÜCRETSİZ
                                                 @else
                                                     {{$next_event->price}}₺
                                                 @endif
                                             </span>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article>
                                    <figure><img src="/site/assets/extra-images/icon-location.png" alt=""/>
                                        <figcaption>
                                             <span>{{$next_event->location}}<br>
                                                   {{$next_event->address}}
                                             </span>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article>
                                    <a href="{{route('site.eventDetail', $next_event->id)}}"
                                       class="px-readmore">DETAY</a>
                                </article>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif

    @if(isset($events) && sizeof($events) > 0)
        <section class="upcoming-event">
            <div class="container">
                <div class="row">
                    <section class="px-event list">
                        <div class="row">
                            <div class="main-heading">
                                <h2>ETKİNLİKLERİMİZ</h2>
                            </div>
                            @foreach($events as $item)
                                <article class="col-md-6">
                                    <div class="event-box box">
                                        <div class="event-date box">
                                            <div class="date-inner">
                                                <strong>{{ iconv('latin5', 'utf-8', strftime('%d', strtotime($item->event_date))) }}</strong>
                                                <span>{{ iconv('latin5', 'utf-8', strftime('%B', strtotime($item->event_date))) }}</span>
                                            </div>
                                        </div>
                                        <div class="event-inner box">
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
                                                @if($item->is_free || $item->price == 0)
                                                    <a href="#"
                                                       class="ticket-btn" style="background-color: #ffc600">Ücretsiz</a>
                                                @else
                                                    <a href="#"
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
            </div>
        </section>
    @endif

    @if(isset($users) && sizeof($users) > 0)
        <section class="px-team-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-heading">
                            <h2>KORO ÜYELERİMİZ</h2>
                        </div>
                        <div class="px-team team-grid">
                            <div class="row">
                                @if(isset($isShowToUser) && sizeof($isShowToUser) > 0)
                                    <article class="col-md-4">
                                        <figure class="effect-selena">
                                            @if(!empty($isShowToUser[0]->image) && file_exists(public_path("/uploads/users/".$isShowToUser[0]->image)))
                                                <a href="#"><img
                                                        src="/uploads/users/{{$isShowToUser[0]->image}}" alt=""/>
                                                </a>
                                            @else
                                                <a href="#"><img
                                                        src="/site/assets/images/default/default_user.jpg" alt=""/>
                                                </a>
                                            @endif
                                            <figcaption>

                                            </figcaption>
                                        </figure>
                                        <div class="px-text"><a href="#">{{$isShowToUser[0]->name}}</a>
                                            @if($isShowToUser[0]->voice_type_id > 0)
                                                <span>{{$isShowToUser[0]->voice_type->type_name}}</span>
                                            @endif
                                        </div>
                                    </article>
                                @endif

                                @foreach($users as $item)
                                    <article class="col-md-4">
                                        <figure class="effect-selena">
                                            @if(!empty($item->image) && file_exists(public_path("/uploads/users/".$item->image)))
                                                <a href="#"><img
                                                        src="/uploads/users/{{$item->image}}" alt=""/>
                                                </a>
                                            @else
                                                <a href="#"><img
                                                        src="/site/assets/images/default/default_user.jpg" alt=""/>
                                                </a>
                                            @endif
                                            <figcaption>

                                            </figcaption>
                                        </figure>
                                        <div class="px-text"><a href="#">{{$item->name}}</a>
                                            @if($item->voice_type_id > 0)
                                                <span>{{$item->voice_type->type_name}}</span>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(isset($news) && sizeof($news) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <section class="px-band-news">
                        <div class="col-md-12">
                            <div class="main-heading">
                                <h2>BİZDEN HABERLER</h2>
                            </div>
                            <div class="holder">
                                @foreach($news as $item)
                                    <article class="col-md-12">
                                        <div class="px-holder">
                                            <img src="/site/assets/images/default/default_news.jpg"
                                                 alt="{{$item->title}}"/>
                                            <div class="px-info"><span
                                                    class="px-author"><em>by</em> {{$item->user->username}}</span>
                                                <h3>
                                                    <a href="{{route('site.newsDetail', $item->id)}}">{{$item->title}}</a>
                                                </h3>
                                                <span class="date"><i
                                                        class="icon-circle-thin"></i>{{ date('d.m.Y H:i', strtotime($item->created_at))}}</span>
                                                <a href="{{route('site.newsDetail', $item->id)}}" class="btn-next"><img
                                                        src="/site/assets/images/arrow.png"
                                                        alt="{{$item->title}}"/></a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif

    @if(isset($photos) && sizeof($photos) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <section class="px-fancy-heading text-center">
                        <div class="col-md-12">
                            <div class="px-spreater">
                                <div class="box-spreater"><i class="icon-camera5"></i></div>
                            </div>
                            <h2>FOTO GALERİ</h2>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <section class="px-grally fancy-grally">
            <div class="col-md-12">
                <div class="row">
                    @foreach($photos as $item)
                        <article class="col-md-2">
                            <figure class="effect-selena">
                                @if(!empty($item->image) && file_exists(public_path("/uploads/photo_gallery/".$item->photo_gallery->folder_name."/photos/".$item->image)))
                                    <img
                                        src="/uploads/photo_gallery/{{$item->photo_gallery->folder_name}}/photos/{{$item->image}}"
                                        alt="{{$item->title}}" width="296" height="222"/>
                                @else
                                    <img
                                        src="/site/assets/images/default/default_photo_gallery.jpg"
                                        alt="{{$item->title}}"/>
                                @endif
                                <figcaption>
                                    <div class="px-text">
                                        <i class="icon-camera5"></i>
                                        <a href="{{route('site.photoGalleryDetail',$item->photo_gallery->id)}}">{{$item->photo_gallery->photo->count()}}
                                            fotoğraf</a>
                                        <span>{{$item->photo_gallery->title}}</span>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($partners) && sizeof($partners) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <section class="px-band-partner">
                        <div class="col-md-12">
                            <div class="main-heading">
                                <h2>Partnerlerimiz</h2>
                            </div>
                            <ul class="px-partners">
                                @foreach($partners as $item)
                                    <li>
                                        <a href="{{$item->url}}" target="_blank">
                                            <img src="/uploads/partners/{{$item->logo}}"
                                                 style="max-width: 140px; max-height: 68px;"
                                                 alt="{{$item->partner_name}}"/>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
