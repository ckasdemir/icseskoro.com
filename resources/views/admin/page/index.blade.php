@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">İçerik Yönetimi</a></div>
        <h1>İçerik Yönetimi</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                        <h5>İçerikler</h5>
                        <div style="float: right; margin: 3px 10px 3px 3px; overflow: hidden">
                            <a href="{{route('pages.create')}}" class="btn btn-success"><i class="icon-plus"></i> Yeni
                                İçerik Ekle</a>
                        </div>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Başlık</th>
                                <th>İçerik</th>
                                <th width="10%">Kullanıcı Adı</th>
                                <th width="12%">Tarih</th>
                                <th width="3%">Durum</th>
                                <th width="7%">Sırala</th>
                                <th width="12%">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $item)
                                <tr class="gradeA">
                                    <td style="text-align: center">
                                        @if(!empty($item->image))
                                            <a href="/uploads/pages/{{$item->image}}" target="_blank" class="tip"
                                               data-original-title="Resmi göster"><i
                                                    class="icon icon-picture text-success"></i>
                                            </a>
                                        @else
                                            <a href="#" class="tip" data-original-title="Resim yok">
                                                <i class="icon icon-ban-circle text-error"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$item->title}}</td>
                                    <td>{!! str_limit(strip_tags($item->content), 80) !!}...</td>
                                    <td style="text-align: center">{{$item->user->username}}</td>
                                    <td style="text-align: center">{!! date('d.m.Y H:i:s', strtotime($item->created_at)) !!}</td>
                                    <td style="text-align: center">
                                        @if($item->status == 1)
                                            <a href="{{route('pages.passive', $item->id)}}">
                                                <i class="icon-ok text-success" title="Aktif"></i>
                                            </a>
                                        @else
                                            <a href="{{route('pages.active', $item->id)}}">
                                                <i class="icon-off text-error" title="Pasif"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if(!$loop->last)
                                            <a href="{{route('pages.down', $item->id)}}"
                                               class="btn btn-danger btn-mini"
                                               style="float: left; margin-right: 5px"><i
                                                    class="icon icon-chevron-down"></i></a>
                                        @endif

                                        @if(!$loop->first)
                                            <a href="{{route('pages.up', $item->id)}}" class="btn btn-success btn-mini"
                                               style="float: left; margin-right: 5px"><i
                                                    class="icon icon-chevron-up"></i></a>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{route('pages.edit', $item->id)}}" class="btn btn-info btn-mini"
                                           style="float: left; margin-right: 5px"><i
                                                class="icon icon-edit"></i> Düzenle</a>
                                        {!! Form::model($item,['route'=>['pages.destroy',$item->id],'method'=>'DELETE', 'style'=>'float:left']) !!}
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
