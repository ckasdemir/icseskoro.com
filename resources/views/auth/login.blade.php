@extends('site/template/layout')

@section('content')
    <section class="bg-form">
        <div class="container">
            <div class="row">
                <section class="px-form plain">
                    <div class="col-md-6">
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
                            <h3>KULLANICI GİRİŞİ</h3>
                        </div>
                        <form action="{{ route('login') }}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-mail6"></i>
                                <input type="email" required="" class=" " placeholder="E-Posta Adresiniz"
                                       style="text-transform: none"
                                       name="email">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-lock3"></i>
                                <input type="password" class=" " placeholder="Şifre" style="
                                text-transform: none"
                                       name="password">
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="Giriş">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Şifremi Unuttum') }}
                                    </a>
                                @endif
                            </label>
                        </form>
                    </div>
                    <div class="col-md-6">
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
                            <h3>ÜYELİK FORMU</h3>
                        </div>
                        <form action="{{ route('register') }}" method="post">
                            {{csrf_field()}}
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-user2"></i>
                                <input type="text" required="" class=" " placeholder="Adınız ve Soyadınız"
                                       style="text-transform: none"
                                       name="name">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-mail6"></i>
                                <input type="email" required="" class=" " placeholder="E-Posta Adresiniz"
                                       style="text-transform: none"
                                       name="email">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-users5"></i>
                                <input type="text" required="" class=" " placeholder="Kullanıcı Adınız"
                                       style="text-transform: none"
                                       name="username">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-lock3"></i>
                                <input type="password" class=" " placeholder="Şifre" style="text-transform: none"
                                       name="password">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-lock3"></i>
                                <input type="password" class=" " placeholder="Şifre Tekrar" style="text-transform: none"
                                       name="password_confirmation">
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="Üye Ol">
                            </label>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
