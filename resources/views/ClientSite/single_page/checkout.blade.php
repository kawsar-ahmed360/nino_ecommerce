@extends('ClientSite.master')

@section('title') Checkout Page @endsection

@section('client-content')


    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Checkout</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a href="#" class="text-white">Home</a> / <span class="text-success">Checkout</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="checkout-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="checkout-step">
                        <div class="accordion" id="accordionExample">

                            <div class="card checkout-step-two">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="number">1</span> Delivery Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <form action="{{route('PaymentStore')}}" method="POST">
                                            @csrf


                                            <div class="heading-part">
                                                <h3 class="sub-heading">Billing Address</h3>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">First Name <span class="required">*</span></label>
                                                        <input class="form-control border-form-control @error('billing_fname') is-invalid @enderror" name="billing_fname" value="{{@$billing_info->billing_fname}}" placeholder="Gurdeep" type="text">
                                                         @error('billing_fname')
                                                           <span class="invalid-feedback" role="alert">
                                                               <strong>{{$message}}</strong>
                                                           </span>
                                                         @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Name <span class="required">*</span></label>
                                                        <input class="form-control border-form-control @error('billing_lname') is-invalid @enderror" name="billing_lname" value="{{@$billing_info->billing_lname}}" placeholder="Osahan" type="text">
                                                            @error('billing_lname')
                                                            <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone <span class="required">*</span></label>
                                                        <input class="form-control border-form-control @error('billing_mobile') is-invalid @enderror" name="billing_mobile" value="{{@$billing_info->billing_mobile}}" placeholder="123 456 7890" type="number">
                                                        @error('billing_mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email Address <span class="required">*</span></label>
                                                        <input class="form-control border-form-control @error('billing_email') is-invalid @enderror" name="billing_email"  value="{{@$billing_info->billing_email}}" placeholder="iamosahan@gmail.com"  type="email">
                                                        @error('billing_email')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Country <span class="required">*</span></label>
                                                        <input type="text" name="billing_country_name" value="{{@$billing_info->billing_country_name}}" class="form-control @error('billing_country_name') is-invalid @enderror" placeholder="Enter Country name">
                                                        @error('billing_country_name')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">State <span class="required">*</span></label>
                                                        <input type="text" name="billing_state_name" value="{{@$billing_info->billing_state_name}}" class="form-control @error('billing_state_name') is-invalid @enderror" placeholder="State name">
                                                        @error('billing_state_name')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">City <span class="required">*</span></label>
                                                        <input type="text" name="billing_city_name" value="{{@$billing_info->billing_city_name}}" class="form-control @error('billing_city_name') is-invalid @enderror" placeholder="Enter City name">
                                                        @error('billing_city_name')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Zip Code <span class="required">*</span></label>
                                                        <input class="form-control border-form-control  @error('billing_zip_code') is-invalid @enderror" name="billing_zip_code" value="{{@$billing_info->billing_zip_code}}" placeholder="123456" type="number">
                                                        @error('billing_zip_code')
                                                        <span class="invalid-feedback" role="alert">
                                                                   <strong>{{$message}}</strong>
                                                               </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Billing Landmark <span class="required">*</span></label>
                                                        <textarea class="form-control border-form-control"  name="billing_address">{{@$billing_info->billing_address}}</textarea>
                                                        <small class="text-danger">
                                                            Please include landmark (e.g : Opposite Bank) as the carrier service may find it easier to locate your address.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" name="other_shipment" {{(@$billing_info->other_shipment=='other_shipment')?'checked':''}}  value="other_shipment" onchange="valueChanged()" id="customCheckbill">
                                                <label class="custom-control-label" for="customCheckbill">Use my delivery address as my billing address</label>
                                            </div>



                                            <div class="shipping_address" id="" style="display: none">

                                                <div class="heading-part">
                                                    <h3 class="sub-heading">Shipping Address</h3>
                                                </div>
                                                <hr>



                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">First Name <span class="required">*</span></label>
                                                            <input class="form-control border-form-control" name="shipping_fname" value="{{@$billing_info->shipping_fname}}" placeholder="Gurdeep" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Last Name <span class="required">*</span></label>
                                                            <input class="form-control border-form-control" name="shipping_lname" value="{{@$billing_info->shipping_lname}}" placeholder="Osahan" type="text">
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Phone <span class="required">*</span></label>
                                                            <input class="form-control border-form-control" name="shipping_mobile" value="{{@$billing_info->shipping_mobile}}" placeholder="123 456 7890" type="number">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Email Address <span class="required">*</span></label>
                                                            <input class="form-control border-form-control" name="shipping_email"  value="{{@$billing_info->shipping_email}}" placeholder="iamosahan@gmail.com"  type="email">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Country <span class="required">*</span></label>
                                                            <input type="text" name="shipping_country_name" value="{{@$billing_info->shipping_country_name}}" class="form-control" placeholder="Enter Country name">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">State <span class="required">*</span></label>
                                                            <input type="text" name="shipping_state_name" value="{{@$billing_info->shipping_state_name}}" class="form-control" placeholder="State name">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">City <span class="required">*</span></label>
                                                            <input type="text" name="shipping_city_name" value="{{@$billing_info->shipping_city_name}}" class="form-control" placeholder="Enter City name">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Zip Code <span class="required">*</span></label>
                                                            <input class="form-control border-form-control" value="{{@$billing_info->shipping_zip_code}}" name="shipping_zip_code" placeholder="123456" type="number">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Shipping Address <span class="required">*</span></label>
                                                            <textarea class="form-control border-form-control" name="shipping_address">{!! @$billing_info->shipping_address !!}</textarea>
                                                            <small class="text-danger">Please provide the number and street.</small>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>



                                    </div>
                                </div>
                            </div>


                            {{--@php--}}
                               {{--\Illuminate\Support\Facades\Session::forget('gest_showsession');--}}
                               {{--\Illuminate\Support\Facades\Session::forget('showOrder');--}}
                            {{--@endphp--}}




                             <div class="card">
                                <div class="show_order">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                            <span class="number">2</span> Order Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">



                                            <div class="row">
                                                <div class="col-md-12">

                                                    <table class="table table-striped">


                                                        @if(@str_replace(',','',$subtotal)>str_replace(',','',@$shipping_offer->price_range))

                                                            <tr>
                                                                <th style="padding: 0.75rem;font-weight: 200;font-size: 20px;font-family: cursive;color: red;vertical-align: top;border-top: 1px solid #a43838;" colspan="2">You got free shipping to buy more than ${{@$shipping_offer->price_range}}.</th>
                                                            </tr>

                                                        @elseif(@str_replace(',','',\Illuminate\Support\Facades\Session::has('Total_Amount'))>str_replace(',','',@$shipping_offer->price_range))

                                                            <tr>
                                                                <th style="padding: 0.75rem;font-weight: 200;font-size: 20px;font-family: cursive;color: red;vertical-align: top;border-top: 1px solid #a43838;" colspan="2">You got free shipping to buy more than ${{@$shipping_offer->price_range}}.</th>
                                                            </tr>

                                                        @endif


                                                        <tr>
                                                            <th>Subtotal :</th>
                                                            <td>@if(\Illuminate\Support\Facades\Session::has('Total_Amount')) ${{\Illuminate\Support\Facades\Session::get('Total_Amount')}} @else ${{@$subtotal}} @endif</td>
                                                        </tr>




                                                        @foreach(@$charge as $key=>$char)
                                                            <tr>
                                                                <th>{{@$char->name}} (${{@$char->amount}}) :</th>

                                                                @if(\Illuminate\Support\Facades\Session::has('Total_Amount'))

                                                                    @if(\Illuminate\Support\Facades\Session::has('Total_Amount')>str_replace(',','',@$shipping_offer->price_range))

                                                                        <td>
                                                                            <input type="hidden" value="{{@$char->name}}" name="shipment_name">
                                                                            <input type="hidden" value="{{@$char->amount}}" name="shipment_amount">
                                                                            <input type="hidden" value="{{\Illuminate\Support\Facades\Session::get('Total_Amount')}}" name="total_cart_amount">
                                                                            <input type="radio"  class="@error('charge') is-invalid @enderror" value="{{@$char->amount+str_replace(',','',\Illuminate\Support\Facades\Session::get('Total_Amount'))}}" name="charge" >
                                                                            <span>${{@$char->amount}}+{{\Illuminate\Support\Facades\Session::get('Total_Amount')}} = ${{@$char->amount+str_replace(',','',\Illuminate\Support\Facades\Session::get('Total_Amount'))}}</span>

                                                                            @error('charge')
                                                                            <span style="color:red" alert="role">
                                                                   <strong>{{$message}}</strong>
                                                                 </span>
                                                                            @enderror
                                                                        </td>

                                                                    @else

                                                                        <td>
                                                                            <input type="hidden" value="free_shipment" name="shipment_name">
                                                                            <input type="hidden" value="free_shipment" name="shipment_amount">
                                                                            <input type="hidden" value="{{\Illuminate\Support\Facades\Session::get('Total_Amount')}}" name="total_cart_amount">
                                                                            <input type="radio"  class="@error('charge') is-invalid @enderror" value="{{@str_replace(',','',\Illuminate\Support\Facades\Session::get('Total_Amount'))}}" name="charge" >
                                                                            <span><span style="color:red"> <img style="width:26px" src="{{asset('fontend/gift_icon.png')}}"
                                                                                                                alt=""> Free Shipping</span> +${{\Illuminate\Support\Facades\Session::get('Total_Amount')}} = ${{str_replace(',','',\Illuminate\Support\Facades\Session::get('Total_Amount'))}}</span>

                                                                            @error('charge')
                                                                            <span style="color:red" alert="role">
                                                                   <strong>{{$message}}</strong>
                                                                 </span>
                                                                            @enderror
                                                                        </td>

                                                                    @endif


                                                                @else

                                                                    @if($subtotal>str_replace(',','',@$shipping_offer->price_range))
                                                                        <td>
                                                                            <input type="hidden" value="{{@$char->name}}" name="shipment_name">
                                                                            <input type="hidden" value="{{@$char->amount}}" name="shipment_amount">
                                                                            <input type="hidden" value="{{@$subtotal}}" name="total_cart_amount">
                                                                            <input type="radio" class="@error('charge') is-invalid @enderror" value="{{@$char->amount+str_replace(',','',$subtotal)}}" name="charge" >
                                                                            <span>${{@$char->amount}}+{{@$subtotal}} = ${{@$char->amount+str_replace(',','',@$subtotal)}}</span>

                                                                            @error('charge')
                                                                            <span style="color:red" alert="role">
                                                                   <strong>{{$message}}</strong>
                                                                 </span>
                                                                            @enderror
                                                                        </td>

                                                                    @else


                                                                        <td>
                                                                            <input type="hidden" value="free_shipment" name="shipment_name">
                                                                            <input type="hidden" value="free_shipment" name="shipment_amount">
                                                                            <input type="hidden" value="{{@$subtotal}}" name="total_cart_amount">
                                                                            <input type="radio" class="@error('charge') is-invalid @enderror" value="{{str_replace(',','',$subtotal)}}" name="charge" >
                                                                            <span><span style="color:red"> <img style="width:26px" src="{{asset('fontend/gift_icon.png')}}"
                                                                                                                alt=""> Free Shipping</span> + ${{@$subtotal}} = ${{str_replace(',','',@$subtotal)}}</span>

                                                                            @error('charge')
                                                                            <span style="color:red" alert="role">
                                                                           <strong>{{$message}}</strong>
                                                                         </span>
                                                                            @enderror
                                                                        </td>

                                                                    @endif

                                                                @endif


                                                            </tr>
                                                        @endforeach
                                                    </table>



                                                    {{--<ul>--}}

                                                  {{--<li style="display: inline-flex;padding-top: 7px;"><h6 style="padding-top: 3px;">Cart Subtotal</h6>  <font style="padding-left: 14px;font-size: 16px;"> :  @if(\Illuminate\Support\Facades\Session::has('Total_Amount')) {{\Illuminate\Support\Facades\Session::get('Total_Amount')}} @else ${{@$subtotal}} @endif</font></li>--}}
                                                  {{--<hr style="padding: 0; margin: 4px 0px 0px 2px;">--}}
                                                  {{--<li>Cart Subtotal: {{\Illuminate\Support\Facades\Session::get('Total_Amount')}}</li>--}}

                                              {{--</ul>--}}

                                            </div>
                                            </div>



                                    </div>
                                </div>
                                </div>
                            </div>






                            <div class="card">
                                 <div class="showpayment" >
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <span class="number">3</span> Payment
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">


                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="payment" value="paypal" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio1">Would you like to pay by Paypal?</label>
                                            </div>
                                            <hr>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="payment" value="cash_on_dalivary" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio2">Would you like to pay by Cash on Delivery?</label>
                                            </div>
                                            <hr>
                                            <p>Vestibulum semper accumsan nisi, at blandit tortor maxi'mus in phasellus malesuada sodales odio, at dapibus libero malesuada quis.</p>
                                            <button type="submit"  data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour" class="btn btn-secondary mb-2 btn-lg">Order Submit</button>
                                        </form>
                                    </div>
                                </div>
                                 </div>
                            </div>







                            {{--<div class="card">--}}
                                {{--<div class="card-header" id="headingThree">--}}
                                    {{--<h5 class="mb-0">--}}
                                        {{--<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">--}}
                                            {{--<span class="number">4</span> Order Complete--}}
                                        {{--</button>--}}
                                    {{--</h5>--}}
                                {{--</div>--}}
                                {{--<div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">--}}
                                    {{--<div class="card-body">--}}
                                        {{--<div class="text-center">--}}
                                            {{--<div class="col-lg-10 col-md-10 mx-auto order-done">--}}
                                                {{--<i class="mdi mdi-check-circle-outline text-secondary"></i>--}}
                                                {{--<h4 class="text-success">Congrats! Your Order has been Accepted..</h4>--}}
                                                {{--<p>--}}
                                                    {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, Sed ex est, consectetur eget consectetur, Lorem ipsum dolor sit amet...--}}
                                                {{--</p>--}}
                                            {{--</div>--}}
                                            {{--<div class="text-center">--}}
                                                {{--<a href="shop.html"><button type="submit" class="btn btn-secondary mb-2 btn-lg">Return to store</button></a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}




                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">My Cart <span class="text-secondary float-right">({{@$count}} item)</span></h5>
                        <div class="card-body pt-0 pr-0 pl-0 pb-0">

                            @foreach(@$cart as $cart)
                              @foreach(\App\Models\Admin\ProductManage::where('status','1')->where('id',$cart->id)->get() as $pro)
                            <div class="cart-list-product">
                                {{--<a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a>--}}
                                <img class="img-fluid" src="{{(@$pro->image)?url('upload/Client/Product/'.@$pro->image):''}}" alt="">
                                <span class="badge badge-success">@if(@$pro->discount) {{@$pro->discount}}% OFF @else 0% OFF @endif</span>
                                <h5><a href="#">{{@$pro->product_name}}</a></h5>
                                <h6><strong><span class="mdi mdi-approval"></span>{{@$pro->carat}}</strong></h6>
                                @if(@$pro->discount)
                                <p class="offer-price mb-0">${{@$pro->new_price}} <i class="mdi mdi-tag-outline"></i> <span class="regular-price">${{@$pro->product_price}}</span></p>
                                @else
                                <p class="offer-price mb-0">${{@$pro->product_price}} <i class="mdi mdi-tag-outline"></i> <span class="regular-price">$00.00</span></p>

                                @endif
                            </div>

                             @endforeach
                            @endforeach




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('client-footer')
    <script>
        function valueChanged(){
            if($('#customCheckbill').is(":checked"))
                $(".shipping_address").show();
            else
                $(".shipping_address").hide();
        }
    </script>



@endsection

@endsection