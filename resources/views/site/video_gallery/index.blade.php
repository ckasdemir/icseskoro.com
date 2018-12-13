@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>Video Galeri</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">Video Galeri</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($video_gallery) && sizeof($video_gallery) > 0)
        <section class="px-grally fancy-grally box-veiw">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach($video_gallery as $item)
                            <article class="col-md-3">
                                <figure>
                                    @if(!empty($item->image) && file_exists(public_path("/uploads/video_gallery/".$item->folder_name."/".$item->image)))
                                        <img
                                            src="/uploads/video_gallery/{{$item->folder_name}}/{{$item->image}}"
                                            alt="{{$item->title}}"/>
                                    @else
                                        <img
                                            src="/site/assets/images/default/default_video_gallery.jpg"
                                            alt="{{$item->title}}"/>
                                    @endif
                                    <figcaption>
                                        <div class="px-text">
                                            <i class="icon-camera5"></i>
                                            <a href="{{route('site.videoGalleryDetail',$item->id)}}">{{$item->video->count()}}
                                                video</a>
                                            <span>{{$item->title}}</span>
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
