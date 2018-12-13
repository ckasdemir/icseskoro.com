@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Şarkı Düzenle</a></div>
        <h1>Şarkı Düzenle</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Şarkı Düzenle : {{$song->song_name}}</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($song, ['route'=>['songs.update', $song->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Albüm :</label>
                            <div class="controls">
                                <select class="span11" name="album_id">
                                    @foreach($albums as $item)
                                        @if($item->id == $song->album_id)
                                            <option value="{{$item->id}}" selected>{{$item->album_name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->album_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Şarkı Adı :</label>
                            <div class="controls">
                                <input type="text" name="song_name" class="span11" value="{{$song->song_name}}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Doküman :</label>
                            <div class="controls">
                                <input type="file" name="document"/>

                                @if(!empty($song->document) && file_exists(public_path("/uploads/albums/".$song->album->folder_name.'/songs/'.$song->document)))
                                    <a href="{{route('songs.document',$song->id)}}" class="tip"
                                       data-original-title="Dosyayı indir" style="margin-right: 5px"><i
                                            class="icon icon-download-alt text-success"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Ses Dosyası :</label>
                            <div class="controls">
                                <input type="file" name="recording"/>

                                @if(!empty($song->recording) && file_exists(public_path("/uploads/albums/".$song->album->folder_name.'/songs/'.$song->recording)))
                                    <a href="{{route('songs.recording',$song->id)}}" class="tip"
                                       data-original-title="Ses dosyası indir"><i
                                            class="icon icon-volume-up text-info"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Durum :</label>
                            <div class="controls">
                                @if($song->status == 1)
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
                                    onclick="window.location.href='{{route('songs.index')}}'">İptal
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
