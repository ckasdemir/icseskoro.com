@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>Haberler</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li><a href="{{route('site.news')}}">Haberler</a></li>
                            <li class="active">{{$news->title}}</li>
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
                <div class="page-content">
                    <div class="col-md-12">
                        <!-- Blog Detail -->
                        <section class="px-blog detail">
                            <h2>{{$news->title}}</h2>
                            <div class="row">
                                <article class="col-md-12">
                                    <div class="px-media">
                                        <figure>
                                            @if(!empty($news->image) && file_exists(public_path("/uploads/news/".$news->image)))
                                                <img src="/uploads/news/{{$news->image}}" class="img-responsive"
                                                     alt="{{$news->title}}">
                                            @else
                                                <img src="/site/assets/images/default/default_news_blog.jpg"
                                                     class="img-responsive" alt="{{$news->title}}">
                                            @endif
                                            <figcaption><a href="#."></a></figcaption>
                                        </figure>
                                    </div>
                                    <div class="description">
                                        <div class="info">
                                            <div class="post-option">
                                                <div class="px-media">
                                                    <figure>
                                                        @if(!empty($news->user->image) && file_exists(public_path("/uploads/users/".$news->user->image)))
                                                            <img src="/uploads/users/{{$news->user->image}}"
                                                                 class="img-responsive" alt="{{$news->user->username}}">
                                                        @else
                                                            <img src="/site/assets/images/default/default_user.jpg"
                                                                 class="img-responsive" alt="{{$news->user->username}}">
                                                        @endif
                                                    </figure>
                                                </div>
                                                <div class="content">
                                                    <div class=px-time>
                                                        <span>TARİH:</span>{{date('d.m.Y', strtotime($news->created_at))}}
                                                    </div>
                                                    <div class="px-posted"><span> by <a class=""
                                                                                        href="#">{{$news->user->username}}</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text">
                                            {!! $news->content !!}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
                        <!-- Blog tags -->
                        @if(isset($tags) && !empty($tags))
                            <section class="px-blog tag">
                                <div class="row">
                                    <article class="col-md-12">
                                        <h6>Tags</h6>
                                        <ul>
                                            @foreach($tags as $item)
                                                <li><a href="">{{$item}}</a></li>
                                            @endforeach
                                        </ul>
                                    </article>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
                <!-- Page Side Bar Start -->
                <aside class="page-sidebar col-md-3">
                    @if(isset($recent_news) && sizeof($recent_news) > 0)
                        <div class="widget widget_recentblog">
                            <div class="widget-section-title"><h2>EN SON HABERLER</h2></div>
                            <ul>
                                @foreach($recent_news as $item)
                                    <li>
                                        <figure><a href="{{route('site.newsDetail', $item->id)}}">
                                                @if(!empty($item->image) && file_exists(public_path("/uploads/news/".$item->image)))
                                                    <img alt="{{$item->title}}" src="/uploads/news/{{$item->image}}"
                                                         style="width: 70px; height: 44px;">
                                                @else
                                                    <img src="/site/assets/images/default/default_news_blog.jpg"
                                                         class="img-responsive" alt="{{$news->title}}">
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="px-text">
                                            <span>{{date('d.m.Y', strtotime($item->created_at))}}</span>
                                            <h6><a href="{{route('site.newsDetail', $item->id)}}">{{$item->title}}</a>
                                            </h6>
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
                <!-- Page Side Bar End -->
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
@endsection
