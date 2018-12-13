<!--Footer-part-->

<div class="row-fluid">
    <div id="footer" class="span12">2018
        @if(2018 < date('Y'))-
        {{date('Y')}} @endif &copy;
        @if(isset($setting) && !empty($setting->title))
            {{$setting->title}}.
        @endif
    </div>
</div>

<!--end-Footer-part-->
@yield('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
@if (Session::has('alert.config'))
    <script>
        swal({!! Session::pull('alert.config') !!});
    </script>
    @endif
    </body>
    </html>
