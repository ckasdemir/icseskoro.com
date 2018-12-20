@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>İLETİŞİM</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">İletişim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    @if(isset($setting) && !empty($setting))
        <section>
            <div class="container">
                <div class="row">
                    <section class="contect-infoarea">
                        <div class="col-md-4">
                            <div class="px-section-title">
                                <h3>İLETİŞİM BİLGİLERİMİZ</h3>
                            </div>
                            <div class="px-contact-info">
                                <ul>
                                    @if(!empty($setting->address))
                                        <li>
                                            <i class="icon-mail6"></i>
                                            <p>
                                                <span>Adres</span>
                                                {{$setting->address}}
                                            </p>
                                        </li>
                                    @endif
                                    @if(!empty($setting->mobile))
                                        <li>
                                            <i class="icon-phone8"></i>
                                            <p>
                                                <span>Telefon</span>
                                                {{$setting->mobile}}
                                            </p>
                                        </li>
                                    @endif
                                    @if(!empty($setting->email))
                                        <li>
                                            <i class="icon-mail6"></i>
                                            <p>
                                                <span>E - Posta</span>
                                                <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                            </p>
                                        </li>
                                    @endif
                                    @if(!empty($setting->email))
                                        <li>
                                            <i class="icon-clock-o"></i>
                                            <p>
                                                <span>Çalışma Saatleri</span>
                                                @if($setting->work_days_1 == true) Pazartesi, @endif
                                                @if($setting->work_days_2 == true) Salı, @endif
                                                @if($setting->work_days_3 == true) Çarşamba, @endif
                                                @if($setting->work_days_4 == true) Perşembe, @endif
                                                @if($setting->work_days_5 == true) Cuma, @endif
                                                @if($setting->work_days_6 == true) Cumartesi, @endif
                                                @if($setting->work_days_7 == true) Pazar, @endif
                                                <br>
                                                @if(!empty($setting->work_start_time))
                                                    {{ date('H:i', strtotime($setting->work_start_time)) }}
                                                @endif
                                                @if(!empty($setting->work_end_time))
                                                    - {{ date('H:i', strtotime($setting->work_end_time)) }}
                                                @endif
                                            </p>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="px-map-sec">
                                @if(!empty($setting->map))
                                    <div class="px-section-title">
                                        <h3>Konum</h3>
                                    </div>
                                    {!! $setting->map !!}
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <section class="bg-form">
            <div class="container">
                <div class="row">
                    <section class="px-form plain">
                        <div class="col-md-12">
                            <div class="px-fancy-heading align-center">
                                <div class="px-spreater2">
                                    <div class="divider">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <h2>Bize Ulaşın</h2>
                            </div>
                            <form action="{{route('contact.sendToMessage')}}" method="post">
                                {{csrf_field()}}
                                <label>
                                    <i class="icon-user9"></i>
                                    <input type="text" required="" class=" " placeholder="Adınız ve Soyadınız"
                                           style="text-transform: none" name="contact_name">
                                </label>
                                <label>
                                    <i class="icon-mail6"></i>
                                    <input type="email" required="" class=" " placeholder="E-Posta Adresiniz"
                                           style="text-transform: none"
                                           name="contact_email">
                                </label>
                                <label>
                                    <i class="icon-phone8"></i>
                                    <input type="text" class=" " placeholder="Telefon" style="text-transform: none"
                                           name="contact_phone">
                                </label>
                                <label>
                                    <i class="icon-text"></i>
                                    <input type="text" required="" class=" " placeholder="Konu"
                                           style="text-transform: none"
                                           name="contact_subject">
                                </label>
                                <label class="textaera-sec">
                                    <i class="icon-text"></i>
                                    <textarea placeholder="Mesajınız" style="text-transform: none"
                                              name="message"></textarea>
                                </label>
                                <label class="submit-sec">
                                    <input type="submit" value="Gönder">
                                </label>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('css')

@endsection

@section('js')

@endsection
