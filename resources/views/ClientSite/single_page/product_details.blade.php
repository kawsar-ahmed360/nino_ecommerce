@extends('ClientSite.master')
@section('title') {{@$product_details->product_name}} @endsection
@section('seo')
    <meta name="description" content="{!!@$product_details->meta_des!!}">
    <meta name="keywords" content="{!!@$product_details->meta_title!!}">
@endsection

@section('client-content')

<style>

        * {box-sizing: border-box;}

         .img-magnifier-container {
           position:relative;
         }

         .img-magnifier-glass {
           position: absolute;
           border: 1px solid #000;
           border-radius: 50%;
           cursor: none;

           width: 200px;
           height: 200px;

           z-index: 9999;
         }



      </style>





    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Shop Detail</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a href="#" class="text-white">Home</a> / <span class="text-success">Shop Detail</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="shop-single section-padding">
        <div class="container">
            <div class="row">

                <div class="col-md-6">

                    <div class="show" style="z-index: 9999;" href="https://placeimg.com/1000/1000/animals">
                        <img style="z-index: 9999;" src="https://placeimg.com/1000/1000/animals" id="show-img">
                    </div>
                    <div class="small-img">
                        <img src="{{asset('fontend/gallery/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                        <div class="small-container">
                            <div id="small-img-roll">
                                <img src="https://placeimg.com/1000/1000/animals" class="show-small-img" alt="">
                                <img src="https://placeimg.com/1000/1000/arch" class="show-small-img" alt="">
                                <img src="https://placeimg.com/1000/1000/nature" class="show-small-img" alt="">
                                <img src="https://placeimg.com/1000/1000/people" class="show-small-img" alt="">
                                <img src="https://placeimg.com/1000/1000/tech" class="show-small-img" alt="">
                                <img src="https://picsum.photos/1000/1000/?random" class="show-small-img" alt="">
                            </div>
                        </div>
                        <img src="{{asset('fontend/gallery/images/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
                    </div>


                    {{--<div class="shop-detail-left">--}}
                        {{--<div class="shop-detail-slider">--}}
                            {{--<div class="card">--}}
                                {{--<div class="demo">--}}
                                    {{--<ul id="lightSlider">--}}
                                        {{--@foreach(@$product_details->ProductGallery as $key=>$gall)--}}
                                        {{--<li  data-thumb="{{(@$gall->product_gallery)?url('upload/Client/ProductGallery/'.@$gall->product_gallery):''}}" > <img src="{{(@$gall->product_gallery)?url('upload/Client/ProductGallery/'.@$gall->product_gallery):''}}" /> </li>--}}
                                            {{--@endforeach--}}

                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>


                <div class="col-md-6">
                    <div class="shop-detail-right">
                        <span class="badge badge-success">@if(@$product_details->discount) {{@$product_details->discount}}% OFF @else 0% Off @endif</span>
                        <span class="pull-right">
                            <style>
                                .checked {
                                    color: orange;
                                }
                                .pull-right{
                                    margin-left: 168px;
                                }
                            </style>

                            @if(avarage_rating_star(@$product_details->id)==0)
                                 review not yet
                                @endif
                                @for($i=1; $i<=avarage_rating_star(@$product_details->id); $i++)
                                <span class="fa fa-star checked"></span>
                                 @endfor


                                {{--<span class="fa fa-star"></span>--}}
                            ( {{avarage_review(@$product_details->id)}} Customer Review)
                        </span>
                        <h2>{{@$product_details->product_name}}</h2>
                        <h6><strong><span class="mdi mdi-approval"></span>{{@$product_details->carat}}</strong></h6>
                        @if(@$product_details->discount)
                        <p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : ${{@$product_details->product_price}}</p>
                        <p class="offer-price mb-0">Discounted price : <span class="text-danger">${{@$product_details->new_price}}</span></p>
                        @else
                            <p class="regular-price"><i class="mdi mdi-tag-outline"></i>Discount MRP : $000.00</p>
                            <p class="offer-price mb-0"><strong>Regular price</strong> : <span class="text-danger">${{@$product_details->product_price}}</span></p>
                            @endif

                        <form action="{{route('AddCart')}}" method="post">
                            @csrf
                         @if(@$product_details->discount)
                                <input type="hidden" name="price" value="{{@$product_details->new_price}}">
                             @else
                                <input type="hidden" name="price" value="{{@$product_details->product_price}}">
                             @endif
                            <input type="hidden" value="{{@$product_details->id}}" name="ProductId">
                            <input type="hidden" value="{{@$product_details->product_name}}" name="pro_name">
                            <input type="hidden" value="{{@$product_details->image}}" name="pro_image">
                        <div class="_p-add-cart">
                            <div class="_p-qty">
                                <span>Add Quantity</span>
                                <div class="value-button decrease_" id="incremnet" value="Decrease Value">-</div>
                                <input type="number" name="qty" id="number" min="1" value="1" />
                                <div class="value-button increase_" id="" value="Increase Value">+</div>
                            </div>
                        </div>

                        <a href="" id="ale"><button type="submit" id="sub" class="btn btn-secondary btn-lg"><i class="mdi mdi-cart-outline"></i> Add To Cart</button> </a>
                        </form>
                        <div class="short-description">
                            <h5>
                                Quick Overview
                                <p class="float-right">Availability: @if(@$product_details->product_qty!=null) <span class="badge badge-success"> In Stock </span> @else <span style="background: darkred;color:white" class="badge badge-danger"> Out Of Stock </span> @endif </p>
                            </h5>
                           {!! @$product_details->summary !!}
                        </div>


                        <h6 class="mb-3 mt-4">Why shop from Osahan Jewelry?</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feature-box">
                                    <i class="mdi mdi-truck-fast"></i>
                                    <h6 class="text-info">Free Delivery</h6>
                                    <p>Lorem ipsum dolor...</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box">
                                    <i class="mdi mdi-basket"></i>
                                    <h6 class="text-info">100% Guarantee</h6>
                                    <p>Rorem Ipsum Dolor sit...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="pro-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach(@$product_details->ProductDetails as $key=>$pro_details)
                        <li class="nav-item">
                            <a class="nav-link @if($key==0) active @endif" id="overview-tab" data-toggle="tab" href="#overview{{$key}}" role="tab" aria-controls="overview" aria-selected="true">{{@$pro_details->title}}</a>
                        </li>
                        @endforeach

                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">Review</a>
                            </li>


                    </ul>

                    <div class="tab-content" id="myTabContent" style="padding: 18px;">

                        @foreach(@$product_details->ProductDetails as $key=>$pro_details)
                        <div class="tab-pane fade @if(@$key==0) show active @endif" id="overview{{$key}}" role="tabpanel" aria-labelledby="overview-tab">

                         {!! @$pro_details->description !!}

                        </div>
                        @endforeach



                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <h6>Review </h6>
                                @if(\Illuminate\Support\Facades\Session::has('customer_id'))
                                    @if($show_review_form==1)
                                <div class="cont">
                                    <div class="stars">
                                        <form action="{{route('ReviewPost')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_details_id" value="{{@$order_details_id->id}}">



                                            <input class="star star-5" id="star-5-2" type="radio" value="5" name="star"/>
                                            <label class="star star-5" for="star-5-2"></label>
                                            <input class="star star-4" id="star-4-2" type="radio" value="4" name="star"/>
                                            <label class="star star-4" for="star-4-2"></label>
                                            <input class="star star-3" id="star-3-2" type="radio" value="3" name="star"/>
                                            <label class="star star-3" for="star-3-2"></label>
                                            <input class="star star-2" id="star-2-2" type="radio" value="2" name="star"/>
                                            <label class="star star-2" for="star-2-2"></label>
                                            <input class="star star-1" id="star-1-2" type="radio" value="1" name="star"/>
                                            <label class="star star-1" for="star-1-2"></label>
                                            <div class="rev-box">
                                                <textarea class="review" col="30" name="review"></textarea>
                                                <label class="review" for="review">Breif Review</label>

                                                <button class="int" style="cursor: pointer" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                        @else

                                        @endif

                                    @else

                                     <div class="">
                                         <h4 style="text-align: center;"><a href="" class="btn btn-warning">Login</a> To Review</h4>
                                     </div>

                                @endif

                            </div>

                    </div>

                </div>
            </div>
    </section>

    <section class="product-items-slider section-padding bg-white border-top">
        <div class="container">
            <div class="section-header">
                <h5 class="heading-design-h5">Related Products
                    <a class="float-right text-secondary" href="shop.html">View All</a>
                </h5>
            </div>

            <div class="owl-carousel owl-carousel-featured">

                @forelse(@$related_product as $product)
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

   <!-------------Product Review Section------------>
    <section class="product-items-slider section-padding bg-white border-top">
        <div class="container">
        <div class="section-header">
            <h5 class="heading-design-h5">Products Review

            </h5>
        </div>
        <div class="testimonial-box-container">
            <!--BOX-1-------------->
            @foreach(@$product_review as $reviews)
            <div class="testimonial-box">
                <!--top------------------------->
                <div class="box-top">
                    <!--profile----->
                    <div class="profile">

                        <!--name-and-username-->
                        <div class="name-user">
                            <strong>{{@$reviews->CustomerInfo->name}}</strong>
                            <span>Date: {{date('d-m-Y',strtotime($reviews->updated_at))}}</span>
                        </div>
                    </div>
                    <!--reviews------>
                    <div class="reviews">
                        @for($i=1; $i<=$reviews->star; $i++)
                            <i class="fas fa-star"></i>
                        @endfor

                        {{--<i class="fas fa-star"></i>--}}
                        {{--<i class="fas fa-star"></i>--}}
                        {{--<i class="fas fa-star"></i>--}}
                        {{--<i class="far fa-star"></i>--}}
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>{!! @$reviews->review !!}</p>
                </div>
            </div>

                @endforeach




        </div>
        </div>
    </section>


    <input type="hidden" id="productQty" value="{{@$product_details->product_qty}}" >

  @section('client-footer')

        <script>
