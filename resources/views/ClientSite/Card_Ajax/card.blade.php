@foreach(@$cart as $cart)
    @foreach(\App\Models\Admin\ProductManage::where('id',@$cart->id)->get() as $pro)

        <tr>
            <td class="cart_product">
                <a href="#"><img class="img-fluid" src="{{(@$pro->image)?url('upload/Client/Product/'.@$pro->image):''}}" alt=""></a>
            </td>
            <td class="cart_description">
                <h5 class="product-name"><a href="#">{{@$cart->name}}</a></h5>
                <h6><strong><span class="mdi mdi-approval"></span>{{@$pro->carat}}</strong></h6>
            </td>
            @if(@$pro->product_qty)
                <td class="availability in-stock"><span class="badge badge-success"> In stock</span></td>
            @else
                <td class="availability in-stock"><span class="badge badge-success" style="background: darkred;color:white">Out Of Stock</span></td>
            @endif

            <td class="price"><span>${{@$cart->price}}</span></td>

            <td class="qty">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-theme-round btn-number" type="button" onclick="decrement('{{@$cart->rowId}}')">-</button></span>
                    <input type="text"  min="1" value="{{@$cart->qty}}" onload="" class="form-control border-form-control form-control-sm input-number" name="product_qty">
                    <span class="input-group-btn">
                         <button class="btn btn-theme-round btn-number" type="button" onclick="Increment('{{@$cart->rowId}}')">+</button>
                                       </span>
                </div>
            </td>
            <td class="price"><span>${{@$cart->subtotal()}}</span></td>
            <td class="action">
                <button class="btn btn-sm btn-danger"  onclick="RemoveCard('{{@$cart->rowId}}')" href="" title=""  ><i class="mdi mdi-close-circle-outline"></i></button>
            </td>
        </tr>



    @endforeach



@endforeach


    <tr>
        <td colspan="1"></td>

        <td colspan="4">
            @if(Session::has('coupon'))

                <div>
                    <p style="color:red;text-align:right"> Coupon Already Applied....</p>
                </div>
            @else
            <form action="{{route('CouponApplay')}}" class="form-inline float-right" method="post">
                @csrf

                <div class="form-group">
                    <input type="text" placeholder="Enter discount code" name="coupon" class="form-control border-form-control form-control-sm">
                </div>
                &nbsp;
                <button class="btn btn-success float-left btn-sm" type="submit">Apply</button>
            </form>
            @endif
        </td>

        @if(Session()->has('coupon'))

            @if(session()->get('coupon')['discount'] && session()->get('coupon')['name'])
            <td colspan="2">
               <strong> Coupon Name</strong>: {{session()->get('coupon')['name']}}<br>
                <strong>Discount</strong> : ${{session()->get('coupon')['discount']}}
            </td>
                @else
                @endif

            @else
            <td colspan="2">Discount : $0 </td>
        @endif


    </tr>

    <tr>
        <td colspan="2"></td>
        <td class="text-right" colspan="3">Total products Subtotal</td>
        @if(session()->has('coupon'))
            @if(session()->get('coupon')['discount'])
            <td colspan="2">${{str_replace(',','',@$total)-session()->get('coupon')['discount']}}.00 </td>

                @php
                    Session::put('Total_Amount',str_replace(',','',@$total)-session()->get('coupon')['discount']);
                @endphp

             @endif
        @else
        <td colspan="2">${{str_replace(',','',@$total)}} </td>
        @endif
    </tr>

    <tr>
        <td class="text-right" colspan="5"><strong>Total</strong></td>
        @if(session()->has('coupon'))
            @if(session()->get('coupon')['discount'])
        <td class="text-danger" colspan="2"><strong>${{str_replace(',','',@$total)-session()->get('coupon')['discount']}}.00 </strong></td>
            @endif
        @else

        <td class="text-danger" colspan="2"><strong>${{str_replace(',','',@$total)}} </strong>  </td>
            @endif
    </tr>

