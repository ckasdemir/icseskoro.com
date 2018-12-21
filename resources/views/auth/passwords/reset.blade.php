@extends('site/template/layout')

@section('content')
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
                            <h3>YENİ ŞİFRE</h3>
                        </div>
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-mail6"></i>
                                <input type="email" required="" class=" " placeholder="E-Posta Adresiniz"
                                       style="text-transform: none"
                                       name="email">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-lock3"></i>
                                <input type="password" required placeholder="Şifre" style="text-transform: none"
                                       name="password">
                            </label>
                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-lock3"></i>
                                <input type="password" required placeholder="Şifre Tekrar" style="text-transform: none"
                                       name="password_confirmation">
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="Şifremi Sıfırla">
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
