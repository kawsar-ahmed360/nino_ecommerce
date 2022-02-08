
<div class="modal fade login-modal-main" id="bd-example-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-modal">
                    <div class="row">
                        <div class="col-lg-6 pad-right-0">
                            <div class="login-modal-left"></div>
                        </div>
                        <div class="col-lg-6 pad-left-0">
                            <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                                <span class="sr-only">Close</span>
                            </button>

                            <div class="login-modal-right">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="login" role="tabpanel">
                                        <form action="#" method="post">
                                            @csrf
                                            <h5 class="heading-design-h5">Login to your account</h5>
                                            <fieldset class="form-group">
                                                <label>Enter Email/Mobile number</label>
                                                <input type="text" class="form-control" name="mobile" placeholder="+91 123 456 7890">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Enter Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="********">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Enter to your account</button>
                                            </fieldset>
                                            {{--<div class="login-with-sites text-center">--}}
                                            {{--<p>or Login with your social profile:</p>--}}
                                            {{--<button class="btn-facebook login-icons btn-lg"><i class="mdi mdi-facebook"></i> Facebook</button>--}}
                                            {{--<button class="btn-google login-icons btn-lg"><i class="mdi mdi-google"></i> Google</button>--}}
                                            {{--<button class="btn-twitter login-icons btn-lg"><i class="mdi mdi-twitter"></i> Twitter</button>--}}
                                            {{--</div>--}}
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                {{--<label class="custom-control-label" for="customCheck1">Remember me</label>--}}
                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane" id="register" role="tabpanel">
                                        <h5 class="heading-design-h5">Register Now!</h5>
                                        <form action="{{route('CustomerRegistartionPost')}}" method="post">
                                            @csrf
                                            <fieldset class="form-group">
                                                <label>Enter Email/Mobile number</label>
                                                <input type="text" name="mobile" id="regis_mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="+91 123 456 7890">
                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                               </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Enter Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                               </span>
                                                @enderror

                                            </fieldset>
                                            <fieldset class="form-group">
                                                <label>Enter Confirm Password </label>
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="********">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                            </fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">I Agree with <a href="#">Term and Conditions</a></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                                <div class="clearfix"></div>
                                <div class="text-center login-footer-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><i class="mdi mdi-lock"></i> LOGIN</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#register" role="tab"><i class="mdi mdi-pencil"></i> REGISTER</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-light navbar-expand-lg bg-white bg-faded osahan-menu">
    <div class="container">
        <a class="navbar-brand" href="{{route('MainIndex')}}"> <img src="{{(@$Logo->logo)?url('upload/Client/Logo/'.$Logo->logo):''}}" alt="logo"> </a>
        <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNavDropdown">

            <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                <div class="top-categories-search">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search for jewelery" onfocus="ShowSearchResult()" onblur="HideSearchResult()" id="searchs"  aria-label="Search for jewelery" type="text">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button"><i class="mdi mdi-file-find"></i> Search</button>
                        </span>
                        <div id="filterProductShow" style="background:white;z-index:9999;width:100%;top:100%;left:0;margin-top:2px;position: absolute;"></div>
                    </div>

                </div>



            </div>
            <div class="my-2 my-lg-0">
                <ul class="list-inline main-nav-right">


                    @if(\Illuminate\Support\Facades\Session::has('customer_id'))

                        <li class="list-inline-item dropdown osahan-top-dropdown">
                            <a class="btn btn-theme-round dropdown-toggle dropdown-toggle-top-user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img alt="logo" src="{{(@$custo_info->image)?url('upload/Client/Customer_Profile/'.$custo_info->image):url('fontend/demo.jpg')}}">
                                <strong>Hi</strong> {{\Illuminate\Support\Facades\Session::get('customer_name')}} </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-list-design">
                                <a href="{{route('CustomerDashboard')}}" class="dropdown-item">
                                    <i aria-hidden="true" class="mdi mdi-home-outline"></i> My Dashboard </a>
                                <a href="{{route('CustomerDashboard')}}" class="dropdown-item">
                                    <i aria-hidden="true" class="mdi mdi-map-marker-circle"></i> My Profile </a>

                                <a href="{{route('customerOrderList')}}" class="dropdown-item">
                                    <i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i> Order List </a>

                                <a href="{{route('customerWishList')}}" class="dropdown-item">
                                    <i aria-hidden="true" class="mdi mdi-heart"></i> WishList </a>


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('CustomerLogout',base64_encode(\Illuminate\Support\Facades\Session::get('customer_id')))}}">
                                    <i class="mdi mdi-lock"></i> Logout </a>
                            </div>
                        </li>
                    @else

                        <li class="list-inline-item">
                            <a href="{{route('CustomerLoginPage')}}" data-target="#"  class="btn btn-link border-left"><i class="mdi mdi-account-circle"></i> Login/Sign Up</a>
                        </li>

                    @endif




                    <li class="list-inline-item cart-btn">
                        <a href="{{route('ShoppingCart')}}"  class="btn btn-link"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value" id="smallcart"></small></a>
                    </li>


                    <li class="list-inline-item cart-btn">
                        <a href="#"  data-toggle="modal" data-target="#modal1"  class="btn btn-link"><i class="mdi mdi-map-marker-circle"></i> Order Traking </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-dark osahan-menu-2 pad-none-mobile">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link shop" href="{{route('MainIndex')}}"><span class="mdi mdi-store"></span> Home</a>
                </li>



                @foreach($main as $main_menu)
                    <?php
                    $submenus = App\Models\Admin\Menu::where('root_id',$main_menu->id)
                        ->where('sroot_id',NULL);
                    if($submenus->count() > 0){
                        $class='dropdown-toggle';
                    }
                    else{
                        $class='';

                    }

                    ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link <?php echo $class;?>" href="@if($main_menu->page_type =='url') {{$main_menu->external_link}} @else {{route('page.details',$main_menu->slug)}} @endif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$main_menu->menu_name}}
                        </a>
                        @if($submenus->count() > 0)

                            <div class="dropdown-menu">
                                @foreach($submenus->get() as $smenus)
                                    <?php $thirdmenus = App\Models\Admin\Menu::where('sroot_id',$smenus->id)
                                        ->where('troot_id',NULL);?>
                                    <a class="dropdown-item" href="@if($smenus->page_type =='url') {{$smenus->external_link}} @else {{route('page.details',$smenus->slug)}} @endif"><i class="mdi mdi-chevron-right" aria-hidden="true"></i>{{ $smenus->menu_name }} </a>


                                @endforeach
                            </div>

                        @endif
                    </li>


                @endforeach


            <!-- <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Pages
                   </a>
                   <div class="dropdown-menu">
                      <a class="dropdown-item" href="shop.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shop Grid</a>
                      <a class="dropdown-item" href="single.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Single Product</a>
                      <a class="dropdown-item" href="cart.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Shopping Cart</a>
                      <a class="dropdown-item" href="checkout.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Checkout</a>
                   </div>
                </li>
                <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   My Account
                   </a>
                   <div class="dropdown-menu">
                      <a class="dropdown-item" href="my-profile.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Profile</a>
                      <a class="dropdown-item" href="my-address.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Address</a>
                      <a class="dropdown-item" href="wishlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Wish List </a>
                      <a class="dropdown-item" href="orderlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Order List</a>
                   </div>
                </li>
                <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   More Pages
                   </a>
                   <div class="dropdown-menu">
                      <a class="dropdown-item" href="about.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> About Us</a>
                      <a class="dropdown-item" href="contact.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Contact Us</a>
                      <a class="dropdown-item" href="faq.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> FAQ </a>
                      <a class="dropdown-item" href="not-found.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> 404 Error</a>
                   </div>
                </li> -->
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="contact.html">Contact</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</nav>


