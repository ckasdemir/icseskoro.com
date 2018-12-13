<!-- Footer Start -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <aside class="widget widget-newsletter col-md-12">
                <div class="social-media">
                    <ul style="border: none">
                        @if(isset($setting) && !empty($setting->facebook))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->facebook}}" target="_blank" data-original="facebook">
                                    <i class="icon-facebook9"></i>
                                    <span>Facebook</span>
                                </a>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->twitter))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->twitter}}" target="_blank" data-original="twitter">
                                    <i class="icon-twitter6"></i>
                                    <span>Twitter</span>
                                </a>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->instagram))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->instagram}}" target="_blank" data-original="instagram">
                                    <i class="icon-instagram4"></i>
                                    <span>Instagram</span>
                                </a>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->youtube))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->youtube}}" target="_blank" data-original="youtube">
                                    <i class="icon-youtube"></i>
                                    <span>YouTube</span>
                                </a>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->vimeo))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->vimeo}}" target="_blank" data-original="vimeo">
                                    <i class="icon-vimeo4"></i>
                                    <span>Vimeo</span>
                                </a>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->soundcloud))
                            <li class="col-md-2" style="border: none">
                                <a href="{{$setting->soundcloud}}" target="_blank" data-original="soundcloud">
                                    <i class="icon-soundcloud4"></i>
                                    <span>Soundcloud</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </aside>
        </div>
        @if(isset($setting))
            <div class="row">
                <aside class="widget widget-contact col-md-12 text-center">
                    <ul style="list-style: none; display:inline-flex;">
                        @if(isset($setting) && !empty($setting->address))
                            <li>
                                <i class=" icon-map5"></i>
                                <p style="margin-right: 10px">{{$setting->address}}</p>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->mobile))
                            <li>
                                <i class=" icon-mobile4"></i>
                                <p style="margin-right: 10px"><span>Telefon</span> : {{$setting->mobile}}</p>
                            </li>
                        @endif

                        @if(isset($setting) && !empty($setting->email))
                            <li>
                                <i class="icon-envelope4"></i>
                                <p><span>E-Posta</span> : {{$setting->email}}</p>
                            </li>
                        @endif
                    </ul>
                </aside>
            </div>
        @endif
    </div>
    <section id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>© 2018 @if(2018 < date('Y'))- {{date('Y')}} @endif
                        @if(isset($setting) && !empty($setting->title))
                            {{$setting->title}}.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
</footer>
<!-- Footer End -->
</div>
<script src="/site/assets/scripts/jquery.min.js"></script>
<script src="/site/assets/scripts/modernizr.min.js"></script>
<script src="/site/assets/scripts/bootstrap.min.js"></script>
<script src="/site/assets/scripts/browser-detect.js"></script>
<script src="/site/assets/scripts/selectFx.js"></script>
<script src="/site/assets/scripts/menu.js"></script>
<script src="/site/assets/scripts/jquery.flexslider.js"></script>
<script src="/site/assets/scripts/jquery.countdown.js"></script>
<script src="/site/assets/scripts/jquery.matchHeight.js"></script>
<script src="/site/assets/scripts/slick-min.js"></script>
<script src="/site/assets/scripts/slick.js"></script>

@yield('js')

<!-- Put all Functions in functions.js -->
<script src="/site/assets/scripts/functions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
@if (Session::has('alert.config'))
    <script>
        swal({!! Session::pull('alert.config') !!});
    </script>
    @endif
</body>
</html>
