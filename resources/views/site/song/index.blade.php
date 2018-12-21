@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>YÜKLEMELERİM</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">Yüklemelerim</li>
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
                <section class="px-result relevent other">
                    <div class="col-md-9">
                        <div class="content">
                            <div class="row">
                                @if(isset($songs) && sizeof($songs) > 0)
                                    @foreach($songs as $item)
                                        <article class="col-md-12">
                                            <div class="px-result blog">
                                                <div class="px-media">
                                                    <figure>
                                                        @if(!empty($item->album->image) && file_exists(public_path("/uploads/albums/".$item->album->folder_name."/".$item->image)))
                                                            <img
                                                                src="/uploads/albums/{{$item->album->folder_name}}/{{$item->album->image}}"
                                                                class="img-responsive" alt="{{$item->song_name}}">
                                                        @else
                                                            <img src="/site/assets/images/default/default_album.jpg"
                                                                 class="img-responsive" alt="{{$item->song_name}}">
                                                        @endif
                                                        <figcaption><a href="#."></a></figcaption>
                                                    </figure>
                                                </div>
                                                <div class="description">
                                                    <div class="text">
                                                        <div class="post-option">
                                                            <div
                                                                class="px-time">{{date('d.m.Y', strtotime($item->created_at))}}</div>
                                                            <h5>{{ $item->song_name }}</h5>
                                                        </div>
                                                        <p>{{ $item->album->album_name }}</p>
                                                        <div class="posted">
                                                            <ul>
                                                                @if(!empty($item->document))
                                                                    <li>
                                                                        <a href="{{route('download.document',$item->id)}}"
                                                                           title="{{$item->song_name}} dokümanı indir">
                                                                            {{request()->root().'/uploads/albums/'.$item->album->folder_name.'/songs/'.$item->document}}
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if(!empty($item->recording))
                                                                    <li>
                                                                        <a href="{{route('download.recording',$item->id)}}"
                                                                           title="{{$item->song_name}} ses dosyasını indir">
                                                                            {{request()->root().'/uploads/albums/'.$item->album->folder_name.'/songs/'.$item->recording}}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <aside class="page-sidebar col-md-3">
                        @if(isset($advertisements) && sizeof($advertisements) > 0)
                            @foreach($advertisements as $item)
                                @if(!empty($item->image) && file_exists(public_path("/uploads/advertisements/".$item->image)))
                                    <div class="widget widget_advertisement">
                                        <figure>
                                            <a href="{{$item->url}}" title="{{$item->title}}"
                                               @if($item->url != "#") target="_blank" @endif />
                                            <img alt="{{$item->slug}}"
                                                 src="/uploads/advertisements/{{$item->image}}"
                                                 style="width: 250px; height: 250px">
                                            </a>
                                        </figure>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </aside>
                    <!--end sidebar-->
                </section>
            </div>
        </div>
    </section>
    <section class="bg-form">
        <div class="container">
            <div class="row">
                <section class="px-form plain">
                    <div class="col-md-12">
                        <div class="px-fancy-heading align-center">
                            <div class="px-spreater2">
                                <div class="divider">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <h2>ŞARKI YÜKLE</h2>
                        </div>
                        <form action="{{route('site.upload')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <label>
                                <i class="icon-music5"></i>
                                <select required="required" name="album_id" style="text-transform: none">
                                    <option value="0" selected>--- Albüm Seçiniz ---</option>
                                    @foreach($albums as $item)
                                        <option value="{{ $item->id }}">{{ $item->album_name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                <i class="icon-microphone5"></i>
                                <input type="text" required="required" class=" " placeholder="Şarkı adı"
                                       style="text-transform: none"
                                       name="song_name">
                            </label>
                            <label>
                                <i class="icon-file-text"></i>
                                <input type="file" id="file-document" class=" "
                                       style="text-transform: none"
                                       name="document">
                                <span
                                    style="font-size: 14px; font-weight: 500; position: absolute; bottom:15px; left:20px; display: block;">Doküman yükle</span>
                            </label>
                            <label>
                                <i class="icon-sound3"></i>
                                <input type="file" id="file-recording" class=" " style="text-transform: none"
                                       name="recording">
                                <span
                                    style="font-size: 14px; font-weight: 500; position: absolute; bottom:15px; left:20px; display: block;">Şarkı yükle</span>
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="YÜKLE">
                            </label>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
