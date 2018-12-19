@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>{{$photo_gallery->title}}</h2>
                        @if(!empty($photo_gallery->description))
                            <span>{{$photo_gallery->description}}</span>
                        @endif
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li><a href="{{route('site.photoGallery')}}">Foto Galeri</a></li>
                            <li class="active">{{$photo_gallery->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($photos) && sizeof($photos) > 0)
        <section class="px-grally fancy-grally box-veiw">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach($photos as $item)
                            <article class="col-md-3">
                                <figure>
                                    @if(!empty($item->image) && file_exists(public_path("/uploads/photo_gallery/".$item->photo_gallery->folder_name."/photos/".$item->image)))
                                        <img
                                            src="/uploads/photo_gallery/{{$item->photo_gallery->folder_name}}/photos/{{$item->image}}"
                                            alt="{{$item->title}}"/>
                                    @else
                                        <img
                                            src="/site/assets/images/default/default_photo_gallery.jpg"
                                            alt="{{$item->title}}"/>
                                    @endif
                                    <figcaption>
                                        <div class="px-text">
                                            <i class="icon-camera5"></i>
                                            <a href="#">{{$item->title}}</a>
                                            <span>{!! $item->description !!}</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('css')
@endsection

@section('js')
@endsection
