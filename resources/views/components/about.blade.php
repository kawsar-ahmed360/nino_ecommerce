<section class="section-padding flower-bg" style=" background-image: url(fontend/img/abo.jpg);
                padding: 70px 0px 70px 0px">
    <div class="container">
        <div class="row">
            <div class="pl-4 col-lg-5 col-md-5 pr-4">
                <img class="rounded img-fluid about" src="{{(@$about->image)?url('upload/Client/About/'.$about->image):''}}" alt="Card image cap">
            </div>
            <div class="col-lg-6 col-md-6 pl-5 pr-5">
                <h2 class="mt-5 mb-5 text-secondary" style="font-family: cursive; ">{{@$about->title}}</h2>

               {!! @$about->short_title !!}

            </div>
        </div>
    </div>
</section>