<!-------Traking Modal Section---------->

<div class="modal fade" id="modal1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="font-family: cursive;">Please Enter Your Order Id Number</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> <!-- Modal body -->
            <div class="modal-body">
                <div class="container">

                    <form action="{{route('OrderTraking')}}" id="orderTrack" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <lable>Order Id</lable>
                                <input type="text" class="form-control" name="OrderId" id="OrderId" placeholder="Enter Your Order Number 00000">
                            </div>
                        </div>
                        <div class="modal-footer"> <button type="submit" class="btn">Track order</button> </div>
                    </form>
                </div>



                <div class="container" id="showallinfo" style="display: none;">

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="pull-left" style="font-family: cursive;">Traking Details:</h5> <h5 class="pull-right"><span style="color:red">OrderId</span>: #<span id="OrderNumber"></span></h5>
                        </div>

                        <div class="col-md-12">
                            <p id="customer_name" style="font-size: 17px;font-family: 'Material Design Icons';">Customer Info :</p>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-striped">

                                <tr>
                                    <th>Name</th>
                                    <td><span id="customerNameAjax"></span></td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td><span id="customerEmailAjax"></span></td>
                                </tr>

                                <tr>
                                    <th>Mobile</th>
                                    <td><span id="customerMobileAjax"></span></td>
                                </tr>



                            </table>
                        </div>

                        <div class="col-md-12">
                            <p id="customer_name" style="font-size: 17px;font-family: 'Material Design Icons';">Track:</p>
                        </div>

                        <div class="col-md-12">
                            <div class="track">
                                <div id="orderst" class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                                <div id="shipping_st" class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div id="final_oder" class="step"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            </div>
                            <hr>
                        </div>

                    </div>
                </div>


            </div> <!-- Modal footer -->

        </div>
    </div>
