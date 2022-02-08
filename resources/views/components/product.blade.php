
@forelse(@$section as $section)


<section class="product-items-slider section-padding">
    <div class="container">


        <div class="section-header">
            <h5 class="heading-design-h5">{{@$section->section_name}}
                <!-- <span class="badge badge-primary">20% OFF</span> -->
                <a class="float-right text-secondary" href="{{route('ShopPage')}}">View All</a>
            </h5>
        </div>
        <div class="owl-carousel owl-carousel-featured">


            @foreach(\App\Models\Admin\ProductManage::where('section_id', 'LIKE', "%$section->id%")->where('status','1')->get() as $product)

                <div class="item">
                    <div class="product">
                        <a href="{{route('SinglePorduct',@$product->slug)}}">
                            <div class="product-header">
                                @if(@$product->discount)
                                <span class="badge badge-success">{{@$product->discount}}% OFF</span>
                                @endif
                                <img class="img-fluid" src="{{(@$product->image)?url('upload/Client/Product/'.@$product->image):''}}" alt="">
                                <span class="text-danger mdi mdi-heart"></span>
                            </div>
                            <div class="product-body">
                                <h5>{{@$product->product_name}}</h5>
                                <h6><strong><span class="mdi mdi-approval"></span>{{@$product->carat}}</strong></h6>
                                <div class="row " style="padding-left:13px">

                                    @if(avarage_rating_star(@$product->id)==0)
                                        review not yet
                                    @endif
                                    @for($i=1; $i<=avarage_rating_star(@$product->id); $i++)
                                        <span style="color:red" class="mdi mdi-star-outline"></span>
                                    @endfor

                                    <span class="vote">({{avarage_review(@$product->id)}})</span>
                                </div>
                            </div>
                            <div class="product-footer">
                                <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i></button>
                                <a href="{{route('WishlistAdd',base64_encode($product->id))}}" style="margin-right:2px;color:white" class="btn btn-danger btn-sm float-right"><i class="mdi mdi-heart-outline"></i></a>

                                @if(@$product->discount)

                                <p class="offer-price mb-0"> ${{@$product->new_price}}  <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">${{@$product->product_price}}</span></p>
                                    @else

                                <p class="offer-price mb-0"> ${{@$product->product_price}}  <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$00.00</span></p>
                                    @endif


                            </div>
                        </a>
                    </div>
                </div>


            @endforeach








</div>
</div>
</section>
<!-- End: Product Item -->



<!--Start: Addvertise -->
<section class="offer-product">
<div class="container">
<div class="row">



@if(@$section->first_add_image && @$section->second_add_image)
@if(@$section->first_add_image)
<div class="col-md-6">
 <a href="#"><img class="img-fluid add" src="{{(@$section->first_add_image)?url('upload/Client/first_add_image/'.@$section->first_add_image):''}}" alt=""></a>
</div>
@else
 @endif

@if(@$section->second_add_image)
<div class="col-md-6">
 <a href="#"><img class="img-fluid add" src="{{(@$section->second_add_image)?url('upload/Client/second_add_image/'.@$section->second_add_image):''}}" alt=""></a>
</div>
 @else
 @endif


 @else


 @if(@$section->first_add_image)
     <div class="col-md-12">
         <a href="#"><img class="img-fluid add" src="{{(@$section->first_add_image)?url('upload/Client/first_add_image/'.@$section->first_add_image):''}}" alt=""></a>
     </div>
 @else
 @endif

 @if(@$section->second_add_image)
     <div class="col-md-12">
         <a href="#"><img class="img-fluid add" src="{{(@$section->second_add_image)?url('upload/Client/second_add_image/'.@$section->second_add_image):''}}" alt=""></a>
     </div>
 @else
 @endif



@endif
</div>
</div>
</section>
<!-- Start: Addvertise -->

@empty

@endforelse