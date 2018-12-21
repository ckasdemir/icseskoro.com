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
                            <h3>ŞİFREMİ UNUTTUM</h3>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <label style="margin: 0 0 20px 0; width: 100%">
                                <i class="icon-mail6"></i>
                                <input type="email" required="" class=" " placeholder="E-Posta Adresiniz"
                                       style="text-transform: none"
                                       name="email">
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="Sıfırlama Linki Gönder">
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
