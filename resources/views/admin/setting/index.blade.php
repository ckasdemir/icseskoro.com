@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Ayarlar</a></div>
        <h1>Ayarlar</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Ayarlar</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($setting, ['route'=>['settings.update', $setting->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Başlık :</label>
                            <div class="controls">
                                <input type="text" name="title" class="span11" value="{{$setting->title}}"
                                       placeholder="Site başlığı"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Anahtar Kelimeler :</label>
                            <div class="controls">
                                <textarea class="span11" placeholder="Site anahtar kelimeleri" name="keywords"
                                          rows="6">{{$setting->keywords}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Açıklama :</label>
                            <div class="controls">
                                <textarea class="span11" placeholder="Site açıklaması" name="description"
                                          rows="6">{{$setting->description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Site Logo :</label>
                            <div class="controls">
                                <input type="file" name="logo"/>

                                @if(!empty($setting->logo))
                                    <a href="/site/assets/images/{{$setting->logo}}" title="{{$setting->title}}"
                                       alt="{{$setting->title}}" target="_blank">Resmi göster</a>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Adres :</label>
                            <div class="controls">
                                <textarea class="span11" placeholder="Adres" name="address"
                                          rows="6">{{$setting->address}}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">E-Posta :</label>
                            <div class="controls">
                                <input type="text" name="email" class="span11" value="{{$setting->email}}"
                                       placeholder="E-Posta adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Telefon :</label>
                            <div class="controls">
                                <input type="text" name="mobile" class="span11" value="{{$setting->mobile}}"
                                       placeholder="Telefon numarası"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Harita :</label>
                            <div class="controls">
                                <textarea class="span11" placeholder="Harita" name="map"
                                          rows="6">{{$setting->map}}</textarea>
                            </div>
                            <span
                                style="color: #ff0f07; text-align: center"><p>width=<strong>"100%"</strong> height=<strong>"370"</strong></p></span>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Çalışma Günleri</label>
                            <div class="controls">
                                <label>
                                    @if($setting->work_days_1 == true)<input type="checkbox" name="work_days_1"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_1" value="1"/>
                                    @endif
                                    Pazartesi</label>
                                <label>
                                    @if($setting->work_days_2 == true)<input type="checkbox" name="work_days_2"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_2" value="1"/>
                                    @endif
                                    Salı</label>
                                <label>
                                    @if($setting->work_days_3 == true)<input type="checkbox" name="work_days_3"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_3" value="1"/>
                                    @endif
                                    Çarşamba</label>
                                <label>
                                    @if($setting->work_days_4 == true)<input type="checkbox" name="work_days_4"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_4" value="1"/>
                                    @endif
                                    Perşembe</label>
                                <label>
                                    @if($setting->work_days_5 == true)<input type="checkbox" name="work_days_5"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_5" value="1"/>
                                    @endif
                                    Cuma</label>
                                <label>
                                    @if($setting->work_days_6 == true)<input type="checkbox" name="work_days_6"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_6" value="1"/>
                                    @endif
                                    Cumartesi</label>
                                <label>
                                    @if($setting->work_days_7 == true)<input type="checkbox" name="work_days_7"
                                                                             value="1" checked/>
                                    @else <input type="checkbox" name="work_days_7" value="1"/>
                                    @endif
                                    Pazar</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Başlangıç Saati :</label>
                            <div class="controls">
                                <div class="input-append date">
                                    <input type="time" value="{{$setting->work_start_time}}" name="work_start_time"
                                           class="span11">
                                    <span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Bitiş Saati :</label>
                            <div class="controls">
                                <div class="input-append date">
                                    <input type="time" value="{{$setting->work_end_time}}" name="work_end_time"
                                           class="span11">
                                    <span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Facebook :</label>
                            <div class="controls">
                                <input type="text" name="facebook" class="span11" value="{{$setting->facebook}}"
                                       placeholder="Facebook adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Twitter :</label>
                            <div class="controls">
                                <input type="text" name="twitter" class="span11" value="{{$setting->twitter}}"
                                       placeholder="Twitter adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Instagram :</label>
                            <div class="controls">
                                <input type="text" name="instagram" class="span11" value="{{$setting->instagram}}"
                                       placeholder="Instagram adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">YouTube :</label>
                            <div class="controls">
                                <input type="text" name="youtube" value="{{$setting->youtube}}" class="span11"
                                       placeholder="YouTube adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Vimeo :</label>
                            <div class="controls">
                                <input type="text" name="vimeo" value="{{$setting->vimeo}}" class="span11"
                                       placeholder="Vimeo adresi"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">SoundCloud :</label>
                            <div class="controls">
                                <input type="text" name="soundcloud" value="{{$setting->soundcloud}}" class="span11"
                                       placeholder="SoundCloud adresi"/>
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
    <script>
        $('.textarea_editor').wysihtml5();
    </script>
    <script>
        $('#price').prop('readonly', true);

        $("input[name=is_free]") // select the radio by its id
            .change(function () { // bind a function to the change event
                if ($(this).is(":checked")) { // check if the radio is checked
                    var val = $(this).val(); // retrieve the value
                    if (val == 1) {
                        $('#price').prop('readonly', true);
                        $('#price').val(0.00);
                    } else {
                        $('#price').prop('readonly', false);
                    }
                }
            });
    </script>
@endsection
