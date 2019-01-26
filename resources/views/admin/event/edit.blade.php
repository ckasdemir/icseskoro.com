@extends('admin/template/layout')

@section('content')
    <div id="content-header">
        <div id="breadcrumb"><a href="{{route('admin.index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Anasayfa</a> <a
                href="#" class="current">Etkinlik Düzenle</a></div>
        <h1>Etkinlik Düzenle</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Etkinlik Düzenle : {!! $events->title !!}</h5>
                    </div>
                    <div class="widget-content nopadding">
                        {!! Form::model($events, ['route'=>['events.update', $events->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'files' => 'true']) !!}
                        <div class="control-group">
                            <label class="control-label">Başlık :</label>
                            <div class="controls">
                                <input type="text" name="title" class="span11" value="{!! $events->title !!}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Yer :</label>
                            <div class="controls">
                                <input type="text" name="location" class="span11" value="{!! $events->location !!}"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Etkinlik Tarihi :</label>
                            <div class="controls">
                                <div class="input-append date">
                                    <input type="date" value="{!! $events->event_date !!}" name="event_date"
                                           class="span11">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Başlangıç Saati :</label>
                            <div class="controls">
                                <div class="input-append date">
                                    <input type="time" value="{!! $events->event_start_time !!}" name="event_start_time"
                                           class="span11">
                                    <span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Bitiş Saati :</label>
                            <div class="controls">
                                <div class="input-append date">
                                    <input type="time" value="{!! $events->event_end_time !!}" class="span11"
                                           name="event_end_time"/>
                                    <span class="add-on"><i class="icon-time"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Adres :</label>
                            <div class="controls">
                                <textarea class="span11" name="address">{!! $events->address !!}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Harita :</label>
                            <div class="controls">
                                <textarea class="span11" name="map"
                                          rows="6">{{ $events->map }}</textarea>
                            </div>
                            <span
                                style="color: #ff0f07; text-align: center"><p>width=<strong>"100%"</strong> height=<strong>"218"</strong></p></span>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Açıklama :</label>
                            <div class="controls">
                                <textarea class="textarea_editor span11" name="description"
                                          rows="20">{!! $events->description !!}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Tags :</label>
                            <div class="controls">
                                <textarea class="span11" name="tags"
                                          rows="6">{!! $events->tags !!}</textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Resim :</label>
                            <div class="controls">
                                <input type="file" name="image"/>

                                @if(!empty($events->image))
                                    <a href="/uploads/events/{{$events->image}}" title="{{$events->slug}}"
                                       alt="{{$events->slug}}" target="_blank">Resmi göster</a>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Ücretsiz mi? :</label>
                            <div class="controls">
                                @if($events->is_free == 1)
                                    <label>
                                        <input type="radio" name="is_free" value="1" checked/>
                                        Evet</label>
                                    <label>
                                        <input type="radio" name="is_free" value="0"/>
                                        Hayır</label>
                                @else
                                    <label>
                                        <input type="radio" name="is_free" value="1"/>
                                        Evet</label>
                                    <label>
                                        <input type="radio" name="is_free" value="0" checked/>
                                        Hayır</label>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Ücret</label>
                            <div class="controls">
                                <div class="input-append">
                                    @if($events->is_free == 1)
                                        <input type="text" value="{!! $events->price !!}" id="price" name="price"
                                               class="span11"
                                               readonly/>
                                    @else
                                        <input type="text" value="{!! $events->price !!}" id="price" name="price"
                                               class="span11"/>
                                    @endif
                                    <span class="add-on">₺</span></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Durum :</label>
                            <div class="controls">
                                @if($events->status == 1)
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
                                    onclick="window.location.href='{{route('events.index')}}'">İptal
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
    <script>
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
