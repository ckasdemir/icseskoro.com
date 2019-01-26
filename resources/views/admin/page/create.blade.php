@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="{{route('admin.index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">İçerik Ekle</a></div>
        <h1>İçerik Ekle</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>İçerik Ekle</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::open(['route'=>'pages.store','method'=>'POST','class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Başlık :</label>
                            <div class="controls">
                                <input type="text" name="title" class="span11" placeholder="İçerik başlığı"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">İçerik :</label>
                            <div class="controls">
                                <textarea class="textarea_editor span11" name="content" rows="20"
                                          placeholder="İçerik yazısı ..."></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Resim :</label>
                            <div class="controls">
                                <input type="file" name="image"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Anasayfada Gösterilsin mi? :</label>
                            <div class="controls">
                                <label>
                                    <input type="radio" name="is_show_to_homepage" value="1"/>
                                    Evet</label>
                                <label>
                                    <input type="radio" name="is_show_to_homepage" value="0" checked/>
                                    Hayır</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Durum :</label>
                            <div class="controls">
                                <label>
                                    <input type="radio" name="status" value="1"/>
                                    Aktif</label>
                                <label>
                                    <input type="radio" name="status" value="0" checked/>
                                    Pasif</label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Kaydet</button>
                            <button type="button" class="btn btn-danger"
                                    onclick="window.location.href='{{route('pages.index')}}'">İptal
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
    <script>
        $('.textarea_editor').wysihtml5();
    </script>
@endsection
