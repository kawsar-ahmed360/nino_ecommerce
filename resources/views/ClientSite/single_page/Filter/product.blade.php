@forelse(@$product as $pro)
    <div class="col-md-4">
        <div class="product">
            <a href="{{route('SinglePorduct',@$pro->slug)}}">
                <div class="product-header">
                    @if(@$pro->discount)
                        <span class="badge badge-success">{{@$pro->discount}}% OFF</span>
                    @endif

                        <img class="img-fluid" src="{{(@$pro->image)?url('upload/Client/Product/'.@$pro->image):''}}" alt="">
                    <span class="text-danger mdi mdi-heart"></span>
                </div>
                <div class="product-body">
                    <h5>{{@$pro->product_name}}</h5>
                    <h6><strong><span class="mdi mdi-approval"></span>{{@$pro->carat}}</strong></h6>
                </div>
                <div class="product-footer">
                    <button type="button" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i></button>
                    @if(@$pro->discount)

                        <p class="offer-price mb-0"> ${{@$pro->new_price}}  <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">${{@$pro->product_price}}</span></p>
                    @else

                        <p class="offer-price mb-0"> ${{@$pro->product_price}}  <i class="mdi mdi-tag-outline"></i><br><span class="regular-price">$00.00</span></p>
                    @endif
                </div>
            </a>
        </div>
    </div>

@empty

     <div style="display: block;margin:0 auto"><img style="width: 356px;" src="{{asset('fontend/product_not.webp')}}" alt=""></div>

@endforelse