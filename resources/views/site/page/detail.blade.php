@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>{{$page->title}}</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">{{$page->title}}</li>
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
                            <div class="row">
                                <article class="col-md-12">
                                    <div class="px-media">
                                        <figure>
                                            @if(!empty($page->image) && file_exists(public_path("/uploads/pages/".$page->image)))
                                                <img src="/uploads/pages/{{$page->image}}" class="img-responsive"
                                                     alt="{{$page->title}}"/>
                                            @else
                                                <img src="/site/assets/images/default/default_page_blog.jpg"
                                                     class="img-responsive" alt="{{$page->title}}"/>
                                            @endif
                                            <figcaption><a href="#."></a></figcaption>
                                        </figure>
                                    </div>
                                    <div class="description">
                                        <div class="text">
                                            <p>{!! $page->content !!}</p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
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
                                                <a href="#" title="{{$item->name}}"><img src="/uploads/users/{{$item->image}}"
                                                                 alt="{{$item->name}}"
                                                                 style="width: 250px; height: 250px"></a>
                                            @else
                                                <a href="#" title="{{$item->name}}"><img src="/site/assets/images/default/default_user.jpg"
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
@endsection

@section('css')
@endsection

@section('js')
@endsection
