@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Foto Galeri Düzenle</a></div>
        <h1>Foto Galeri Düzenle</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Foto Galeri Düzenle : {{$photo_gallery->title}}</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($photo_gallery, ['route'=>['photo_gallery.update', $photo_gallery->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Başlık :</label>
                            <div class="controls">
                                <input type="text" name="title" class="span11" value="{{$photo_gallery->title}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Açıklama :</label>
                            <div class="controls">
                                <textarea class="span11" name="description"
                                          rows="6">{{$photo_gallery->description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Kapak Resmi :</label>
                            <div class="controls">
                                <input type="file" name="image"/>

                                @if(!empty($photo_gallery->image))
                                    <a href="/uploads/photo_gallery/{{$photo_gallery->folder_name}}/{{$photo_gallery->image}}"
                                       title="{{$photo_gallery->slug}}"
                                       alt="{{$photo_gallery->slug}}" target="_blank">Resmi göster</a>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Durum :</label>
                            <div class="controls">
                                @if($photo_gallery->status == 1)
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
                                    onclick="window.location.href='{{route('photo_gallery.index')}}'">İptal
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
