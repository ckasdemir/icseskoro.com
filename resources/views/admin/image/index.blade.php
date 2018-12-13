@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Resim Yönetimi</a></div>
        <h1>Resim Yönetimi</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                {!! Form::open(['route'=>'images.store','method'=>'POST','class'=>'form-inline', 'files' => 'true']) !!}
                <div class="control-group" style="border: none">
                    <div class="controls">
                        <input type="file" name="filename" class="span12"/>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-picture"></i> </span>
                        <h5>Resim Yönetimi</h5>
                    </div>
                    <div class="widget-content">
                        <ul class="thumbnails">
                            @foreach($images as $item)
                                <li class="span2"><a><img src="/uploads/contents/{{$item->filename}}"
                                                          alt="/uploads/contents/{{$item->filename}}"
                                                          style="width: 176px; height: 99px;"></a>
                                    <div class="actions">
                                        <a href="{{ route('image.delete', $item->id) }}"><i
                                                class="icon icon-trash"></i></a>
                                        <a class="lightbox_trigger" href="/uploads/contents/{{$item->filename}}"><i
                                                class="icon-search"></i>
                                        </a>
                                    </div>
                                    <span class="text-white">/uploads/contents/{{$item->filename}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/admin/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="/admin/css/uniform.css"/>
    <link rel="stylesheet" href="/admin/css/select2.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-style.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-media.css"/>
@endsection

@section('js')
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/js/jquery.ui.custom.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/jquery.uniform.js"></script>
    <script src="/admin/js/select2.min.js"></script>
    <script src="/admin/js/jquery.dataTables.min.js"></script>
    <script src="/admin/js/matrix.js"></script>
    <script src="/admin/js/matrix.tables.js"></script>
@endsection
