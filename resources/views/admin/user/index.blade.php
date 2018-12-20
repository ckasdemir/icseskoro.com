@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Kullanıcı Yönetimi</a></div>
        <h1>Kullanıcı Yönetimi</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                        <h5>Kullanıcılar</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th>Adı Soyadı</th>
                                <th width="10%">Kullanıcı Adı</th>
                                <th width="10%">Kullanıcı Rolü</th>
                                <th width="12%">Tarih</th>
                                <th width="3%">Durum</th>
                                <th width="15%">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr class="gradeA">
                                    <td style="text-align: center">
                                        @if(!empty($item->image))
                                            <a href="/uploads/users/{{$item->image}}"
                                               target="_blank"
                                               class="tip"
                                               data-original-title="Resmi göster"><i
                                                    class="icon icon-picture text-success"></i>
                                            </a>
                                        @else
                                            <a href="#" class="tip" data-original-title="Resim yok">
                                                <i class="icon icon-ban-circle text-error"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->role}}</td>
                                    <td style="text-align: center">{!! date('d.m.Y H:i:s', strtotime($item->created_at)) !!}</td>
                                    <td style="text-align: center">
                                        @if($item->status == 1)
                                            <a href="{{route('users.passive', $item->id)}}">
                                                <i class="icon-ok text-success" title="Aktif"></i>
                                            </a>
                                        @else
                                            <a href="{{route('users.active', $item->id)}}">
                                                <i class="icon-off text-error" title="Pasif"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if($item->role == "admin")
                                            <a href="{{route('users.role', $item->id)}}" class="btn btn-info btn-mini"
                                               style="float: left; margin-right: 5px"><i
                                                    class="icon icon-edit"></i> Admini Kaldır</a>
                                        @else
                                            <a href="{{route('users.role', $item->id)}}"
                                               class="btn btn-warning btn-mini"
                                               style="float: left; margin-right: 5px"><i
                                                    class="icon icon-edit"></i> Admin Yap</a>
                                        @endif
                                        {!! Form::model($item,['route'=>['users.destroy',$item->id],'method'=>'DELETE', 'style'=>'float:left']) !!}
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
