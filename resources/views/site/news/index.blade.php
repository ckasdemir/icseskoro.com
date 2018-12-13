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
                            <li class="active">Haberler</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($news) && sizeof($news) > 0)
        <section>
            <div class="container">
                <div class="row">
                    <!-- Page Content Start -->
                    <div class="page-content">
                        <section class="px-blog large">
                            <div class="col-md-12">
                                <h3>Haberler</h3>
                                <div class="row">
                                    @foreach($news as $item)
                                        <article class="col-md-12">
                                            <div class="px-media">
                                                <figure>
                                                    @if(!empty($item->image) && file_exists(public_path("/uploads/news/".$item->image)))
                                                        <img src="/uploads/news/{{$item->image}}"
                                                             class="img-responsive" alt="{{$item->title}}">
                                                    @else
                                                        <img src="/site/assets/images/default/default_news_blog.jpg"
                                                             class="img-responsive" alt="{{$item->title}}">
                                                    @endif
                                                    <figcaption><a href="{{route('site.newsDetail', $item->id)}}"></a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                            <div class="description">
                                                <div class="text">
                                                    <div class="post-option">
                                                        <div
                                                            class=px-time>{{date('d-m-Y', strtotime($item->created_at))}}</div>
                                                        <h5>
                                                            <a href="{{route('site.newsDetail', $item->id)}}">{{$item->title}}</a>
                                                        </h5>
                                                        <div class="px-posted"><span>by <a class=""
                                                                                           href="#">{{$item->user->username}}</a></span>
                                                        </div>
                                                    </div>
                                                    <p>{!! str_limit($item->content, 300) !!}...</p>
                                                    <div class="read-more">
                                                        <ul>
                                                            <li><a href="{{route('site.newsDetail', $item->id)}}"
                                                                   class="px-read">Devamını oku</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- Page Content End -->
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
