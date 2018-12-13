@extends('admin.template.layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Profilim</a></div>
        <h1>Profilim</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Profil Güncelle</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($user, ['route'=>['users.update', $user->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Adınız ve Soyadız :</label>
                            <div class="controls">
                                <input type="text" name="name" class="span11" value="{{$user->name}}"
                                       placeholder="Adınız ve Soyadız"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Grup :</label>
                            <div class="controls">
                                <select class="span11" name="voice_type_id">
                                    @foreach($voice_types as $item)
                                        @if($item->id == $user->voice_type_id)
                                            <option value="{{$item->id}}" selected>{{$item->type_name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Cinsiyet :</label>
                            <div class="controls">
                                @if($user->gender == 0)
                                    <label>
                                        <input type="radio" name="gender" value="0" checked/>
                                        Kadın</label>
                                    <label>
                                        <input type="radio" name="gender" value="1"/>
                                        Erkek</label>
                                @else
                                    <label>
                                        <input type="radio" name="gender" value="0"/>
                                        Kadın</label>
                                    <label>
                                        <input type="radio" name="gender" value="1" checked/>
                                        Erkek</label>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">E - Posta Adresiniz :</label>
                            <div class="controls">
                                <input type="text" name="email" class="span11" value="{{$user->email}}"
                                       placeholder="E - Posta Adresiniz"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Telefon :</label>
                            <div class="controls">
                                <input type="tel" name="phone" class="span11" value="{{$user->phone}}"
                                       placeholder="Telefon" maxlength="11"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Şifre :</label>
                            <div class="controls">
                                <input type="password" name="password" class="span11" maxlength="11"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Profil Resmi :</label>
                            <div class="controls">
                                <input type="file" name="image"/>

                                @if(!empty($user->image))
                                    <a href="/uploads/users/{{$user->image}}" title="{{$user->name}}"
                                       alt="{{$user->name}}" target="_blank">Resmi göster</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Kaydet</button>
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
