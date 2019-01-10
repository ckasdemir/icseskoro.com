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
                                            alt="{{$item->title}}" width="250" height="188"/>
                                    @else
                                        <img
                                            src="/site/assets/images/default/default_photo_gallery.jpg"
                                            alt="{{$item->title}}"/>
                                    @endif
                                    <figcaption>
                                        <div class="px-text">
                                            <i class="icon-camera5"></i>
                                            <a href="/uploads/photo_gallery/{{$item->photo_gallery->folder_name}}/photos/{{$item->image}}"
                                               data-toggle="lightbox" data-gallery="example-gallery">{{$item->title}}</a>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"/>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
    <script type="text/javascript">
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection
