@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Video Yönetimi</a></div>
        <h1>Video Yönetimi</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                        <h5>Videolar</h5>
                        <div style="float: right; margin: 3px 10px 3px 3px; overflow: hidden">
                            <a href="{{route('videos.create')}}" class="btn btn-success"><i class="icon-plus"></i>
                                Yeni
                                Video Ekle</a>
                        </div>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Başlık</th>
                                <th>Video Galeri Adı</th>
                                <th width="10%">Kullanıcı Adı</th>
                                <th width="12%">Tarih</th>
                                <th width="3%">Durum</th>
                                <th width="12%">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $item)
                                <tr class="gradeA">
                                    <td style="text-align: center">
                                        @if(!empty($item->video))
                                            <a href="{{$item->video}}" target="_blank" class="tip"
                                               data-original-title="Videoyu göster"><i
                                                    class="icon icon-facetime-video text-success"></i>
                                            </a>
                                        @else
                                            <a href="#" class="tip" data-original-title="Video yok">
                                                <i class="icon icon-ban-circle text-error"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->video_gallery->title}}</td>
                                    <td style="text-align: center">{{$item->user->username}}</td>
                                    <td style="text-align: center">{!! date('d.m.Y H:i:s', strtotime($item->created_at)) !!}</td>
                                    <td style="text-align: center">
                                        @if($item->status == 1)
                                            <a href="{{route('videos.passive', $item->id)}}">
                                                <i class="icon-ok text-success" title="Aktif"></i>
                                            </a>
                                        @else
                                            <a href="{{route('videos.active', $item->id)}}">
                                                <i class="icon-off text-error" title="Pasif"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{route('videos.edit', $item->id)}}" class="btn btn-info btn-mini"
                                           style="float: left; margin-right: 5px"><i
                                                class="icon icon-edit"></i> Düzenle</a>
                                        {!! Form::model($item,['route'=>['videos.destroy',$item->id],'method'=>'DELETE', 'style'=>'float:left']) !!}
                                        <button class="btn btn-danger btn-mini"><i class="icon icon-trash"></i> Sil
                                        </button>
                                        {!! Form::close() !!}
                                        <div style="clear: both"></div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