</div>


<input type="hidden" id="order_confirm" class="order_confirm" >
<input type="hidden" id="shipping_status" class="shipping_status" >
<input type="hidden" id="final_step" class="final_step" >

<!-------Modal Cart Sesction Small------->
{{--<div class="cart-sidebar">--}}
{{--<div class="cart-sidebar-header">--}}
{{--<h5>--}}
{{--My Carts <span class="text-success">(<small id="cartCount"></small> item)</span> <a data-toggle="offcanvas" class="float-right" href="#">--}}
{{--<i class="mdi mdi-close"></i>--}}
{{--</a>--}}
{{--</h5>--}}
{{--</div>--}}

{{--<div class="cart-sidebar-body">--}}

{{--<table id="cart" class="table table-striped">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th class="first">Img</th>--}}
{{--<th class="second">Qty</th>--}}
{{--<th class="third">name</th>--}}
{{--<th class="fourth">Total</th>--}}
{{--<th class="fifth">Remove</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody id="cardmini">--}}

<!-- shopping cart contents -->
{{--<tr class="">--}}
{{--<!-- http://www.inkydeals.com/deal/ginormous-bundle/ -->--}}
{{--<td><img src="https://i.imgur.com/8goC6r6.png" class="thumb"></td>--}}
{{--<td>1</td>--}}
{{--<td>Design Bundle Package</td>--}}
{{--<td>$79.00</td>--}}
{{--<td><i class="fa fa-times"></i></td>--}}
{{--</tr>--}}





{{--</tbody>--}}
{{--</table>--}}

{{--</div>--}}


{{--<div class="cart-sidebar-footer">--}}
{{--<div class="cart-store-details">--}}
{{--<p>Sub Total <strong class="float-right">$900.69</strong></p>--}}
{{--<p>Total <strong class="float-right">$900.69</strong></p>--}}
{{--</div>--}}
{{--<a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong>$1200.69</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>--}}
{{--</div>--}}
{{--</div>--}}


{{--onfocus="ShowSearchResult()" onblur="HideSearchResult()"--}}

@section('client-footer')


    <script>
        $('#orderTrack').submit(function(e){
            e.preventDefault();

            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();


            var a = document.forms["orderTrack"]["OrderId"].value;

            if (a == null || a == "") {
                alert('null');
            }else{


                $.ajax({
                    url:url,
                    type:method,
                    data:data,

                    success:function(data){

                        $('#showallinfo').css({
                            "display":"block"
                        })
                        $('#OrderNumber').empty().html(data['order'].orderId);
                        $('#customerNameAjax').empty().html(data['customer_info'].name);
                        $('#customerEmailAjax').empty().html(data['customer_info'].email);
                        $('#customerMobileAjax').empty().html(data['customer_info'].mobile);

                        //----------------- Order Status ---------------
                        $('#order_confirm').val(data['order'].status);
                        var confi = $('.order_confirm').val();

                        if(confi==2){
                            $('#orderst').addClass('active');
                        }else if(confi==1){
                            $('#orderst').removeClass('active');
                        }

                        //----------------- Shipping Status ---------------
                        $('#shipping_status').val(data['order'].shipping_status);
                        var shi_confi = $('.shipping_status').val();

                        if(shi_confi==2){
                            $('#shipping_st').addClass('active');
                        }else if(shi_confi==1){
                            $('#shipping_st').removeClass('active');
                        }


                        //----------------- Final Status ---------------
                        $('#final_step').val(data['order'].order_complete);
                        var final_step = $('.final_step').val();

                        if(final_step==2){
                            $('#final_oder').addClass('active');
                        }else if(final_step==1){
                            $('#final_oder').removeClass('active');
                        }



                    }
                });

            }


        });
    </script>


    <script>
        $("body").on("keyup","#searchs",function(){

            let Searchval = $(this).val();
            if(Searchval.length >0){

                $.ajax({
                    url:"{{route('FilterSearchProd')}}",
                    type:"get",
                    data:{Searchval:Searchval},
                    success:function(data){

                        $('#filterProductShow').empty().html(data);

                    }
                })
            }

            if(Searchval.length <1){
                $('#filterProductShow').empty().html("");
            }
            //  console.log(val);
        })
    </script>



    <script>
        function ShowSearchResult(){
            $('#filterProductShow').fadeIn();
        }


        function HideSearchResult(){
            $('#filterProductShow').fadeOut();
        }
    </script>




@endsection