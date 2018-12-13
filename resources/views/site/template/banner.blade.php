@if(isset($sliders) && sizeof($sliders) > 0)
    <!-- Banner Start -->
    <section class="px-banner">
        <div class="banner-holder">
            <div class="flexslider px-loading">
                <div class="loader"><img src="/site/assets/images/squares.gif" alt=""/></div>
                <ul class="slides">
                    @foreach($sliders as $item)
                        <li><img src="/uploads/sliders/{{$item->image}}" alt="{{$item->slug}}"/>
                            <div class="banner-mask"><img src="/site/assets/images/slider-border.png" alt=""/></div>
                            @if($item->is_show_content == true && !empty($item->title))
                                <div class="caption">
                                    <h2>{{str_limit(strip_tags($item->title), 30)}}</h2>
                                    @if(!empty($item->content))
                                        <p>
                                            {{str_limit(strip_tags($item->content), 100)}}...
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- Banner End -->
@endif
