
<div class="banner">
    <div class="full-container">
        <div class="slider-content">
            <ul id="pager2" class="container">
            </ul>
            <!-- prev/next links -->

            <span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span> <span
                class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>
            <div class="slider slider-v1"
                 data-cycle-swipe=true
                 data-cycle-prev=".prevControl"
                 data-cycle-next=".nextControl" data-cycle-loader="wait">
                @foreach ($banners as $banner)
                <div class="slider-item slider-item-img1">
                    <a href="{{ URL::to($banner->target_url) }}"><img src="{{ asset($banner->image_url) }}" class="img-responsive parallaximg sliderImg"></a>
                </div>
                <!--/.slider-item-->
                @endforeach
            </div>
            <!--/.slider slider-v1-->
        </div>
        <!--/.slider-content-->
    </div>
    <!--/.full-container-->
</div>
<!--/.banner style1-->
