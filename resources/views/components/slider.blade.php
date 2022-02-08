<section class="carousel-slider-main text-center bg-white">
    <div class="owl-carousel owl-carousel-slider">
        @foreach(@$slider as $slider)
        <div class="item">
            <a href="#"><img class="img-fluid" src="{{(@$slider->image)?url('upload/Client/Slider/'.@$slider->image):''}}" alt="First slide"></a>
        </div>
            @endforeach
    </div>
</section>