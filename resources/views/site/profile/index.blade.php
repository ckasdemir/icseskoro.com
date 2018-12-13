@extends('site/template/layout')

@section('content')
    <!-- Bredcrumb -->
    <div class="breadcrumb-sec align-left"
         style="background:url('/site/assets/extra-images/subheader1.jpg') no-repeat; min-height:179px;">
        <div class="container">
            <div class="px-table">
                <div class="px-tablerow">
                    <div class="px-pageinfo">
                        <h2>{{$profile->name}}</h2>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{route('site.index')}}">Anasayfa</a></li>
                            <li class="active">Profilim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bredcrumb End -->
    <section class="bg-form" style="margin-top: -40px; overflow: hidden">
        <div class="container">
            <div class="row">
                <form method="post" action="{{ route('site.profileUpdate',Auth::user()->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    <section class="px-team">
                        <div class="col-md-5">
                            <div class="slider slidernav">
                                <div class="px-media">
                                    <figure>
                                        <div class="icses-upload-btn-wrapper">
                                            @if(!empty($profile->image) && file_exists(public_path("/uploads/users/".$profile->image)))
                                                <button class="icses-btn">
                                                    <img src="/uploads/users/{{$profile->image}}"
                                                         class="img-responsive"
                                                         alt="{{$profile->name}}"/>
                                                </button>
                                                <input type="file" name="image">
                                            @else
                                                <button class="icses-btn"><img
                                                        src="/site/assets/images/default/default_user.jpg"
                                                        class="img-responsive"
                                                        alt="{{$profile->name}}"/>
                                                </button>
                                                <input type="file" name="image">
                                            @endif
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="px-form plain" style="margin-top: -40px">
                        <div class="col-md-7">
                            <label>
                                <i class="icon-user9"></i>
                                <input type="text" required="" class=" " value="{{$profile->name}}"
                                       onblur="if(this.value == '') { this.value = 'Adınız ve Soyadınız'; }"
                                       onfocus="if(this.value == 'Adınız ve Soyadınız') { this.value = ''; }"
                                       name="name">
                            </label>
                            <label>
                                <i class="icon-mail6"></i>
                                <input type="email" required="" class=" " value="{{$profile->email}}"
                                       onblur="if(this.value == '') { this.value = 'E-Posta Adresiniz'; }"
                                       onfocus="if(this.value == 'E-Posta Adresiniz') { this.value = ''; }"
                                       name="email" style="text-transform:lowercase ">
                            </label>
                            <label>
                                <i class="icon-phone8"></i>
                                <input type="tel" class=" " value="{{$profile->phone}}"
                                       onblur="if(this.value == '') { this.value = 'Telefon'; }"
                                       onfocus="if(this.value == 'Telefon') { this.value = ''; }"
                                       name="phone" maxlength="11">
                            </label>
                            <label>
                                <i class="icon-lock2"></i>
                                <input type="password" class=" "
                                       name="password" style="text-transform: none">
                            </label>
                            <label>
                                <i class="icon-user"></i>
                                <select required="required" name="gender">
                                    @if($profile->gender == 0)
                                        <option value="0" selected>Kadın</option>
                                    @else
                                        <option value="0">Kadın</option>
                                    @endif

                                    @if($profile->gender == 1)
                                        <option value="1" selected>Erkek</option>
                                    @else
                                        <option value="1">Erkek</option>
                                    @endif
                                </select>
                            </label>
                            <label>
                                <i class="icon-music2"></i>
                                <select required="required" name="voice_type_id">
                                    @foreach($voice_types as $item)
                                        @if($profile->voice_type_id == $item->id)
                                            <option value="{{$item->id}}" selected>{{$item->type_name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                            <label class="submit-sec">
                                <input type="submit" value="Güncelle">
                            </label>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('css')

@endsection

@section('js')

@endsection
