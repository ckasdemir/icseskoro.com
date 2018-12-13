@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Video Düzenle</a></div>
        <h1>Video Düzenle</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Video Düzenle</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($video, ['route'=>['videos.update', $video->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Video Galeri :</label>
                            <div class="controls">
                                <select class="span11" name="video_gallery_id">
                                    @foreach($video_gallery as $item)
                                        @if($item->id == $video->video_gallery_id)
                                            <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Başlık :</label>
                            <div class="controls">
                                <input type="text" name="title" class="span11" value="{{$video->title}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Açıklama :</label>
                            <div class="controls">
                                <textarea class="span11" name="description" rows="6">{{$video->description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Kanal :</label>
                            <div class="controls">
                                <select name="channel">
                                    <option value="youtube" @if($video->channel == "youtube") selected @endif>Youtube
                                    </option>
                                    <option value="vimeo" @if($video->channel == "vimeo") selected @endif>Vimeo</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">URL :</label>
                            <div class="controls">
                                <input type="text" name="video" class="span11"
                                       value="{{$video->video}}"/>
                            </div>
                            <p style="text-align: center">Örn: https://www.youtube.com/watch?v=<b style="color: #FF0000;">AyRpGcXSgvc</b></p>
                            <p style="text-align: center">Örn: https://vimeo.com/<b style="color: #FF0000;">16299637</b></p>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Durum :</label>
                            <div class="controls">
                                @if($video->status == 1)
                                    <label>
                                        <input type="radio" name="status" value="1" checked/>
                                        Aktif</label>
                                    <label>
                                        <input type="radio" name="status" value="0"/>
                                        Pasif</label>
                                @else
                                    <label>
                                        <input type="radio" name="status" value="1"/>
                                        Aktif</label>
                                    <label>
                                        <input type="radio" name="status" value="0" checked/>
                                        Pasif</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Kaydet</button>
                            <button type="button" class="btn btn-danger"
                                    onclick="window.location.href='{{route('videos.index')}}'">İptal
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/admin/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="/admin/css/colorpicker.css"/>
    <link rel="stylesheet" href="/admin/css/datepicker.css"/>
    <link rel="stylesheet" href="/admin/css/uniform.css"/>
    <link rel="stylesheet" href="/admin/css/select2.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-style.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-media.css"/>
    <link rel="stylesheet" href="/admin/css/bootstrap-wysihtml5.css"/>
@endsection

@section('js')
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/js/jquery.ui.custom.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/bootstrap-colorpicker.js"></script>
    <script src="/admin/js/bootstrap-datepicker.js"></script>
    <script src="/admin/js/jquery.toggle.buttons.js"></script>
    <script src="/admin/js/masked.js"></script>
    <script src="/admin/js/jquery.uniform.js"></script>
    <script src="/admin/js/select2.min.js"></script>
    <script src="/admin/js/matrix.js"></script>
    <script src="/admin/js/matrix.form_common.js"></script>
    <script src="/admin/js/wysihtml5-0.3.0.js"></script>
    <script src="/admin/js/jquery.peity.min.js"></script>
    <script src="/admin/js/bootstrap-wysihtml5.js"></script>
@endsection