function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /create magnifier glass:/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /insert magnifier glass:/
  img.parentElement.insertBefore(glass, img);
  /set background properties for the magnifier glass:/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /execute a function when someone moves the magnifier glass over the image:/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /and also for touch screens:/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /prevent any other actions that may occur when moving over the image/
    e.preventDefault();
    /get the cursor's x and y positions:/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /prevent the magnifier glass from being positioned outside the image:/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /set the position of the magnifier glass:/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /display what the magnifier glass "sees":/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /get the x and y positions of the image:/
    a = img.getBoundingClientRect();
    /calculate the cursor's x and y coordinates, relative to the image:/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /consider any page scrolling:/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
</script>
     
     <script>
      magnify("myimage", 3);
   </script>

      <script>

          $(document).ready(function() {
              var quryvrify = $('#productQty').val();
               if(quryvrify<1){
                    $('#sub').attr('disabled',true);
                   const Toast = Swal.mixin({
                           toast: true,
                           position: 'top-end',
                           showConfirmButton: false,
                           timer: 4000,
                           timerProgressBar: true,
                           didOpen: (toast) => {
                           toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
               })

                   Toast.fire({
                       icon: 'error',
                       title: 'This Product Out of Stock'
                   })
               }

          });


          $('#ale').on('click',function () {


              const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
          })

              Toast.fire({
                  icon: 'success',
                  title: 'Product Added To Cart'
              })
          })
      </script>

  @endsection



@endsection